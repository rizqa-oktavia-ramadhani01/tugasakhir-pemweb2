<?php

namespace App\Http\Controllers;

use App\Models\Children;
use App\Models\Activity;
use App\Models\ActivityLog;
use App\Models\ParentJournal;
use App\Models\ChildMilestone;
use App\Models\Milestone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProgressController extends Controller
{
    public function index()
    {
        // Ambil anak aktif dari session
        $childId = session('active_child_id');
        $child = null;
        
        if ($childId && Auth::check()) {
            $child = Children::where('user_id', Auth::id())
                ->where('id', $childId)
                ->first();
        }
        
        if (!$child) {
            return redirect()->route('children.index')->with('error', 'Silakan pilih anak terlebih dahulu');
        }
        
        // ========== STREAK ORTU (Hari Beruntun) ==========
        $streak = $this->calculateStreak($child->id);
        
        // ========== METRIK KONSISTENSI (Rapor Komitmen Ortu) ==========
        $consistencyScore = $this->calculateConsistency($child->id);
        $consistencyPercent = round($consistencyScore * 100);
        
        // Bandingkan dengan rata-rata (contoh: 74% lebih baik dari rata-rata)
        $averagePercent = 55;
        $betterThan = $consistencyPercent > $averagePercent ? round($consistencyPercent - $averagePercent) : 0;
        
        // ========== GRAFIK STIMULASI MINGGUAN ==========
        $weeklyData = $this->getWeeklyActivityData($child->id);
        
        // ========== TARGET IDEAL ==========
        $targetPerHari = 3;
        $hariIni = $weeklyData[6]['completed'] ?? 0;
        
        // ========== PROGRES MILESTONE ==========
        $milestoneProgress = $this->getMilestoneProgress($child->id);
        
        // ========== STATISTIK ==========
        $stats = [
            'total_kata_baru' => $this->getTotalKataBaru($child->id),
            'total_sesi' => ActivityLog::where('child_id', $child->id)
                ->where('selesai', true)
                ->count(),
            'total_jurnal' => ParentJournal::where('child_id', $child->id)->count(),
        ];
        
        return view('progress.index', compact(
            'child',
            'streak',
            'consistencyPercent',
            'betterThan',
            'weeklyData',
            'targetPerHari',
            'hariIni',
            'milestoneProgress',
            'stats'
        ));
    }
    
    // Hitung streak hari beruntun (aktivitas selesai)
    private function calculateStreak($childId)
    {
        $streak = 0;
        $date = now();
        
        while (true) {
            $hasActivity = ActivityLog::where('child_id', $childId)
                ->where('tanggal', $date->format('Y-m-d'))
                ->where('selesai', true)
                ->exists();
            
            if ($hasActivity) {
                $streak++;
                $date->subDay();
            } else {
                break;
            }
        }
        
        return $streak;
    }
    
    // Hitung skor konsistensi (dari aktivitas + jurnal)
    private function calculateConsistency($childId)
    {
        $totalDays = 30; // 30 hari terakhir
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
    
    // Data aktivitas mingguan (Senin - Minggu)
    private function getWeeklyActivityData($childId)
    {
        $data = [];
        $totalActivities = 3;
        
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->startOfWeek()->addDays($i);
            $completed = ActivityLog::where('child_id', $childId)
                ->where('tanggal', $date->format('Y-m-d'))
                ->where('selesai', true)
                ->count();
            
            $data[] = [
                'hari' => $this->getDayName($i),
                'completed' => $completed,
                'total' => $totalActivities,
                'date' => $date->format('Y-m-d'),
                'isToday' => $date->isToday(),
            ];
        }
        
        return $data;
    }
    
    private function getDayName($index)
    {
        $days = ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'];
        return $days[$index];
    }
    
    // Progres milestone berdasarkan usia anak
    private function getMilestoneProgress($childId)
    {
        $child = Children::find($childId);
        $usiaTahun = $child->usia_anak ?? 2;
        
        // Ambil milestone berdasarkan kategori usia
        $usiaCategory = $usiaTahun . '- Tahun';
        $milestones = Milestone::where('kategori_usia', 'LIKE', $usiaTahun . '%')->get();
        
        if ($milestones->isEmpty()) {
            // Fallback ke milestone 1-3 tahun
            $milestones = Milestone::where('kategori_usia', '1-3 Tahun')->get();
        }
        
        $totalMilestones = $milestones->count();
        $completedMilestones = ChildMilestone::where('child_id', $childId)
            ->whereIn('milestone_id', $milestones->pluck('id'))
            ->where('status', 'tercapai')
            ->count();
        
        $percent = $totalMilestones > 0 ? round(($completedMilestones / $totalMilestones) * 100) : 0;
        
        return [
            'percent' => $percent,
            'completed' => $completedMilestones,
            'total' => $totalMilestones,
            'items' => $milestones->map(function($m) use ($childId) {
                $status = ChildMilestone::where('child_id', $childId)
                    ->where('milestone_id', $m->id)
                    ->first();
                return [
                    'milestone' => $m->milestone,
                    'status' => $status->status ?? 'belum',
                    'deskripsi' => $m->deskripsi,
                ];
            }),
        ];
    }
    
    // Hitung total kata baru dari jurnal
    private function getTotalKataBaru($childId)
    {
        $journals = ParentJournal::where('child_id', $childId)->get();
        $totalKata = 0;
        
        foreach ($journals as $journal) {
            if ($journal->kata_baru) {
                $kataArray = explode(',', $journal->kata_baru);
                $totalKata += count(array_filter($kataArray, function($k) { return trim($k) != ''; }));
            }
        }
        
        return $totalKata;
    }
}