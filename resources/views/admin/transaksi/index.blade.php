@extends('layouts.dashboard')
@section('title', 'Kelola Transaksi')
@section('page-title', 'Kelola Transaksi')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h5 class="fw-bold mb-1">Semua Transaksi</h5>
        <p class="text-muted small mb-0">Total {{ $pesanans->total() }} transaksi</p>
    </div>
    <a href="{{ route('admin.laporan') }}" class="btn btn-outline-primary btn-sm">
        <i class="bi bi-bar-chart me-1"></i>Lihat Laporan
    </a>
</div>

{{-- Filter --}}
<div class="card mb-4">
    <div class="card-body py-3">
        <form method="GET" class="row g-2 align-items-end">
            <div class="col-md-4">
                <label class="form-label small fw-semibold text-muted mb-1">Cari Pelanggan</label>
                <input type="text" name="search" class="form-control"
                    placeholder="Nama pelanggan..."
                    value="{{ request('search') }}">
            </div>
            <div class="col-md-3">
                <label class="form-label small fw-semibold text-muted mb-1">Status Pesanan</label>
                <select name="status" class="form-select">
                    <option value="">Semua Status</option>
                    @foreach(['pending','dibayar','diproses','selesai'] as $s)
                    <option value="{{ $s }}" {{ request('status') === $s ? 'selected' : '' }}>
                        {{ ucfirst($s) }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">
                    <i class="bi bi-funnel me-1"></i>Filter
                </button>
            </div>
            @if(request('search') || request('status'))
            <div class="col-md-2">
                <a href="{{ route('admin.transaksi.index') }}" class="btn btn-outline-secondary w-100">
                    <i class="bi bi-x me-1"></i>Reset
                </a>
            </div>
            @endif
        </form>
    </div>
</div>

{{-- Stats --}}
<div class="row g-3 mb-4">
    @php
        $pendingCount  = \App\Models\Pesanan::where('status_pesanan','pending')->count();
        $dibayarCount  = \App\Models\Pesanan::where('status_pesanan','dibayar')->count();
        $diprosesCount = \App\Models\Pesanan::where('status_pesanan','diproses')->count();
        $selesaiCount  = \App\Models\Pesanan::where('status_pesanan','selesai')->count();
    @endphp
    <div class="col-6 col-md-3">
        <div class="card p-3 text-center">
            <div class="fw-bold fs-4 text-warning">{{ $pendingCount }}</div>
            <div class="text-muted small">Pending</div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card p-3 text-center">
            <div class="fw-bold fs-4 text-info">{{ $dibayarCount }}</div>
            <div class="text-muted small">Dibayar</div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card p-3 text-center">
            <div class="fw-bold fs-4 text-primary">{{ $diprosesCount }}</div>
            <div class="text-muted small">Diproses</div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card p-3 text-center">
            <div class="fw-bold fs-4 text-success">{{ $selesaiCount }}</div>
            <div class="text-muted small">Selesai</div>
        </div>
    </div>
</div>

{{-- Table --}}
<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0 align-middle">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Pelanggan</th>
                        <th>Karya</th>
                        <th>Total</th>
                        <th>Pengambilan</th>
                        <th>Status Pesanan</th>
                        <th>Pembayaran</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pesanans as $i => $p)
                    <tr>
                        <td class="text-muted small">{{ $pesanans->firstItem() + $i }}</td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <div class="rounded-circle text-white d-flex align-items-center justify-content-center fw-bold flex-shrink-0"
                                    style="width:30px;height:30px;font-size:11px;background:#6C3483;">
                                    {{ strtoupper(substr($p->pelanggan->nama, 0, 1)) }}
                                </div>
                                <span class="small fw-semibold">{{ Str::limit($p->pelanggan->nama, 14) }}</span>
                            </div>
                        </td>
                        <td class="small text-muted">{{ Str::limit($p->karya->judul, 20) }}</td>
                        <td class="small fw-semibold" style="color:#6C3483;white-space:nowrap;">
                            {{ $p->total_harga_format }}
                        </td>
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
                        <td>{!! $p->status_badge !!}</td>
                        <td>
                            @if($p->pembayaran)
                                {!! $p->pembayaran->status_badge !!}
                            @else
                                <span class="badge bg-secondary" style="font-size:0.65rem;">Belum Upload</span>
                            @endif
                        </td>
                        <td class="small text-muted" style="white-space:nowrap;">
                            {{ $p->created_at->format('d M Y') }}
                        </td>
                        <td>
                            <a href="{{ route('admin.transaksi.show', $p) }}"
                                class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-eye"></i>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="text-center py-5 text-muted">
                            <i class="bi bi-receipt fs-2 d-block mb-2 opacity-25"></i>
                            Tidak ada transaksi ditemukan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($pesanans->hasPages())
    <div class="card-footer">{{ $pesanans->withQueryString()->links() }}</div>
    @endif
</div>
@endsection