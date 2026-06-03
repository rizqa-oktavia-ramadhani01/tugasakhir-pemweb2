<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActivityController extends Controller
{
    public function index()
    {
        $activities = Activity::latest()->paginate(10);
        return view('admin.activities.index', compact('activities'));
    }

    public function create()
    {
        return view('admin.activities.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'kategori' => 'required',
            'durasi_menit' => 'nullable|integer',
            'deskripsi' => 'required',
            'panduan' => 'nullable',
        ]);

        Activity::create($request->all());

        return redirect()->route('admin.activities.index')
            ->with('success', 'Activity berhasil ditambahkan!');
    }

    public function show($id)
    {
        if (Auth::user()->role !== 'admin') {  // ← pakai Auth::user()
            abort(403, 'Akses ditolak!');
        }
        $activity = Activity::findOrFail($id);
        return view('admin.activities.show', compact('activity'));
    }

    public function edit($id)
    {
        $activity = Activity::findOrFail($id);
        return view('admin.activities.edit', compact('activity'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required',
            'kategori' => 'required',
            'durasi_menit' => 'nullable|integer',
            'deskripsi' => 'required',
            'panduan' => 'nullable',
        ]);

        $activity = Activity::findOrFail($id);
        $activity->update($request->all());

        return redirect()->route('admin.activities.index')
            ->with('success', 'Activity berhasil diupdate!');
    }

    public function destroy($id)
    {
        $activity = Activity::findOrFail($id);
        $activity->delete();

        return redirect()->route('admin.activities.index')
            ->with('success', 'Activity berhasil dihapus!');
    }
}
