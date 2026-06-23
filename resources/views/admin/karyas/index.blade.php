@extends('layouts.dashboard')
@section('title', 'Kelola Karya')
@section('page-title', 'Kelola Karya')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h5 class="fw-bold mb-1">Semua Karya Seni</h5>
        <p class="text-muted small mb-0">Total {{ $karyas->total() }} karya terdaftar</p>
    </div>
</div>

{{-- Filter --}}
<div class="card mb-4">
    <div class="card-body py-3">
        <form method="GET" class="row g-2 align-items-end">
            <div class="col-md-5">
                <label class="form-label small fw-semibold text-muted mb-1">Cari Karya</label>
                <input type="text" name="search" class="form-control"
                    placeholder="Cari judul karya..."
                    value="{{ request('search') }}">
            </div>
            <div class="col-md-3">
                <label class="form-label small fw-semibold text-muted mb-1">Status</label>
                <select name="status" class="form-select">
                    <option value="">Semua Status</option>
                    <option value="tersedia" {{ request('status') === 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                    <option value="terjual"  {{ request('status') === 'terjual'  ? 'selected' : '' }}>Terjual</option>
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">
                    <i class="bi bi-funnel me-1"></i>Filter
                </button>
            </div>
            @if(request('search') || request('status'))
            <div class="col-md-2">
                <a href="{{ route('admin.karyas.index') }}" class="btn btn-outline-secondary w-100">
                    <i class="bi bi-x me-1"></i>Reset
                </a>
            </div>
            @endif
        </form>
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
                        <th>Gambar</th>
                        <th>Judul</th>
                        <th>Seniman</th>
                        <th>Harga</th>
                        <th>Status</th>
                        <th>Upload</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($karyas as $i => $k)
                    <tr>
                        <td class="text-muted small">{{ $karyas->firstItem() + $i }}</td>
                        <td>
                            <div style="width:52px;height:52px;border-radius:10px;overflow:hidden;background:linear-gradient(135deg,#9B59B6,#6C3483);display:flex;align-items:center;justify-content:center;font-size:1.3rem;">
                                @if($k->gambar && file_exists(public_path('uploads/karya/'.$k->gambar)))
                                    <img src="{{ asset('uploads/karya/'.$k->gambar) }}"
                                        style="width:52px;height:52px;object-fit:cover;">
                                @else
                                    🎨
                                @endif
                            </div>
                        </td>
                        <td>
                            <div class="fw-semibold small">{{ Str::limit($k->judul, 28) }}</div>
                            <div class="text-muted" style="font-size:0.72rem;">
                                {{ Str::limit($k->deskripsi, 40) }}
                            </div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <div class="rounded-circle text-white d-flex align-items-center justify-content-center fw-bold flex-shrink-0"
                                    style="width:28px;height:28px;font-size:11px;background:#6C3483;">
                                    {{ strtoupper(substr($k->seniman->nama, 0, 1)) }}
                                </div>
                                <span class="small">{{ $k->seniman->nama }}</span>
                            </div>
                        </td>
                        <td class="small fw-semibold" style="color:#6C3483;white-space:nowrap;">
                            {{ $k->harga_format }}
                        </td>
                        <td>
                            <span class="badge {{ $k->status_karya === 'tersedia' ? 'bg-success' : 'bg-danger' }}">
                                {{ ucfirst($k->status_karya) }}
                            </span>
                        </td>
                        <td class="small text-muted">{{ $k->created_at->format('d M Y') }}</td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="{{ route('admin.karyas.show', $k) }}"
                                    class="btn btn-sm btn-outline-primary" title="Detail">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('gallery.show', $k) }}" target="_blank"
                                    class="btn btn-sm btn-outline-secondary" title="Lihat Publik">
                                    <i class="bi bi-box-arrow-up-right"></i>
                                </a>
                                <form method="POST" action="{{ route('admin.karyas.destroy', $k) }}"
                                    onsubmit="return confirm('Hapus karya {{ addslashes($k->judul) }}?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger" title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center py-5 text-muted">
                            <i class="bi bi-images fs-2 d-block mb-2 opacity-25"></i>
                            Tidak ada karya ditemukan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($karyas->hasPages())
    <div class="card-footer">{{ $karyas->withQueryString()->links() }}</div>
    @endif
</div>
@endsection