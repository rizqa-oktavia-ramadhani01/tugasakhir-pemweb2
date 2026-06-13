<?php

namespace App\Http\Controllers;

use App\Models\Children;
use App\Models\Activity;
use App\Models\ActivityLog;
use App\Models\ParentJournal;
use App\Models\Milestone;
use App\Models\ChildMilestone;
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
        // Hitung langsung jumlah aktivitas yang selesai hari ini
        $hariIni = ActivityLog::where('child_id', $child->id)
            ->whereDate('tanggal', today())
            ->where('selesai', true)
            ->count();

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

    public function toggleMilestone(Request $request)
    {
        $request->validate([
            'milestone_id' => 'required|exists:milestones,id',
            'status' => 'required|in:belum_tercapai,tercapai'
        ]);

        $childId = session('active_child_id');

        ChildMilestone::updateOrCreate(
            [
                'child_id' => $childId,
                'milestone_id' => $request->milestone_id
            ],
            [
                'status' => $request->status,
                'tanggal_tercapai' => $request->status == 'tercapai' ? now()->toDateString() : null
            ]
        );

        return redirect()->back()->with('success', 'Status milestone diperbarui!');
    }

    // Hitung streak hari beruntun (aktivitas selesai)
    private function calculateStreak($childId)
    {
        $streak = 0;
        $date = now();
        $targetPerHari = 3;

        while (true) {
            // Hitung berapa aktivitas yang SELESAI pada tanggal tersebut
            $completedCount = ActivityLog::where('child_id', $childId)
                ->where('tanggal', $date->format('Y-m-d'))
                ->where('selesai', true)
                ->count();

            // Streak bertambah hanya jika SEMUA 3 aktivitas selesai (completedCount == 3)
            if ($completedCount >= $targetPerHari) {
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
            'items' => $milestones->map(function ($m) use ($childId) {
                $childMilestone = ChildMilestone::where('child_id', $childId)
                    ->where('milestone_id', $m->id)
                    ->first();
                return [
                    'milestone' => $m->milestone,
                    'deskripsi' => $m->deskripsi,
                    'status' => $childMilestone->status ?? 'belum_tercapai',
                    'milestone_id' => $m->id,
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
                $totalKata += count(array_filter($kataArray, function ($k) {
                    return trim($k) != '';
                }));
            }
        }

        return $totalKata;
    }
}
