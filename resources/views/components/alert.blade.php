@props([
    'type' => 'info',
    'message' => ''
])

@php
    $alertClass = match($type) {
        'sukses', 'success' => 'alert-success',
        'peringatan', 'warning' => 'alert-warning',
        'bahaya', 'danger'  => 'alert-danger',
        default             => 'alert-info'
    };

    $iconClass = match($type) {
        'sukses', 'success' => 'fa-check-circle',
        'peringatan', 'warning' => 'fa-exclamation-triangle',
        'bahaya', 'danger'  => 'fa-times-circle',
        default             => 'fa-info-circle'
    };
@endphp

<div class="alert {{ $alertClass }} d-flex align-items-center mb-3" role="alert">
    <i class="fas {{ $iconClass }} fs-4 me-3"></i>
    <div>
        <strong>{{ ucfirst($type) }}:</strong> {{ $message ?? $slot }}
    </div>
</div>
