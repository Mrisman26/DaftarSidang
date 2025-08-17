@php
    $warna = match($status) {
        'pending' => 'warning text-dark',
        'diterima' => 'success text-white',
        'ditolak' => 'danger text-white',
        default => 'secondary text-white',
    };
@endphp

<span class="badge bg-{{ $warna }}">
    {{ ucfirst($status) }}
</span>
