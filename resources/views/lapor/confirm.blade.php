@extends('layouts.app')

@section('title', 'Konfirmasi Laporan Berhasil')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <!-- Komponen Blade x-alert sesuai spesifikasi Modul 4 -->
        <x-alert type="sukses" message="Laporan kejadian banjir Anda berhasil diterima dan disimpan ke database BPBD Kabupaten Bandung!" />

        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-white py-3">
                <h5 class="card-title mb-0 text-success">
                    <i class="fas fa-file-invoice me-2"></i>Rincian Data Laporan Terkirim
                </h5>
            </div>
            <div class="card-body p-4">
                <table class="table table-borderless mb-0">
                    <tbody>
                        <tr>
                            <th class="ps-0 text-muted" style="width: 35%;">ID Laporan:</th>
                            <td class="fw-bold">#{{ $data->id ?? $data['id'] }}</td>
                        </tr>
                        <tr>
                            <th class="ps-0 text-muted">Nama Pelapor:</th>
                            <td class="fw-semibold">{{ $data->nama_pelapor ?? $data['nama_pelapor'] }}</td>
                        </tr>
                        <tr>
                            <th class="ps-0 text-muted">Lokasi / Kecamatan:</th>
                            <td>
                                <i class="fas fa-map-marker-alt text-danger me-1"></i>
                                {{ $data->lokasi ?? $data['lokasi'] }}
                            </td>
                        </tr>
                        <tr>
                            <th class="ps-0 text-muted">Tinggi Genangan Air:</th>
                            <td>
                                <span class="badge bg-info text-dark fs-6">
                                    {{ $data->tinggi_genangan ?? $data['tinggi_genangan'] }} cm
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th class="ps-0 text-muted">Status Potensi:</th>
                            <td>
                                @php
                                    $tinggi = (int)($data->tinggi_genangan ?? $data['tinggi_genangan']);
                                @endphp
                                @if($tinggi < 30)
                                    <span class="badge bg-success">Waspada</span>
                                @elseif($tinggi <= 70)
                                    <span class="badge bg-warning text-dark">Siaga</span>
                                @else
                                    <span class="badge bg-danger">Awas</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th class="ps-0 text-muted">Tanggal Kejadian:</th>
                            <td>{{ $data->tanggal_kejadian ?? $data['tanggal_kejadian'] }}</td>
                        </tr>
                        <tr>
                            <th class="ps-0 text-muted">Waktu Pelaporan:</th>
                            <td class="text-muted small">{{ $data->created_at ?? now() }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="card-footer bg-light p-3 d-flex justify-content-between align-items-center">
                <a href="{{ route('lapor.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-1"></i>Kirim Laporan Lain
                </a>
                @auth
                    <a href="{{ route('lapor.daftar') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-list me-1"></i>Lihat Semua Laporan Petugas
                    </a>
                @else
                    <span class="text-muted small">
                        <i class="fas fa-lock me-1"></i>Daftar laporan hanya dapat diakses oleh petugas BPBD terdaftar.
                    </span>
                @endauth
            </div>
        </div>
    </div>
</div>
@endsection
