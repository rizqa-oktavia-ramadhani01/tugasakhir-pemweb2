<?php

namespace App\Http\Controllers;

use App\Models\ParentJournal;
use App\Models\Children;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ParentJournalController extends Controller
{
    // Halaman index (daftar jurnal)
    public function index()
    {
        $childId = session('active_child_id');
        $child = null;
        
        if ($childId && Auth::check()) {
            $child = Children::where('user_id', Auth::id())
                ->where('id', $childId)
                ->first();
        }
        
        if (!$child) {
            return redirect()->route('children.index')->with('error', 'Silakan pilih anak terlebih dahulu');
        }
        
        $journals = ParentJournal::where('child_id', $child->id)
            ->orderBy('tanggal', 'desc')
            ->get();
        
        return view('parent_journals.index', compact('child', 'journals'));
    }
    
    // Halaman form tambah jurnal
    public function create()
    {
        $childId = session('active_child_id');
        $child = Children::where('user_id', Auth::id())
            ->where('id', $childId)
            ->first();
        
        if (!$child) {
            return redirect()->route('children.index')->with('error', 'Silakan pilih anak terlebih dahulu');
        }
        
        // Cek apakah sudah ada jurnal untuk hari ini
        $todayJournal = ParentJournal::where('child_id', $child->id)
            ->where('tanggal', today())
            ->first();
        
        if ($todayJournal) {
            return redirect()->route('parent-journals.edit', $todayJournal->id)
                ->with('info', 'Jurnal hari ini sudah ada. Silakan edit.');
        }
        
        return view('parent_journals.create', compact('child'));
    }
    
    // Simpan jurnal
    public function store(Request $request)
    {
        $request->validate([
            'aktivitas_dilakukan' => 'required|string',
            'respon_anak' => 'nullable|string',
            'kata_baru' => 'nullable|string',
            'kendala' => 'nullable|string',
            'catatan' => 'nullable|string',
        ]);
        
        ParentJournal::create([
            'child_id' => $request->child_id,
            'tanggal' => today(),
            'aktivitas_dilakukan' => $request->aktivitas_dilakukan,
            'respon_anak' => $request->respon_anak,
            'kata_baru' => $request->kata_baru,
            'kendala' => $request->kendala,
            'catatan' => $request->catatan,
        ]);
        
        return redirect()->route('parent-journals.index')
            ->with('success', 'Jurnal berhasil disimpan!');
    }
    
    // Halaman edit jurnal
    public function edit($id)
    {
        $journal = ParentJournal::findOrFail($id);
        $child = Children::findOrFail($journal->child_id);
        
        return view('parent_journals.edit', compact('journal', 'child'));
    }
    
    // Update jurnal
    public function update(Request $request, $id)
    {
        $request->validate([
            'aktivitas_dilakukan' => 'required|string',
            'respon_anak' => 'nullable|string',
            'kata_baru' => 'nullable|string',
            'kendala' => 'nullable|string',
            'catatan' => 'nullable|string',
        ]);
        
        $journal = ParentJournal::findOrFail($id);
        $journal->update($request->all());
        
        return redirect()->route('parent-journals.index')
            ->with('success', 'Jurnal berhasil diupdate!');
    }
    
    // Hapus jurnal
    public function destroy($id)
    {
        $journal = ParentJournal::findOrFail($id);
        $journal->delete();
        
        return redirect()->route('parent-journals.index')
            ->with('success', 'Jurnal berhasil dihapus!');
    }
    
    // Laporan kata baru
    public function report()
    {
        $childId = session('active_child_id');
        $child = Children::where('user_id', Auth::id())
            ->where('id', $childId)
            ->first();
        
        if (!$child) {
            return redirect()->route('children.index')->with('error', 'Silakan pilih anak terlebih dahulu');
        }
        
        $journals = ParentJournal::where('child_id', $child->id)
            ->orderBy('tanggal', 'desc')
            ->get();
        
        // Hitung total kata baru
        $totalKataBaru = 0;
        $kataBaruList = [];
        
        foreach ($journals as $journal) {
            if ($journal->kata_baru) {
                $kataArray = explode(',', $journal->kata_baru);
                foreach ($kataArray as $kata) {
                    $kata = trim($kata);
                    if (!empty($kata)) {
                        $totalKataBaru++;
                        if (!in_array($kata, $kataBaruList)) {
                            $kataBaruList[] = $kata;
                        }
                    }
                }
            }
        }
        
        return view('parent_journals.report', compact('child', 'journals', 'totalKataBaru', 'kataBaruList'));
    }
}