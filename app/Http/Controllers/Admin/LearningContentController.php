<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LearningContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LearningContentController extends Controller
{
    public function index()
    {
        $contents = LearningContent::latest()->paginate(10);
        return view('admin.learning_contents.index', compact('contents'));
    }

    public function create()
    {
        return view('admin.learning_contents.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'kategori' => 'required',
            'deskripsi' => 'nullable',
            'isi' => 'required',
            'gambar' => 'nullable|image|max:2048',
            'audio' => 'nullable|mimes:mp3,wav,aac|max:10240',
        ]);

        $gambar = null;
        $audio = null;

        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar')->store('gambar', 'public');
        }

        if ($request->hasFile('audio')) {
            $audio = $request->file('audio')->store('audio', 'public');
        }

        LearningContent::create([
            'judul' => $request->judul,
            'kategori' => $request->kategori,
            'deskripsi' => $request->deskripsi,
            'isi' => $request->isi,
            'gambar' => $gambar,
            'audio' => $audio,
        ]);

        return redirect()->route('admin.learning-contents.index')
            ->with('success', 'Konten pembelajaran berhasil ditambahkan!');
    }

    public function show($id)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Akses ditolak!');
        }
        $content = LearningContent::findOrFail($id);
        return view('admin.learning_contents.show', compact('content'));
    }

    public function edit($id)
    {
        $content = LearningContent::findOrFail($id);
        return view('admin.learning_contents.edit', compact('content'));
    }

    public function update(Request $request, $id)
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
            $gambar = $request->file('gambar')->store('gambar', 'public');
        }

        if ($request->hasFile('audio')) {
            $audio = $request->file('audio')->store('audio', 'public');
        }

        $content->update([
            'judul' => $request->judul,
            'kategori' => $request->kategori,
            'deskripsi' => $request->deskripsi,
            'isi' => $request->isi,
            'gambar' => $gambar,
            'audio' => $audio,
        ]);

        return redirect()->route('admin.learning-contents.index')
            ->with('success', 'Konten pembelajaran berhasil diupdate!');
    }

    public function destroy($id)
    {
        $content = LearningContent::findOrFail($id);
        $content->delete();

        return redirect()->route('admin.learning-contents.index')
            ->with('success', 'Konten pembelajaran berhasil dihapus!');
    }
}
