@extends('layouts.dashboard')
@section('title', 'Dashboard Admin')
@section('page-title', 'Dashboard Admin')

@push('styles')
<style>
    .stat-card { background: #fff; border-radius: 14px; padding: 1.4rem; box-shadow: 0 2px 12px rgba(0,0,0,0.06); }
    .stat-icon { width: 50px; height: 50px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; }
</style>
@endpush

@section('content')

{{-- Stats --}}
<div class="row g-3 mb-4">
    <div class="col-6 col-md-3">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="text-muted small">Total User</div>
                    <div class="fw-bold fs-3">{{ $stats['total_users'] }}</div>
                </div>
                <div class="stat-icon" style="background:#eee8ff;color:#6C3483">
                    <i class="bi bi-people"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="text-muted small">Total Seniman</div>
                    <div class="fw-bold fs-3">{{ $stats['total_seniman'] }}</div>
                </div>
                <div class="stat-icon" style="background:#fff3e0;color:#e67e22">
                    <i class="bi bi-brush"></i>
                </div>
            </div>
            @if($stats['seniman_pending'] > 0)
            <div class="mt-2">
                <span class="badge bg-warning text-dark small">{{ $stats['seniman_pending'] }} menunggu verifikasi</span>
            </div>
            @endif
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="text-muted small">Total Karya</div>
                    <div class="fw-bold fs-3">{{ $stats['total_karya'] }}</div>
                </div>
                <div class="stat-icon" style="background:#e8f5e9;color:#27ae60">
                    <i class="bi bi-images"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="text-muted small">Total Pesanan</div>
                    <div class="fw-bold fs-3">{{ $stats['total_pesanan'] }}</div>
                </div>
                <div class="stat-icon" style="background:#fce4ec;color:#e91e63">
                    <i class="bi bi-receipt"></i>
                </div>
            </div>
            @if($stats['pesanan_pending'] > 0)
            <div class="mt-2">
                <span class="badge bg-danger small">{{ $stats['pesanan_pending'] }} pending</span>
            </div>
            @endif
        </div>
    </div>
</div>

{{-- Chart + Aksi --}}
<div class="row g-4 mb-4">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <span class="fw-semibold">Statistik Pesanan (6 Bulan Terakhir)</span>
            </div>
            <div class="card-body">
                <canvas id="chartPesanan" height="100"></canvas>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card h-100">
            <div class="card-header py-3">
                <span class="fw-semibold">Aksi Cepat</span>
            </div>
            <div class="card-body d-flex flex-column gap-2">
                <a href="{{ route('admin.users.index', ['role'=>'seniman']) }}" class="btn btn-outline-warning">
                    <i class="bi bi-person-check me-2"></i>Verifikasi Seniman
                    @if($stats['seniman_pending'] > 0)
                        <span class="badge bg-warning text-dark ms-1">{{ $stats['seniman_pending'] }}</span>
                    @endif
                </a>
                <a href="{{ route('admin.transaksi.index') }}" class="btn btn-outline-primary">
                    <i class="bi bi-receipt me-2"></i>Kelola Transaksi
                </a>
                <a href="{{ route('admin.karyas.index') }}" class="btn btn-outline-success">
                    <i class="bi bi-images me-2"></i>Kelola Karya
                </a>
                <a href="{{ route('admin.laporan') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-bar-chart me-2"></i>Laporan Sistem
                </a>
            </div>
        </div>
    </div>
</div>

{{-- Pesanan Terbaru & Pembayaran Menunggu --}}
<div class="row g-4">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header py-3 d-flex justify-content-between">
                <span class="fw-semibold">Pesanan Terbaru</span>
                <a href="{{ route('admin.transaksi.index') }}" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Pelanggan</th>
                                <th>Karya</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pesananTerbaru as $p)
                            <tr>
                                <td class="small">{{ $p->pelanggan->nama }}</td>
                                <td class="small">{{ Str::limit($p->karya->judul, 25) }}</td>
                                <td>{!! $p->status_badge !!}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center py-3 text-muted small">
                                    Belum ada pesanan.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card">
            <div class="card-header py-3 d-flex justify-content-between">
                <span class="fw-semibold">Pembayaran Menunggu Verifikasi</span>
                <a href="{{ route('admin.transaksi.index') }}" class="btn btn-sm btn-outline-warning">Kelola</a>
            </div>
            <div class="card-body p-0">
                @forelse($pembayaranMenunggu as $pb)
                <div class="d-flex align-items-center gap-3 p-3 border-bottom">
                    <div class="rounded-circle bg-warning text-white d-flex align-items-center justify-content-center fw-bold"
                        style="width:36px;height:36px;font-size:13px;flex-shrink:0;">
                        {{ strtoupper(substr($pb->pesanan->pelanggan->nama, 0, 1)) }}
                    </div>
                    <div class="flex-grow-1">
                        <div class="fw-semibold small">{{ $pb->pesanan->pelanggan->nama }}</div>
                        <div class="text-muted" style="font-size:0.75rem;">
                            {{ Str::limit($pb->pesanan->karya->judul, 30) }}
                        </div>
                    </div>
                    <a href="{{ route('admin.transaksi.show', $pb->pesanan) }}"
                        class="btn btn-sm btn-warning">Verifikasi</a>
                </div>
                @empty
                <div class="text-center py-4 text-muted small">
                    <i class="bi bi-check-circle fs-4 d-block mb-2 text-success"></i>
                    Tidak ada pembayaran yang menunggu.
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('chartPesanan').getContext('2d');
new Chart(ctx, {
    type: 'bar',
    data: {
        labels: {!! json_encode(array_column($chartData, 'bulan')) !!},
        datasets: [{
            label: 'Jumlah Pesanan',
            data: {!! json_encode(array_column($chartData, 'pesanan')) !!},
            backgroundColor: 'rgba(108,52,131,0.7)',
            borderRadius: 6,
        }]
    },
    options: {
        responsive: true,
        plugins: { legend: { display: false } },
        scales: { y: { beginAtZero: true, ticks: { stepSize: 1 } } }
    }
});
</script>
@endpush