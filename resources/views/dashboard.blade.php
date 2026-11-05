@extends('layouts.app')

@section('title', 'Dashboard Petugas')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white py-3">
                <h5 class="card-title mb-0"><i class="fas fa-tachometer-alt me-2"></i>Dashboard Petugas BPBD</h5>
            </div>
            <div class="card-body p-4 text-center">
                <div class="py-3">
                    <i class="fas fa-check-circle text-success fa-3x mb-3"></i>
                    <h4 class="fw-bold">You are logged in!</h4>
                    <p class="text-muted">Selamat datang di Panel Pengelolaan Bencana Banjir BPBD Kabupaten Bandung.</p>
                </div>
                <div class="d-flex justify-content-center gap-3">
                    <a href="{{ route('lapor.daftar') }}" class="btn btn-primary">
                        <i class="fas fa-clipboard-list me-1"></i>Kelola Daftar Laporan
                    </a>
                    <a href="{{ route('profile') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-user me-1"></i>Lihat Profil
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
