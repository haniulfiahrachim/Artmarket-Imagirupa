@extends('layouts.app')
@section('title', $user->nama . ' - Seniman Imagirupa')

@push('styles')
<style>

body{
    background:#F5F5F5;
    color:#2C3E50;
}

/* Hero Profile */
.artist-hero{
    background:
        radial-gradient(circle at top left, rgba(255,90,9,0.08), transparent 30%),
        radial-gradient(circle at bottom right, rgba(44,62,80,0.06), transparent 30%),
        linear-gradient(135deg,#FFFFFF 0%,#F5F5F5 100%);
    padding:4rem 0;
    border-bottom:1px solid #EEEEEE;
    position:relative;
    overflow:hidden;
}

.artist-hero::before{
    content:'';
    position:absolute;
    inset:0;
    background-image:
        linear-gradient(rgba(0,0,0,0.015) 1px, transparent 1px),
        linear-gradient(90deg, rgba(0,0,0,0.015) 1px, transparent 1px);
    background-size:40px 40px;
}

/* Profile Avatar */
.artist-avatar{
    width:100px;
    height:100px;
    border-radius:50%;
    background:#FFFFFF;
    color:#FF5A09;
    font-size:2.3rem;
    font-weight:700;
    flex-shrink:0;
    border:4px solid #FFFFFF;
    box-shadow:
        0 10px 25px rgba(0,0,0,0.08),
        0 4px 10px rgba(255,90,9,0.08);
    overflow:hidden;
}

.artist-avatar img{
    width:100%;
    height:100%;
    object-fit:cover;
}

/* Verified */
.artist-badge{
    display:inline-flex;
    align-items:center;
    gap:6px;
    background:#FFFFFF;
    color:#2C3E50;
    border:1px solid #E5E7EB;
    padding:0.45rem 1rem;
    border-radius:999px;
    font-size:0.82rem;
    font-weight:600;
    box-shadow:0 4px 12px rgba(0,0,0,0.04);
}

/* Artist Name */
.artist-name{
    font-family:'Playfair Display', serif;
    font-size:2.8rem;
    font-weight:700;
    color:#2C3E50;
    line-height:1.2;
}

/* Bio */
.artist-bio{
    color:#5C6773;
    line-height:1.9;
    max-width:700px;
}

/* Portfolio Button */
.btn-outline-light{
    border:1px solid #FF5A09;
    color:#FF5A09 !important;
    background:#FFFFFF;
    border-radius:14px;
    font-weight:600;
    padding:0.7rem 1.2rem;
    transition:0.3s;
}

.btn-outline-light:hover{
    background:#FF5A09;
    color:#FFFFFF !important;
}

/* Section */
.section-title{
    font-size:1.5rem;
    font-weight:700;
    color:#2C3E50;
}

/* Artwork Card */
.karya-card{
    border:none;
    border-radius:24px;
    overflow:hidden;
    background:#FFFFFF;
    transition:0.35s ease;
    box-shadow:
        0 6px 18px rgba(0,0,0,0.05),
        0 2px 8px rgba(0,0,0,0.03);
}

.karya-card:hover{
    transform:translateY(-8px);
    box-shadow:
        0 20px 40px rgba(0,0,0,0.10),
        0 5px 15px rgba(255,90,9,0.08);
}

/* Artwork Image */
.karya-image{
    height:220px;
    overflow:hidden;
    background:#F3F4F6;
    position:relative;
}

.karya-image img{
    width:100%;
    height:100%;
    object-fit:cover;
    transition:0.4s ease;
}

.karya-card:hover img{
    transform:scale(1.05);
}

/* Title */
.karya-title{
    color:#2C3E50;
    font-weight:700;
    font-size:1rem;
    line-height:1.5;
}

/* Description */
.karya-description{
    color:#6B7280;
    line-height:1.7;
    min-height:45px;
}

/* Price */
.karya-price{
    color:#FF5A09;
    font-size:1.1rem;
    font-weight:700;
}

/* Empty State */
.empty-state{
    background:#FFFFFF;
    border-radius:24px;
    padding:4rem 2rem;
    box-shadow:0 6px 20px rgba(0,0,0,0.04);
}

.empty-state i{
    color:#D1D5DB;
}

/* Pagination */
.pagination{
    gap:0.5rem;
}

.page-link{
    border:none;
    border-radius:12px !important;
    color:#2C3E50;
    background:#FFFFFF;
    box-shadow:0 2px 8px rgba(0,0,0,0.04);
    min-width:42px;
    text-align:center;
}

.page-link:hover{
    background:#FFF3EC;
    color:#FF5A09;
}

.page-item.active .page-link{
    background:#FF5A09;
    color:#FFFFFF;
}

/* Responsive */
@media(max-width:768px){

    .artist-name{
        font-size:2rem;
    }

    .artist-hero{
        text-align:center;
    }

    .artist-hero .d-flex{
        flex-direction:column;
    }

}

</style>
@endpush

@section('content')
<div class="artist-hero">
    <div class="container">
        <div class="d-flex align-items-center gap-4">
            <div class="artist-avatar d-flex align-items-center justify-content-center" style="width:90px;height:90px;font-size:2.2rem;color:#6C3483;flex-shrink:0;">
                @if($user->profile && $user->profile->foto && file_exists(public_path('uploads/profil/'.$user->profile->foto)))
                    <img src="{{ asset('uploads/profil/'.$user->profile->foto) }}" class="rounded-circle" style="width:90px;height:90px;object-fit:cover;">
                @else
                    {{ strtoupper(substr($user->nama, 0, 1)) }}
                @endif
            </div>
            <div>
                <div class="artist-badge mb-3"><i class="bi bi-patch-check-fill me-1 text-warning"></i>Seniman Terverifikasi</div>
                <h2 class="artist-name">{{ $user->nama }}</h2>
                @if($user->profile && $user->profile->bio)
                    <p class="artist-bio mb-3" style="max-width:600px;">{{ $user->profile->bio }}</p>
                @endif
                @if($user->profile && $user->profile->link_portofolio)
                    <a href="{{ $user->profile->link_portofolio }}" target="_blank" class="btn btn-sm btn-outline-light">
                        <i class="bi bi-link-45deg me-1"></i>Portofolio
                    </a>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="section-title mb-0">Karya dari {{ $user->nama }}</h5>
        <span class="text-muted small">{{ $karyas->total() }} karya tersedia</span>
    </div>

    <div class="row g-4">
        @forelse($karyas as $karya)
        <div class="col-sm-6 col-md-4">
            <a href="{{ route('gallery.show', $karya) }}" class="text-decoration-none">
                <div class="card karya-card h-100" style="border-radius:16px;overflow:hidden;border:none;box-shadow:0 4px 15px rgba(0,0,0,0.08);transition:transform .3s;" onmouseover="this.style.transform='translateY(-5px)'" onmouseout="this.style.transform='none'">
                    <div class="karya-image"display:flex;align-items:center;justify-content:center;font-size:3rem;">
                        @if($karya->gambar && file_exists(public_path('uploads/karya/'.$karya->gambar)))
                            <img src="{{ asset('uploads/karya/'.$karya->gambar) }}" style="width:100%;height:200px;object-fit:cover;">
                        @else
                            🎨
                        @endif
                    </div>
                    <div class="card-body">
                        <h6 class="karya-title mb-1">{{ $karya->judul }}</h6>
                        <p class="karya-description small mb-2">{{ Str::limit($karya->deskripsi, 70) }}</p>
                        <div class="karya-price">{{ $karya->harga_format }}</div>
                    </div>
                </div>
            </a>
        </div>
        </div>
        @empty
        <div class="col-12">
    <div class="empty-state text-center text-muted">
            <i class="bi bi-images fs-1 d-block mb-2"></i>
            Seniman ini belum memiliki karya yang tersedia.
        </div>
        @endforelse
    </div>

    @if($karyas->hasPages())
    <div class="d-flex justify-content-center mt-5">{{ $karyas->links() }}</div>
    @endif
</div>
@endsection
