@extends('layouts.app')

@section('title', 'Daftar Laporan Banjir')

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center mb-4 pb-2 border-bottom">
    <div>
        <h2 class="h3 mb-1 text-primary fw-bold">
            <i class="fas fa-clipboard-list me-2"></i>Daftar Laporan Kejadian Banjir
        </h2>
        <p class="text-muted mb-0">
            Halaman internal monitoring dan rekap data bencana banjir BPBD Kabupaten Bandung (Khusus Petugas).
        </p>
    </div>
    <div class="mt-2 mt-md-0">
        <a href="{{ route('lapor.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i>Input Laporan Baru
        </a>
    </div>
</div>

<!-- Kartu Ringkasan Status -->
@php
    $totalLaporan = $laporanList->count();
    $totalWaspada = $laporanList->where('tinggi_genangan', '<', 30)->count();
    $totalSiaga   = $laporanList->whereBetween('tinggi_genangan', [30, 70])->count();
    $totalAwas    = $laporanList->where('tinggi_genangan', '>', 70)->count();
@endphp
<div class="row g-3 mb-4">
    <div class="col-6 col-md-3">
        <div class="card bg-primary text-white border-0 shadow-sm text-center py-2">
            <div class="fs-4 fw-bold">{{ $totalLaporan }}</div>
            <div class="small">Total Laporan</div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card bg-success text-white border-0 shadow-sm text-center py-2">
            <div class="fs-4 fw-bold">{{ $totalWaspada }}</div>
            <div class="small">Waspada (&lt; 30 cm)</div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card bg-warning text-dark border-0 shadow-sm text-center py-2">
            <div class="fs-4 fw-bold">{{ $totalSiaga }}</div>
            <div class="small">Siaga (30 - 70 cm)</div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card bg-danger text-white border-0 shadow-sm text-center py-2">
            <div class="fs-4 fw-bold">{{ $totalAwas }}</div>
            <div class="small">Awas (&gt; 70 cm)</div>
        </div>
    </div>
</div>

<!-- Daftar Card Laporan -->
<div class="row">
    @forelse($laporanList as $laporan)
        {{-- Menggunakan partial laporan-card dengan directive @include sesuai Modul 3 & 4 --}}
        @include('partials.laporan-card', ['laporan' => $laporan])
    @empty
        <div class="col-12">
            <div class="alert alert-info text-center py-4">
                <i class="fas fa-info-circle fa-2x mb-2 d-block"></i>
                Belum ada data laporan banjir yang tercatat di database.
            </div>
        </div>
    @endforelse
</div>
@endsection
