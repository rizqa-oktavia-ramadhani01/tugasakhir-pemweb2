<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\DB; // Tambahkan ini

class ProfileController extends Controller
{
    public function index()
    {
        return view('profile.index');
    }

    public function updateName(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Update menggunakan DB facade - pasti tidak merah
        DB::table('users')
            ->where('id', Auth::id())
            ->update(['name' => $request->name]);

        return redirect()->route('profile')->with('success', 'Nama berhasil diupdate!');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'new_password' => ['required', Password::min(8), 'confirmed'],
        ]);

        // Update menggunakan DB facade - pasti tidak merah
        DB::table('users')
            ->where('id', Auth::id())
            ->update(['password' => Hash::make($request->new_password)]);

        return redirect()->route('profile')->with('success', 'Password berhasil diganti!');
    }
}