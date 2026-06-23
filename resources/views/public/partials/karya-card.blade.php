<a href="{{ route('gallery.show', $karya) }}" class="text-decoration-none">
    <div class="karya-card h-100">
        <div class="karya-img-wrap">
            @if($karya->gambar && file_exists(public_path('uploads/karya/'.$karya->gambar)))
                <img src="{{ asset('uploads/karya/'.$karya->gambar) }}" alt="{{ $karya->judul }}">
            @else
                <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;font-size:3.5rem;background:linear-gradient(135deg,#9B59B6,#6C3483);">🎨</div>
            @endif
            <span class="karya-badge {{ $badgeClass }}">{{ $badgeLabel }}</span>
        </div>
        <div class="card-body p-3">
            <h6 class="fw-bold text-dark mb-1" style="font-size:.9rem;">{{ Str::limit($karya->judul, 32) }}</h6>
            <p class="text-muted mb-2" style="font-size:.78rem;line-height:1.5;">{{ Str::limit($karya->deskripsi, 65) }}</p>

            {{-- Rating mini --}}
            @php $totalU = $karya->ulasans()->count(); @endphp
            @if($totalU > 0)
            <div class="d-flex align-items-center gap-1 mb-2">
                <span style="color:#F39C12;font-size:.8rem;">
                    {!! $karya->rating_star_html !!}
                </span>
                <span style="font-size:.72rem;color:#aaa;">
                    {{ number_format($karya->rating_rata, 1) }} ({{ $totalU }})
                </span>
            </div>
            @endif

            <div class="d-flex justify-content-between align-items-center">
                <span class="price-tag">{{ $karya->harga_format }}</span>
                <div class="d-flex align-items-center gap-1">
                    <div style="width:20px;height:20px;border-radius:50%;background:#6C3483;display:flex;align-items:center;justify-content:center;font-size:.6rem;color:#fff;font-weight:700;overflow:hidden;">
                        @if($karya->seniman->profile && $karya->seniman->profile->foto && file_exists(public_path('uploads/profil/'.$karya->seniman->profile->foto)))
                            <img src="{{ asset('uploads/profil/'.$karya->seniman->profile->foto) }}" style="width:20px;height:20px;object-fit:cover;">
                        @else
                            {{ strtoupper(substr($karya->seniman->nama,0,1)) }}
                        @endif
                    </div>
                    <span style="font-size:.72rem;color:#aaa;">{{ Str::limit($karya->seniman->nama, 14) }}</span>
                </div>
            </div>
        </div>
    </div>
</a>