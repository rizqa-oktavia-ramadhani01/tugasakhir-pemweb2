<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Children;
use Illuminate\Support\Facades\Auth;

class ChildController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $childId = session('active_child_id');

        $child = Children::where('user_id', Auth::id())
            ->where('id', $childId)
            ->first();

        if (!$child) {
            $child = Children::where('user_id', Auth::id())->first();
        }

        return view('children.index', compact('child'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('children.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::check() ? Auth::user() : null;

        if (!$user) {
            return redirect('/auth')->with('error', 'Silakan login dulu');
        }
        Children::create([
            'user_id' => Auth::id(),
            'nama_anak' => $request->nama_anak,
            'usia_anak' => $request->usia_anak,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tingkat_kemampuan_bicara' => $request->tingkat_kemampuan_bicara,
            'respon_verbal' => $request->respon_verbal,
            'riwayat_perkembangan_bahasa' => $request->riwayat_perkembangan_bahasa,
        ]);

        return redirect()
            ->route('setting.index')
            ->with('success', 'Data anak berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $child = Children::findOrFail($id);

        return view('children.show', compact('child'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $child = Children::findOrFail($id);

        return view('children.edit', compact('child'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $child = Children::findOrFail($id);

        $child->update([
            'nama_anak' => $request->nama_anak,
            'usia_anak' => $request->usia_anak,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tingkat_kemampuan_bicara' => $request->tingkat_kemampuan_bicara,
            'respon_verbal' => $request->respon_verbal,
            'riwayat_perkembangan_bahasa' => $request->riwayat_perkembangan_bahasa,
        ]);

        return redirect()->route('children.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $child = Children::findOrFail($id);

        $child->delete();

        return redirect()->route('children.index');
    }
}
