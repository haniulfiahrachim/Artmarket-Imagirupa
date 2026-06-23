@extends('layouts.dashboard')
@section('title', 'Edit Profil')
@section('page-title', 'Profil Saya')

@push('styles')
<style>
    .section-divider { font-size:0.72rem;font-weight:700;text-transform:uppercase;letter-spacing:.1em;color:#6C3483;border-bottom:2px solid #f0e6ff;padding-bottom:.4rem;margin-bottom:1rem;margin-top:1.5rem; }
    .sosmed-input-wrap { position:relative; }
    .sosmed-input-wrap .bi { position:absolute;left:12px;top:50%;transform:translateY(-50%);font-size:1rem;z-index:5; }
    .sosmed-input-wrap input { padding-left:2.2rem; }
    .profile-preview { width:100px;height:100px;border-radius:50%;object-fit:cover;border:4px solid #f0e6ff;box-shadow:0 4px 15px rgba(108,52,131,.15); }
    .avatar-placeholder { width:100px;height:100px;border-radius:50%;background:linear-gradient(135deg,#6C3483,#9B59B6);display:flex;align-items:center;justify-content:center;font-size:2.5rem;font-weight:700;color:#fff;border:4px solid #f0e6ff;box-shadow:0 4px 15px rgba(108,52,131,.15); }
    .preview-link { display:inline-flex;align-items:center;gap:6px;font-size:.8rem;color:#6C3483;text-decoration:none;padding:.35rem .85rem;border:1.5px solid #6C3483;border-radius:20px;transition:all .2s; }
    .preview-link:hover { background:#6C3483;color:#fff; }
</style>
@endpush

@section('content')
<div class="row justify-content-center">
<div class="col-lg-8">

    {{-- Header --}}
    <div class="card mb-4" style="background:linear-gradient(135deg,#1a0a2e,#6C3483);border-radius:16px;">
        <div class="card-body p-4 d-flex align-items-center gap-4 flex-wrap">
            <div id="avatarPreviewWrap">
                @if($user->profile && $user->profile->foto && file_exists(public_path('uploads/profil/'.$user->profile->foto)))
                    <img src="{{ asset('uploads/profil/'.$user->profile->foto) }}" class="profile-preview" id="avatarImg">
                @else
                    <div class="avatar-placeholder" id="avatarPlaceholder">{{ strtoupper(substr($user->nama,0,1)) }}</div>
                @endif
            </div>
            <div class="flex-grow-1">
                <h5 class="text-white fw-bold mb-1">{{ $user->nama }}</h5>
                <div class="text-white-50 small mb-2">{{ $user->email }}</div>
                <span class="badge {{ $user->status_akun==='verified'?'bg-success':'bg-warning text-dark' }}">
                    <i class="bi bi-patch-check-fill me-1"></i>
                    {{ $user->status_akun==='verified'?'Seniman Verified':'Menunggu Verifikasi' }}
                </span>
            </div>
            <a href="{{ route('seniman.profile.public', $user) }}" class="preview-link" target="_blank">
                <i class="bi bi-box-arrow-up-right"></i>Lihat Profil Publik
            </a>
        </div>
    </div>

    {{-- Form --}}
    <div class="card">
        <div class="card-header py-3"><span class="fw-semibold"><i class="bi bi-pencil-square me-2 text-primary"></i>Edit Profil Seniman</span></div>
        <div class="card-body p-4">
            <form method="POST" action="{{ route('seniman.profil.update') }}" enctype="multipart/form-data">
                @csrf @method('PUT')

                <div class="section-divider"><i class="bi bi-person me-1"></i>Informasi Dasar</div>
                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold small">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama',$user->nama) }}" required>
                        @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold small">Email</label>
                        <input type="email" class="form-control bg-light" value="{{ $user->email }}" disabled>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold small">Spesialisasi</label>
                        <input type="text" name="spesialisasi" class="form-control" placeholder="cth: Ilustrasi Digital, Lukisan, Fotografi" value="{{ old('spesialisasi',optional($user->profile)->spesialisasi) }}">
                        <div class="form-text">Pisahkan dengan koma jika lebih dari satu.</div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold small">Kota / Lokasi</label>
                        <input type="text" name="kota" class="form-control" placeholder="cth: Pontianak, Kalimantan Barat" value="{{ old('kota',optional($user->profile)->kota) }}">
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold small">Bio / Tentang Saya</label>
                    <textarea name="bio" class="form-control" rows="5" placeholder="Ceritakan tentang diri Anda sebagai seniman...">{{ old('bio',optional($user->profile)->bio) }}</textarea>
                    <div class="form-text">Maks. 2000 karakter. Bio tampil di halaman profil publik.</div>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold small">Foto Profil</label>
                    <input type="file" name="foto" id="fotoInput" class="form-control" accept="image/jpg,image/jpeg,image/png">
                    <div class="form-text">Format: JPG, PNG. Maks. 2MB.</div>
                </div>

                <div class="section-divider"><i class="bi bi-share me-1"></i>Media Sosial & Tautan</div>
                <p class="text-muted small mb-3">Untuk Instagram, Twitter, TikTok — isi username saja (tanpa @).</p>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold small"><i class="bi bi-instagram me-1" style="color:#E1306C;"></i>Instagram</label>
                        <div class="sosmed-input-wrap">
                            <i class="bi bi-at text-muted"></i>
                            <input type="text" name="instagram" class="form-control" placeholder="username_instagram" value="{{ old('instagram',optional($user->profile)->instagram) }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold small"><i class="bi bi-twitter-x me-1"></i>Twitter / X</label>
                        <div class="sosmed-input-wrap">
                            <i class="bi bi-at text-muted"></i>
                            <input type="text" name="twitter" class="form-control" placeholder="username_twitter" value="{{ old('twitter',optional($user->profile)->twitter) }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold small"><i class="bi bi-facebook me-1" style="color:#1877F2;"></i>Facebook</label>
                        <input type="text" name="facebook" class="form-control" placeholder="nama.profil atau URL facebook" value="{{ old('facebook',optional($user->profile)->facebook) }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold small"><i class="bi bi-tiktok me-1"></i>TikTok</label>
                        <div class="sosmed-input-wrap">
                            <i class="bi bi-at text-muted"></i>
                            <input type="text" name="tiktok" class="form-control" placeholder="username_tiktok" value="{{ old('tiktok',optional($user->profile)->tiktok) }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold small"><i class="bi bi-youtube me-1" style="color:#FF0000;"></i>YouTube</label>
                        <input type="text" name="youtube" class="form-control" placeholder="nama channel atau URL youtube" value="{{ old('youtube',optional($user->profile)->youtube) }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold small"><i class="bi bi-globe2 me-1" style="color:#6C3483;"></i>Website Pribadi</label>
                        <input type="text" name="website" class="form-control" placeholder="www.website-anda.com" value="{{ old('website',optional($user->profile)->website) }}">
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-semibold small"><i class="bi bi-briefcase me-1" style="color:#27ae60;"></i>Link Portofolio</label>
                        <input type="url" name="link_portofolio" class="form-control" placeholder="https://behance.net/username" value="{{ old('link_portofolio',optional($user->profile)->link_portofolio) }}">
                        <div class="form-text">URL lengkap portofolio online Anda (Behance, ArtStation, dll).</div>
                    </div>
                </div>

                <div class="d-flex gap-2 mt-4 pt-3 border-top">
                    <button type="submit" class="btn btn-primary px-4 py-2"><i class="bi bi-save me-2"></i>Simpan Profil</button>
                    <a href="{{ route('seniman.profile.public', $user) }}" target="_blank" class="btn btn-outline-secondary py-2"><i class="bi bi-eye me-2"></i>Preview Profil</a>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
@endsection

@push('scripts')
<script>
document.getElementById('fotoInput').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = (ev) => {
        const wrap = document.getElementById('avatarPreviewWrap');
        let img = document.getElementById('avatarImg');
        const placeholder = document.getElementById('avatarPlaceholder');
        if (!img) {
            img = document.createElement('img');
            img.id = 'avatarImg';
            img.className = 'profile-preview';
            if (placeholder) placeholder.replaceWith(img);
            else wrap.appendChild(img);
        }
        img.src = ev.target.result;
    };
    reader.readAsDataURL(file);
});
</script>
@endpush
