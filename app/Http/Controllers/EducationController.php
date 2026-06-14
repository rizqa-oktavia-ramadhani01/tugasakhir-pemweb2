<?php

namespace App\Http\Controllers;

use App\Models\Education;

class EducationController extends Controller
{
    public function index()
    {
        $educations = Education::latest()->get();

        return view('parent_journals.education', compact('educations'));
    }

    public function show($id)
    {
        $education = Education::findOrFail($id);

        return view('parent_journals.education-detail', compact('education'));
    }
}