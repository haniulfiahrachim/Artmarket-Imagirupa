@extends('layouts.dashboard')
@section('title', 'Detail User - '.$user->nama)
@section('page-title', 'Detail User')

@section('content')
<div class="mb-3 d-flex align-items-center justify-content-between">
    <a href="{{ route('admin.users.index') }}" class="btn btn-sm btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i>Kembali
    </a>
    @if($user->isSeniman())
    <a href="{{ route('seniman.profile.public', $user) }}" target="_blank"
        class="btn btn-sm btn-outline-primary">
        <i class="bi bi-box-arrow-up-right me-1"></i>Lihat Profil Publik
    </a>
    @endif
</div>

<div class="row g-4">

    {{-- ═══ KOLOM KIRI ═══ --}}
    <div class="col-lg-4">

        {{-- Kartu Profil --}}
        <div class="card mb-4">
            <div class="card-body text-center py-4 px-3">
                {{-- Avatar --}}
                <div class="rounded-circle text-white d-flex align-items-center justify-content-center fw-bold mx-auto mb-3 overflow-hidden"
                    style="width:90px;height:90px;font-size:2.2rem;background:#6C3483;">
                    @if($user->profile && $user->profile->foto && file_exists(public_path('uploads/profil/'.$user->profile->foto)))
                        <img src="{{ asset('uploads/profil/'.$user->profile->foto) }}"
                            style="width:90px;height:90px;object-fit:cover;">
                    @else
                        {{ strtoupper(substr($user->nama, 0, 1)) }}
                    @endif
                </div>

                <h5 class="fw-bold mb-1">{{ $user->nama }}</h5>
                <p class="text-muted small mb-2">{{ $user->email }}</p>

                <div class="d-flex justify-content-center gap-2 mb-3">
                    <span class="badge {{ $user->role === 'seniman' ? 'bg-warning text-dark' : 'bg-info' }}">
                        {{ ucfirst($user->role) }}
                    </span>
                    <span class="badge {{ $user->status_akun === 'verified' ? 'bg-success' : 'bg-secondary' }}">
                        {{ $user->status_akun === 'verified' ? '✓ Verified' : '⏳ Pending' }}
                    </span>
                </div>

                @if($user->profile && $user->profile->bio)
                <p class="text-muted small text-start px-1 mb-3" style="line-height:1.7;">
                    {{ $user->profile->bio }}
                </p>
                @endif

                <div class="d-flex flex-column gap-1 mb-3 text-start px-1">
                    @if($user->profile && $user->profile->spesialisasi)
                    <div class="small">
                        <i class="bi bi-brush me-2 text-primary"></i>
                        <span class="text-muted">Spesialisasi:</span>
                        <strong class="ms-1">{{ $user->profile->spesialisasi }}</strong>
                    </div>
                    @endif
                    @if($user->profile && $user->profile->kota)
                    <div class="small">
                        <i class="bi bi-geo-alt me-2 text-primary"></i>
                        <span class="text-muted">Kota:</span>
                        <strong class="ms-1">{{ $user->profile->kota }}</strong>
                    </div>
                    @endif
                    @if($user->profile && $user->profile->alamat)
                    <div class="small">
                        <i class="bi bi-house me-2 text-primary"></i>
                        <span class="text-muted">Alamat:</span>
                        <span class="ms-1">{{ $user->profile->alamat }}</span>
                    </div>
                    @endif
                    <div class="small">
                        <i class="bi bi-calendar3 me-2 text-primary"></i>
                        <span class="text-muted">Bergabung:</span>
                        <strong class="ms-1">{{ $user->created_at->format('d M Y') }}</strong>
                    </div>
                </div>

                <hr>

                {{-- Tombol Verifikasi --}}
                @if($user->isSeniman() && !$user->isVerified())
                <div class="alert alert-warning py-2 small text-start mb-3">
                    <i class="bi bi-exclamation-triangle me-1"></i>
                    Akun seniman ini belum diverifikasi. Tinjau portofolio sebelum menyetujui.
                </div>
                <form method="POST" action="{{ route('admin.users.verifikasi', $user) }}" class="mb-2">
                    @csrf
                    <button class="btn btn-success w-100">
                        <i class="bi bi-check-circle me-2"></i>Verifikasi Akun Seniman
                    </button>
                </form>
                @elseif($user->isSeniman() && $user->isVerified())
                <div class="alert alert-success py-2 small text-start mb-3">
                    <i class="bi bi-patch-check-fill me-1"></i>
                    Akun seniman ini sudah terverifikasi.
                </div>
                <form method="POST" action="{{ route('admin.users.tolak', $user) }}" class="mb-2">
                    @csrf
                    <button class="btn btn-outline-warning w-100">
                        <i class="bi bi-x-circle me-2"></i>Batalkan Verifikasi
                    </button>
                </form>
                @endif

                <form method="POST" action="{{ route('admin.users.destroy', $user) }}"
                    onsubmit="return confirm('Yakin hapus user ini? Data tidak bisa dikembalikan.')">
                    @csrf @method('DELETE')
                    <button class="btn btn-outline-danger w-100">
                        <i class="bi bi-trash me-2"></i>Hapus User
                    </button>
                </form>
            </div>
        </div>

        {{-- Media Sosial --}}
        @if($user->profile && count($user->profile->sosmed) > 0)
        <div class="card mb-4">
            <div class="card-header py-3">
                <span class="fw-semibold">
                    <i class="bi bi-share me-2 text-primary"></i>Media Sosial
                </span>
            </div>
            <div class="card-body p-3">
                <div class="d-flex flex-column gap-2">
                    @foreach($user->profile->sosmed as $sm)
                    <a href="{{ $sm['url'] }}" target="_blank" rel="noopener"
                        class="d-flex align-items-center gap-3 text-decoration-none p-2 rounded-2"
                        style="transition:background .15s;"
                        onmouseover="this.style.background='#f5f0ff'"
                        onmouseout="this.style.background='transparent'">
                        <div class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0"
                            style="width:32px;height:32px;background:{{ $sm['color'] }};">
                            <i class="bi {{ $sm['icon'] }} text-white" style="font-size:.85rem;"></i>
                        </div>
                        <div class="flex-grow-1 overflow-hidden">
                            <div class="fw-semibold" style="font-size:.8rem;color:#333;">{{ $sm['name'] }}</div>
                            <div class="text-muted text-truncate" style="font-size:.72rem;">{{ $sm['label'] }}</div>
                        </div>
                        <i class="bi bi-arrow-up-right text-muted small flex-shrink-0"></i>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
        @endif

        {{-- Statistik --}}
        <div class="card">
            <div class="card-header py-3">
                <span class="fw-semibold">
                    <i class="bi bi-bar-chart me-2 text-primary"></i>Statistik
                </span>
            </div>
            <div class="card-body p-0">
                @php
                    $karyaTersedia = $user->karyas->where('status_karya','tersedia')->count();
                    $karyaTerjual  = $user->karyas->where('status_karya','terjual')->count();
                @endphp
                <div class="row g-0 text-center">
                    <div class="col-6 p-3 border-end">
                        <div class="fw-bold fs-4" style="color:#6C3483;">{{ $user->karyas->count() }}</div>
                        <div class="text-muted small">Total Karya</div>
                    </div>
                    <div class="col-6 p-3">
                        <div class="fw-bold fs-4 text-success">{{ $karyaTersedia }}</div>
                        <div class="text-muted small">Tersedia</div>
                    </div>
                    <div class="col-6 p-3 border-top border-end">
                        <div class="fw-bold fs-4 text-danger">{{ $karyaTerjual }}</div>
                        <div class="text-muted small">Terjual</div>
                    </div>
                    <div class="col-6 p-3 border-top">
                        <div class="fw-bold fs-4 text-info">{{ $user->pesanans->count() }}</div>
                        <div class="text-muted small">Pesanan</div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- ═══ KOLOM KANAN ═══ --}}
    <div class="col-lg-8">

        {{-- ═══ PORTOFOLIO KURASI (khusus seniman) ═══ --}}
        @if($user->isSeniman())
        <div class="card mb-4" style="border:2px solid {{ $user->isVerified() ? '#d4edda' : '#fff3cd' }};border-radius:16px;">
            <div class="card-header py-3 d-flex justify-content-between align-items-center"
                style="background:{{ $user->isVerified() ? '#f0fff4' : '#fffbea' }};border-bottom:1px solid {{ $user->isVerified() ? '#d4edda' : '#fde68a' }};">
                <span class="fw-semibold">
                    <i class="bi bi-folder2-open me-2" style="color:{{ $user->isVerified() ? '#27ae60' : '#f39c12' }};"></i>
                    Portofolio untuk Kurasi Admin
                </span>
                @if(!$user->isVerified())
                <span class="badge bg-warning text-dark">
                    <i class="bi bi-exclamation-triangle me-1"></i>Perlu Ditinjau
                </span>
                @else
                <span class="badge bg-success">
                    <i class="bi bi-check-circle me-1"></i>Sudah Diverifikasi
                </span>
                @endif
            </div>
            <div class="card-body p-4">

                {{-- File Portofolio yang diupload --}}
                @if($user->profile && $user->profile->portofolio_file)
                <div class="mb-4">
                    <div class="fw-semibold small text-muted text-uppercase mb-2 letter-spacing-1">
                        <i class="bi bi-paperclip me-1"></i>File Portofolio yang Diupload
                    </div>
                    @php
                        $portoFile = $user->profile->portofolio_file;
                        $portoPath = public_path('uploads/portofolio/' . $portoFile);
                        $ext = strtolower(pathinfo($portoFile, PATHINFO_EXTENSION));
                        $isImage = in_array($ext, ['jpg','jpeg','png','webp']);
                        $isPdf   = $ext === 'pdf';
                        $fileExists = file_exists($portoPath);
                    @endphp

                    @if($fileExists)
                        @if($isImage)
                        {{-- Preview gambar portofolio --}}
                        <div class="position-relative">
                            <img src="{{ asset('uploads/portofolio/'.$portoFile) }}"
                                class="img-fluid rounded-3 w-100"
                                style="max-height:360px;object-fit:contain;background:#f8f8f8;cursor:zoom-in;border:1px solid #eee;"
                                onclick="document.getElementById('portoModal').style.display='flex'">
                            <div class="text-muted small mt-1 text-center">
                                <i class="bi bi-zoom-in me-1"></i>Klik untuk perbesar
                            </div>
                        </div>

                        {{-- Fullscreen modal --}}
                        <div id="portoModal"
                            style="display:none;position:fixed;inset:0;background:rgba(0,0,0,0.9);z-index:9999;align-items:center;justify-content:center;cursor:zoom-out;"
                            onclick="this.style.display='none'">
                            <img src="{{ asset('uploads/portofolio/'.$portoFile) }}"
                                style="max-width:90vw;max-height:90vh;object-fit:contain;border-radius:8px;">
                        </div>

                        @elseif($isPdf)
                        {{-- Preview PDF --}}
                        <div class="border rounded-3 overflow-hidden mb-2" style="height:400px;">
                            <iframe src="{{ asset('uploads/portofolio/'.$portoFile) }}"
                                width="100%" height="100%" style="border:none;"></iframe>
                        </div>
                        @endif

                        {{-- Tombol download --}}
                        <div class="d-flex gap-2 mt-2">
                            <a href="{{ asset('uploads/portofolio/'.$portoFile) }}"
                                target="_blank"
                                class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-eye me-1"></i>Buka di Tab Baru
                            </a>
                            <a href="{{ asset('uploads/portofolio/'.$portoFile) }}"
                                download="{{ $portoFile }}"
                                class="btn btn-sm btn-outline-secondary">
                                <i class="bi bi-download me-1"></i>Download ({{ strtoupper($ext) }})
                            </a>
                        </div>
                    @else
                        <div class="alert alert-secondary small mb-0">
                            <i class="bi bi-exclamation-circle me-2"></i>
                            File portofolio terdaftar tapi tidak ditemukan di server.
                            <span class="text-muted">({{ $portoFile }})</span>
                        </div>
                    @endif
                </div>
                @else
                {{-- Tidak ada file portofolio --}}
                <div class="text-center py-3 mb-4">
                    <div style="width:56px;height:56px;border-radius:14px;background:#f5f5f5;display:flex;align-items:center;justify-content:center;font-size:1.6rem;margin:auto;margin-bottom:.75rem;">
                        📂
                    </div>
                    <div class="fw-semibold small text-muted">Tidak ada file portofolio diupload</div>
                    <div class="text-muted" style="font-size:.75rem;">Seniman tidak mengupload file portofolio saat registrasi.</div>
                </div>
                @endif

                {{-- Link Portofolio Online --}}
                @if($user->profile && $user->profile->link_portofolio)
                <div class="mb-4">
                    <div class="fw-semibold small text-muted text-uppercase mb-2">
                        <i class="bi bi-link-45deg me-1"></i>Link Portofolio Online
                    </div>
                    <a href="{{ $user->profile->link_portofolio }}" target="_blank" rel="noopener"
                        class="d-flex align-items-center gap-3 p-3 rounded-3 text-decoration-none"
                        style="background:#f8f4ff;border:1.5px solid #e0d0ff;transition:all .2s;"
                        onmouseover="this.style.borderColor='#6C3483'"
                        onmouseout="this.style.borderColor='#e0d0ff'">
                        <div class="d-flex align-items-center justify-content-center rounded-2"
                            style="width:40px;height:40px;background:#6C3483;flex-shrink:0;">
                            <i class="bi bi-briefcase text-white" style="font-size:1.1rem;"></i>
                        </div>
                        <div class="flex-grow-1 overflow-hidden">
                            <div class="fw-semibold small text-dark">Portofolio Online</div>
                            <div class="text-muted text-truncate" style="font-size:.75rem;">
                                {{ $user->profile->link_portofolio }}
                            </div>
                        </div>
                        <i class="bi bi-arrow-up-right text-muted flex-shrink-0"></i>
                    </a>
                </div>
                @endif

                {{-- Karya yang sudah diupload di platform --}}
                @if($user->karyas->count() > 0)
                <div class="mb-3">
                    <div class="fw-semibold small text-muted text-uppercase mb-2">
                        <i class="bi bi-images me-1"></i>Contoh Karya di Platform ({{ $user->karyas->count() }} karya)
                    </div>
                    <div class="row g-2">
                        @foreach($user->karyas->take(6) as $k)
                        <div class="col-4">
                            <a href="{{ route('gallery.show', $k) }}" target="_blank" class="d-block position-relative">
                                <div style="height:100px;border-radius:10px;overflow:hidden;background:linear-gradient(135deg,#9B59B6,#6C3483);">
                                    @if($k->gambar && file_exists(public_path('uploads/karya/'.$k->gambar)))
                                        <img src="{{ asset('uploads/karya/'.$k->gambar) }}"
                                            style="width:100%;height:100%;object-fit:cover;transition:.3s;"
                                            onmouseover="this.style.transform='scale(1.05)'"
                                            onmouseout="this.style.transform='none'">
                                    @else
                                        <div style="height:100%;display:flex;align-items:center;justify-content:center;font-size:2rem;">🎨</div>
                                    @endif
                                </div>
                                <div class="mt-1 px-1">
                                    <div style="font-size:.7rem;font-weight:600;color:#333;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">
                                        {{ $k->judul }}
                                    </div>
                                    <div style="font-size:.68rem;color:#6C3483;font-weight:700;">{{ $k->harga_format }}</div>
                                </div>
                            </a>
                        </div>
                        @endforeach
                    </div>
                    @if($user->karyas->count() > 6)
                    <div class="text-center mt-2">
                        <span class="text-muted small">+{{ $user->karyas->count() - 6 }} karya lainnya</span>
                    </div>
                    @endif
                </div>
                @else
                <div class="text-center py-2 text-muted small">
                    <i class="bi bi-images opacity-25 fs-3 d-block mb-1"></i>
                    Belum ada karya diupload di platform.
                </div>
                @endif

                {{-- Tombol aksi verifikasi di bawah --}}
                @if(!$user->isVerified())
                <div class="d-flex gap-2 mt-4 pt-3 border-top">
                    <form method="POST" action="{{ route('admin.users.verifikasi', $user) }}" class="flex-fill">
                        @csrf
                        <button class="btn btn-success w-100 py-2">
                            <i class="bi bi-check-circle me-2"></i>Setujui & Verifikasi Seniman
                        </button>
                    </form>
                    <form method="POST" action="{{ route('admin.users.destroy', $user) }}"
                        onsubmit="return confirm('Tolak dan hapus akun ini?')"
                        class="flex-fill">
                        @csrf @method('DELETE')
                        <button class="btn btn-outline-danger w-100 py-2">
                            <i class="bi bi-x-circle me-2"></i>Tolak & Hapus Akun
                        </button>
                    </form>
                </div>
                @endif

            </div>
        </div>
        @endif

        {{-- ═══ KARYA LENGKAP (tabel) ═══ --}}
        @if($user->karyas->count() > 0)
        <div class="card mb-4">
            <div class="card-header py-3">
                <span class="fw-semibold">
                    <i class="bi bi-images me-2 text-primary"></i>
                    Semua Karya ({{ $user->karyas->count() }})
                </span>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0 align-middle">
                        <thead>
                            <tr>
                                <th>Gambar</th>
                                <th>Judul</th>
                                <th>Harga</th>
                                <th>Status</th>
                                <th>Upload</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($user->karyas as $k)
                            <tr>
                                <td>
                                    <div style="width:44px;height:44px;border-radius:8px;overflow:hidden;background:linear-gradient(135deg,#9B59B6,#6C3483);display:flex;align-items:center;justify-content:center;font-size:1rem;">
                                        @if($k->gambar && file_exists(public_path('uploads/karya/'.$k->gambar)))
                                            <img src="{{ asset('uploads/karya/'.$k->gambar) }}"
                                                style="width:44px;height:44px;object-fit:cover;">
                                        @else
                                            🎨
                                        @endif
                                    </div>
                                </td>
                                <td class="fw-semibold small">{{ Str::limit($k->judul, 28) }}</td>
                                <td class="small fw-bold" style="color:#6C3483;">{{ $k->harga_format }}</td>
                                <td>
                                    <span class="badge {{ $k->status_karya === 'tersedia' ? 'bg-success' : 'bg-danger' }}">
                                        {{ ucfirst($k->status_karya) }}
                                    </span>
                                </td>
                                <td class="small text-muted">{{ $k->created_at->format('d M Y') }}</td>
                                <td>
                                    <a href="{{ route('gallery.show', $k) }}" target="_blank"
                                        class="btn btn-xs btn-outline-primary" style="font-size:.72rem;padding:2px 8px;">
                                        <i class="bi bi-eye me-1"></i>Lihat
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @endif

        {{-- ═══ RIWAYAT PESANAN (pelanggan) ═══ --}}
        @if($user->isPelanggan() && $user->pesanans->count() > 0)
        <div class="card">
            <div class="card-header py-3">
                <span class="fw-semibold">
                    <i class="bi bi-bag me-2 text-primary"></i>
                    Riwayat Pesanan ({{ $user->pesanans->count() }})
                </span>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0 align-middle">
                        <thead>
                            <tr><th>Karya</th><th>Total</th><th>Status</th><th>Tanggal</th><th></th></tr>
                        </thead>
                        <tbody>
                            @foreach($user->pesanans as $ps)
                            <tr>
                                <td class="small">{{ Str::limit(optional($ps->karya)->judul ?? '-', 24) }}</td>
                                <td class="small fw-bold" style="color:#6C3483;">{{ $ps->total_harga_format }}</td>
                                <td>{!! $ps->status_badge !!}</td>
                                <td class="small text-muted">{{ $ps->tanggal_pesanan->format('d M Y') }}</td>
                                <td>
                                    <a href="{{ route('admin.transaksi.show', $ps) }}"
                                        class="btn btn-xs btn-outline-primary" style="font-size:.72rem;padding:2px 8px;">
                                        Detail
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @endif

    </div>
</div>
@endsection