@extends('layouts.dashboard')
@section('title', 'Detail Karya')
@section('page-title', 'Detail Karya')

@section('content')
<div class="mb-3">
    <a href="{{ route('admin.karyas.index') }}" class="btn btn-sm btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i>Kembali
    </a>
</div>

<div class="row g-4">
    <div class="col-lg-5">
        <div class="card overflow-hidden" style="border-radius:16px;">
            @if($karya->gambar && file_exists(public_path('uploads/karya/'.$karya->gambar)))
                <img src="{{ asset('uploads/karya/'.$karya->gambar) }}"
                    class="img-fluid w-100" style="max-height:420px;object-fit:cover;">
            @else
                <div style="height:300px;background:linear-gradient(135deg,#9B59B6,#6C3483);display:flex;align-items:center;justify-content:center;font-size:6rem;">
                    🎨
                </div>
            @endif
        </div>
    </div>

    <div class="col-lg-7">
        <div class="card mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <span class="fw-semibold"><i class="bi bi-image me-2 text-primary"></i>Info Karya</span>
                <span class="badge {{ $karya->status_karya === 'tersedia' ? 'bg-success' : 'bg-danger' }} fs-6">
                    {{ ucfirst($karya->status_karya) }}
                </span>
            </div>
            <div class="card-body">
                <h4 class="fw-bold mb-2" style="font-family:'Playfair Display',serif;">
                    {{ $karya->judul }}
                </h4>
                <div class="fw-bold fs-4 mb-3" style="color:#6C3483;">{{ $karya->harga_format }}</div>
                <p class="text-muted" style="line-height:1.8;">{{ $karya->deskripsi }}</p>
                <hr>
                <div class="row g-3">
                    <div class="col-sm-6">
                        <div class="text-muted small">Diupload</div>
                        <div class="fw-semibold">{{ $karya->created_at->format('d M Y, H:i') }}</div>
                    </div>
                    <div class="col-sm-6">
                        <div class="text-muted small">Terakhir Diupdate</div>
                        <div class="fw-semibold">{{ $karya->updated_at->format('d M Y, H:i') }}</div>
                    </div>
                </div>
                <hr>
                <div class="d-flex gap-2">
                    <a href="{{ route('gallery.show', $karya) }}" target="_blank"
                        class="btn btn-outline-primary">
                        <i class="bi bi-eye me-2"></i>Lihat di Galeri
                    </a>
                    <form method="POST" action="{{ route('admin.karyas.destroy', $karya) }}"
                        onsubmit="return confirm('Hapus karya ini permanen?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-outline-danger">
                            <i class="bi bi-trash me-2"></i>Hapus Karya
                        </button>
                    </form>
                </div>
            </div>
        </div>

        {{-- Info Seniman --}}
        <div class="card">
            <div class="card-header py-3">
                <span class="fw-semibold"><i class="bi bi-person me-2 text-primary"></i>Seniman</span>
            </div>
            <div class="card-body">
                <div class="d-flex align-items-center gap-3">
                    <div class="rounded-circle text-white d-flex align-items-center justify-content-center fw-bold overflow-hidden"
                        style="width:52px;height:52px;font-size:1.3rem;background:#6C3483;flex-shrink:0;">
                        @if($karya->seniman->profile && $karya->seniman->profile->foto && file_exists(public_path('uploads/profil/'.$karya->seniman->profile->foto)))
                            <img src="{{ asset('uploads/profil/'.$karya->seniman->profile->foto) }}"
                                style="width:52px;height:52px;object-fit:cover;">
                        @else
                            {{ strtoupper(substr($karya->seniman->nama, 0, 1)) }}
                        @endif
                    </div>
                    <div class="flex-grow-1">
                        <div class="fw-bold">{{ $karya->seniman->nama }}</div>
                        <div class="text-muted small">{{ $karya->seniman->email }}</div>
                        @if($karya->seniman->profile && $karya->seniman->profile->spesialisasi)
                        <div class="text-muted small">
                            <i class="bi bi-brush me-1"></i>{{ $karya->seniman->profile->spesialisasi }}
                        </div>
                        @endif
                    </div>
                    <div class="d-flex gap-2">
                        <a href="{{ route('admin.users.show', $karya->seniman) }}"
                            class="btn btn-sm btn-outline-primary">Detail</a>
                        <a href="{{ route('seniman.profile.public', $karya->seniman) }}"
                            target="_blank" class="btn btn-sm btn-outline-secondary">
                            <i class="bi bi-box-arrow-up-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection