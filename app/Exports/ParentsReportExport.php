<?php

namespace App\Exports;

use App\Models\User;
use App\Models\Children;
use App\Models\ActivityLog;
use App\Models\ParentJournal;
use App\Models\ChildMilestone;
use App\Models\Milestone;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ParentsReportExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        // Ambil semua user dengan role parent
        return User::where('role', 'parent')->with('children')->get();
    }
    
    public function headings(): array
    {
        return [
            'ID Parent',
            'Nama Parent',
            'Email',
            'Tanggal Daftar',
            'Nama Anak',
            'Usia Anak',
            'Total Aktivitas Selesai',
            'Total Jurnal',
            'Streak (Hari Beruntun)',
            'Konsistensi (%)',
            'Progres Milestone (%)',
            'Total Kata Baru',
            'Kata Baru (Unik)',
            'Terakhir Aktif',
        ];
    }
    
    public function map($user): array
    {
        $child = $user->children->first();
        
        $totalAktivitas = 0;
        $streak = 0;
        $konsistensi = 0;
        $milestonePercent = 0;
        $totalKataBaru = 0;
        $uniqueKata = [];
        $lastActive = null;
        
        if ($child) {
            // Total aktivitas selesai
            $totalAktivitas = ActivityLog::where('child_id', $child->id)
                ->where('selesai', true)
                ->count();
            
            // Streak
            $streak = $this->calculateStreak($child->id);
            
            // Konsistensi
            $konsistensi = $this->calculateConsistency($child->id);
            
            // Progress milestone
            $milestonePercent = $this->calculateMilestoneProgress($child->id);
            
            // Total kata baru
            $journals = ParentJournal::where('child_id', $child->id)->get();
            foreach ($journals as $journal) {
                if ($journal->kata_baru) {
                    $kataArray = explode(',', $journal->kata_baru);
                    foreach ($kataArray as $kata) {
                        $kata = trim($kata);
                        if (!empty($kata)) {
                            $totalKataBaru++;
                            $uniqueKata[] = $kata;
                        }
                    }
                }
            }
            
            // Terakhir aktif
            $lastJournal = ParentJournal::where('child_id', $child->id)->orderBy('tanggal', 'desc')->first();
            $lastActivity = ActivityLog::where('child_id', $child->id)->orderBy('tanggal', 'desc')->first();
            
            if ($lastJournal && $lastActivity) {
                $lastActive = max($lastJournal->tanggal, $lastActivity->tanggal);
            } elseif ($lastJournal) {
                $lastActive = $lastJournal->tanggal;
            } elseif ($lastActivity) {
                $lastActive = $lastActivity->tanggal;
            }
        }
        
        return [
            $user->id,
            $user->name,
            $user->email,
            $user->created_at ? $user->created_at->format('d/m/Y') : '-',
            $child ? $child->nama_anak : '-',
            $child ? $child->usia_anak . ' Tahun' : '-',
            $totalAktivitas,
            $child ? ParentJournal::where('child_id', $child->id)->count() : 0,
            $streak,
            round($konsistensi * 100),
            $milestonePercent,
            $totalKataBaru,
            implode(', ', array_unique($uniqueKata)),
            $lastActive ? date('d/m/Y', strtotime($lastActive)) : '-',
        ];
    }
    
    private function calculateStreak($childId)
    {
        $streak = 0;
        $date = now();
        $targetPerHari = 3;
        
        while (true) {
            $completedCount = ActivityLog::where('child_id', $childId)
                ->where('tanggal', $date->format('Y-m-d'))
                ->where('selesai', true)
                ->count();
            
            if ($completedCount >= $targetPerHari) {
                $streak++;
                $date->subDay();
            } else {
                break;
            }
        }
        
        return $streak;
    }
    
    private function calculateConsistency($childId)
    {
        $totalDays = 30;
        $completedDays = 0;
        
        for ($i = 0; $i < $totalDays; $i++) {
            $date = now()->subDays($i);
            
            $hasActivity = ActivityLog::where('child_id', $childId)
                ->where('tanggal', $date->format('Y-m-d'))
                ->where('selesai', true)
                ->exists();
            
            $hasJournal = ParentJournal::where('child_id', $childId)
                ->where('tanggal', $date->format('Y-m-d'))
                ->exists();
            
            if ($hasActivity || $hasJournal) {
                $completedDays++;
            }
        }
        
        return $completedDays / $totalDays;
    }
    
    private function calculateMilestoneProgress($childId)
    {
        $child = Children::find($childId);
        if (!$child) return 0;
        
        $usiaTahun = $child->usia_anak ?? 2;
        
        if ($usiaTahun >= 1 && $usiaTahun < 2) {
            $kategoriUsia = '1-2 Tahun';
        } elseif ($usiaTahun >= 2 && $usiaTahun < 3) {
            $kategoriUsia = '2-3 Tahun';
        } elseif ($usiaTahun >= 3 && $usiaTahun < 4) {
            $kategoriUsia = '3-4 Tahun';
        } elseif ($usiaTahun >= 4 && $usiaTahun < 5) {
            $kategoriUsia = '4-5 Tahun';
        } else {
            $kategoriUsia = '5+ Tahun';
        }
        
        $milestones = Milestone::where('kategori_usia', $kategoriUsia)->get();
        
        if ($milestones->isEmpty()) {
            return 0;
        }
        
        $totalMilestones = $milestones->count();
        $completedMilestones = ChildMilestone::where('child_id', $childId)
            ->whereIn('milestone_id', $milestones->pluck('id'))
            ->where('status', 'tercapai')
            ->count();
        
        return $totalMilestones > 0 ? round(($completedMilestones / $totalMilestones) * 100) : 0;
    }
}