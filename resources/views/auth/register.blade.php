@extends('layouts.app')

@section('title', 'Pendaftaran Petugas BPBD')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6 col-lg-5">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white py-3 text-center">
                <h4 class="card-title mb-0">
                    <i class="fas fa-user-plus me-2"></i>Pendaftaran Petugas BPBD
                </h4>
            </div>
            <div class="card-body p-4">
                <p class="text-muted text-center small mb-4">
                    Silakan daftarkan akun baru Anda untuk mengakses sistem pengelolaan laporan bencana banjir BPBD Kabupaten Bandung.
                </p>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- Nama Lengkap -->
                    <div class="mb-3">
                        <label for="name" class="form-label fw-semibold">Nama Lengkap</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-user text-muted"></i></span>
                            <input id="name"
                                   type="text"
                                   class="form-control @error('name') is-invalid @enderror"
                                   name="name"
                                   value="{{ old('name') }}"
                                   placeholder="Contoh: Budi Santoso"
                                   required
                                   autocomplete="name"
                                   autofocus>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Email Address -->
                    <div class="mb-3">
                        <label for="email" class="form-label fw-semibold">Alamat Email</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-envelope text-muted"></i></span>
                            <input id="email"
                                   type="email"
                                   class="form-control @error('email') is-invalid @enderror"
                                   name="email"
                                   value="{{ old('email') }}"
                                   placeholder="nama@email.com"
                                   required
                                   autocomplete="email">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <label for="password" class="form-label fw-semibold">Password</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-lock text-muted"></i></span>
                            <input id="password"
                                   type="password"
                                   class="form-control @error('password') is-invalid @enderror"
                                   name="password"
                                   placeholder="Minimal 8 karakter"
                                   required
                                   autocomplete="new-password">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Konfirmasi Password -->
                    <div class="mb-4">
                        <label for="password-confirm" class="form-label fw-semibold">Konfirmasi Password</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-check-double text-muted"></i></span>
                            <input id="password-confirm"
                                   type="password"
                                   class="form-control"
                                   name="password_confirmation"
                                   placeholder="Ulangi password di atas"
                                   required
                                   autocomplete="new-password">
                        </div>
                    </div>

                    <!-- Tombol Register -->
                    <div class="d-grid mb-3">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fas fa-user-plus me-1"></i>Daftar Petugas Baru
                        </button>
                    </div>

                    <div class="text-center">
                        <span class="text-muted small">Sudah memiliki akun petugas?</span>
                        <a href="{{ route('login') }}" class="small fw-bold">Masuk di sini</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
