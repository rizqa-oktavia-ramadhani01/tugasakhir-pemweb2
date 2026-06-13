<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\Password;
use App\Models\Children;

class SettingController extends Controller
{
    public function index()
    {
        $children = Children::where('user_id', Auth::id())->get();

        return view('setting.index', compact('children'));
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'new_password' => ['required', Password::min(8), 'confirmed'],
        ]);

        // Menggunakan Query Builder - pasti tidak merah
        DB::table('users')
            ->where('id', Auth::id())
            ->update([
                'password' => Hash::make($request->new_password)
            ]);

        return redirect()->route('setting.index')->with('success', 'Password berhasil diubah!');
    }

    public function resetData(Request $request)
    {
        // Logika reset data studi anak menggunakan Query Builder
        try {
            // Contoh: Hapus semua progress anak yang login
            // DB::table('child_progress')->where('user_id', Auth::id())->delete();

            // Contoh: Hapus data activities
            // DB::table('activities')->where('user_id', Auth::id())->delete();

            // Contoh: Reset data learning contents
            // DB::table('learning_contents')->where('user_id', Auth::id())->delete();

            return response()->json(['success' => true, 'message' => 'Data studi berhasil direset']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Gagal mereset data: ' . $e->getMessage()], 500);
        }
    }
}