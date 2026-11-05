@extends('layouts.app')

@section('title', 'Form Pelaporan Kejadian Banjir')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white py-3">
                <h4 class="card-title mb-0">
                    <i class="fas fa-hand-holding-water me-2"></i>Formulir Pelaporan Banjir BPBD Kab. Bandung
                </h4>
            </div>
            <div class="card-body p-4">
                <p class="text-muted mb-4">
                    Warga dapat melaporkan kejadian banjir secara langsung tanpa perlu login. Mohon isi data dengan akurat agar petugas BPBD dapat segera melakukan penanganan di lapangan.
                </p>

                <form action="{{ route('lapor.store') }}" method="POST">
                    @csrf

                    <!-- Nama Pelapor -->
                    <div class="mb-3">
                        <label for="nama_pelapor" class="form-label fw-semibold">
                            <i class="fas fa-user text-muted me-1"></i>Nama Pelapor
                        </label>
                        <input type="text"
                               name="nama_pelapor"
                               id="nama_pelapor"
                               class="form-control @error('nama_pelapor') is-invalid @enderror"
                               placeholder="Masukkan nama lengkap Anda..."
                               value="{{ old('nama_pelapor') }}"
                               required>
                        @error('nama_pelapor')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Lokasi / Kecamatan -->
                    <div class="mb-3">
                        <label for="lokasi" class="form-label fw-semibold">
                            <i class="fas fa-map-marker-alt text-muted me-1"></i>Lokasi / Wilayah Kecamatan
                        </label>
                        <input type="text"
                               name="lokasi"
                               id="lokasi"
                               class="form-control @error('lokasi') is-invalid @enderror"
                               placeholder="Contoh: Dayeuhkolot, Baleendah, Bojongsoang..."
                               value="{{ old('lokasi') }}"
                               required>
                        <div class="form-text">
                            Wilayah rawan: Dayeuhkolot, Baleendah, Bojongsoang, Rancaekek, Majalaya, Banjaran.
                        </div>
                        @error('lokasi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Tinggi Genangan (cm) -->
                    <div class="mb-3">
                        <label for="tinggi_genangan" class="form-label fw-semibold">
                            <i class="fas fa-ruler-vertical text-muted me-1"></i>Tinggi Genangan Air (cm)
                        </label>
                        <div class="input-group">
                            <input type="number"
                                   name="tinggi_genangan"
                                   id="tinggi_genangan"
                                   class="form-control @error('tinggi_genangan') is-invalid @enderror"
                                   placeholder="Contoh: 50"
                                   min="1"
                                   max="500"
                                   value="{{ old('tinggi_genangan') }}"
                                   required>
                            <span class="input-group-text">cm</span>
                            @error('tinggi_genangan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-text">
                            Status genangan: <strong>&lt; 30 cm</strong> (Waspada), <strong>30 - 70 cm</strong> (Siaga), <strong>&gt; 70 cm</strong> (Awas).
                        </div>
                    </div>

                    <!-- Tanggal Kejadian -->
                    <div class="mb-4">
                        <label for="tanggal_kejadian" class="form-label fw-semibold">
                            <i class="fas fa-calendar-alt text-muted me-1"></i>Tanggal Kejadian
                        </label>
                        <input type="date"
                               name="tanggal_kejadian"
                               id="tanggal_kejadian"
                               class="form-control @error('tanggal_kejadian') is-invalid @enderror"
                               value="{{ old('tanggal_kejadian', date('Y-m-d')) }}"
                               required>
                        @error('tanggal_kejadian')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fas fa-paper-plane me-2"></i>Kirim Laporan Bencana
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
