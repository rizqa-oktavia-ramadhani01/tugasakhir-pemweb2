<?php

namespace App\Http\Controllers;

use App\Models\Children;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $child = Children::with([
            'dailyTodos',
            'journals',
            'childMilestones.milestone'
        ])
        ->where('user_id', Auth::id())
        ->first();

        if (!$child) {
            return view('dashboard.dashboard', [
                'child' => null
            ]);
        }

        $completedTasks =
            $child->dailyTodos
                  ->where('status', 'completed')
                  ->count();

        $totalTasks =
            $child->dailyTodos->count();

        $completedMilestones =
            $child->childMilestones
                  ->where('status', 'tercapai')
                  ->count();

        $totalMilestones =
            $child->childMilestones->count();

        $milestoneProgressPercent =
            $totalMilestones > 0
                ? round(
                    ($completedMilestones / $totalMilestones) * 100
                  )
                : 0;

        return view(
            'dashboard.dashboard',
            compact(
                'child',
                'completedTasks',
                'totalTasks',
                'completedMilestones',
                'totalMilestones',
                'milestoneProgressPercent'
            )
        );
    }
}