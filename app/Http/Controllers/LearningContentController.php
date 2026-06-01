<?php

namespace App\Http\Controllers;

use App\Models\LearningContent;
use Illuminate\Http\Request;

class LearningContentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contents = LearningContent::all();

        return view('learning_contents.index', compact('contents'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('learning_contents.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'kategori' => 'required',
            'deskripsi' => 'required',
            'isi' => 'required',
            'gambar' => 'nullable|image',
            'audio' => 'nullable|mimes:mp3,wav,aac',
        ]);

        $gambar = null;
        $audio = null;

        if ($request->hasFile('gambar')) {

            $gambar = $request->file('gambar')
                ->store('gambar', 'public');
        }

        if ($request->hasFile('audio')) {

            $audio = $request->file('audio')
                ->store('audio', 'public');
        }

        LearningContent::create([
            'judul' => $request->judul,
            'kategori' => $request->kategori,
            'deskripsi' => $request->deskripsi,
            'isi' => $request->isi,
            'gambar' => $gambar,
            'audio' => $audio,
        ]);

        return redirect()
            ->route('learning-contents.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $content = LearningContent::findOrFail($id);

        return view('learning_contents.show', compact('content'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $content = LearningContent::findOrFail($id);

        return view('learning_contents.edit', compact('content'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'judul' => 'required',
            'kategori' => 'required',
            'deskripsi' => 'required',
            'isi' => 'required',
            'gambar' => 'nullable|image',
            'audio' => 'nullable|mimes:mp3,wav,aac',
        ]);

        $content = LearningContent::findOrFail($id);

        $gambar = $content->gambar;
        $audio = $content->audio;

        if ($request->hasFile('gambar')) {

            $gambar = $request->file('gambar')
                ->store('gambar', 'public');
        }

        if ($request->hasFile('audio')) {

            $audio = $request->file('audio')
                ->store('audio', 'public');
        }

        $content->update([
            'judul' => $request->judul,
            'kategori' => $request->kategori,
            'deskripsi' => $request->deskripsi,
            'isi' => $request->isi,
            'gambar' => $gambar,
            'audio' => $audio,
        ]);

        return redirect()
            ->route('learning-contents.index')
            ->with('success', 'Data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $content = LearningContent::findOrFail($id);

        $content->delete();

        return redirect()->route('learning-contents.index');
    }
}
