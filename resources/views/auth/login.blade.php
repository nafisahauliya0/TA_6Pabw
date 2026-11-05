@extends('layouts.app')

@section('title', 'Login Petugas BPBD')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6 col-lg-5">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white py-3 text-center">
                <h4 class="card-title mb-0">
                    <i class="fas fa-sign-in-alt me-2"></i>Login Petugas BPBD
                </h4>
            </div>
            <div class="card-body p-4">
                <p class="text-muted text-center small mb-4">
                    Masukkan akun petugas Anda untuk mengakses data pelaporan banjir dan fitur pengelolaan.
                </p>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

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
                                   autocomplete="email"
                                   autofocus>
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
                                   placeholder="Masukkan password Anda"
                                   required
                                   autocomplete="current-password">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Remember Me Checkbox -->
                    <div class="mb-4 form-check">
                        <input class="form-check-input"
                               type="checkbox"
                               name="remember"
                               id="remember"
                               {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label text-muted small" for="remember">
                            Ingat Saya di Perangkat Ini (Remember Me)
                        </label>
                    </div>

                    <!-- Tombol Login -->
                    <div class="d-grid mb-3">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fas fa-sign-in-alt me-1"></i>Masuk ke Sistem
                        </button>
                    </div>

                    <div class="text-center">
                        <span class="text-muted small">Belum memiliki akun petugas?</span>
                        <a href="{{ route('register') }}" class="small fw-bold">Daftar sekarang</a>
                    </div>
                </form>
            </div>
            <div class="card-footer bg-light text-center py-3">
                <small class="text-muted">
                    <i class="fas fa-shield-alt text-primary me-1"></i>Akun Seeder Default: <strong>admin.bpbd@bandungkab.go.id</strong> / Password: <strong>admin123</strong>
                </small>
            </div>
        </div>
    </div>
</div>
@endsection
