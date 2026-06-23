@extends('layouts.dashboard')
@section('title', 'Dashboard Seniman')
@section('page-title', 'Dashboard')

@push('styles')
<style>

body{
    background:#F5F5F5;
    color:#2C3E50;
    font-family:'Inter',sans-serif;
}

/* Welcome Card */
.welcome-card{
    background:
        radial-gradient(circle at top left, rgba(255,90,9,0.08), transparent 30%),
        radial-gradient(circle at bottom right, rgba(44,62,80,0.05), transparent 30%),
        linear-gradient(135deg,#FFFFFF 0%,#F8F9FA 100%);
    border-radius:28px;
    padding:2.3rem;
    position:relative;
    overflow:hidden;
    border:1px solid #EEEEEE;
    box-shadow:
        0 10px 30px rgba(0,0,0,0.05),
        0 2px 10px rgba(0,0,0,0.03);
}

.welcome-card::before{
    content:'';
    position:absolute;
    width:260px;
    height:260px;
    background:rgba(255,90,9,0.04);
    border-radius:50%;
    top:-120px;
    right:-80px;
}

.welcome-card::after{
    content:'';
    position:absolute;
    width:160px;
    height:160px;
    background:rgba(44,62,80,0.04);
    border-radius:50%;
    bottom:-70px;
    right:120px;
}

.welcome-card h3{
    color:#2C3E50;
    font-size:2.1rem;
}

.welcome-card p{
    color:#6B7280 !important;
}

.text-white-50,
.text-white-75{
    color:#6B7280 !important;
}

/* Stat Cards */
.stat-card{
    background:#FFFFFF;
    border-radius:22px;
    padding:1.5rem;
    border:none;
    box-shadow:
        0 6px 20px rgba(0,0,0,0.05),
        0 2px 8px rgba(0,0,0,0.03);
    transition:0.35s ease;
}

.stat-card:hover{
    transform:translateY(-6px);
    box-shadow:
        0 18px 35px rgba(0,0,0,0.08),
        0 5px 15px rgba(255,90,9,0.06);
}

.stat-num{
    font-size:2rem;
    font-weight:700;
    color:#2C3E50;
    line-height:1;
}

.stat-lbl{
    font-size:0.8rem;
    color:#6B7280;
    margin-bottom:0.4rem;
}

.stat-icon{
    width:56px;
    height:56px;
    border-radius:18px;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:1.3rem;
    flex-shrink:0;
}

/* Cards */
.card{
    border:none;
    border-radius:24px;
    overflow:hidden;
    background:#FFFFFF;
    box-shadow:
        0 6px 18px rgba(0,0,0,0.05),
        0 2px 8px rgba(0,0,0,0.03);
}

.card-header{
    background:#FFFFFF;
    border-bottom:1px solid #F1F1F1;
    padding:1rem 1.4rem;
}

/* Table */
.table{
    margin-bottom:0;
}

.table thead th{
    background:#FAFAFA !important;
    color:#6B7280 !important;
    font-size:0.72rem !important;
    font-weight:600;
    letter-spacing:.05em;
    border-bottom:none;
    padding:1rem;
}

.table tbody td{
    padding:1rem;
    vertical-align:middle;
    border-color:#F3F4F6;
}

.table-hover tbody tr:hover{
    background:#FAFAFA;
}

/* Buttons */
.btn{
    border-radius:14px;
    font-weight:600;
    transition:0.3s;
}

.btn-warning{
    background:#FF5A09 !important;
    border:none !important;
    color:#FFFFFF !important;
    box-shadow:0 8px 20px rgba(255,90,9,0.20);
}

.btn-warning:hover{
    background:#E74C3C !important;
    transform:translateY(-2px);
}

.btn-outline-light{
    border:1px solid #D1D5DB;
    background:#FFFFFF;
    color:#2C3E50 !important;
}

.btn-outline-light:hover{
    background:#2C3E50;
    color:#FFFFFF !important;
}

.btn-outline-primary{
    border:1px solid #FF5A09;
    color:#FF5A09;
}

.btn-outline-primary:hover{
    background:#FF5A09;
    color:#FFFFFF;
}

/* Quick Action */
.quick-action{
    display:flex;
    align-items:center;
    gap:1rem;
    padding:1rem 1.1rem;
    border-radius:18px;
    text-decoration:none;
    background:#FFFFFF;
    border:1px solid #EEEEEE;
    transition:0.3s;
    color:#2C3E50;
}

.quick-action:hover{
    background:#FFF7F2;
    border-color:#FFD6BF;
    transform:translateX(5px);
    color:#FF5A09;
}

.quick-action-icon{
    width:46px;
    height:46px;
    border-radius:14px;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:1.15rem;
    flex-shrink:0;
}

/* Avatar */
.rounded-circle{
    box-shadow:0 4px 12px rgba(0,0,0,0.06);
}

/* Empty */
.empty-table{
    text-align:center;
    padding:3rem 1rem;
    color:#9CA3AF;
}

.empty-table i{
    font-size:2.5rem;
    margin-bottom:0.7rem;
    opacity:0.4;
}

/* Alert */
.alert{
    border:none;
    border-radius:18px;
    box-shadow:0 4px 14px rgba(0,0,0,0.04);
}

.alert-warning{
    background:#FFF7ED;
    color:#C2410C;
}

/* Badges */
.badge{
    border-radius:999px;
    padding:0.45rem 0.8rem;
    font-weight:600;
}

/* Text */
.text-muted{
    color:#6B7280 !important;
}

/* Responsive */
@media(max-width:768px){

    .welcome-card{
        padding:1.8rem;
    }

    .welcome-card h3{
        font-size:1.6rem;
    }

    .stat-num{
        font-size:1.6rem;
    }

}

</style>
@endpush

@section('content')

{{-- Welcome Banner --}}
<div class="welcome-card mb-4">
    <div class="row align-items-center position-relative">
        <div class="col-md-8">
            <p class="text-white-50 small mb-1 fw-semibold text-uppercase">
                <i class="bi bi-palette2 me-1"></i>Imagirupa Art Market
            </p>
            <h3 class="fw-bold mb-1" style="font-family:'Playfair Display',serif;">
                Halo, {{ auth()->user()->nama }}! 👋
            </h3>
            <p class="text-white-75 mb-3" style="font-size:0.9rem;">
                @if(auth()->user()->isVerified())
                    Selamat datang kembali. Kelola karya dan pesanan Anda dari sini.
                @else
                    Akun Anda <strong>belum diverifikasi</strong> oleh admin. Anda belum bisa mengupload karya.
                @endif
            </p>
            <div class="d-flex gap-2 flex-wrap">
                @if(auth()->user()->isVerified())
                    <a href="{{ route('seniman.karya.create') }}" class="btn btn-warning btn-sm fw-semibold px-3">
                        <i class="bi bi-plus-circle me-1"></i>Upload Karya
                    </a>
                @endif
                <a href="{{ route('seniman.pesanan.index') }}" class="btn btn-outline-light btn-sm px-3">
                    <i class="bi bi-bag me-1"></i>Lihat Pesanan
                </a>
                <a href="{{ route('seniman.profile.public', auth()->user()) }}" target="_blank"
                   class="btn btn-outline-light btn-sm px-3">
                    <i class="bi bi-eye me-1"></i>Profil Publik
                </a>
            </div>
        </div>
        <div class="col-md-4 d-none d-md-flex justify-content-end align-items-center">
            <div style="font-size:5rem;opacity:0.2;">🎨</div>
        </div>
    </div>
</div>

@if(!auth()->user()->isVerified())
<div class="alert alert-warning d-flex align-items-start gap-3 mb-4" style="border-radius:12px;border-left:4px solid #f39c12;">
    <i class="bi bi-exclamation-triangle-fill fs-5 mt-1 text-warning"></i>
    <div>
        <div class="fw-semibold">Akun Belum Diverifikasi</div>
        <div class="small text-muted">Admin sedang memproses verifikasi akun seniman Anda. Setelah diverifikasi, Anda dapat mengupload karya dan menerima pesanan. Hubungi admin jika butuh bantuan.</div>
    </div>
</div>
@endif

{{-- Stats --}}
<div class="row g-3 mb-4">
    <div class="col-6 col-md-3">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="stat-lbl">Total Karya</div>
                    <div class="stat-num">{{ $stats['total_karya'] }}</div>
                </div>
                <div class="stat-icon" style="background:#eee8ff;color:#6C3483;">
                    <i class="bi bi-images"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="stat-lbl">Karya Tersedia</div>
                    <div class="stat-num">{{ $stats['karya_tersedia'] }}</div>
                </div>
                <div class="stat-icon" style="background:#e8f5e9;color:#27ae60;">
                    <i class="bi bi-check-circle"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="stat-lbl">Karya Terjual</div>
                    <div class="stat-num">{{ $stats['karya_terjual'] }}</div>
                </div>
                <div class="stat-icon" style="background:#fce4ec;color:#e91e63;">
                    <i class="bi bi-bag-check"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="stat-card">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <div class="stat-lbl">Total Pesanan</div>
                    <div class="stat-num">{{ $stats['total_pesanan'] }}</div>
                </div>
                <div class="stat-icon" style="background:#fff3e0;color:#e67e22;">
                    <i class="bi bi-receipt"></i>
                </div>
            </div>
            @if($stats['pesanan_pending'] > 0)
            <div class="mt-2">
                <span class="badge bg-warning text-dark" style="font-size:0.7rem;">
                    {{ $stats['pesanan_pending'] }} perlu diproses
                </span>
            </div>
            @endif
        </div>
    </div>
</div>

<div class="row g-4">

    {{-- Pesanan Terbaru --}}
    <div class="col-lg-8">
        <div class="card h-100">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <span class="fw-semibold"><i class="bi bi-receipt me-2 text-primary"></i>Pesanan Terbaru</span>
                <a href="{{ route('seniman.pesanan.index') }}" class="btn btn-sm btn-outline-primary">
                    Lihat Semua
                </a>
            </div>
            <div class="card-body p-0">
                @if($pesananTerbaru->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover mb-0 align-middle">
                        <thead>
                            <tr>
                                <th style="font-size:0.72rem;text-transform:uppercase;letter-spacing:.05em;color:#888;background:#fafafa;">Pelanggan</th>
                                <th style="font-size:0.72rem;text-transform:uppercase;letter-spacing:.05em;color:#888;background:#fafafa;">Karya</th>
                                <th style="font-size:0.72rem;text-transform:uppercase;letter-spacing:.05em;color:#888;background:#fafafa;">Total</th>
                                <th style="font-size:0.72rem;text-transform:uppercase;letter-spacing:.05em;color:#888;background:#fafafa;">Status</th>
                                <th style="font-size:0.72rem;text-transform:uppercase;letter-spacing:.05em;color:#888;background:#fafafa;">Bayar</th>
                                <th style="font-size:0.72rem;text-transform:uppercase;letter-spacing:.05em;color:#888;background:#fafafa;"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pesananTerbaru as $p)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="rounded-circle text-white d-flex align-items-center justify-content-center fw-bold"
                                            style="width:30px;height:30px;font-size:11px;background:#6C3483;flex-shrink:0;">
                                            {{ strtoupper(substr($p->pelanggan->nama, 0, 1)) }}
                                        </div>
                                        <span class="small fw-semibold text-nowrap">{{ Str::limit($p->pelanggan->nama, 14) }}</span>
                                    </div>
                                </td>
                                <td class="small text-muted">{{ Str::limit($p->karya->judul, 18) }}</td>
                                <td class="small fw-semibold" style="color:#6C3483;white-space:nowrap;">{{ $p->total_harga_format }}</td>
                                <td>{!! $p->status_badge !!}</td>
                                <td>
                                    {!! optional($p->pembayaran)->status_badge ?? '<span class="badge bg-secondary" style="font-size:.65rem;">Belum</span>' !!}
                                </td>
                                <td>
                                    <a href="{{ route('seniman.pesanan.show', $p) }}" class="btn btn-xs btn-outline-primary" style="font-size:0.75rem;padding:2px 8px;">
                                        Detail
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="empty-table">
                    <i class="bi bi-inbox"></i>
                    <p class="small mb-0">Belum ada pesanan masuk.</p>
                </div>
                @endif
            </div>
        </div>
    </div>

    {{-- Aksi Cepat + Info --}}
    <div class="col-lg-4">

        {{-- Aksi Cepat --}}
        <div class="card mb-4">
            <div class="card-header py-3">
                <span class="fw-semibold"><i class="bi bi-lightning me-2 text-warning"></i>Aksi Cepat</span>
            </div>
            <div class="card-body d-flex flex-column gap-2 p-3">
                @if(auth()->user()->isVerified())
                <a href="{{ route('seniman.karya.create') }}" class="quick-action">
                    <div class="quick-action-icon" style="background:#eee8ff;color:#6C3483;">
                        <i class="bi bi-plus-circle"></i>
                    </div>
                    <div>
                        <div class="fw-semibold small">Upload Karya Baru</div>
                        <div class="text-muted" style="font-size:0.72rem;">Tambahkan karya ke galeri</div>
                    </div>
                    <i class="bi bi-chevron-right ms-auto text-muted small"></i>
                </a>
                @endif
                <a href="{{ route('seniman.karya.index') }}" class="quick-action">
                    <div class="quick-action-icon" style="background:#e8f5e9;color:#27ae60;">
                        <i class="bi bi-images"></i>
                    </div>
                    <div>
                        <div class="fw-semibold small">Kelola Karya</div>
                        <div class="text-muted" style="font-size:0.72rem;">Edit atau hapus karya</div>
                    </div>
                    <i class="bi bi-chevron-right ms-auto text-muted small"></i>
                </a>
                <a href="{{ route('seniman.pesanan.index') }}" class="quick-action">
                    <div class="quick-action-icon" style="background:#fff3e0;color:#e67e22;">
                        <i class="bi bi-bag-check"></i>
                    </div>
                    <div>
                        <div class="fw-semibold small">Pesanan Masuk</div>
                        <div class="text-muted" style="font-size:0.72rem;">
                            @if($stats['pesanan_pending'] > 0)
                                <span class="text-danger fw-semibold">{{ $stats['pesanan_pending'] }} menunggu</span>
                            @else
                                Semua pesanan
                            @endif
                        </div>
                    </div>
                    <i class="bi bi-chevron-right ms-auto text-muted small"></i>
                </a>
                <a href="{{ route('seniman.profil.edit') }}" class="quick-action">
                    <div class="quick-action-icon" style="background:#fce4ec;color:#e91e63;">
                        <i class="bi bi-person-circle"></i>
                    </div>
                    <div>
                        <div class="fw-semibold small">Edit Profil</div>
                        <div class="text-muted" style="font-size:0.72rem;">Bio & media sosial</div>
                    </div>
                    <i class="bi bi-chevron-right ms-auto text-muted small"></i>
                </a>
                <a href="{{ route('gallery') }}" class="quick-action">
                    <div class="quick-action-icon" style="background:#e3f2fd;color:#1565c0;">
                        <i class="bi bi-shop"></i>
                    </div>
                    <div>
                        <div class="fw-semibold small">Lihat Marketplace</div>
                        <div class="text-muted" style="font-size:0.72rem;">Galeri publik</div>
                    </div>
                    <i class="bi bi-chevron-right ms-auto text-muted small"></i>
                </a>
            </div>
        </div>

        {{-- Status Akun --}}
        <div class="card">
            <div class="card-header py-3">
                <span class="fw-semibold"><i class="bi bi-person-badge me-2 text-primary"></i>Status Akun</span>
            </div>
            <div class="card-body p-3">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="rounded-circle text-white d-flex align-items-center justify-content-center fw-bold"
                        style="width:50px;height:50px;font-size:1.3rem;background:#6C3483;flex-shrink:0;">
                        @if(auth()->user()->profile && auth()->user()->profile->foto && file_exists(public_path('uploads/profil/'.auth()->user()->profile->foto)))
                            <img src="{{ asset('uploads/profil/'.auth()->user()->profile->foto) }}"
                                style="width:50px;height:50px;object-fit:cover;border-radius:50%;">
                        @else
                            {{ strtoupper(substr(auth()->user()->nama, 0, 1)) }}
                        @endif
                    </div>
                    <div>
                        <div class="fw-semibold small">{{ auth()->user()->nama }}</div>
                        <div class="text-muted" style="font-size:0.72rem;">{{ auth()->user()->email }}</div>
                    </div>
                </div>

                <div class="d-flex flex-column gap-2" style="font-size:0.82rem;">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="text-muted">Role</span>
                        <span class="badge bg-warning text-dark">Seniman</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="text-muted">Status Akun</span>
                        @if(auth()->user()->isVerified())
                            <span class="badge bg-success"><i class="bi bi-patch-check-fill me-1"></i>Verified</span>
                        @else
                            <span class="badge bg-secondary">Menunggu Verifikasi</span>
                        @endif
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="text-muted">Bergabung</span>
                        <span class="fw-semibold">{{ auth()->user()->created_at->format('d M Y') }}</span>
                    </div>
                    @if(auth()->user()->profile && auth()->user()->profile->spesialisasi)
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="text-muted">Spesialisasi</span>
                        <span class="fw-semibold text-end" style="max-width:150px;font-size:0.75rem;">
                            {{ Str::limit(auth()->user()->profile->spesialisasi, 30) }}
                        </span>
                    </div>
                    @endif
                </div>

                <div class="mt-3 pt-2 border-top">
                    <a href="{{ route('seniman.profile.public', auth()->user()) }}"
                       target="_blank"
                       class="btn btn-outline-primary btn-sm w-100">
                        <i class="bi bi-box-arrow-up-right me-1"></i>Lihat Profil Publik
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection