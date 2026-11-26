@extends('layouts.dashboard')
@section('title', 'Laporan Sistem')
@section('page-title', 'Laporan Sistem')

@section('content')
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card text-center p-4">
            <div class="fw-bold fs-2" style="color:#6C3483;">{{ $totalPesanan }}</div>
            <div class="text-muted small">Total Pesanan Selesai</div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-center p-4">
            <div class="fw-bold fs-2" style="color:#27ae60;">
                Rp {{ number_format($totalRevenue, 0, ',', '.') }}
            </div>
            <div class="text-muted small">Total Revenue</div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-center p-4">
            <div class="fw-bold fs-2" style="color:#e67e22;">
                {{ $totalPesanan > 0 ? 'Rp '.number_format($totalRevenue / $totalPesanan, 0, ',', '.') : '-' }}
            </div>
            <div class="text-muted small">Rata-rata per Transaksi</div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <span class="fw-semibold">
            <i class="bi bi-bar-chart me-2 text-primary"></i>Riwayat Transaksi Selesai
        </span>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0 align-middle">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Pelanggan</th>
                        <th>Karya</th>
                        <th>Seniman</th>
                        <th>Total</th>
                        <th>Pengambilan</th>
                        <th>Tanggal Selesai</th>
                        <th>Pembayaran</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pesanans as $i => $p)
                    <tr>
                        <td class="small text-muted">{{ $i + 1 }}</td>
                        <td class="small fw-semibold">{{ $p->pelanggan->nama }}</td>
                        <td class="small">{{ Str::limit($p->karya->judul, 22) }}</td>
                        <td class="small text-muted">{{ $p->karya->seniman->nama }}</td>
                        <td class="small fw-bold" style="color:#6C3483;">{{ $p->total_harga_format }}</td>
                        <td>
                            @if($p->opsi_pengambilan === 'antar')
                                <span class="badge bg-info text-white" style="font-size:0.65rem;">
                                    <i class="bi bi-truck me-1"></i>Antar
                                </span>
                            @elseif($p->opsi_pengambilan === 'ambil_sendiri')
                                <span class="badge bg-success" style="font-size:0.65rem;">
                                    <i class="bi bi-shop me-1"></i>Ambil
                                </span>
                            @else
                                <span class="text-muted small">-</span>
                            @endif
                        </td>
                        <td class="small text-muted">{{ $p->updated_at->format('d M Y') }}</td>
                        <td>
                            {!! optional($p->pembayaran)->status_badge ?? '<span class="badge bg-secondary">-</span>' !!}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center py-5 text-muted">
                            <i class="bi bi-bar-chart fs-2 d-block mb-2 opacity-25"></i>
                            Belum ada transaksi yang selesai.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection