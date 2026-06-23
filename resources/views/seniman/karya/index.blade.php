@extends('layouts.dashboard')
@section('title', 'Kelola Karya')
@section('page-title', 'Kelola Karya Saya')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="fw-bold mb-0">Karya Saya ({{ $karyas->total() }})</h5>
    @if(auth()->user()->isVerified())
    <a href="{{ route('seniman.karya.create') }}" class="btn btn-primary"><i class="bi bi-plus-circle me-2"></i>Upload Karya</a>
    @endif
</div>

@if(!auth()->user()->isVerified())
<div class="alert alert-warning mb-4"><i class="bi bi-exclamation-triangle me-2"></i>Akun Anda belum diverifikasi. Anda tidak dapat mengupload karya baru.</div>
@endif

<div class="row g-4">
    @forelse($karyas as $karya)
    <div class="col-sm-6 col-xl-4">
        <div class="card h-100" style="border-radius:14px;overflow:hidden;">
            <div style="height:180px;overflow:hidden;background:linear-gradient(135deg,#9B59B6,#6C3483);display:flex;align-items:center;justify-content:center;font-size:3rem;">
                @if($karya->gambar && file_exists(public_path('uploads/karya/'.$karya->gambar)))
                    <img src="{{ asset('uploads/karya/'.$karya->gambar) }}" style="width:100%;height:180px;object-fit:cover;">
                @else 🎨 @endif
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start mb-1">
                    <h6 class="fw-bold mb-0 flex-grow-1 me-2">{{ $karya->judul }}</h6>
                    <div class="d-flex gap-1 flex-wrap">
                <span class="badge {{ $karya->status_karya==='tersedia'?'bg-success':'bg-danger' }}">
                    {{ ucfirst($karya->status_karya) }}
                </span>
                {!! $karya->stok_label !!}
            </div>
                </div>
                <p class="text-muted small mb-2">{{ Str::limit($karya->deskripsi, 70) }}</p>
                <div class="fw-bold mb-3" style="color:#6C3483;">{{ $karya->harga_format }}</div>
                <div class="d-flex gap-2">
                    <a href="{{ route('seniman.karya.edit', $karya) }}" class="btn btn-sm btn-outline-primary flex-fill"><i class="bi bi-pencil me-1"></i>Edit</a>
                    <form method="POST" action="{{ route('seniman.karya.destroy', $karya) }}" onsubmit="return confirm('Hapus karya {{ $karya->judul }}?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12 text-center py-5">
        <i class="bi bi-images fs-1 text-muted d-block mb-3"></i>
        <h5 class="text-muted">Belum ada karya</h5>
        @if(auth()->user()->isVerified())
        <a href="{{ route('seniman.karya.create') }}" class="btn btn-primary mt-2"><i class="bi bi-plus-circle me-2"></i>Upload Karya Pertama</a>
        @endif
    </div>
    @endforelse
</div>
@if($karyas->hasPages())
<div class="d-flex justify-content-center mt-4">{{ $karyas->links() }}</div>
@endif
@endsection
