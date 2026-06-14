<?php

namespace App\Http\Controllers;

use App\Models\LearningContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LearningContentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Hanya untuk user yang sudah login
        $contents = LearningContent::all();
        return view('learning_contents.index', compact('contents'));
    }

    /**
     * Show the specified resource.
     */
    public function show(string $id)
    {
        $content = LearningContent::findOrFail($id);
        return view('learning_contents.show', compact('content'));
    }

    /**
     * Halaman Pelafalan (Area Anak)
     */
    public function pelafalan()
    {
        $contents = LearningContent::all();
        $child = auth()->user() ? auth()->user()->children->first() : null;
        return view('learning_contents.pelafalan', compact('contents', 'child'));
    }

    /**
     * Halaman Tantangan (Area Anak)
     */
    public function tantangan()
    {
        $contents = LearningContent::all();
        $child = auth()->user() ? auth()->user()->children->first() : null;
        return view('learning_contents.tantangan', compact('contents', 'child'));
    }

    // ========== METHOD DI BAWAH INI HANYA UNTUK ADMIN ==========
    // Tapi karena sudah ada route admin terpisah, method ini sebenarnya tidak dipakai user

    public function create()
    {
        // Hanya admin bisa akses
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403);
        }
        return view('learning_contents.create');
    }

    public function store(Request $request)
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403);
        }
        // ... kode store
    }

    public function edit(string $id)
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403);
        }
        $content = LearningContent::findOrFail($id);
        return view('learning_contents.edit', compact('content'));
    }

    public function update(Request $request, string $id)
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403);
        }
        // ... kode update
    }

    public function destroy(string $id)
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            abort(403);
        }
        $content = LearningContent::findOrFail($id);
        $content->delete();
        return redirect()->route('learning-contents.index');
    }
}