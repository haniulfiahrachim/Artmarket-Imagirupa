@extends('layouts.dashboard')
@section('title', 'Pesanan Masuk')
@section('page-title', 'Pesanan Masuk')

@section('content')
<div class="card mb-4">
    <div class="card-body">
        <form method="GET" class="row g-2">
            <div class="col-md-4">
                <select name="status" class="form-select">
                    <option value="">Semua Status</option>
                    @foreach(['pending','dibayar','diproses','selesai'] as $s)
                    <option value="{{ $s }}" {{ request('status')===$s?'selected':'' }}>{{ ucfirst($s) }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2"><button type="submit" class="btn btn-primary w-100">Filter</button></div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header py-3"><span class="fw-semibold">Pesanan Masuk ({{ $pesanans->total() }})</span></div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead><tr><th>#</th><th>Pelanggan</th><th>Karya</th><th>Total</th><th>Status</th><th>Pembayaran</th><th>Tanggal</th><th>Aksi</th></tr></thead>
                <tbody>
                    @forelse($pesanans as $i => $p)
                    <tr>
                        <td class="small text-muted">{{ $pesanans->firstItem() + $i }}</td>
                        <td class="small fw-semibold">{{ $p->pelanggan->nama }}</td>
                        <td class="small">{{ Str::limit($p->karya->judul, 25) }}</td>
                        <td class="small fw-bold" style="color:#6C3483;">{{ $p->total_harga_format }}</td>
                        <td>{!! $p->status_badge !!}</td>
                        <td>{!! optional($p->pembayaran)->status_badge ?? '<span class="badge bg-secondary">Belum</span>' !!}</td>
                        <td class="small text-muted">{{ $p->tanggal_pesanan->format('d M Y') }}</td>
                        <td><a href="{{ route('seniman.pesanan.show', $p) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-eye"></i></a></td>
                    </tr>
                    @empty
                    <tr><td colspan="8" class="text-center py-4 text-muted">Belum ada pesanan masuk.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($pesanans->hasPages())<div class="card-footer">{{ $pesanans->withQueryString()->links() }}</div>@endif
</div>
@endsection
