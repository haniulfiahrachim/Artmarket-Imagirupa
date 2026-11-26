@extends('layouts.app')
@section('title', 'Galeri Karya - Imagirupa')

@push('styles')
<style>
    .gallery-hero{
    background:
        radial-gradient(circle at top left, rgba(255,90,9,0.08), transparent 30%),
        radial-gradient(circle at bottom right, rgba(44,62,80,0.05), transparent 30%),
        linear-gradient(135deg,#F5F5F5 0%,#FFFFFF 100%);
    padding:5rem 0 4rem;
    position:relative;
    overflow:hidden;
    border-bottom:1px solid #EEEEEE;
}

.gallery-hero::before{
    content:'';
    position:absolute;
    inset:0;
    background-image:
        linear-gradient(rgba(0,0,0,0.015) 1px, transparent 1px),
        linear-gradient(90deg, rgba(0,0,0,0.015) 1px, transparent 1px);
    background-size:40px 40px;
}

.gallery-hero h1{
    color:#2C3E50;
    font-weight:700;
    letter-spacing:-1px;
}

.gallery-hero p{
    color:#6B7280 !important;
    font-size:1rem;
}

/* Filter */
.filter-bar{
    background:#FFFFFF;
    border-radius:24px;
    padding:1.5rem;
    box-shadow:
        0 10px 30px rgba(0,0,0,0.05),
        0 2px 10px rgba(0,0,0,0.03);
    border:1px solid #ECECEC;
    margin-top:-2rem;
    position:relative;
    z-index:10;
}

.filter-bar .form-control,
.filter-bar .input-group-text,
.filter-bar .form-select{
    border:1px solid #E5E7EB;
    background:#FAFAFA;
    min-height:48px;
}

.filter-bar .form-control:focus,
.filter-bar .form-select:focus{
    border-color:#FF5A09;
    box-shadow:0 0 0 0.15rem rgba(255,90,9,0.15);
}

.input-group-text{
    border-radius:14px 0 0 14px !important;
}

.form-control{
    border-radius:0 14px 14px 0 !important;
}

.form-select{
    border-radius:14px !important;
}

/* Sort Button */
.sort-btn{
    border-radius:12px;
    padding:0.55rem 1rem;
    border:1px solid #E5E7EB;
    background:#FFFFFF;
    color:#2C3E50;
    font-weight:500;
    transition:0.3s;
}

.sort-btn:hover{
    background:#FFF3EC;
    color:#FF5A09;
    border-color:#FFD6BF;
}

.sort-btn.active{
    background:#FF5A09;
    color:#FFFFFF !important;
    border-color:#FF5A09;
    box-shadow:0 8px 20px rgba(255,90,9,0.2);
}

/* Card */
.karya-card{
    border:none;
    border-radius:24px;
    overflow:hidden;
    background:#FFFFFF;
    transition:0.35s ease;
    box-shadow:
        0 6px 18px rgba(0,0,0,0.05),
        0 2px 8px rgba(0,0,0,0.03);
    position:relative;
}

.karya-card:hover{
    transform:translateY(-8px);
    box-shadow:
        0 20px 40px rgba(0,0,0,0.10),
        0 5px 15px rgba(255,90,9,0.08);
}

.karya-img{
    height:240px;
    overflow:hidden;
    background:#F3F4F6;
    position:relative;
}

.karya-img img{
    width:100%;
    height:100%;
    object-fit:cover;
    transition:0.4s ease;
}

.karya-card:hover .karya-img img{
    transform:scale(1.06);
}

.karya-img::after{
    content:'';
    position:absolute;
    inset:0;
    background:linear-gradient(to top, rgba(0,0,0,0.08), transparent);
}

/* Text */
.card-body h6{
    color:#2C3E50;
    font-size:1rem;
    line-height:1.5;
}

.text-muted{
    color:#6B7280 !important;
}

.karya-price{
    color:#FF5A09;
    font-size:1.15rem;
    font-weight:700;
}

/* Badge */
.badge-tersedia{
    background:#ECFDF3;
    color:#027A48;
    padding:0.45rem 0.7rem;
    border-radius:999px;
    font-size:0.72rem;
}

.badge-terjual{
    background:#FEF3F2;
    color:#B42318;
    padding:0.45rem 0.7rem;
    border-radius:999px;
    font-size:0.72rem;
}

/* Artist */
.rounded-circle{
    box-shadow:0 4px 10px rgba(0,0,0,0.08);
}

/* Buttons */
.btn-primary{
    background:#FF5A09 !important;
    border:none !important;
    border-radius:14px;
    padding:0.7rem 1rem;
    font-weight:600;
    transition:0.3s;
}

.btn-primary:hover{
    background:#E74C3C !important;
    transform:translateY(-2px);
}

.btn-outline-primary{
    border:1px solid #FF5A09;
    color:#FF5A09;
    border-radius:14px;
    font-weight:600;
}

.btn-outline-primary:hover{
    background:#FF5A09;
    color:#FFFFFF;
}

.btn-secondary{
    border-radius:14px;
}

/* Empty State */
.bi-search{
    color:#D1D5DB !important;
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

    .gallery-hero{
        padding:4rem 0 3rem;
    }

    .gallery-hero h1{
        font-size:2rem !important;
    }

    .filter-bar{
        padding:1rem;
    }

}
</style>
@endpush

@section('content')
<div class="gallery-hero">
    <div class="container text-center">
        <h1 style="font-family:'Playfair Display',serif;font-size:2.5rem;">Galeri Karya Seni</h1>
        <p class="text-white-50">Jelajahi koleksi karya seni unik dari seniman berbakat Kalimantan Barat</p>
    </div>
</div>

<div class="container pb-5">
    <!-- Filter Bar -->
    <div class="filter-bar mb-4">
        <form method="GET" action="{{ route('gallery') }}" class="row g-2 align-items-center">
            <div class="col-md-5">
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0"><i class="bi bi-search text-muted"></i></span>
                    <input type="text" name="search" class="form-control border-start-0" placeholder="Cari karya seni..." value="{{ request('search') }}">
                </div>
            </div>
            <div class="col-md-5">
                <div class="d-flex gap-2 flex-wrap">
                    @foreach(['terbaru'=>'Terbaru','terpopuler'=>'Terpopuler','harga_terendah'=>'Harga ↓','harga_tertinggi'=>'Harga ↑'] as $val=>$label)
                    <a href="{{ route('gallery', array_merge(request()->query(), ['sort'=>$val])) }}"
                        class="btn btn-sm btn-outline-secondary sort-btn {{ request('sort', 'terbaru') === $val ? 'active' : '' }}">
                        {{ $label }}
                    </a>
                    @endforeach
                </div>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">Cari</button>
            </div>
        </form>
    </div>

    <!-- Results -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <span class="text-muted small">Menampilkan {{ $karyas->total() }} karya</span>
        @if(request('search'))
            <a href="{{ route('gallery') }}" class="btn btn-sm btn-outline-secondary">
                <i class="bi bi-x me-1"></i>Reset Filter
            </a>
        @endif
    </div>

    <div class="row g-4">
        @forelse($karyas as $karya)
        <div class="col-sm-6 col-lg-4 col-xl-3">
            <div class="card karya-card h-100">
                <a href="{{ route('gallery.show', $karya) }}" class="text-decoration-none">
                    <div class="karya-img">
                        @if($karya->gambar && file_exists(public_path('uploads/karya/'.$karya->gambar)))
                            <img src="{{ asset('uploads/karya/'.$karya->gambar) }}" alt="{{ $karya->judul }}">
                        @else
                            🎨
                        @endif
                    </div>
                </a>
                <div class="card-body d-flex flex-column">
                    <div class="d-flex justify-content-between align-items-start mb-1">
                        <h6 class="fw-bold text-dark mb-0 flex-grow-1 me-2">{{ $karya->judul }}</h6>
                        <span class="badge {{ $karya->status_karya === 'tersedia' ? 'badge-tersedia' : 'badge-terjual' }} small flex-shrink-0">
                            {{ ucfirst($karya->status_karya) }}
                        </span>
                    </div>
                    <p class="text-muted small mb-2 flex-grow-1">{{ Str::limit($karya->deskripsi, 70) }}</p>
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="karya-price">{{ $karya->harga_format }}</span>
                    </div>
                    @if($karya->total_terjual > 0)
                    <div class="d-flex align-items-center gap-1 mt-1" style="font-size:.80rem;color:#888;">
                        <i class="bi bi-bag-check-fill" style="color:#27ae60;font-size:.7rem;"></i>
                        <span>{{ $karya->total_terjual }} terjual</span>
                    </div>
                    @endif

                    <div class="d-flex align-items-center gap-2 mb-3">
                        <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center" style="width:24px;height:24px;font-size:11px;background:#6C3483!important;">
                            {{ strtoupper(substr($karya->seniman->nama, 0, 1)) }}
                        </div>
                        <a href="{{ route('seniman.profile.public', $karya->seniman) }}" class="text-decoration-none text-muted small">
                            {{ $karya->seniman->nama }}
                        </a>
                    </div>
                    @if($karya->status_karya === 'tersedia')
                        @auth
                            @if(auth()->user()->isPelanggan())
                                <a href="{{ route('gallery.show', $karya) }}" class="btn btn-primary btn-sm w-100">
                                    <i class="bi bi-bag-plus me-1"></i>Pesan Karya
                                </a>
                            @else
                                <a href="{{ route('gallery.show', $karya) }}" class="btn btn-outline-primary btn-sm w-100">
                                    <i class="bi bi-eye me-1"></i>Lihat Detail
                                </a>
                            @endif
                        @else
                            <a href="{{ route('login') }}" class="btn btn-primary btn-sm w-100">
                                <i class="bi bi-bag-plus me-1"></i>Pesan Karya
                            </a>
                        @endauth
                    @else
                        <button class="btn btn-secondary btn-sm w-100" disabled>Sudah Terjual</button>
                    @endif
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <i class="bi bi-search fs-1 text-muted d-block mb-3"></i>
            <h5 class="text-muted">Tidak ada karya ditemukan</h5>
            <p class="text-muted small">Coba ubah filter pencarian Anda</p>
            <a href="{{ route('gallery') }}" class="btn btn-outline-primary mt-2">Reset Filter</a>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($karyas->hasPages())
    <div class="d-flex justify-content-center mt-5">
        {{ $karyas->links() }}
    </div>
    @endif
</div>
@endsection
