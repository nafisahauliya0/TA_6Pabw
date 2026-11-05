<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Http\Request;

class LaporBanjirController extends Controller
{
    /**
     * Menampilkan form pelaporan banjir untuk warga (tanpa login).
     */
    public function form()
    {
        return view('lapor.create');
    }

    /**
     * Menyimpan data laporan banjir dari form ke database.
     * Menggunakan Laporan::create() dan menampilkan halaman konfirmasi dengan <x-alert>.
     */
    public function simpan(Request $request)
    {
        $validated = $request->validate([
            'nama_pelapor'     => ['required', 'string', 'max:255'],
            'lokasi'           => ['required', 'string', 'max:255'],
            'tinggi_genangan'  => ['required', 'integer', 'min:1', 'max:500'],
            'tanggal_kejadian' => ['required', 'date'],
        ], [
            'nama_pelapor.required'     => 'Nama pelapor wajib diisi.',
            'lokasi.required'           => 'Lokasi kejadian banjir wajib diisi.',
            'tinggi_genangan.required'  => 'Tinggi genangan wajib diisi.',
            'tinggi_genangan.integer'   => 'Tinggi genangan harus berupa angka.',
            'tanggal_kejadian.required' => 'Tanggal kejadian wajib diisi.',
            'tanggal_kejadian.date'     => 'Format tanggal kejadian tidak valid.',
        ]);

        $laporan = Laporan::create($validated);

        return view('lapor.confirm', [
            'data' => $laporan,
        ]);
    }

    /**
     * Menampilkan daftar laporan kejadian banjir (hanya untuk petugas yang sudah login).
     */
    public function daftar()
    {
        $laporanList = Laporan::orderBy('tanggal_kejadian', 'desc')->get();
        return view('lapor.index', compact('laporanList'));
    }

    /**
     * Alias untuk daftar laporan (opsional).
     */
    public function index()
    {
        return $this->daftar();
    }
}
