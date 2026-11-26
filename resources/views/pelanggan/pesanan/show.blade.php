@extends('layouts.dashboard')
@section('title', 'Detail Pesanan')
@section('page-title', 'Detail Pesanan')

@push('styles')
<style>
    /* Opsi card */
    .opsi-card {
        border: 2px solid #e0e0e0;
        border-radius: 14px;
        padding: 1.25rem;
        cursor: pointer;
        transition: all .25s;
        background: #fff;
        position: relative;
    }
    .opsi-card:hover { border-color: #6C3483; background: #faf7ff; }
    .opsi-card.selected { border-color: #6C3483; background: #f5f0ff; }
    .opsi-card.selected::after {
        content: '✓';
        position: absolute;
        top: 10px; right: 12px;
        color: #6C3483;
        font-size: 1rem;
        font-weight: 700;
    }
    .opsi-card input[type="radio"] { display: none; }
    .opsi-icon {
        width: 50px; height: 50px;
        border-radius: 12px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.4rem; flex-shrink: 0;
    }

    /* Zona cards */
    .zona-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: .6rem; }
    @media(max-width:576px){ .zona-grid{ grid-template-columns: repeat(2, 1fr); } }

    .zona-card {
        border: 1.5px solid #e0e0e0;
        border-radius: 12px;
        padding: .75rem .5rem;
        cursor: pointer;
        transition: all .2s;
        background: #fff;
        text-align: center;
    }
    .zona-card:hover { border-color: #6C3483; background: #faf7ff; transform: translateY(-2px); }
    .zona-card.selected {
        border-color: #6C3483;
        background: #f5f0ff;
        box-shadow: 0 4px 14px rgba(108,52,131,.15);
    }
    .zona-card.selected .zona-km { color: #6C3483; }
    .zona-km { font-size: .8rem; font-weight: 600; color: #444; margin-bottom: 3px; }
    .zona-biaya { font-size: .88rem; font-weight: 700; color: #6C3483; }

    /* Cost preview */
    .cost-preview {
        background: linear-gradient(135deg, #f5f0ff, #ede7f6);
        border: 1.5px solid #c8b4e8;
        border-radius: 12px;
        padding: 1rem 1.25rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    /* Address box */
    .address-box {
        background: #faf8ff;
        border: 1.5px solid #d8c8f0;
        border-radius: 14px;
        padding: 1.25rem;
        margin-top: 1rem;
    }

    /* Step badges */
    .step-badge {
        display: inline-flex; align-items: center; justify-content: center;
        width: 28px; height: 28px; border-radius: 50%;
        background: #6C3483; color: #fff;
        font-size: .78rem; font-weight: 700; flex-shrink: 0;
    }
    .step-badge.done   { background: #27ae60; }
    .step-badge.inactive { background: #ddd; color: #999; }

    .info-rekening {
        background: #e8f4fd;
        border-left: 4px solid #3498db;
        border-radius: 0 10px 10px 0;
        padding: 1rem 1.25rem;
        font-size: .88rem;
    }
</style>
@endpush

@section('content')
<div class="mb-3">
    <a href="{{ route('pelanggan.pesanan.index') }}" class="btn btn-sm btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i>Kembali
    </a>
</div>

<div class="row g-4">

    {{-- ═══ KOLOM KIRI ═══ --}}
    <div class="col-lg-7">

        {{-- Info Pesanan --}}
        <div class="card mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <span class="fw-semibold">Pesanan #{{ $pesanan->id }}</span>
                {!! $pesanan->status_badge !!}
            </div>
            <div class="card-body">
                <div class="d-flex gap-3 mb-3">
                    <div style="width:70px;height:70px;border-radius:10px;overflow:hidden;background:linear-gradient(135deg,#9B59B6,#6C3483);flex-shrink:0;display:flex;align-items:center;justify-content:center;font-size:2rem;">
                        @if($pesanan->karya->gambar && file_exists(public_path('uploads/karya/'.$pesanan->karya->gambar)))
                            <img src="{{ asset('uploads/karya/'.$pesanan->karya->gambar) }}" style="width:70px;height:70px;object-fit:cover;">
                        @else 🎨 @endif
                    </div>
                    <div>
                        <div class="fw-bold text-dark">{{ $pesanan->karya->judul }}</div>
                        <div class="text-muted small">
                            by <a href="{{ route('seniman.profile.public', $pesanan->karya->seniman) }}"
                                class="text-decoration-none text-primary">{{ $pesanan->karya->seniman->nama }}</a>
                        </div>
                        <div class="fw-bold mt-1" style="color:#6C3483;font-size:1.1rem;">
                            {{ $pesanan->karya->harga_format }}
                        </div>
                    </div>
                </div>

                <hr class="my-2">
                <div class="row g-2 small">
                    <div class="col-6">
                        <span class="text-muted">Tanggal Pesan:</span>
                        <strong class="ms-1">{{ $pesanan->tanggal_pesanan->format('d M Y') }}</strong>
                    </div>
                    <div class="col-6">
                        <span class="text-muted">Opsi:</span>
                        <span class="ms-1">{!! $pesanan->opsi_pengambilan_label !!}</span>
                    </div>
                    @if($pesanan->opsi_pengambilan === 'antar' && $pesanan->alamat_pengiriman)
                    <div class="col-12">
                        <span class="text-muted">Alamat:</span>
                        <strong class="ms-1">{{ $pesanan->alamat_pengiriman }}</strong>
                    </div>
                    @if($pesanan->jarak_km > 0)
                    <div class="col-6">
                        <span class="text-muted">Zona Jarak:</span>
                        <strong class="ms-1">≤ {{ $pesanan->jarak_km }} km</strong>
                    </div>
                    @endif
                    @endif
                </div>

                @if($pesanan->opsi_pengambilan)
                <div class="mt-3 p-3 bg-light rounded-3">
                    <div class="d-flex justify-content-between small mb-1">
                        <span class="text-muted">Harga Karya</span>
                        <span>{{ $pesanan->karya->harga_format }}</span>
                    </div>
                    <div class="d-flex justify-content-between small mb-2">
                        <span class="text-muted">Biaya Pengiriman</span>
                        <span class="{{ $pesanan->biaya_pengiriman > 0 ? 'text-danger' : 'text-success' }}">
                            {{ $pesanan->biaya_pengiriman > 0 ? $pesanan->biaya_pengiriman_format : 'Gratis' }}
                        </span>
                    </div>
                    <hr class="my-1">
                    <div class="d-flex justify-content-between fw-bold">
                        <span>Total Bayar</span>
                        <span style="color:#6C3483;font-size:1.1rem;">{{ $pesanan->total_harga_format }}</span>
                    </div>
                </div>
                @endif
            </div>
        </div>

        {{-- ═══ STEP 1: Opsi Pengambilan ═══ --}}
        <div class="card mb-3">
            <div class="card-header py-3 d-flex align-items-center gap-2">
                <span class="step-badge {{ $pesanan->opsi_pengambilan ? 'done' : '' }}">
                    {{ $pesanan->opsi_pengambilan ? '✓' : '1' }}
                </span>
                <span class="fw-semibold">Pilih Opsi Pengambilan</span>
                @if($pesanan->opsi_pengambilan)
                    {!! $pesanan->opsi_pengambilan_label !!}
                @endif
            </div>
            <div class="card-body">
                @if($pesanan->status_pesanan === 'pending')
                <form method="POST"
                      action="{{ route('pelanggan.pesanan.pengambilan', $pesanan) }}"
                      id="formPengambilan">
                    @csrf
                    <input type="hidden" name="zona_index" id="zonaIndex"
                           value="{{ old('zona_index', '') }}">

                    {{-- Pilihan opsi --}}
                    <div class="row g-3 mb-3">
                        {{-- Layanan Antar --}}
                        <div class="col-md-6">
                            <label class="d-block h-100">
                                <input type="radio" name="opsi_pengambilan" value="antar"
                                    {{ $pesanan->opsi_pengambilan === 'antar' ? 'checked' : '' }}>
                                <div class="opsi-card h-100 {{ $pesanan->opsi_pengambilan === 'antar' ? 'selected' : '' }}"
                                     id="cardAntar">
                                    <div class="d-flex align-items-start gap-3">
                                        <div class="opsi-icon" style="background:#e3f2fd;color:#1565c0;">
                                            <i class="bi bi-truck"></i>
                                        </div>
                                        <div>
                                            <div class="fw-bold text-dark mb-1">Layanan Antar</div>
                                            <div class="text-muted small mb-1">Diantar ke alamat Anda.</div>
                                            <span class="badge bg-info text-white" style="font-size:.68rem;">
                                                Biaya sesuai zona jarak
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </label>
                        </div>

                        {{-- Ambil Sendiri --}}
                        <div class="col-md-6">
                            <label class="d-block h-100">
                                <input type="radio" name="opsi_pengambilan" value="ambil_sendiri"
                                    {{ $pesanan->opsi_pengambilan === 'ambil_sendiri' ? 'checked' : '' }}>
                                <div class="opsi-card h-100 {{ $pesanan->opsi_pengambilan === 'ambil_sendiri' ? 'selected' : '' }}"
                                     id="cardAmbil">
                                    <div class="d-flex align-items-start gap-3">
                                        <div class="opsi-icon" style="background:#e8f5e9;color:#2e7d32;">
                                            <i class="bi bi-shop"></i>
                                        </div>
                                        <div>
                                            <div class="fw-bold text-dark mb-1">Ambil Sendiri</div>
                                            <div class="text-muted small mb-1">Ke lokasi Imagirupa.</div>
                                            <span class="badge bg-success" style="font-size:.68rem;">GRATIS</span>
                                            <div class="text-muted mt-1" style="font-size:.7rem;">
                                                <i class="bi bi-clock me-1"></i>Sen–Sab, 09.00–17.00 WIB
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </label>
                        </div>
                    </div>

                    {{-- ═══ FORM ANTAR (muncul jika pilih layanan antar) ═══ --}}
                    <div id="antarFields" style="display:none;">
                        <div class="address-box">

                            {{-- Alamat text manual --}}
                            <div class="mb-4">
                                <label class="form-label fw-semibold small">
                                    <i class="bi bi-house-door me-1 text-primary"></i>
                                    Alamat Lengkap Pengiriman
                                    <span class="text-danger">*</span>
                                </label>
                                <textarea name="alamat_pengiriman" id="addressTextarea"
                                    class="form-control @error('alamat_pengiriman') is-invalid @enderror"
                                    rows="3"
                                    maxlength="500"
                                    placeholder="Contoh: Jl. Ahmad Yani No. 12, RT 03/RW 02, Kel. Sungai Jawi, Kec. Pontianak Kota, Kota Pontianak, 78112">{{ old('alamat_pengiriman', $pesanan->alamat_pengiriman) }}</textarea>
                                <div class="d-flex justify-content-between align-items-center mt-1">
                                    <div class="form-text">
                                        <i class="bi bi-pencil me-1"></i>
                                        Tulis nama jalan, nomor rumah, kelurahan, kecamatan, dan kota.
                                    </div>
                                    <div class="text-muted" id="addrCount" style="font-size:.68rem;">0/500</div>
                                </div>
                                @error('alamat_pengiriman')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Zona jarak --}}
                            <div class="mb-3">
                                <label class="form-label fw-semibold small">
                                    <i class="bi bi-map me-1 text-primary"></i>
                                    Estimasi Jarak dari Toko
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="alert alert-light py-2 small mb-3" style="border:1px solid #e0e0e0;">
                                    <i class="bi bi-geo-alt-fill me-1 text-danger"></i>
                                    Toko: <strong>{{ config('shipping.origin_name') }}</strong>.
                                    Cek jarak Anda ke toko via
                                    <a href="https://maps.google.com/?q={{ urlencode(config('shipping.origin_name')) }}"
                                       target="_blank" class="fw-semibold" style="color:#6C3483;">Google Maps</a>,
                                    lalu pilih zona di bawah.
                                </div>

                                <div class="zona-grid">
                                    @foreach(config('shipping.zona') as $i => $zona)
                                    <div class="zona-card {{ old('zona_index') == $i ? 'selected' : '' }}
                                                         {{ $pesanan->opsi_pengambilan === 'antar' && $pesanan->jarak_km == $zona['max_km'] ? 'selected' : '' }}"
                                         data-index="{{ $i }}"
                                         data-biaya="{{ $zona['biaya'] }}"
                                         data-label="{{ $zona['label'] }}"
                                         onclick="selectZona({{ $i }}, {{ $zona['biaya'] }}, '{{ $zona['label'] }}')">
                                        <div class="zona-km">{{ $zona['label'] }}</div>
                                        <div class="zona-biaya">
                                            Rp {{ number_format($zona['biaya'], 0, ',', '.') }}
                                        </div>
                                    </div>
                                    @endforeach
                                </div>

                                @error('zona_index')
                                    <div class="text-danger small mt-2">
                                        <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>

                            {{-- Preview biaya --}}
                            <div id="costPreview" style="display:none;">
                                <div class="cost-preview">
                                    <div>
                                        <div class="fw-semibold small">Estimasi Ongkos Kirim</div>
                                        <div class="text-muted" style="font-size:.75rem;">
                                            Zona: <span id="costZonaLabel"></span>
                                        </div>
                                    </div>
                                    <div class="fw-bold" style="color:#6C3483;font-size:1.3rem;" id="costAmount">
                                        Rp 0
                                    </div>
                                </div>
                                <div class="text-muted mt-1" style="font-size:.72rem;">
                                    <i class="bi bi-info-circle me-1"></i>
                                    Biaya final dikonfirmasi admin. Pembayaran sesuai total yang tertera di pesanan.
                                </div>
                            </div>

                        </div>{{-- end address-box --}}
                    </div>{{-- end antarFields --}}

                    @if($errors->has('opsi_pengambilan'))
                    <div class="alert alert-danger py-2 small mt-2">
                        {{ $errors->first('opsi_pengambilan') }}
                    </div>
                    @endif

                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="bi bi-check-circle me-2"></i>Simpan Pilihan Pengambilan
                        </button>
                    </div>
                </form>

                @else
                <div class="alert alert-secondary small mb-0">
                    <i class="bi bi-lock me-2"></i>
                    Opsi pengambilan tidak dapat diubah setelah pesanan diproses.
                </div>
                @endif
            </div>
        </div>

        {{-- Step line --}}
        <div style="width:2px;height:16px;background:#e0e0e0;margin:0 0 0 13px;"></div>

        {{-- ═══ STEP 2: Upload Pembayaran ═══ --}}
        <div class="card">
            <div class="card-header py-3 d-flex align-items-center gap-2">
                <span class="step-badge {{ $pesanan->pembayaran ? 'done' : ($pesanan->opsi_pengambilan ? '' : 'inactive') }}">
                    {{ $pesanan->pembayaran ? '✓' : '2' }}
                </span>
                <span class="fw-semibold">Upload Bukti Pembayaran</span>
                @if($pesanan->pembayaran)
                    {!! $pesanan->pembayaran->status_badge !!}
                @endif
            </div>
            <div class="card-body">
                @if(!$pesanan->opsi_pengambilan)
                    <div class="text-center py-3 text-muted">
                        <i class="bi bi-arrow-up-circle fs-3 d-block mb-2 opacity-50"></i>
                        <p class="small mb-0">Pilih opsi pengambilan di Langkah 1 terlebih dahulu.</p>
                    </div>

                @elseif($pesanan->status_pesanan === 'pending')
                    <div class="info-rekening mb-3">
                        <div class="fw-semibold mb-2">
                            <i class="bi bi-bank me-2"></i>Info Pembayaran
                        </div>
                        <div class="row g-1">
                            <div class="col-sm-6">
                                <div class="text-muted" style="font-size:.78rem;">Bank</div>
                                <div class="fw-bold">BCA</div>
                            </div>
                            <div class="col-sm-6">
                                <div class="text-muted" style="font-size:.78rem;">No. Rekening</div>
                                <div class="fw-bold">1234567890</div>
                            </div>
                            <div class="col-sm-6">
                                <div class="text-muted" style="font-size:.78rem;">Atas Nama</div>
                                <div class="fw-bold">Imagirupa Art Market</div>
                            </div>
                            <div class="col-sm-6">
                                <div class="text-muted" style="font-size:.78rem;">Jumlah Transfer</div>
                                <div class="fw-bold text-danger fs-6">{{ $pesanan->total_harga_format }}</div>
                            </div>
                        </div>
                    </div>

                    @if($pesanan->pembayaran && $pesanan->pembayaran->status_pembayaran === 'ditolak')
                    <div class="alert alert-danger small mb-3">
                        <i class="bi bi-x-circle me-2"></i>
                        Pembayaran ditolak. Silakan upload ulang bukti yang benar.
                    </div>
                    @elseif($pesanan->pembayaran && $pesanan->pembayaran->status_pembayaran === 'menunggu')
                    <div class="alert alert-warning small mb-3">
                        <i class="bi bi-hourglass-split me-2"></i>
                        Bukti pembayaran sedang menunggu verifikasi admin.
                    </div>
                    @endif

                    <form method="POST"
                          action="{{ route('pelanggan.pesanan.upload-bukti', $pesanan) }}"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label fw-semibold small">
                                Bukti Transfer <span class="text-danger">*</span>
                            </label>
                            <input type="file" name="bukti_pembayaran"
                                class="form-control @error('bukti_pembayaran') is-invalid @enderror"
                                accept="image/jpg,image/jpeg,image/png" required>
                            <div class="form-text">
                                Foto/screenshot bukti transfer. JPG/PNG, maks. 2MB.
                            </div>
                            @error('bukti_pembayaran')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-success px-4">
                            <i class="bi bi-cloud-upload me-2"></i>Upload Bukti Bayar
                        </button>
                    </form>

                @else
                    @if($pesanan->pembayaran)
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="fw-semibold small">Bukti Pembayaran</span>
                        {!! $pesanan->pembayaran->status_badge !!}
                    </div>
                    @if($pesanan->pembayaran->bukti_pembayaran && file_exists(public_path('uploads/pembayaran/'.$pesanan->pembayaran->bukti_pembayaran)))
                        <img src="{{ asset('uploads/pembayaran/'.$pesanan->pembayaran->bukti_pembayaran) }}"
                            class="img-fluid rounded-3" style="max-height:200px;">
                    @else
                        <div class="alert alert-secondary small">
                            Bukti pembayaran diterima ({{ $pesanan->pembayaran->tanggal_bayar->format('d M Y') }})
                        </div>
                    @endif
                    @endif
                @endif
            </div>
        </div>

    </div>{{-- end kolom kiri --}}

    {{-- ═══ KOLOM KANAN: CHAT ═══ --}}
    <div class="col-lg-5">
        <div class="card" style="height:600px;display:flex;flex-direction:column;">
            <div class="card-header py-3">
                <div class="d-flex align-items-center gap-2">
                    <div class="rounded-circle text-white d-flex align-items-center justify-content-center fw-bold"
                        style="width:34px;height:34px;font-size:13px;background:#6C3483;flex-shrink:0;">
                        {{ strtoupper(substr($pesanan->karya->seniman->nama, 0, 1)) }}
                    </div>
                    <div>
                        <div class="fw-semibold" style="font-size:.88rem;">{{ $pesanan->karya->seniman->nama }}</div>
                        <div class="text-muted" style="font-size:.72rem;">Seniman</div>
                    </div>
                    <div class="ms-auto">
                        <span class="badge bg-warning text-dark" style="font-size:.65rem;">
                            <i class="bi bi-shield-check me-1"></i>Chat Aman
                        </span>
                    </div>
                </div>
            </div>

            <div class="px-3 pt-2 pb-1" style="background:#fff8e1;border-bottom:1px solid #ffe082;">
                <div style="font-size:.7rem;color:#856404;">
                    <i class="bi bi-exclamation-triangle-fill me-1"></i>
                    Dilarang berbagi nomor telepon, kontak WA/Telegram, atau transaksi di luar platform.
                </div>
            </div>

            @if(session('chat_error'))
            <div class="mx-3 mt-2">
                <div class="alert alert-danger py-2 mb-0" style="font-size:.8rem;">
                    <i class="bi bi-x-circle me-1"></i>{{ session('chat_error') }}
                </div>
            </div>
            @endif

            <div class="flex-grow-1 overflow-auto p-3" id="chatBox"
                style="display:flex;flex-direction:column;gap:.6rem;">
                @forelse($pesanan->chats as $chat)
                <div class="d-flex {{ $chat->pengirim_id === auth()->id() ? 'justify-content-end' : 'justify-content-start' }}">
                    <div class="px-3 py-2 rounded-3"
                        style="max-width:80%;word-break:break-word;{{ $chat->pengirim_id === auth()->id() ? 'background:#6C3483;color:#fff;' : 'background:#f0f0f0;color:#333;' }}">
                        <div style="font-size:.75rem;opacity:.75;margin-bottom:2px;">{{ $chat->pengirim->nama }}</div>
                        <div style="font-size:.88rem;">{{ $chat->pesan }}</div>
                        <div class="text-end" style="font-size:.66rem;opacity:.6;margin-top:3px;">
                            {{ $chat->waktu_kirim->format('H:i') }}
                        </div>
                    </div>
                </div>
                @empty
                <div class="text-center text-muted py-5" style="font-size:.85rem;">
                    <i class="bi bi-chat-dots fs-2 d-block mb-2 opacity-25"></i>
                    Belum ada pesan.
                </div>
                @endforelse
                <div id="chatEnd"></div>
            </div>

            <div class="card-footer p-2" style="background:#fafafa;">
                <form method="POST" action="{{ route('chat.send', $pesanan) }}"
                      class="d-flex gap-2" id="chatForm">
                    @csrf
                    <input type="text" name="pesan" id="chatInput"
                        class="form-control form-control-sm"
                        placeholder="Tulis pesan..."
                        maxlength="500"
                        autocomplete="off" required>
                    <button class="btn btn-primary btn-sm px-3" id="chatSendBtn">
                        <i class="bi bi-send"></i>
                    </button>
                </form>
                <div class="d-flex justify-content-between mt-1 px-1">
                    <div id="chatWarning" class="text-danger d-none" style="font-size:.68rem;">
                        <i class="bi bi-exclamation-circle me-1"></i>
                        <span id="chatWarningText"></span>
                    </div>
                    <div class="text-muted ms-auto" style="font-size:.68rem;">
                        <span id="charCount">0</span>/500
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script>
(function () {

    // ── Opsi card toggle ─────────────────────────────────────────
    const radios      = document.querySelectorAll('input[name="opsi_pengambilan"]');
    const antarFields = document.getElementById('antarFields');

    function updateOpsiUI() {
        const val = document.querySelector('input[name="opsi_pengambilan"]:checked')?.value;
        document.getElementById('cardAntar')?.classList.toggle('selected', val === 'antar');
        document.getElementById('cardAmbil')?.classList.toggle('selected', val === 'ambil_sendiri');
        if (antarFields) {
            antarFields.style.display = val === 'antar' ? 'block' : 'none';
        }
    }
    radios.forEach(r => r.addEventListener('change', updateOpsiUI));
    updateOpsiUI();

    // ── Zona selection ───────────────────────────────────────────
    window.selectZona = function(index, biaya, label) {
        document.getElementById('zonaIndex').value = index;

        // Update card styles
        document.querySelectorAll('.zona-card').forEach(c => c.classList.remove('selected'));
        const card = document.querySelector(`.zona-card[data-index="${index}"]`);
        if (card) card.classList.add('selected');

        // Show cost preview
        const preview = document.getElementById('costPreview');
        if (preview) preview.style.display = 'block';

        const labelEl = document.getElementById('costZonaLabel');
        const amountEl = document.getElementById('costAmount');
        if (labelEl) labelEl.textContent = label;
        if (amountEl) amountEl.textContent = 'Rp ' + parseInt(biaya).toLocaleString('id-ID');
    };

    // Restore saved zona on page load (old() value)
    const savedZona = document.getElementById('zonaIndex')?.value;
    if (savedZona !== '' && savedZona !== null && savedZona !== undefined) {
        const card = document.querySelector(`.zona-card[data-index="${savedZona}"]`);
        if (card) {
            selectZona(
                parseInt(savedZona),
                parseInt(card.dataset.biaya),
                card.dataset.label
            );
        }
    }

    // ── Address char counter ─────────────────────────────────────
    const addrTextarea = document.getElementById('addressTextarea');
    const addrCount    = document.getElementById('addrCount');

    addrTextarea?.addEventListener('input', function () {
        if (addrCount) addrCount.textContent = this.value.length + '/500';
        if (this.value.length > 500) this.value = this.value.slice(0, 500);
    });
    if (addrTextarea && addrCount) {
        addrCount.textContent = addrTextarea.value.length + '/500';
    }

    // ── Chat scroll ──────────────────────────────────────────────
    document.getElementById('chatEnd')?.scrollIntoView({ behavior: 'smooth' });

    // ── Chat filter keamanan ─────────────────────────────────────
    const chatInput   = document.getElementById('chatInput');
    const chatSendBtn = document.getElementById('chatSendBtn');
    const chatWarning = document.getElementById('chatWarning');
    const charCount   = document.getElementById('charCount');

    const forbidden = [
        { p: /08\d{8,11}/,                        m: 'Nomor HP tidak diperbolehkan.' },
        { p: /(\+62|62)\d{8,12}/,                m: 'Nomor HP tidak diperbolehkan.' },
        { p: /\d{6,}/,                            m: 'Rangkaian angka panjang tidak boleh.' },
        { p: /whatsapp|wa\.me/i,                 m: 'Link WhatsApp tidak diperbolehkan.' },
        { p: /telegram|t\.me/i,                 m: 'Link Telegram tidak diperbolehkan.' },
        { p: /transfer\s*(ke|bca|bni|ovo|dana)/i, m: 'Info transfer di luar sistem tidak boleh.' },
    ];

    function checkChat(val) {
        const noSpace = val.replace(/\s+/g, '');
        for (const item of forbidden) {
            if (item.p.test(item.p.source.includes('\\d') ? noSpace : val)) return item.m;
        }
        return null;
    }

    chatInput?.addEventListener('input', function () {
        charCount.textContent = this.value.length;
        const err = checkChat(this.value);
        chatWarning?.classList.toggle('d-none', !err);
        if (err) document.getElementById('chatWarningText').textContent = err;
        if (chatSendBtn) chatSendBtn.disabled = !!err;
        this.style.borderColor = err ? '#dc3545' : '';
    });

    chatInput?.addEventListener('keydown', function (e) {
        if (e.key >= '0' && e.key <= '9') {
            const nv = this.value.slice(0, this.selectionStart) + e.key + this.value.slice(this.selectionEnd);
            if (/\d{6,}/.test(nv.replace(/\s+/g, ''))) {
                e.preventDefault();
                chatWarning?.classList.remove('d-none');
                document.getElementById('chatWarningText').textContent = 'Angka lebih dari 5 digit tidak boleh.';
                if (chatSendBtn) chatSendBtn.disabled = true;
            }
        }
    });

    // ── Auto refresh chat ────────────────────────────────────────
    setInterval(() => {
        fetch('{{ route("chat.messages", $pesanan) }}')
            .then(r => r.json())
            .then(msgs => {
                const box = document.getElementById('chatBox');
                box.innerHTML = '';
                if (!msgs.length) {
                    box.innerHTML = `<div class="text-center text-muted py-5" style="font-size:.85rem;">
                        <i class="bi bi-chat-dots fs-2 d-block mb-2 opacity-25"></i>Belum ada pesan.</div>`;
                    return;
                }
                msgs.forEach(m => {
                    const div = document.createElement('div');
                    div.className = 'd-flex ' + (m.is_mine ? 'justify-content-end' : 'justify-content-start');
                    div.innerHTML = `<div class="px-3 py-2 rounded-3" style="max-width:80%;word-break:break-word;${
                        m.is_mine ? 'background:#6C3483;color:#fff;' : 'background:#f0f0f0;color:#333;'
                    }">
                        <div style="font-size:.75rem;opacity:.75;margin-bottom:2px;">${m.pengirim}</div>
                        <div style="font-size:.88rem;">${m.pesan}</div>
                        <div class="text-end" style="font-size:.66rem;opacity:.6;margin-top:3px;">${m.waktu}</div>
                    </div>`;
                    box.appendChild(div);
                });
                box.scrollTop = box.scrollHeight;
            }).catch(() => {});
    }, 10000);

})();
</script>
@endpush