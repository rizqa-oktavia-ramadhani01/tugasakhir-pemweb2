<?php

namespace App\Http\Controllers;

use App\Models\Children;
use App\Models\Activity;
use App\Models\ActivityLog;
use App\Models\DailyTodo;
use App\Models\Milestone;
use App\Models\ChildMilestone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    public function index()
    {
        $childId = session('active_child_id');

        $query = Children::with([
            'dailyTodos',
            'journals',
            'childMilestones.milestone'
        ])->where('user_id', Auth::id());

        if ($childId) {
            $child = $query->where('id', $childId)->first();
        } else {
            $child = $query->first();
        }

        if (!$child) {
            return view('dashboard.dashboard', [
                'child' => null,
                'completedTasks' => 0,
                'totalTasks' => 0,
                'taskProgressPercent' => 0,
                'milestoneProgressPercent' => 0
            ]);
        }

        // ========== AKTIVITAS HARIAN ==========
        // Total aktivitas hari ini (dari daily_todos)
        $totalTasks = DailyTodo::where('child_id', $child->id)
            ->where('tanggal', today())
            ->count();

        // Aktivitas yang sudah selesai (dari activity_logs)
        $completedTasks = ActivityLog::where('child_id', $child->id)
            ->whereDate('tanggal', today())
            ->where('selesai', true)
            ->count();

        $taskProgressPercent = $totalTasks > 0 ? round(($completedTasks / $totalTasks) * 100) : 0;

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

        if ($milestones->isEmpty()) {
            $milestones = Milestone::where('kategori_usia', '5+ Tahun')->get();
        }

        $totalMilestones = $milestones->count();
        $completedMilestones = ChildMilestone::where('child_id', $child->id)
            ->whereIn('milestone_id', $milestones->pluck('id'))
            ->where('status', 'tercapai')
            ->count();

        $milestoneProgressPercent = $totalMilestones > 0 ? round(($completedMilestones / $totalMilestones) * 100) : 0;

        return view('dashboard.dashboard', compact(
            'child',
            'completedTasks',
            'totalTasks',
            'taskProgressPercent',
            'milestoneProgressPercent'
        ));
    }

    public function switchChild($id)
    {
        $child = Children::where('user_id', Auth::id())->where('id', $id)->first();

        if ($child) {
            session(['active_child_id' => $child->id]);
        }

        return redirect()->route('dashboard');
    }

    public function activities()
    {
        $childId = session('active_child_id');
        $child = Children::where('user_id', Auth::id())->where('id', $childId)->first();

        // Cek apakah sudah ada daily_todo untuk hari ini
        $dailyTodos = DailyTodo::where('child_id', $child->id)
            ->where('tanggal', today())
            ->with('activity')
            ->get();

        // Jika belum ada, buat 3 aktivitas acak untuk hari ini
        if ($dailyTodos->isEmpty()) {
            $randomActivities = Activity::inRandomOrder()->limit(3)->get();

            foreach ($randomActivities as $activity) {
                DailyTodo::create([
                    'child_id' => $child->id,
                    'tanggal' => today(),
                    'activity_id' => $activity->id,
                    'status' => 'pending'
                ]);
            }

            // Ambil ulang data yang baru dibuat
            $dailyTodos = DailyTodo::where('child_id', $child->id)
                ->where('tanggal', today())
                ->with('activity')
                ->get();
        }

        // Ambil data aktivitas dari daily_todos
        $activities = $dailyTodos->pluck('activity');
        $totalActivities = $activities->count();

        $todayLogs = ActivityLog::where('child_id', $child->id)
            ->whereDate('tanggal', today())
            ->get()
            ->keyBy('activity_id');

        $completedCount = $todayLogs->where('selesai', true)->count();
        $progress = $totalActivities > 0 ? round(($completedCount / $totalActivities) * 100) : 0;

        return view('activities.index', [
            'activities' => $activities,
            'todayLogs' => $todayLogs,
            'progress' => $progress,
            'completedCount' => $completedCount,
            'totalActivities' => $totalActivities
        ]);
    }

    public function toggleActivity(Request $request)
    {
        $log = ActivityLog::where('child_id', $request->child_id)
            ->where('activity_id', $request->activity_id)
            ->whereDate('tanggal', today())
            ->first();

        if ($log) {
            $log->update(['selesai' => $request->selesai]);
        } else {
            ActivityLog::create([
                'child_id' => $request->child_id,
                'activity_id' => $request->activity_id,
                'tanggal' => today(),
                'user_id' => Auth::id(),
                'selesai' => $request->selesai
            ]);
        }

        return redirect()->back();
    }
}
