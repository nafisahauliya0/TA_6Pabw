@php
    $tinggi = (int)($laporan->tinggi_genangan ?? $laporan['tinggi_genangan'] ?? $laporan['tinggi'] ?? 0);
    $nama   = $laporan->nama_pelapor ?? $laporan['nama_pelapor'] ?? $laporan['nama'] ?? 'Anonim';
    $lokasi = $laporan->lokasi ?? $laporan['lokasi'] ?? '-';
    $tgl    = $laporan->tanggal_kejadian ?? $laporan['tanggal_kejadian'] ?? $laporan['tanggal'] ?? '-';

    if ($tinggi < 30) {
        $statusLabel = 'Waspada';
        $badgeClass = 'bg-success';
        $cardBorder = 'border-success-subtle';
    } elseif ($tinggi <= 70) {
        $statusLabel = 'Siaga';
        $badgeClass = 'bg-warning text-dark';
        $cardBorder = 'border-warning-subtle';
    } else {
        $statusLabel = 'Awas';
        $badgeClass = 'bg-danger';
        $cardBorder = 'border-danger-subtle';
    }
@endphp

<div class="col-md-6 col-lg-4 mb-4">
    <div class="card h-100 shadow-sm {{ $cardBorder }}">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0 fs-6 fw-bold">
                <i class="fas fa-map-marker-alt text-danger me-1"></i>{{ $lokasi }}
            </h5>
            <span class="badge {{ $badgeClass }}">{{ $statusLabel }}</span>
        </div>
        <div class="card-body">
            <p class="card-text mb-1">
                <strong><i class="fas fa-user text-muted me-1"></i>Nama Pelapor:</strong> {{ $nama }}
            </p>
            <p class="card-text mb-1">
                <strong><i class="fas fa-ruler-vertical text-muted me-1"></i>Tinggi Genangan:</strong> 
                <span class="badge bg-secondary">{{ $tinggi }} cm</span>
            </p>
            <p class="card-text mb-1">
                <strong><i class="fas fa-calendar-day text-muted me-1"></i>Tanggal Kejadian:</strong> {{ $tgl }}
            </p>
            <p class="card-text mb-0">
                <strong>Status Genangan:</strong> 
                <span class="fw-semibold text-capitalize">{{ $statusLabel }}</span>
            </p>
        </div>
    </div>
</div>
