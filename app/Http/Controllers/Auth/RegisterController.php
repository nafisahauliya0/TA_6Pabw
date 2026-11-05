<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisterController extends Controller
{
    /**
     * Menampilkan form pendaftaran akun petugas baru.
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Menangani proses pendaftaran akun petugas baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ], [
            'name.required'      => 'Nama lengkap wajib diisi.',
            'email.required'     => 'Alamat email wajib diisi.',
            'email.email'        => 'Format email tidak valid.',
            'email.unique'       => 'Email ini sudah terdaftar sebagai petugas.',
            'password.required'  => 'Password wajib diisi.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'password.min'       => 'Password minimal harus terdiri dari 8 karakter.',
        ]);

        // Buat user baru di database dengan password yang di-hash
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Memicu event Registered
        event(new Registered($user));

        // Langsung login user tersebut setelah mendaftar
        Auth::login($user);

        // Redirect ke halaman daftar laporan petugas
        return redirect()->route('lapor.daftar')->with('success', 'Pendaftaran akun petugas berhasil dan Anda telah masuk!');
    }
}
