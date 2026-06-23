@extends('layouts.dashboard')
@section('title', 'Edit Karya')
@section('page-title', 'Edit Karya')

@section('content')
<div class="mb-3">
    <a href="{{ route('seniman.karya.index') }}" class="btn btn-sm btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i>Kembali</a>
</div>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header py-3"><span class="fw-semibold"><i class="bi bi-pencil me-2 text-primary"></i>Edit Karya</span></div>
            <div class="card-body">
                <form method="POST" action="{{ route('seniman.karya.update', $karya) }}" enctype="multipart/form-data">
                    @csrf @method('PUT')
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Judul Karya <span class="text-danger">*</span></label>
                        <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror"
                            value="{{ old('judul', $karya->judul) }}" required>
                        @error('judul')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Deskripsi <span class="text-danger">*</span></label>
                        <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" rows="5" required>{{ old('deskripsi', $karya->deskripsi) }}</textarea>
                        @error('deskripsi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="row g-3 mb-3">
                <div class="col-md-8">
                    <label class="form-label fw-semibold">Harga (Rp) <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text">Rp</span>
                        <input type="number" name="harga" class="form-control"
                            value="{{ old('harga', $karya->harga) }}" min="0" required>
                    </div>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Stok <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <button type="button" class="btn btn-outline-secondary" onclick="changeStok(-1)">
                            <i class="bi bi-dash"></i>
                        </button>
                        <input type="number" name="stok" id="stokInput"
                            class="form-control text-center fw-bold"
                            value="{{ old('stok', $karya->stok) }}"
                            min="0" max="999" required>
                        <button type="button" class="btn btn-outline-secondary" onclick="changeStok(1)">
                            <i class="bi bi-plus"></i>
                        </button>
                    </div>
                    <div class="form-text">Stok saat ini: <strong>{{ $karya->stok }}</strong></div>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Status Karya</label>
                        <select name="status_karya" class="form-select">
                            <option value="tersedia" {{ $karya->status_karya==='tersedia'?'selected':'' }}>Tersedia</option>
                            <option value="terjual" {{ $karya->status_karya==='terjual'?'selected':'' }}>Terjual</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Gambar Karya (opsional, biarkan kosong untuk tidak mengubah)</label>
                        @if($karya->gambar && file_exists(public_path('uploads/karya/'.$karya->gambar)))
                        <div class="mb-2">
                            <img src="{{ asset('uploads/karya/'.$karya->gambar) }}" class="rounded img-fluid" style="max-height:150px;">
                        </div>
                        @endif
                        <input type="file" name="gambar" class="form-control" accept="image/jpg,image/jpeg,image/png,image/webp" id="gambarInput">
                        <div class="form-text">Format: JPG, PNG, WEBP. Maks. 2MB.</div>
                        <div id="imgPreview" class="mt-2 d-none">
                            <img id="previewImg" src="" class="rounded img-fluid" style="max-height:150px;">
                        </div>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary px-4"><i class="bi bi-save me-2"></i>Simpan Perubahan</button>
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
    input.value = Math.max(0, Math.min(999, val));
}
// ... kode preview gambar yang sudah ada ...
document.getElementById('gambarInput').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = (ev) => {
            document.getElementById('previewImg').src = ev.target.result;
            document.getElementById('imgPreview').classList.remove('d-none');
        };
        reader.readAsDataURL(file);
    }
});
</script>
@endpush
