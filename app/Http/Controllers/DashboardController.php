<?php

namespace App\Http\Controllers;

use App\Models\Children;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil ID anak dari session, atau jika tidak ada ambil anak pertama
        $childId = session('active_child_id');
        
        // Query anak milik user yang login
        $query = Children::with([
            'dailyTodos',
            'journals',
            'childMilestones.milestone'
        ])->where('user_id', Auth::id());
        
        // Jika ada session child_id, ambil anak tersebut, jika tidak ambil pertama
        if ($childId) {
            $child = $query->where('id', $childId)->first();
        } else {
            $child = $query->first();
        }

        // Jika data anak belum ada, semua persentase diatur ke 0
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

        // HITUNG PERSENTASE DI SINI (ANTI ERROR DIVISION BY ZERO)
        $taskProgressPercent = $totalTasks > 0 ? round(($completedTasks / $totalTasks) * 100) : 0;

        $completedMilestones = $child->childMilestones->where('status', 'tercapai')->count();
        $totalMilestones = $child->childMilestones->count();

        $milestoneProgressPercent = $totalMilestones > 0
            ? round(($completedMilestones / $totalMilestones) * 100)
            : 0;

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
    
    // Method untuk ganti anak aktif
    public function switchChild($id)
    {
        // Cek apakah anak dengan id ini milik user yang login
        $child = Children::where('user_id', Auth::id())->where('id', $id)->first();
        
        if ($child) {
            // Simpan id anak ke session
            session(['active_child_id' => $child->id]);
        }
        
        // Redirect ke dashboard
        return redirect()->route('dashboard');
    }
}