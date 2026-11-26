@extends('layouts.dashboard')
@section('title', 'Dashboard Pelanggan')
@section('page-title', 'Dashboard Pelanggan')

@section('content')
<div class="row g-3 mb-4">
    <div class="col-6 col-md-4">
        <div class="card p-3">
            <div class="d-flex justify-content-between align-items-start">
                <div><div class="text-muted small">Total Pesanan</div><div class="fw-bold fs-3">{{ $stats['total_pesanan'] }}</div></div>
                <div style="width:48px;height:48px;border-radius:10px;background:#eee8ff;color:#6C3483;display:flex;align-items:center;justify-content:center;font-size:1.3rem;"><i class="bi bi-bag"></i></div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-4">
        <div class="card p-3">
            <div class="d-flex justify-content-between align-items-start">
                <div><div class="text-muted small">Pending</div><div class="fw-bold fs-3">{{ $stats['pesanan_pending'] }}</div></div>
                <div style="width:48px;height:48px;border-radius:10px;background:#fff3e0;color:#e67e22;display:flex;align-items:center;justify-content:center;font-size:1.3rem;"><i class="bi bi-clock"></i></div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-4">
        <div class="card p-3">
            <div class="d-flex justify-content-between align-items-start">
                <div><div class="text-muted small">Selesai</div><div class="fw-bold fs-3">{{ $stats['pesanan_selesai'] }}</div></div>
                <div style="width:48px;height:48px;border-radius:10px;background:#e8f5e9;color:#27ae60;display:flex;align-items:center;justify-content:center;font-size:1.3rem;"><i class="bi bi-check-circle"></i></div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header py-3 d-flex justify-content-between">
                <span class="fw-semibold">Pesanan Terbaru</span>
                <a href="{{ route('pelanggan.pesanan.index') }}" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead><tr><th>Karya</th><th>Seniman</th><th>Total</th><th>Status</th><th>Pembayaran</th><th>Aksi</th></tr></thead>
                        <tbody>
                            @forelse($pesananTerbaru as $p)
                            <tr>
                                <td class="small">{{ Str::limit($p->karya->judul, 22) }}</td>
                                <td class="small text-muted">{{ $p->karya->seniman->nama }}</td>
                                <td class="small fw-semibold" style="color:#6C3483;">{{ $p->total_harga_format }}</td>
                                <td>{!! $p->status_badge !!}</td>
                                <td>{!! optional($p->pembayaran)->status_badge ?? '<span class="badge bg-secondary">Belum Upload</span>' !!}</td>
                                <td><a href="{{ route('pelanggan.pesanan.show', $p) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-eye"></i></a></td>
                            </tr>
                            @empty
                            <tr><td colspan="6" class="text-center py-3 text-muted small">Belum ada pesanan.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header py-3"><span class="fw-semibold">Aksi Cepat</span></div>
            <div class="card-body d-flex flex-column gap-2">
                <a href="{{ route('gallery') }}" class="btn btn-primary"><i class="bi bi-shop me-2"></i>Jelajahi Galeri</a>
                <a href="{{ route('pelanggan.pesanan.index') }}" class="btn btn-outline-primary"><i class="bi bi-bag me-2"></i>Riwayat Pesanan</a>
                <a href="{{ route('pelanggan.profil.edit') }}" class="btn btn-outline-secondary"><i class="bi bi-person me-2"></i>Edit Profil</a>
            </div>
        </div>
    </div>
</div>
@endsection
