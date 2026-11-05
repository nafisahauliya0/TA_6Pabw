<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'LaporBanjir') - BPBD Kab. Bandung</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        body {
            background-color: #f8fafc;
            color: #334155;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .navbar-brand {
            font-weight: 700;
            color: #0d6efd !important;
            letter-spacing: -0.5px;
        }
        .navbar {
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }
        main {
            flex: 1;
        }
        footer {
            background-color: #ffffff;
            border-top: 1px solid #e2e8f0;
            padding: 1.5rem 0;
            margin-top: 3rem;
            color: #64748b;
        }
        .card {
            border: 1px solid #e2e8f0;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            border-radius: 0.5rem;
        }
        .card-header {
            background-color: #ffffff;
            border-bottom: 1px solid #e2e8f0;
            font-weight: 600;
        }
    </style>
    @stack('styles')
</head>
<body>

    <!-- Navbar Navigasi -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white mb-4">
        <div class="container">
            <a class="navbar-brand" href="{{ route('lapor.create') }}">
                <i class="fas fa-water text-primary me-2"></i>LaporBanjir <span class="badge bg-primary text-white fs-6">BPBD</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <!-- Bagian Kiri Navbar -->
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('lapor.create') ? 'active fw-bold text-primary' : '' }}" href="{{ route('lapor.create') }}">
                            <i class="fas fa-bullhorn me-1"></i>Form Laporan
                        </a>
                    </li>
                    @auth
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('lapor.daftar') ? 'active fw-bold text-primary' : '' }}" href="{{ route('lapor.daftar') }}">
                            <i class="fas fa-clipboard-list me-1"></i>Daftar Laporan
                        </a>
                    </li>
                    @endauth
                </ul>

                {{-- Bagian Kanan Navbar (Autentikasi Directive @auth dan @else) --}}
                <ul class="navbar-nav ms-auto align-items-center">
                    @auth
                        <!-- Menu Khusus Petugas yang Sudah Login -->
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('profile') ? 'active fw-bold text-primary' : '' }}" href="{{ route('profile') }}">
                                <i class="fas fa-user-circle me-1"></i>Profil Petugas ({{ Auth::user()->name }})
                            </a>
                        </li>
                        <li class="nav-item ms-lg-2">
                            <!-- Tombol Logout dengan form POST demi keamanan -->
                            <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-outline-danger btn-sm">
                                    <i class="fas fa-sign-out-alt me-1"></i>Logout
                                </button>
                            </form>
                        </li>
                    @else
                        <!-- Menu Saat Pengguna Belum Login -->
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('login') ? 'active fw-bold text-primary' : '' }}" href="{{ route('login') }}">
                                <i class="fas fa-sign-in-alt me-1"></i>Login Petugas
                            </a>
                        </li>
                        <li class="nav-item ms-lg-2">
                            <a class="btn btn-primary btn-sm px-3" href="{{ route('register') }}">
                                <i class="fas fa-user-plus me-1"></i>Register
                            </a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Konten Utama Halaman -->
    <main class="container">
        <!-- Notifikasi Pesan Sukses -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Notifikasi Pesan Galat -->
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="text-center">
        <div class="container">
            <p class="mb-1">&copy; 2026 BPBD Kabupaten Bandung - Sistem Informasi Pelaporan Bencana Banjir</p>
            <small class="text-muted">Praktikum Pemrograman Aplikasi Berbasis Web (PABW) - Modul 6 Authentication</small>
        </div>
    </footer>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
