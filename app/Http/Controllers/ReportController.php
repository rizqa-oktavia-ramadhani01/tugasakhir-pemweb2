<?php

namespace App\Http\Controllers;

use App\Models\Children;
use App\Models\Activity;
use App\Models\ActivityLog;
use App\Models\ParentJournal;
use App\Models\Milestone;
use App\Models\ChildMilestone;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function generate(Request $request)
    {
        // Ambil anak aktif dari session
        $childId = session('active_child_id');
        $child = Children::where('user_id', Auth::id())->where('id', $childId)->first();
        
        if (!$child) {
            return redirect()->back()->with('error', 'Silakan pilih anak terlebih dahulu');
        }
        
        // ========== DATA AKTIVITAS HARIAN (30 hari terakhir) ==========
        $activities = Activity::all();
        $totalActivities = $activities->count();
        
        $dailyProgress = [];
        for ($i = 29; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $completed = ActivityLog::where('child_id', $child->id)
                ->whereDate('tanggal', $date)
                ->where('selesai', true)
                ->count();
            
            $dailyProgress[] = [
                'tanggal' => $date->format('d/m/Y'),
                'selesai' => $completed,
                'total' => $totalActivities,
            ];
        }
        
        // ========== STREAK ==========
        $streak = $this->calculateStreak($child->id);
        
        // ========== KONSISTENSI ==========
        $consistencyScore = $this->calculateConsistency($child->id);
        $consistencyPercent = round($consistencyScore * 100);
        
        // ========== PROGRES MILESTONE ==========
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
        $totalMilestones = $milestones->count();
        $completedMilestones = ChildMilestone::where('child_id', $child->id)
            ->whereIn('milestone_id', $milestones->pluck('id'))
            ->where('status', 'tercapai')
            ->count();
        
        $milestonePercent = $totalMilestones > 0 ? round(($completedMilestones / $totalMilestones) * 100) : 0;
        
        // ========== KATA BARU (dari jurnal) ==========
        $journals = ParentJournal::where('child_id', $child->id)
            ->orderBy('tanggal', 'desc')
            ->get();
        
        $allKataBaru = [];
        foreach ($journals as $journal) {
            if ($journal->kata_baru) {
                $kataArray = explode(',', $journal->kata_baru);
                foreach ($kataArray as $kata) {
                    $kata = trim($kata);
                    if (!empty($kata)) {
                        $allKataBaru[] = $kata;
                    }
                }
            }
        }
        $uniqueKataBaru = array_unique($allKataBaru);
        
        // ========== TOTAL SESI ==========
        $totalSesi = ActivityLog::where('child_id', $child->id)
            ->where('selesai', true)
            ->count();
        
        // ========== TOTAL JURNAL ==========
        $totalJurnal = ParentJournal::where('child_id', $child->id)->count();
        
        // Data untuk PDF
        $data = [
            'child' => $child,
            'streak' => $streak,
            'consistencyPercent' => $consistencyPercent,
            'totalSesi' => $totalSesi,
            'totalJurnal' => $totalJurnal,
            'milestonePercent' => $milestonePercent,
            'completedMilestones' => $completedMilestones,
            'totalMilestones' => $totalMilestones,
            'dailyProgress' => $dailyProgress,
            'journals' => $journals,
            'uniqueKataBaru' => $uniqueKataBaru,
            'generated_at' => now()->format('d F Y H:i:s'),
        ];
        
        // Generate PDF
        $pdf = Pdf::loadView('reports.parent-report', $data);
        $pdf->setPaper('a4', 'portrait');
        
        // Download PDF
        return $pdf->download('raport_' . $child->nama_anak . '_' . now()->format('Ymd') . '.pdf');
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
}