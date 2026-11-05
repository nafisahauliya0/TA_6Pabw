@extends('layouts.app')

@section('title', 'Profil Petugas BPBD')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8 col-lg-6">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white py-3">
                <h4 class="card-title mb-0">
                    <i class="fas fa-id-card me-2"></i>Profil Petugas BPBD Kabupaten Bandung
                </h4>
            </div>
            <div class="card-body p-4 text-center">
                <!-- Avatar Icon -->
                <div class="mb-3">
                    <span class="d-inline-flex align-items-center justify-content-center bg-primary-subtle text-primary rounded-circle" style="width: 80px; height: 80px;">
                        <i class="fas fa-user-shield fa-2x"></i>
                    </span>
                </div>

                <h4 class="fw-bold mb-1">{{ Auth::user()->name }}</h4>
                <p class="text-muted mb-3">{{ Auth::user()->email }}</p>

                <div class="badge bg-success-subtle text-success border border-success-subtle px-3 py-2 mb-4">
                    <i class="fas fa-check-circle me-1"></i>Akun Petugas Aktif & Terverifikasi
                </div>

                <ul class="list-group list-group-flush text-start border-top border-bottom mb-4">
                    <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-3">
                        <span class="text-muted"><i class="fas fa-user me-2 text-primary"></i>Nama Lengkap</span>
                        <span class="fw-semibold">{{ Auth::user()->name }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-3">
                        <span class="text-muted"><i class="fas fa-envelope me-2 text-primary"></i>Alamat Email</span>
                        <span class="fw-semibold">{{ Auth::user()->email }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-3">
                        <span class="text-muted"><i class="fas fa-clock me-2 text-primary"></i>Waktu Pembuatan Akun</span>
                        <span class="fw-semibold">
                            {{ Auth::user()->created_at ? Auth::user()->created_at->diffForHumans() : 'Baru saja' }}
                            <small class="text-muted d-block text-end">
                                ({{ Auth::user()->created_at ? Auth::user()->created_at->format('d M Y, H:i') : '-' }})
                            </small>
                        </span>
                    </li>
                </ul>

                <div class="d-flex justify-content-center gap-2">
                    <a href="{{ route('lapor.daftar') }}" class="btn btn-primary">
                        <i class="fas fa-clipboard-list me-1"></i>Buka Daftar Laporan
                    </a>
                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger">
                            <i class="fas fa-sign-out-alt me-1"></i>Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
