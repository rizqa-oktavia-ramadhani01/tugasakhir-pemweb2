<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogOutController extends Controller
{
    // Menampilkan halaman konfirmasi logout
    public function index()
    {
        // Cek apakah user sudah login
        if (!Auth::check()) {
            return redirect('/')->with('error', 'Anda belum login.');
        }
        
        return view('logout.index');
    }
}