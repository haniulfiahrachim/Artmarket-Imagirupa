@extends('layouts.app')
@section('title', $karya->judul . ' - Imagirupa')

@push('styles')
<style>
    .star-input { display: flex; flex-direction: row-reverse; gap: 4px; }
    .star-input input { display: none; }
    .star-input label {
        font-size: 2rem;
        color: #ddd;
        cursor: pointer;
        transition: color .15s;
    }
    .star-input input:checked ~ label,
    .star-input label:hover,
    .star-input label:hover ~ label {
        color: #F39C12;
    }
    .rating-bar-wrap { display: flex; align-items: center; gap: 8px; }
    .rating-bar {
        flex: 1;
        height: 8px;
        background: #f0f0f0;
        border-radius: 99px;
        overflow: hidden;
    }
    .rating-bar-fill {
        height: 100%;
        background: linear-gradient(to right, #F39C12, #f1c40f);
        border-radius: 99px;
        transition: width .5s ease;
    }
    .ulasan-card {
        border: 1px solid #f0f0f0;
        border-radius: 14px;
        padding: 1.25rem;
        background: #fff;
        transition: box-shadow .2s;
    }
    .ulasan-card:hover { box-shadow: 0 4px 16px rgba(0,0,0,.07); }
    .badge-rating-5 { background: #e8f5e9; color: #2e7d32; }
    .badge-rating-4 { background: #e3f2fd; color: #1565c0; }
    .badge-rating-3 { background: #fff8e1; color: #f57f17; }
    .badge-rating-2 { background: #fff3e0; color: #e65100; }
    .badge-rating-1 { background: #fce4ec; color: #c62828; }
</style>
@endpush

@section('content')
<div class="container py-5">

    <div class="row g-5">

        {{-- Gambar --}}
        <div class="col-lg-7">
            <div class="card p-0 overflow-hidden" style="border-radius:20px;">
                @if($karya->gambar && file_exists(public_path('uploads/karya/'.$karya->gambar)))
                    <img src="{{ asset('uploads/karya/'.$karya->gambar) }}"
                        alt="{{ $karya->judul }}"
                        class="img-fluid w-100"
                        style="max-height:500px;object-fit:cover;">
                @else
                    <div style="height:400px;background:linear-gradient(135deg,#9B59B6,#6C3483);display:flex;align-items:center;justify-content:center;font-size:6rem;">
                        🎨
                    </div>
                @endif
            </div>
        </div>

        {{-- Info --}}
        <div class="col-lg-5">
            <div class="d-flex gap-2 mb-3 flex-wrap">
                <span class="badge {{ $karya->status_karya === 'tersedia' ? 'bg-success' : 'bg-danger' }}">
                    {{ $karya->status_karya === 'tersedia' ? 'Tersedia' : 'Habis Terjual' }}
                </span>
                @if(isset($karya->stok))
                <span class="badge {{ $karya->stok <= 3 ? 'bg-warning text-dark' : 'bg-success' }}">
                    Stok: {{ $karya->stok }}
                </span>
                @endif
            </div>

            <h2 style="font-family:'Playfair Display',serif;font-weight:700;" class="mb-2">
                {{ $karya->judul }}
            </h2>

            {{-- Seniman --}}
            <a href="{{ route('seniman.profile.public', $karya->seniman) }}"
                class="d-flex align-items-center gap-2 text-decoration-none mb-3">
                <div class="rounded-circle text-white d-flex align-items-center justify-content-center fw-bold overflow-hidden"
                    style="width:36px;height:36px;font-size:14px;background:#6C3483;flex-shrink:0;">
                    @if($karya->seniman->profile && $karya->seniman->profile->foto && file_exists(public_path('uploads/profil/'.$karya->seniman->profile->foto)))
                        <img src="{{ asset('uploads/profil/'.$karya->seniman->profile->foto) }}"
                            style="width:36px;height:36px;object-fit:cover;">
                    @else
                        {{ strtoupper(substr($karya->seniman->nama, 0, 1)) }}
                    @endif
                </div>
                <div>
                    <div class="fw-semibold text-dark small">{{ $karya->seniman->nama }}</div>
                    <div class="text-muted" style="font-size:.72rem;">
                        Seniman Terverifikasi
                        @if($karya->seniman->profile && $karya->seniman->profile->spesialisasi)
                            · {{ $karya->seniman->profile->spesialisasi }}
                        @endif
                    </div>
                </div>
            </a>

            {{-- Rating ringkasan --}}
            @php
                $rataRata   = $karya->rating_rata;
                $totalUlasan = $karya->total_ulasan;
            @endphp
            @if($totalUlasan > 0)
            <div class="d-flex align-items-center gap-2 mb-3 p-3 rounded-3"
                style="background:#fffbf0;border:1px solid #ffe0b2;">
                <div class="text-center">
                    <div style="font-size:2rem;font-weight:700;color:#F39C12;line-height:1;">
                        {{ number_format($rataRata, 1) }}
                    </div>
                    <div style="font-size:.65rem;color:#aaa;">dari 5</div>
                </div>
                <div class="flex-grow-1">
                    <div style="font-size:.95rem;">{!! $karya->rating_star_html !!}</div>
                    <div class="text-muted" style="font-size:.75rem;">
                        Berdasarkan {{ $totalUlasan }} ulasan
                    </div>
                </div>
                <a href="#ulasan-section" class="btn btn-sm btn-outline-warning">
                    Lihat Ulasan
                </a>
            </div>
            @else
            <div class="text-muted small mb-3">
                <i class="bi bi-star me-1"></i>Belum ada ulasan
            </div>
            @endif

            <hr>

            <div class="mb-4">
                <div class="text-muted small mb-1">Harga</div>
                <div style="font-size:2rem;font-weight:700;color:#6C3483;">
                    {{ $karya->harga_format }}
                </div>
            </div>

            <div class="mb-4">
                <div class="fw-semibold mb-2">Deskripsi Karya</div>
                <p class="text-muted" style="line-height:1.8;">{{ $karya->deskripsi }}</p>
            </div>

            {{-- Tombol Pesan --}}
            @if($karya->status_karya === 'tersedia')
                @auth
                    @if(auth()->user()->isPelanggan())
                        <form method="POST" action="{{ route('pelanggan.pesanan.store') }}">
                            @csrf
                            <input type="hidden" name="karya_id" value="{{ $karya->id }}">
                            <button type="submit"
                                class="btn btn-primary btn-lg w-100 py-3 fw-semibold"
                                onclick="return confirm('Konfirmasi pemesanan karya ini?')">
                                <i class="bi bi-bag-plus me-2 fs-5"></i>Pesan Karya Ini
                            </button>
                        </form>
                        <div class="alert alert-info mt-3 small">
                            <i class="bi bi-info-circle me-2"></i>
                            Setelah pesan, upload bukti pembayaran untuk diverifikasi admin.
                        </div>
                    @elseif(auth()->user()->isSeniman())
                        <div class="alert alert-warning small">
                            <i class="bi bi-info-circle me-2"></i>
                            Anda terdaftar sebagai seniman. Login sebagai pelanggan untuk memesan.
                        </div>
                    @endif
                @else
                    <a href="{{ route('login') }}"
                        class="btn btn-primary btn-lg w-100 py-3 fw-semibold">
                        <i class="bi bi-bag-plus me-2 fs-5"></i>Login untuk Memesan
                    </a>
                @endauth
            @else
                <button class="btn btn-secondary btn-lg w-100" disabled>
                    Karya Sudah Habis Terjual
                </button>
            @endif

            <div class="mt-3 d-flex gap-2">
                <div class="flex-fill p-3 rounded-3 text-center" style="background:#f8f4ff;">
                    <i class="bi bi-shield-check text-primary d-block fs-5"></i>
                    <div class="small text-muted mt-1">Karya Original</div>
                </div>
                <div class="flex-fill p-3 rounded-3 text-center" style="background:#f8f4ff;">
                    <i class="bi bi-chat-dots text-primary d-block fs-5"></i>
                    <div class="small text-muted mt-1">Chat Langsung</div>
                </div>
                <div class="flex-fill p-3 rounded-3 text-center" style="background:#f8f4ff;">
                    <i class="bi bi-credit-card text-primary d-block fs-5"></i>
                    <div class="small text-muted mt-1">Bayar Manual</div>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════════════════════════════════════════════════════
         SECTION RATING & ULASAN
    ═══════════════════════════════════════════════════════ --}}
    <div id="ulasan-section" class="mt-5 pt-4 border-top">
        <div class="row g-5">

            {{-- Ringkasan Rating --}}
            <div class="col-lg-4">
                <h5 class="fw-bold mb-4">
                    <i class="bi bi-star-fill text-warning me-2"></i>Rating & Ulasan
                </h5>

                @if($totalUlasan > 0)
                @php
                    $distribusi = [];
                    for ($s = 5; $s >= 1; $s--) {
                        $cnt = $karya->ulasans()->where('rating', $s)->count();
                        $distribusi[$s] = [
                            'count'   => $cnt,
                            'persen'  => $totalUlasan > 0 ? round($cnt / $totalUlasan * 100) : 0,
                        ];
                    }
                @endphp

                <div class="card p-4 mb-3" style="border-radius:16px;">
                    <div class="text-center mb-3">
                        <div style="font-size:3.5rem;font-weight:700;color:#F39C12;line-height:1;">
                            {{ number_format($rataRata, 1) }}
                        </div>
                        <div style="font-size:1.2rem;">{!! $karya->rating_star_html !!}</div>
                        <div class="text-muted small mt-1">
                            {{ $totalUlasan }} ulasan pembeli
                        </div>
                    </div>

                    {{-- Bar distribusi --}}
                    @foreach($distribusi as $bintang => $data)
                    <div class="rating-bar-wrap mb-1">
                        <div class="d-flex align-items-center gap-1" style="width:60px;font-size:.78rem;">
                            <span>{{ $bintang }}</span>
                            <i class="bi bi-star-fill" style="color:#F39C12;font-size:.7rem;"></i>
                        </div>
                        <div class="rating-bar">
                            <div class="rating-bar-fill" style="width:{{ $data['persen'] }}%;"></div>
                        </div>
                        <div style="width:32px;font-size:.75rem;color:#aaa;text-align:right;">
                            {{ $data['count'] }}
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="card p-4 text-center" style="border-radius:16px;">
                    <div style="font-size:3rem;opacity:.2;">⭐</div>
                    <div class="fw-semibold mt-2">Belum ada ulasan</div>
                    <div class="text-muted small">Jadilah yang pertama memberi ulasan!</div>
                </div>
                @endif

                {{-- Form Tulis Ulasan --}}
                @auth
                    @if(auth()->user()->isPelanggan())
                    @php
                        // Cek apakah pelanggan punya pesanan selesai yang belum diulas
                        $pesananSelesai = \App\Models\Pesanan::where('pelanggan_id', auth()->id())
                            ->where('karya_id', $karya->id)
                            ->where('status_pesanan', 'selesai')
                            ->whereDoesntHave('ulasan')
                            ->first();

                        $sudahUlas = \App\Models\Ulasan::where('pelanggan_id', auth()->id())
                            ->where('karya_id', $karya->id)
                            ->first();
                    @endphp

                    @if($pesananSelesai)
                    <div class="card p-4" style="border-radius:16px;border:2px solid #e8f5e9;">
                        <div class="fw-bold mb-3">
                            <i class="bi bi-pencil-square me-2 text-success"></i>Tulis Ulasan Anda
                        </div>

                        @if(session('success') && str_contains(session('success'), 'Ulasan'))
                        <div class="alert alert-success py-2 small">
                            <i class="bi bi-check-circle me-1"></i>{{ session('success') }}
                        </div>
                        @endif
                        @if($errors->has('rating'))
                        <div class="alert alert-danger py-2 small">{{ $errors->first('rating') }}</div>
                        @endif

                        <form method="POST"
                              action="{{ route('pelanggan.ulasan.store', $pesananSelesai) }}">
                            @csrf

                            {{-- Bintang interaktif --}}
                            <div class="mb-3">
                                <label class="form-label fw-semibold small">
                                    Rating <span class="text-danger">*</span>
                                </label>
                                <div class="star-input" id="starInput">
                                    @for($s = 5; $s >= 1; $s--)
                                    <input type="radio" name="rating" id="star{{ $s }}"
                                        value="{{ $s }}" {{ old('rating') == $s ? 'checked' : '' }}>
                                    <label for="star{{ $s }}" title="{{ $s }} bintang">
                                        <i class="bi bi-star-fill"></i>
                                    </label>
                                    @endfor
                                </div>
                                <div class="mt-1" id="ratingLabel" style="font-size:.8rem;color:#aaa;min-height:18px;"></div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold small">
                                    Komentar
                                    <span class="text-muted fw-normal">(opsional)</span>
                                </label>
                                <textarea name="komentar"
                                    class="form-control @error('komentar') is-invalid @enderror"
                                    rows="3"
                                    maxlength="1000"
                                    placeholder="Ceritakan pengalaman Anda membeli karya ini...">{{ old('komentar') }}</textarea>
                                @error('komentar')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-success w-100">
                                <i class="bi bi-send me-2"></i>Kirim Ulasan
                            </button>
                        </form>
                    </div>

                    @elseif($sudahUlas)
                    <div class="card p-3" style="border-radius:14px;border:1.5px solid #e8f5e9;background:#f9fff9;">
                        <div class="fw-semibold small text-success mb-2">
                            <i class="bi bi-check-circle-fill me-1"></i>Ulasan Anda
                        </div>
                        <div style="font-size:.95rem;">{!! $sudahUlas->star_html !!}</div>
                        @if($sudahUlas->komentar)
                        <p class="text-muted small mt-2 mb-2">{{ $sudahUlas->komentar }}</p>
                        @endif
                        <div class="d-flex justify-content-between align-items-center mt-1">
                            <span class="text-muted" style="font-size:.72rem;">
                                {{ $sudahUlas->created_at->format('d M Y') }}
                            </span>
                            <form method="POST"
                                  action="{{ route('pelanggan.ulasan.destroy', $sudahUlas) }}"
                                  onsubmit="return confirm('Hapus ulasan ini?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-xs btn-outline-danger"
                                    style="font-size:.72rem;padding:2px 8px;">
                                    <i class="bi bi-trash me-1"></i>Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                    @endif
                    @endif
                @endauth
            </div>

            {{-- Daftar Ulasan --}}
            <div class="col-lg-8">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h6 class="fw-bold mb-0">
                        Semua Ulasan
                        @if($totalUlasan > 0)
                        <span class="badge bg-warning text-dark ms-1">{{ $totalUlasan }}</span>
                        @endif
                    </h6>
                    @if($totalUlasan > 0)
                    <div class="d-flex gap-1 flex-wrap">
                        @foreach([0,5,4,3,2,1] as $filterR)
                        @php
                            $filterUrl = request()->fullUrlWithQuery(['filter_rating' => $filterR ?: '']);
                            $isActive  = request('filter_rating', 0) == $filterR;
                        @endphp
                        <a href="{{ $filterUrl }}#ulasan-section"
                            class="btn btn-xs {{ $isActive ? 'btn-warning text-dark' : 'btn-outline-secondary' }}"
                            style="font-size:.72rem;padding:3px 10px;">
                            @if($filterR === 0)
                                Semua
                            @else
                                {{ $filterR }}⭐
                            @endif
                        </a>
                        @endforeach
                    </div>
                    @endif
                </div>

                @php
                    $ulasanQuery = $karya->ulasans()->with('pelanggan.profile')->latest();
                    if (request('filter_rating') && request('filter_rating') > 0) {
                        $ulasanQuery->where('rating', request('filter_rating'));
                    }
                    $ulasans = $ulasanQuery->paginate(5)->withQueryString()->fragment('ulasan-section');
                @endphp

                @forelse($ulasans as $ulasan)
                <div class="ulasan-card mb-3">
                    <div class="d-flex align-items-start gap-3">
                        {{-- Avatar --}}
                        <div class="rounded-circle text-white d-flex align-items-center justify-content-center fw-bold overflow-hidden flex-shrink-0"
                            style="width:42px;height:42px;font-size:1rem;background:#6C3483;">
                            @if($ulasan->pelanggan->profile && $ulasan->pelanggan->profile->foto && file_exists(public_path('uploads/profil/'.$ulasan->pelanggan->profile->foto)))
                                <img src="{{ asset('uploads/profil/'.$ulasan->pelanggan->profile->foto) }}"
                                    style="width:42px;height:42px;object-fit:cover;">
                            @else
                                {{ strtoupper(substr($ulasan->pelanggan->nama, 0, 1)) }}
                            @endif
                        </div>

                        <div class="flex-grow-1">
                            <div class="d-flex justify-content-between align-items-start flex-wrap gap-1">
                                <div>
                                    <div class="fw-semibold small">{{ $ulasan->pelanggan->nama }}</div>
                                    <div class="d-flex align-items-center gap-2 mt-1">
                                        <span style="font-size:.9rem;">{!! $ulasan->star_html !!}</span>
                                        <span class="badge badge-rating-{{ $ulasan->rating }}"
                                            style="font-size:.65rem;">
                                            {{ $ulasan->label_rating }}
                                        </span>
                                    </div>
                                </div>
                                <div class="text-muted" style="font-size:.72rem;">
                                    {{ $ulasan->created_at->diffForHumans() }}
                                </div>
                            </div>

                            @if($ulasan->komentar)
                            <p class="text-muted mt-2 mb-0" style="font-size:.88rem;line-height:1.7;">
                                {{ $ulasan->komentar }}
                            </p>
                            @else
                            <p class="text-muted mt-2 mb-0 fst-italic" style="font-size:.82rem;">
                                (Tidak ada komentar)
                            </p>
                            @endif

                            {{-- Verified purchase badge --}}
                            <div class="mt-2">
                                <span class="badge bg-success-subtle text-success" style="font-size:.65rem;">
                                    <i class="bi bi-patch-check-fill me-1"></i>Pembelian Terverifikasi
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="text-center py-5 text-muted">
                    <div style="font-size:3rem;opacity:.2;">💬</div>
                    <p class="mt-2">
                        @if(request('filter_rating'))
                            Tidak ada ulasan dengan {{ request('filter_rating') }} bintang.
                        @else
                            Belum ada ulasan untuk karya ini.
                        @endif
                    </p>
                </div>
                @endforelse

                @if($ulasans->hasPages())
                <div class="mt-4">{{ $ulasans->links() }}</div>
                @endif
            </div>
        </div>
    </div>

    {{-- Karya Lain dari Seniman --}}
    @if($karya->seniman->karyas->count() > 0)
    <div class="mt-5 pt-4 border-top">
        <h5 class="fw-bold mb-4">Karya Lain dari {{ $karya->seniman->nama }}</h5>
        <div class="row g-4">
            @foreach($karya->seniman->karyas as $other)
            <div class="col-sm-6 col-md-3">
                <a href="{{ route('gallery.show', $other) }}" class="text-decoration-none">
                    <div class="card h-100" style="border-radius:12px;overflow:hidden;transition:transform .2s;"
                        onmouseover="this.style.transform='translateY(-4px)'"
                        onmouseout="this.style.transform='none'">
                        <div style="height:160px;background:linear-gradient(135deg,#9B59B6,#6C3483);display:flex;align-items:center;justify-content:center;font-size:2.5rem;">
                            @if($other->gambar && file_exists(public_path('uploads/karya/'.$other->gambar)))
                                <img src="{{ asset('uploads/karya/'.$other->gambar) }}"
                                    style="width:100%;height:160px;object-fit:cover;">
                            @else 🎨 @endif
                        </div>
                        <div class="card-body p-2">
                            <div class="fw-semibold small text-dark">{{ Str::limit($other->judul, 30) }}</div>
                            <div class="text-primary small fw-bold" style="color:#6C3483!important;">
                                {{ $other->harga_format }}
                            </div>
                            @if($other->total_ulasan > 0)
                            <div style="font-size:.7rem;color:#aaa;">
                                ⭐ {{ number_format($other->rating_rata, 1) }}
                                ({{ $other->total_ulasan }})
                            </div>
                            @endif
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
    @endif

</div>
@endsection

@push('scripts')
<script>
// Label rating bintang
const labels = {1:'Sangat Buruk 😞',2:'Buruk 😕',3:'Cukup 😐',4:'Bagus 😊',5:'Sangat Bagus 🤩'};
document.querySelectorAll('input[name="rating"]').forEach(r => {
    r.addEventListener('change', () => {
        const el = document.getElementById('ratingLabel');
        if (el) el.textContent = labels[r.value] || '';
    });
});
// Inisialisasi label jika sudah ada pilihan
const checked = document.querySelector('input[name="rating"]:checked');
if (checked) {
    const el = document.getElementById('ratingLabel');
    if (el) el.textContent = labels[checked.value] || '';
}
</script>
@endpush