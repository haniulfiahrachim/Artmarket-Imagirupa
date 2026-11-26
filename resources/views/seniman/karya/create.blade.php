@extends('layouts.dashboard')
@section('title', 'Upload Karya')
@section('page-title', 'Upload Karya Baru')

@section('content')
<div class="mb-3">
    <a href="{{ route('seniman.karya.index') }}" class="btn btn-sm btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i>Kembali
    </a>
</div>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header py-3">
                <span class="fw-semibold">
                    <i class="bi bi-plus-circle me-2 text-primary"></i>Form Upload Karya
                </span>
            </div>
            <div class="card-body p-4">
                <form method="POST" action="{{ route('seniman.karya.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Judul Karya <span class="text-danger">*</span></label>
                        <input type="text" name="judul"
                            class="form-control @error('judul') is-invalid @enderror"
                            placeholder="Contoh: keychain kayu ukir"
                            value="{{ old('judul') }}" required>
                        @error('judul')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Deskripsi <span class="text-danger">*</span></label>
                        <textarea name="deskripsi"
                            class="form-control @error('deskripsi') is-invalid @enderror"
                            rows="5"
                            placeholder="Ceritakan tentang karya Anda dan tambahkan kata kunci yang relevan untuk pencarian" required>{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-8">
                            <label class="form-label fw-semibold">Harga (Rp) <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" name="harga"
                                    class="form-control @error('harga') is-invalid @enderror"
                                    placeholder="500000"
                                    value="{{ old('harga') }}"
                                    min="0" required>
                            </div>
                            @error('harga')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">
                                Stok <span class="text-danger">*</span>
                                <span class="text-muted fw-normal" style="font-size:.78rem;">(jumlah tersedia)</span>
                            </label>
                            <div class="input-group">
                                <button type="button" class="btn btn-outline-secondary"
                                    onclick="changeStok(-1)">
                                    <i class="bi bi-dash"></i>
                                </button>
                                <input type="number" name="stok" id="stokInput"
                                    class="form-control text-center fw-bold @error('stok') is-invalid @enderror"
                                    value="{{ old('stok', 1) }}"
                                    min="1" max="999" required>
                                <button type="button" class="btn btn-outline-secondary"
                                    onclick="changeStok(1)">
                                    <i class="bi bi-plus"></i>
                                </button>
                            </div>
                            @error('stok')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            <div class="form-text">
                                Misal: 1 = karya tunggal, &gt;1 = bisa dipesan beberapa orang.
                            </div>
                        </div>
                    </div>

                    {{-- Info stok --}}
                    <div class="alert alert-info py-2 small mb-3">
                        <i class="bi bi-info-circle me-2"></i>
                        <strong>Cara kerja stok:</strong> Stok berkurang setiap kali pesanan diselesaikan.
                        Karya baru berubah status <strong>"Terjual"</strong> jika stok mencapai 0.
                        Jika stok lebih dari 1, karya tetap <strong>"Tersedia"</strong> meski sudah ada yang membeli.
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">
                            Gambar Karya <span class="text-danger">*</span>
                        </label>

                        {{-- Upload area --}}
                        <div id="uploadArea"
                            style="border:2px dashed #c8b4e8;border-radius:12px;padding:2rem;text-align:center;cursor:pointer;background:#fdfcff;transition:all .2s;"
                            onclick="document.getElementById('gambarInput').click()"
                            ondragover="event.preventDefault();this.style.borderColor='#6C3483';this.style.background='#f5f0ff';"
                            ondragleave="this.style.borderColor='#c8b4e8';this.style.background='#fdfcff';"
                            ondrop="handleDrop(event)">
                            <div id="uploadPlaceholder">
                                <i class="bi bi-cloud-upload fs-2 d-block mb-2" style="color:#9B59B6;opacity:.7;"></i>
                                <div class="fw-semibold small text-muted">Klik atau drag & drop gambar</div>
                                <div class="text-muted mt-1" style="font-size:.75rem;">JPG, PNG, WEBP — Maks. 2MB</div>
                            </div>
                            <div id="imgPreview" class="d-none">
                                <img id="previewImg" src="" class="img-fluid rounded-3"
                                    style="max-height:220px;box-shadow:0 4px 16px rgba(0,0,0,.1);">
                                <div class="text-muted small mt-2" id="uploadFileName"></div>
                            </div>
                        </div>

                        <input type="file" name="gambar" id="gambarInput"
                            class="d-none @error('gambar') is-invalid @enderror"
                            accept="image/jpg,image/jpeg,image/png,image/webp">
                        @error('gambar')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="bi bi-cloud-upload me-2"></i>Upload Karya
                        </button>
                        <a href="{{ route('seniman.karya.index') }}" class="btn btn-outline-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function changeStok(delta) {
    const input = document.getElementById('stokInput');
    const val = parseInt(input.value) + delta;
    input.value = Math.max(1, Math.min(999, val));
}

function handleDrop(e) {
    e.preventDefault();
    const file = e.dataTransfer.files[0];
    if (file && file.type.startsWith('image/')) {
        setPreview(file);
        const dt = new DataTransfer();
        dt.items.add(file);
        document.getElementById('gambarInput').files = dt.files;
    }
    document.getElementById('uploadArea').style.borderColor = '#c8b4e8';
    document.getElementById('uploadArea').style.background  = '#fdfcff';
}

function setPreview(file) {
    const reader = new FileReader();
    reader.onload = (ev) => {
        document.getElementById('previewImg').src = ev.target.result;
        document.getElementById('uploadFileName').textContent = file.name;
        document.getElementById('uploadPlaceholder').classList.add('d-none');
        document.getElementById('imgPreview').classList.remove('d-none');
    };
    reader.readAsDataURL(file);
}

document.getElementById('gambarInput').addEventListener('change', function() {
    if (this.files[0]) setPreview(this.files[0]);
});
</script>
@endpush