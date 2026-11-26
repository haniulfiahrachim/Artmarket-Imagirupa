@extends('layouts.dashboard')
@section('title', 'Riwayat Pesanan')
@section('page-title', 'Riwayat Pesanan')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="fw-bold mb-0">Pesanan Saya</h5>
    <a href="{{ route('gallery') }}" class="btn btn-primary"><i class="bi bi-plus me-1"></i>Beli Karya</a>
</div>

<div class="card mb-4">
    <div class="card-body py-2">
        <form method="GET" class="d-flex gap-2">
            <select name="status" class="form-select form-select-sm" style="max-width:200px;" onchange="this.form.submit()">
                <option value="">Semua Status</option>
                @foreach(['pending','dibayar','diproses','selesai'] as $s)
                <option value="{{ $s }}" {{ request('status')===$s?'selected':'' }}>{{ ucfirst($s) }}</option>
                @endforeach
            </select>
        </form>
    </div>
</div>

<div class="row g-3">
    @forelse($pesanans as $p)
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row align-items-center g-3">
                    <div class="col-md-1">
                        <div style="width:50px;height:50px;border-radius:8px;overflow:hidden;background:linear-gradient(135deg,#9B59B6,#6C3483);display:flex;align-items:center;justify-content:center;font-size:1.2rem;">
                            @if($p->karya->gambar && file_exists(public_path('uploads/karya/'.$p->karya->gambar)))
                                <img src="{{ asset('uploads/karya/'.$p->karya->gambar) }}" style="width:50px;height:50px;object-fit:cover;">
                            @else 🎨 @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="fw-semibold">{{ $p->karya->judul }}</div>
                        <div class="text-muted small">by {{ $p->karya->seniman->nama }}</div>
                    </div>
                    <div class="col-md-2">
                        <div class="fw-bold" style="color:#6C3483;">{{ $p->total_harga_format }}</div>
                        <div class="text-muted" style="font-size:0.72rem;">{{ $p->tanggal_pesanan->format('d M Y') }}</div>
                    </div>
                    <div class="col-md-2">{!! $p->status_badge !!}</div>
                    <div class="col-md-2">
                        {!! optional($p->pembayaran)->status_badge ?? '<span class="badge bg-secondary">Belum Upload</span>' !!}
                    </div>
                    <div class="col-md-1">
                        <a href="{{ route('pelanggan.pesanan.show', $p) }}" class="btn btn-sm btn-outline-primary">Detail</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12 text-center py-5">
        <i class="bi bi-bag fs-1 text-muted d-block mb-3"></i>
        <h5 class="text-muted">Belum ada pesanan</h5>
        <a href="{{ route('gallery') }}" class="btn btn-primary mt-2"><i class="bi bi-shop me-2"></i>Jelajahi Galeri</a>
    </div>
    @endforelse
</div>
@if($pesanans->hasPages())<div class="d-flex justify-content-center mt-4">{{ $pesanans->withQueryString()->links() }}</div>@endif
@endsection
