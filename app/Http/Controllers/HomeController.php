<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Menampilkan dashboard petugas (atau redirect ke daftar laporan).
     */
    public function dashboard()
    {
        return redirect()->route('lapor.daftar');
    }

    /**
     * Menampilkan profil petugas yang sedang login menggunakan Auth::user().
     */
    public function profile()
    {
        $user = Auth::user();
        return view('profile', compact('user'));
    }
}
