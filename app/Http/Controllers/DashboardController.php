<?php

namespace App\Http\Controllers;

use App\Models\Children;
use App\Models\Activity;
use App\Models\ActivityLog;
use App\Models\DailyTodo;
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
                'completedMilestones' => 0,
                'totalMilestones' => 0,
                'milestoneProgressPercent' => 0
            ]);
        }

        $completedTasks = $child->dailyTodos->where('status', 'completed')->count();
        $totalTasks = $child->dailyTodos->count();
        $taskProgressPercent = $totalTasks > 0 ? round(($completedTasks / $totalTasks) * 100) : 0;

        $completedMilestones = $child->childMilestones->where('status', 'tercapai')->count();
        $totalMilestones = $child->childMilestones->count();
        $milestoneProgressPercent = $totalMilestones > 0 ? round(($completedMilestones / $totalMilestones) * 100) : 0;

        return view('dashboard.dashboard', compact(
            'child',
            'completedTasks',
            'totalTasks',
            'taskProgressPercent',
            'completedMilestones',
            'totalMilestones',
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
