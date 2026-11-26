@extends('layouts.dashboard')
@section('title', 'Detail Transaksi #'.$pesanan->id)
@section('page-title', 'Detail Transaksi')

@section('content')
<div class="mb-3">
    <a href="{{ route('admin.transaksi.index') }}" class="btn btn-sm btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i>Kembali
    </a>
</div>

<div class="row g-4">
    {{-- Kolom kiri --}}
    <div class="col-lg-7">

        {{-- Info Pesanan --}}
        <div class="card mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <span class="fw-semibold">
                    <i class="bi bi-receipt me-2 text-primary"></i>Pesanan #{{ $pesanan->id }}
                </span>
                {!! $pesanan->status_badge !!}
            </div>
            <div class="card-body">
                {{-- Karya --}}
                <div class="d-flex gap-3 mb-4">
                    <div style="width:72px;height:72px;border-radius:12px;overflow:hidden;background:linear-gradient(135deg,#9B59B6,#6C3483);flex-shrink:0;display:flex;align-items:center;justify-content:center;font-size:2rem;">
                        @if($pesanan->karya->gambar && file_exists(public_path('uploads/karya/'.$pesanan->karya->gambar)))
                            <img src="{{ asset('uploads/karya/'.$pesanan->karya->gambar) }}"
                                style="width:72px;height:72px;object-fit:cover;">
                        @else
                            🎨
                        @endif
                    </div>
                    <div>
                        <div class="fw-bold">{{ $pesanan->karya->judul }}</div>
                        <div class="text-muted small">
                            by {{ $pesanan->karya->seniman->nama }}
                        </div>
                        <div class="fw-bold mt-1" style="color:#6C3483;font-size:1.1rem;">
                            {{ $pesanan->karya->harga_format }}
                        </div>
                    </div>
                </div>

                <hr class="my-3">

                <div class="row g-3">
                    <div class="col-sm-6">
                        <div class="text-muted small">Pelanggan</div>
                        <div class="fw-semibold">{{ $pesanan->pelanggan->nama }}</div>
                        <div class="text-muted small">{{ $pesanan->pelanggan->email }}</div>
                    </div>
                    <div class="col-sm-6">
                        <div class="text-muted small">Tanggal Pesanan</div>
                        <div class="fw-semibold">{{ $pesanan->tanggal_pesanan->format('d M Y') }}</div>
                    </div>
                    <div class="col-sm-6">
                        <div class="text-muted small">Opsi Pengambilan</div>
                        <div>{!! $pesanan->opsi_pengambilan_label !!}</div>
                    </div>
                    @if($pesanan->opsi_pengambilan === 'antar' && $pesanan->alamat_pengiriman)
                    <div class="col-sm-6">
                        <div class="text-muted small">Alamat Pengiriman</div>
                        <div class="fw-semibold small">{{ $pesanan->alamat_pengiriman }}</div>
                    </div>
                    @endif
                </div>
                <div class="col-sm-6">
            <div class="text-muted small">No. HP / WhatsApp</div>
            <div class="fw-semibold">
                {{ $pesanan->pelanggan->profile->no_hp ?? '-' }}
                @if($pesanan->pelanggan->profile->no_hp)
                <a href="https://wa.me/{{ preg_replace('/^0/', '62', $pesanan->pelanggan->profile->no_hp) }}"
                target="_blank" class="btn btn-sm btn-outline-success ms-2" style="padding:1px 8px;font-size:.7rem;">
                    <i class="bi bi-whatsapp"></i> Chat
                </a>
                @endif
            </div>
        </div>
        @if($pesanan->pelanggan->profile->instagram)
        <div class="col-sm-6">
            <div class="text-muted small">Instagram</div>
            <a href="https://instagram.com/{{ $pesanan->pelanggan->profile->instagram }}" target="_blank" class="fw-semibold">
                @{{ $pesanan->pelanggan->profile->instagram }}
            </a>
        </div>
        @endif

                {{-- Rincian harga --}}
                <div class="mt-3 p-3 rounded-3" style="background:#f8f8f8;">
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
                        <span style="color:#6C3483;">{{ $pesanan->total_harga_format }}</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Bukti Pembayaran --}}
        @if($pesanan->pembayaran)
        <div class="card">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <span class="fw-semibold">
                    <i class="bi bi-credit-card me-2 text-primary"></i>Bukti Pembayaran
                </span>
                {!! $pesanan->pembayaran->status_badge !!}
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        @if($pesanan->pembayaran->bukti_pembayaran && file_exists(public_path('uploads/pembayaran/'.$pesanan->pembayaran->bukti_pembayaran)))
                            <img src="{{ asset('uploads/pembayaran/'.$pesanan->pembayaran->bukti_pembayaran) }}"
                                class="img-fluid rounded-3 w-100"
                                style="max-height:280px;object-fit:contain;background:#f5f5f5;cursor:pointer;"
                                onclick="window.open(this.src)">
                            <div class="text-muted small mt-1 text-center">Klik gambar untuk perbesar</div>
                        @else
                            <div class="alert alert-secondary small">
                                <i class="bi bi-file-image me-2"></i>
                                Bukti diterima pada {{ $pesanan->pembayaran->tanggal_bayar->format('d M Y') }}
                                (file tidak ditemukan di server).
                            </div>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <div class="text-muted small">Tanggal Upload</div>
                            <div class="fw-semibold">{{ $pesanan->pembayaran->tanggal_bayar->format('d M Y') }}</div>
                        </div>
                        <div class="mb-3">
                            <div class="text-muted small">Status Pembayaran</div>
                            <div>{!! $pesanan->pembayaran->status_badge !!}</div>
                        </div>

                        @if($pesanan->pembayaran->status_pembayaran === 'menunggu')
                        <div class="d-flex flex-column gap-2 mt-3">
                            <form method="POST" action="{{ route('admin.pembayaran.verifikasi', $pesanan->pembayaran) }}">
                                @csrf
                                <button class="btn btn-success w-100">
                                    <i class="bi bi-check-circle me-2"></i>Setujui Pembayaran
                                </button>
                            </form>
                            <form method="POST" action="{{ route('admin.pembayaran.tolak', $pesanan->pembayaran) }}">
                                @csrf
                                <button class="btn btn-danger w-100">
                                    <i class="bi bi-x-circle me-2"></i>Tolak Pembayaran
                                </button>
                            </form>
                        </div>
                        @elseif($pesanan->pembayaran->status_pembayaran === 'disetujui')
                        <div class="alert alert-success small mb-0">
                            <i class="bi bi-check-circle-fill me-2"></i>
                            Pembayaran telah disetujui.
                        </div>
                        @elseif($pesanan->pembayaran->status_pembayaran === 'ditolak')
                        <div class="alert alert-danger small mb-0">
                            <i class="bi bi-x-circle-fill me-2"></i>
                            Pembayaran ditolak. Pelanggan diminta upload ulang.
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @else
        <div class="alert alert-warning">
            <i class="bi bi-exclamation-triangle me-2"></i>
            Pelanggan belum mengupload bukti pembayaran.
        </div>
        @endif
    </div>

    {{-- Kolom kanan --}}
    <div class="col-lg-5">

        {{-- Riwayat Chat --}}
        <div class="card mb-4">
            <div class="card-header py-3">
                <span class="fw-semibold">
                    <i class="bi bi-chat-dots me-2 text-primary"></i>Riwayat Chat
                </span>
            </div>
            <div class="card-body" style="max-height:300px;overflow-y:auto;">
                @forelse($pesanan->chats as $chat)
                <div class="mb-3">
                    <div class="d-flex align-items-center gap-2 mb-1">
                        <div class="rounded-circle text-white d-flex align-items-center justify-content-center fw-bold"
                            style="width:24px;height:24px;font-size:10px;background:#6C3483;flex-shrink:0;">
                            {{ strtoupper(substr($chat->pengirim->nama, 0, 1)) }}
                        </div>
                        <span class="fw-semibold small" style="color:#6C3483;">{{ $chat->pengirim->nama }}</span>
                        <span class="text-muted" style="font-size:0.68rem;">
                            {{ $chat->waktu_kirim->format('H:i d/m/Y') }}
                        </span>
                    </div>
                    <div class="bg-light rounded p-2 small ms-4">{{ $chat->pesan }}</div>
                </div>
                @empty
                <div class="text-center text-muted small py-3">
                    <i class="bi bi-chat-dots fs-3 d-block mb-2 opacity-25"></i>
                    Belum ada pesan.
                </div>
                @endforelse
            </div>
        </div>

        {{-- Timeline Status --}}
        <div class="card">
            <div class="card-header py-3">
                <span class="fw-semibold">
                    <i class="bi bi-clock-history me-2 text-primary"></i>Timeline Status
                </span>
            </div>
            <div class="card-body">
                @php
                    $steps = [
                        ['status' => 'pending',  'label' => 'Pesanan Dibuat',       'icon' => 'bi-bag-plus',       'color' => '#f39c12'],
                        ['status' => 'dibayar',  'label' => 'Pembayaran Diverifikasi','icon'=> 'bi-credit-card',    'color' => '#3498db'],
                        ['status' => 'diproses', 'label' => 'Sedang Diproses',      'icon' => 'bi-gear',           'color' => '#9b59b6'],
                        ['status' => 'selesai',  'label' => 'Pesanan Selesai',       'icon' => 'bi-check-circle',   'color' => '#27ae60'],
                    ];
                    $currentIndex = array_search($pesanan->status_pesanan, array_column($steps,'status'));
                @endphp
                <div class="d-flex flex-column gap-3">
                    @foreach($steps as $idx => $step)
                    @php $done = $idx <= $currentIndex; @endphp
                    <div class="d-flex align-items-center gap-3">
                        <div class="d-flex align-items-center justify-content-center rounded-circle flex-shrink-0"
                            style="width:36px;height:36px;background:{{ $done ? $step['color'] : '#e0e0e0' }};">
                            <i class="bi {{ $step['icon'] }} {{ $done ? 'text-white' : 'text-muted' }}" style="font-size:0.9rem;"></i>
                        </div>
                        <div>
                            <div class="fw-semibold small {{ $done ? '' : 'text-muted' }}">
                                {{ $step['label'] }}
                            </div>
                            @if($idx === $currentIndex)
                            <div style="font-size:0.7rem;color:{{ $step['color'] }};">● Status Saat Ini</div>
                            @endif
                        </div>
                    </div>
                    @if(!$loop->last)
                    <div style="width:2px;height:16px;background:{{ $idx < $currentIndex ? $step['color'] : '#e0e0e0' }};margin-left:17px;"></div>
                    @endif
                    @endforeach
                </div>
            </div>
        </div>

    </div>
</div>
@endsection