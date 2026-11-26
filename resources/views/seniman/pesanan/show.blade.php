@extends('layouts.dashboard')
@section('title', 'Detail Pesanan')
@section('page-title', 'Detail Pesanan')

@section('content')
<div class="mb-3">
    <a href="{{ route('seniman.pesanan.index') }}" class="btn btn-sm btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i>Kembali</a>
</div>

<div class="row g-4">
    <div class="col-lg-7">
        <div class="card mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <span class="fw-semibold">Info Pesanan #{{ $pesanan->id }}</span>
                {!! $pesanan->status_badge !!}
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-sm-6">
                        <div class="text-muted small">Pelanggan</div>
                        <div class="fw-semibold">{{ $pesanan->pelanggan->nama }}</div>
                        <div class="small text-muted">{{ $pesanan->pelanggan->email }}</div>
                    </div>
                    <div class="col-sm-6">
                        <div class="text-muted small">Karya</div>
                        <div class="fw-semibold">{{ $pesanan->karya->judul }}</div>
                    </div>
                    <div class="col-sm-6">
                        <div class="text-muted small">Total</div>
                        <div class="fw-bold fs-5" style="color:#6C3483;">{{ $pesanan->total_harga_format }}</div>
                    </div>
                    <div class="col-sm-6">
                        <div class="text-muted small">Tanggal</div>
                        <div class="fw-semibold">{{ $pesanan->tanggal_pesanan->format('d M Y') }}</div>
                    </div>
                </div>

                @if($pesanan->pembayaran)
                <hr>
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span class="fw-semibold">Bukti Pembayaran</span>
                    {!! $pesanan->pembayaran->status_badge !!}
                </div>
                @if($pesanan->pembayaran->bukti_pembayaran && file_exists(public_path('uploads/pembayaran/'.$pesanan->pembayaran->bukti_pembayaran)))
                    <img src="{{ asset('uploads/pembayaran/'.$pesanan->pembayaran->bukti_pembayaran) }}" class="img-fluid rounded" style="max-height:200px;">
                @else
                    <div class="alert alert-secondary small">Bukti telah diupload ({{ $pesanan->pembayaran->tanggal_bayar->format('d M Y') }})</div>
                @endif
                @endif

                @if(in_array($pesanan->status_pesanan, ['dibayar', 'diproses']))
                <hr>
                <div class="fw-semibold mb-2">Update Status Pesanan</div>
                <form method="POST" action="{{ route('seniman.pesanan.status', $pesanan) }}" class="d-flex gap-2">
                    @csrf
                    @if($pesanan->status_pesanan === 'dibayar')
                    <button name="status_pesanan" value="diproses" class="btn btn-primary">
                        <i class="bi bi-gear me-2"></i>Tandai Sedang Diproses
                    </button>
                    @elseif($pesanan->status_pesanan === 'diproses')
                    <button name="status_pesanan" value="selesai" class="btn btn-success">
                        <i class="bi bi-check-circle me-2"></i>Tandai Selesai
                    </button>
                    @endif
                </form>
                @endif
            </div>
        </div>
    </div>

    <!-- Chat Box -->
    <div class="col-lg-5">
        <x-chat-box :pesanan="$pesanan" :lawan-bicara="$pesanan->pelanggan" />
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.getElementById('chatEnd')?.scrollIntoView({ behavior: 'smooth' });

    // Auto-refresh chat setiap 10 detik
    setInterval(() => {
        fetch('{{ route("chat.messages", $pesanan) }}')
            .then(r => r.json())
            .then(msgs => {
                const box = document.getElementById('chatBox');
                const myId = {{ auth()->id() }};
                box.innerHTML = '';
                msgs.forEach(m => {
                    const div = document.createElement('div');
                    div.className = 'd-flex ' + (m.is_mine ? 'justify-content-end' : 'justify-content-start');
                    div.innerHTML = `<div class="px-3 py-2 rounded-3" style="max-width:80%;${m.is_mine?'background:#6C3483;color:#fff;':'background:#f0f0f0;color:#333;'}">
                        <div style="font-size:0.78rem;opacity:0.8;margin-bottom:2px;">${m.pengirim}</div>
                        <div style="font-size:0.9rem;">${m.pesan}</div>
                        <div class="text-end" style="font-size:0.68rem;opacity:0.7;margin-top:3px;">${m.waktu}</div>
                    </div>`;
                    box.appendChild(div);
                });
                box.scrollTop = box.scrollHeight;
            });
    }, 10000);
</script>
@endpush
