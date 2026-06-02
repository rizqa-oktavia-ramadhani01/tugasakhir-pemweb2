<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Activity;
use App\Models\LearningContent;

class DashboardController extends Controller
{
    public function index()
    {
        $totalParents = User::where('role', 'parent')->count();
        $totalActivities = Activity::count();
        $totalContents = LearningContent::count();

        return view('admin.dashboard', compact('totalParents', 'totalActivities', 'totalContents'));
    }
}