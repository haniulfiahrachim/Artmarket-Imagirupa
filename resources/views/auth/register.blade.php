@extends('layouts.app')
@section('title', 'Daftar - Imagirupa')

@push('styles')
<style>
body {
    min-height: 100vh;
    background:
        radial-gradient(circle at top left, rgba(255,90,9,0.08), transparent 30%),
        radial-gradient(circle at bottom right, rgba(44,62,80,0.05), transparent 30%),
        linear-gradient(135deg, #F5F5F5 0%, #FFFFFF 100%);
    font-family: 'Inter', sans-serif;
    color: #2C3E50;
    position: relative;
    overflow-x: hidden;
}
body::before {
    content: '';
    position: fixed;
    inset: 0;
    background-image:
        linear-gradient(rgba(0,0,0,0.015) 1px, transparent 1px),
        linear-gradient(90deg, rgba(0,0,0,0.015) 1px, transparent 1px);
    background-size: 40px 40px;
    pointer-events: none;
}
.auth-card {
    background: #FFFFFF;
    border-radius: 32px;
    box-shadow: 0 20px 50px rgba(0,0,0,0.08), 0 5px 20px rgba(0,0,0,0.04);
    padding: 2.8rem;
    max-width: 620px;
    width: 100%;
    border: 1px solid #EEEEEE;
    position: relative;
    overflow: hidden;
}
.auth-card::before {
    content: '';
    position: absolute;
    width: 220px; height: 220px;
    background: rgba(255,90,9,0.05);
    border-radius: 50%;
    top: -120px; right: -100px;
}
.auth-card::after {
    content: '';
    position: absolute;
    width: 140px; height: 140px;
    background: rgba(44,62,80,0.04);
    border-radius: 50%;
    bottom: -70px; left: -60px;
}
.auth-logo img { height: 58px; width: auto; filter: drop-shadow(0 4px 10px rgba(0,0,0,0.08)); }
.step-indicator {
    display: flex; align-items: center; gap: .6rem;
    background: #FFF7F2; border: 1px solid #FFE1CF;
    border-radius: 999px; padding: .5rem 1rem;
    font-size: .76rem; font-weight: 600; color: #FF5A09;
}
.step-dot {
    width: 22px; height: 22px; border-radius: 50%;
    background: #FF5A09; color: #fff;
    display: flex; align-items: center; justify-content: center;
    font-size: .68rem; font-weight: 700;
}
.form-label { color: #374151; font-weight: 600; margin-bottom: .45rem; }
.form-control, .form-select {
    min-height: 50px; border-radius: 14px;
    border: 1px solid #E5E7EB; background: #FAFAFA;
    color: #2C3E50; padding: .75rem 1rem; transition: .3s;
}
textarea.form-control { min-height: auto; }
.form-control::placeholder { color: #9CA3AF; }
.form-control:focus, .form-select:focus {
    border-color: #FF5A09; background: #fff;
    box-shadow: 0 0 0 .18rem rgba(255,90,9,0.12);
}
.btn-primary {
    background: #FF5A09 !important; border: none !important;
    border-radius: 16px; font-weight: 600; min-height: 52px;
    box-shadow: 0 10px 20px rgba(255,90,9,0.18); transition: .3s;
}
.btn-primary:hover { background: #E74C3C !important; transform: translateY(-2px); }

/* Role card */
.role-card {
    border: 1.5px solid #E5E7EB; border-radius: 20px;
    padding: 1.3rem 1rem; cursor: pointer; transition: .3s;
    background: #fff; height: 100%;
}
.role-card:hover { border-color: #FF5A09; background: #FFF7F2; transform: translateY(-3px); }
.role-card.selected {
    border-color: #FF5A09; background: #FFF3EC;
    box-shadow: 0 10px 20px rgba(255,90,9,0.08);
}
.role-radio { display: none; }

/* Pelanggan extra */
#pelangganFields { display: none; }
#pelangganFields.show { display: block; animation: fadeDown .3s ease; }

/* Seniman section */
#senimanFields { display: none; }
#senimanFields.show { display: block; animation: fadeDown .3s ease; }

@keyframes fadeDown {
    from { opacity: 0; transform: translateY(-10px); }
    to   { opacity: 1; transform: translateY(0); }
}

.section-box {
    background: #FAFAFA; border: 1px solid #EEEEEE;
    border-radius: 22px; padding: 1.5rem; margin-top: 1rem;
}
.section-title {
    font-size: .78rem; font-weight: 700;
    text-transform: uppercase; letter-spacing: .08em;
    color: #FF5A09; border-bottom: 1px solid #FFE1CF;
    padding-bottom: .55rem; margin-bottom: 1rem;
}

/* Foto preview */
.foto-preview {
    width: 85px; height: 85px; border-radius: 50%;
    object-fit: cover; border: 4px solid #fff;
    box-shadow: 0 6px 18px rgba(0,0,0,0.08); display: none;
}
.foto-placeholder {
    width: 85px; height: 85px; border-radius: 50%;
    background: linear-gradient(135deg, #FF5A09, #E74C3C);
    display: flex; align-items: center; justify-content: center;
    font-size: 2rem; color: #fff;
    border: 4px solid #fff; box-shadow: 0 6px 18px rgba(255,90,9,0.18);
}

/* Upload area */
.upload-area {
    border: 2px dashed #FFD6BF; border-radius: 18px;
    padding: 1.5rem; text-align: center; cursor: pointer; transition: .3s;
    background: #FFFDFC;
}
.upload-area:hover { border-color: #FF5A09; background: #FFF7F2; }
.upload-area.dragover { border-color: #FF5A09; background: #FFF3EC; }

/* Sosmed */
.sosmed-wrap { position: relative; }
.sosmed-wrap .sosmed-icon {
    position: absolute; left: 12px; top: 50%;
    transform: translateY(-50%); z-index: 5; color: #9CA3AF;
}
.sosmed-wrap input { padding-left: 2.2rem; }

.alert { border: none; border-radius: 16px; font-size: .85rem; }
.alert-danger { background: #FEF2F2; color: #B91C1C; }
.form-text { color: #9CA3AF !important; font-size: .72rem; }
.text-center a { color: #FF5A09 !important; }
.text-center a:hover { color: #E74C3C !important; }

@media(max-width: 768px) {
    .auth-card { padding: 2rem 1.5rem; border-radius: 24px; }
}
</style>
@endpush

@section('content')
<div class="d-flex align-items-center justify-content-center" style="min-height:100vh;padding:2rem 1rem;">
    <div class="auth-card">

        {{-- Logo --}}
        <div class="text-center mb-4">
            <div class="auth-logo">
                <img src="{{ asset('img/imagirupa.png') }}" alt="Imagirupa Logo">
            </div>
            <h5 class="mt-3 fw-bold">Buat Akun Baru</h5>
            <p class="text-muted small">Bergabung dengan komunitas seni Imagirupa Pontianak</p>
        </div>

        {{-- Errors --}}
        @if($errors->any())
        <div class="alert alert-danger py-2 small mb-3">
            <ul class="mb-0 ps-3">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
            @csrf

            {{-- ══════════════════════════════════
                 STEP 1 — PILIH ROLE
            ══════════════════════════════════ --}}
            <div class="step-indicator mb-3">
                <div class="step-dot">1</div> Pilih Tipe Akun
            </div>

            <div class="row g-2 mb-2">
                {{-- Pelanggan --}}
                <div class="col-6">
                    <label class="d-block h-100">
                        <input type="radio" name="role" value="pelanggan"
                            class="role-radio" id="rolePelanggan"
                            {{ old('role', 'pelanggan') === 'pelanggan' ? 'checked' : '' }}>
                        <div class="role-card h-100 {{ old('role', 'pelanggan') === 'pelanggan' ? 'selected' : '' }}"
                             id="cardPelanggan">
                            <div class="text-center">
                                <i class="bi bi-person-heart fs-2" style="color:#FF5A09;"></i>
                                <div class="fw-semibold small mt-1">Pelanggan</div>
                                <div class="text-muted" style="font-size:.7rem;">Beli & koleksi karya seni</div>
                            </div>
                        </div>
                    </label>
                </div>
                {{-- Seniman --}}
                <div class="col-6">
                    <label class="d-block h-100">
                        <input type="radio" name="role" value="seniman"
                            class="role-radio" id="roleSeniman"
                            {{ old('role') === 'seniman' ? 'checked' : '' }}>
                        <div class="role-card h-100 {{ old('role') === 'seniman' ? 'selected' : '' }}"
                             id="cardSeniman">
                            <div class="text-center">
                                <i class="bi bi-brush fs-2" style="color:#FF5A09;"></i>
                                <div class="fw-semibold small mt-1">Seniman</div>
                                <div class="text-muted" style="font-size:.7rem;">Jual karya seni Anda</div>
                            </div>
                        </div>
                    </label>
                </div>
            </div>
            <div class="small text-muted mb-4">
                <i class="bi bi-info-circle me-1 text-warning"></i>
                Akun seniman memerlukan verifikasi admin sebelum bisa mengupload karya.
            </div>

            {{-- ══════════════════════════════════
                 STEP 2 — INFORMASI AKUN (semua role)
            ══════════════════════════════════ --}}
            <div class="step-indicator mb-3">
                <div class="step-dot">2</div> Informasi Akun
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold small">
                    Nama Lengkap <span class="text-danger">*</span>
                </label>
                <input type="text" name="nama"
                    class="form-control @error('nama') is-invalid @enderror"
                    placeholder="Nama lengkap Anda"
                    value="{{ old('nama') }}" required>
                @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold small">
                    Email <span class="text-danger">*</span>
                </label>
                <input type="email" name="email"
                    class="form-control @error('email') is-invalid @enderror"
                    placeholder="nama@email.com"
                    value="{{ old('email') }}" required>
                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="row g-2 mb-3">
                <div class="col-6">
                    <label class="form-label fw-semibold small">
                        Password <span class="text-danger">*</span>
                    </label>
                    <input type="password" name="password"
                        class="form-control @error('password') is-invalid @enderror"
                        placeholder="Min. 6 karakter" required>
                    @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-6">
                    <label class="form-label fw-semibold small">
                        Konfirmasi Password <span class="text-danger">*</span>
                    </label>
                    <input type="password" name="password_confirmation"
                        class="form-control" placeholder="Ulangi password" required>
                </div>
            </div>

            {{-- ══════════════════════════════════
                 STEP 3A — PELANGGAN: Alamat saja
            ══════════════════════════════════ --}}
            <div id="pelangganFields" class="{{ old('role', 'pelanggan') === 'pelanggan' ? 'show' : '' }}">
            <div class="step-indicator mb-3">
                <div class="step-dot">3</div> Informasi Tambahan
            </div>
            <div class="section-box">
                <div class="section-title">
                    <i class="bi bi-house me-1"></i>Data Diri
                </div>

        {{-- No HP / WhatsApp --}}
        <div class="mb-3">
            <label class="form-label fw-semibold small">
                No. HP / WhatsApp <span class="text-danger">*</span>
            </label>
            <input type="text" name="no_hp"
                class="form-control @error('no_hp') is-invalid @enderror"
                placeholder="08xxxxxxxxxx"
                value="{{ old('no_hp') }}" required>
            <div class="form-text">
                <i class="bi bi-shield-check me-1"></i>
                Wajib diisi untuk verifikasi keaslian pesanan & konfirmasi admin.
            </div>
            @error('no_hp')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        {{-- Instagram --}}
        <div class="mb-3">
            <label class="form-label fw-semibold small">
                Instagram
                <span class="badge bg-secondary ms-1" style="font-size:0.6rem;">Opsional</span>
            </label>
            <div class="sosmed-wrap">
                <span class="sosmed-icon">@</span>
                <input type="text" name="instagram"
                    class="form-control"
                    placeholder="username"
                    value="{{ old('instagram') }}">
            </div>
            <div class="form-text">
                Membantu verifikasi identitas Anda sebagai pembeli.
            </div>
        </div>

        {{-- Alamat --}}
        <div class="mb-3">
            <label class="form-label fw-semibold small">Alamat Lengkap</label>
            <textarea name="alamat"
                class="form-control @error('alamat') is-invalid @enderror"
                rows="3"
                placeholder="Jl. Contoh No. 1, Kel. Sungai Jawi, Kec. Pontianak Kota, Kota Pontianak...">{{ old('alamat') }}</textarea>
            <div class="form-text">
                <i class="bi bi-info-circle me-1"></i>
                Alamat digunakan untuk keperluan pengiriman karya.
            </div>
            @error('alamat')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
    </div>
</div>

            {{-- ══════════════════════════════════
                 STEP 3B — SENIMAN: Profil lengkap
            ══════════════════════════════════ --}}
            <div id="senimanFields" class="{{ old('role') === 'seniman' ? 'show' : '' }}">
                <div class="step-indicator mb-3">
                    <div class="step-dot">3</div> Data Profil Seniman
                </div>

                <div class="section-box">

                    {{-- Foto Profil --}}
                    <div class="section-title">
                        <i class="bi bi-person-circle me-1"></i>Foto Profil
                    </div>
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div id="fotoPlaceholder" class="foto-placeholder">🎨</div>
                        <img id="fotoPreview" class="foto-preview" src="" alt="Preview">
                        <div class="flex-grow-1">
                            <input type="file" name="foto" id="fotoInput"
                                class="form-control form-control-sm @error('foto') is-invalid @enderror"
                                accept="image/jpg,image/jpeg,image/png">
                            <div class="form-text">JPG/PNG, maks. 2MB. Tampil di profil publik.</div>
                            @error('foto')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    {{-- Biodata --}}
                    <div class="section-title">
                        <i class="bi bi-file-person me-1"></i>Biodata
                    </div>
                    <div class="row g-2 mb-2">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small">Spesialisasi Seni</label>
                            <input type="text" name="spesialisasi"
                                class="form-control form-control-sm @error('spesialisasi') is-invalid @enderror"
                                placeholder="cth: Ilustrasi Digital, Lukisan"
                                value="{{ old('spesialisasi') }}">
                            <div class="form-text">Pisahkan dengan koma jika lebih dari satu.</div>
                            @error('spesialisasi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small">Kota / Lokasi</label>
                            <input type="text" name="kota"
                                class="form-control form-control-sm @error('kota') is-invalid @enderror"
                                placeholder="cth: Pontianak"
                                value="{{ old('kota') }}">
                            @error('kota')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="mb-2">
                        <label class="form-label fw-semibold small">Alamat Lengkap</label>
                        <textarea name="alamat_seniman"
                            class="form-control form-control-sm"
                            rows="2"
                            placeholder="Jl. Contoh No. 1, Pontianak...">{{ old('alamat_seniman') }}</textarea>
                    </div>
                    <div class="mb-2">
                        <label class="form-label fw-semibold small">Bio / Tentang Saya</label>
                        <textarea name="bio"
                            class="form-control form-control-sm @error('bio') is-invalid @enderror"
                            rows="3"
                            placeholder="Ceritakan tentang diri Anda sebagai seniman, pengalaman, gaya seni...">{{ old('bio') }}</textarea>
                        <div class="form-text">Tampil di profil publik. Maks. 1000 karakter.</div>
                        @error('bio')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    {{-- Portofolio & Sosmed --}}
                    <div class="section-title mt-3">
                        <i class="bi bi-share me-1"></i>Portofolio & Media Sosial
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold small">
                            Upload File Portofolio
                            <span class="badge bg-secondary ms-1" style="font-size:.6rem;">Opsional</span>
                        </label>
                        <div class="upload-area" id="uploadArea"
                            onclick="document.getElementById('portofolioInput').click()">
                            <i class="bi bi-cloud-upload fs-3 d-block mb-1" style="color:#FF5A09;opacity:.7;"></i>
                            <div class="fw-semibold small text-muted" id="uploadText">
                                Klik atau drag & drop file portofolio
                            </div>
                            <div class="text-muted mt-1" style="font-size:.72rem;">
                                PDF, JPG, PNG — Maks. 5MB
                            </div>
                        </div>
                        <input type="file" name="portofolio_file" id="portofolioInput"
                            class="d-none @error('portofolio_file') is-invalid @enderror"
                            accept=".pdf,image/jpg,image/jpeg,image/png">
                        @error('portofolio_file')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold small">
                            Link Portofolio Online
                            <span class="badge bg-secondary ms-1" style="font-size:.6rem;">Opsional</span>
                        </label>
                        <div class="input-group input-group-sm">
                            <span class="input-group-text">
                                <i class="bi bi-briefcase" style="color:#27ae60;"></i>
                            </span>
                            <input type="url" name="link_portofolio"
                                class="form-control @error('link_portofolio') is-invalid @enderror"
                                placeholder="https://behance.net/username"
                                value="{{ old('link_portofolio') }}">
                            @error('link_portofolio')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-text">Behance, ArtStation, Dribbble, dsb.</div>
                    </div>

                    <div class="row g-2">
                        <div class="col-6">
                            <label class="form-label fw-semibold small">
                                <i class="bi bi-instagram me-1" style="color:#E1306C;"></i>Instagram
                            </label>
                            <div class="sosmed-wrap">
                                <span class="sosmed-icon">@</span>
                                <input type="text" name="instagram"
                                    class="form-control form-control-sm"
                                    placeholder="username"
                                    value="{{ old('instagram') }}">
                            </div>
                        </div>
                        <div class="col-6">
                            <label class="form-label fw-semibold small">
                                <i class="bi bi-tiktok me-1"></i>TikTok
                            </label>
                            <div class="sosmed-wrap">
                                <span class="sosmed-icon">@</span>
                                <input type="text" name="tiktok"
                                    class="form-control form-control-sm"
                                    placeholder="username"
                                    value="{{ old('tiktok') }}">
                            </div>
                        </div>
                        <div class="col-6">
                            <label class="form-label fw-semibold small">
                                <i class="bi bi-twitter-x me-1"></i>Twitter / X
                            </label>
                            <div class="sosmed-wrap">
                                <span class="sosmed-icon">@</span>
                                <input type="text" name="twitter"
                                    class="form-control form-control-sm"
                                    placeholder="username"
                                    value="{{ old('twitter') }}">
                            </div>
                        </div>
                        <div class="col-6">
                            <label class="form-label fw-semibold small">
                                <i class="bi bi-facebook me-1" style="color:#1877F2;"></i>Facebook
                            </label>
                            <input type="text" name="facebook"
                                class="form-control form-control-sm"
                                placeholder="nama.profil"
                                value="{{ old('facebook') }}">
                        </div>
                        <div class="col-6">
                            <label class="form-label fw-semibold small">
                                <i class="bi bi-youtube me-1" style="color:#FF0000;"></i>YouTube
                            </label>
                            <input type="text" name="youtube"
                                class="form-control form-control-sm"
                                placeholder="nama channel"
                                value="{{ old('youtube') }}">
                        </div>
                        <div class="col-6">
                            <label class="form-label fw-semibold small">
                                <i class="bi bi-globe2 me-1" style="color:#6C3483;"></i>Website
                            </label>
                            <input type="text" name="website"
                                class="form-control form-control-sm"
                                placeholder="www.website-anda.com"
                                value="{{ old('website') }}">
                        </div>
                    </div>

                </div>{{-- end .section-box --}}
            </div>{{-- end #senimanFields --}}

            {{-- Submit --}}
            <button type="submit" class="btn btn-primary w-100 py-2 fw-semibold mt-4">
                <i class="bi bi-person-plus me-2"></i>Daftar Sekarang
            </button>
        </form>

        <p class="text-center small text-muted mt-3 mb-0">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="text-decoration-none fw-semibold">Masuk di sini</a>
        </p>

    </div>
</div>
@endsection

@push('scripts')
<script>
(function () {

    // ── Role toggle ──────────────────────────────────────────
    const radios          = document.querySelectorAll('.role-radio');
    const cardPelanggan   = document.getElementById('cardPelanggan');
    const cardSeniman     = document.getElementById('cardSeniman');
    const pelangganFields = document.getElementById('pelangganFields');
    const senimanFields   = document.getElementById('senimanFields');

    function updateRole() {
        const val = document.querySelector('.role-radio:checked')?.value;

        cardPelanggan.classList.toggle('selected', val === 'pelanggan');
        cardSeniman.classList.toggle('selected',   val === 'seniman');

        // Pelanggan: tampilkan form alamat saja
        if (val === 'pelanggan') {
            pelangganFields.classList.add('show');
            senimanFields.classList.remove('show');
        } else {
            pelangganFields.classList.remove('show');
            senimanFields.classList.add('show');
        }
    }

    radios.forEach(r => r.addEventListener('change', updateRole));
    updateRole();

    // ── Foto preview ─────────────────────────────────────────
    const fotoInput       = document.getElementById('fotoInput');
    const fotoPreview     = document.getElementById('fotoPreview');
    const fotoPlaceholder = document.getElementById('fotoPlaceholder');

    fotoInput?.addEventListener('change', function () {
        const file = this.files[0];
        if (!file) return;
        const reader = new FileReader();
        reader.onload = e => {
            fotoPreview.src = e.target.result;
            fotoPreview.style.display = 'block';
            fotoPlaceholder.style.display = 'none';
        };
        reader.readAsDataURL(file);
    });

    // ── Upload portofolio drag & drop ─────────────────────────
    const uploadArea = document.getElementById('uploadArea');
    const portoInput = document.getElementById('portofolioInput');
    const uploadText = document.getElementById('uploadText');

    portoInput?.addEventListener('change', function () {
        const file = this.files[0];
        if (file) {
            uploadText.innerHTML = `<i class="bi bi-check-circle-fill text-success me-1"></i>${file.name}`;
            uploadArea.style.borderColor = '#27ae60';
            uploadArea.style.background  = '#f0fff4';
        }
    });

    uploadArea?.addEventListener('dragover', e => {
        e.preventDefault();
        uploadArea.classList.add('dragover');
    });
    uploadArea?.addEventListener('dragleave', () => uploadArea.classList.remove('dragover'));
    uploadArea?.addEventListener('drop', e => {
        e.preventDefault();
        uploadArea.classList.remove('dragover');
        const file = e.dataTransfer.files[0];
        if (file) {
            const dt = new DataTransfer();
            dt.items.add(file);
            portoInput.files = dt.files;
            uploadText.innerHTML = `<i class="bi bi-check-circle-fill text-success me-1"></i>${file.name}`;
            uploadArea.style.borderColor = '#27ae60';
            uploadArea.style.background  = '#f0fff4';
        }
    });

    // ── Bio char counter ──────────────────────────────────────
    const bio = document.querySelector('textarea[name="bio"]');
    if (bio) {
        const counter = document.createElement('div');
        counter.className = 'form-text text-end';
        counter.style.fontSize = '.68rem';
        bio.parentNode.appendChild(counter);

        function updateCounter() {
            const len = bio.value.length;
            counter.textContent = `${len} / 1000 karakter`;
            counter.style.color = len > 900 ? '#e74c3c' : '#aaa';
        }
        bio.addEventListener('input', function () {
            if (this.value.length > 1000) this.value = this.value.slice(0, 1000);
            updateCounter();
        });
        updateCounter();
    }

})();
</script>
@endpush