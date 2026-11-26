@extends('layouts.dashboard')
@section('title', 'Edit Profil')
@section('page-title', 'Profil Saya')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header py-3"><span class="fw-semibold"><i class="bi bi-person-circle me-2 text-primary"></i>Edit Profil</span></div>
            <div class="card-body">
                <div class="text-center mb-4">
                    <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center fw-bold mx-auto" style="width:80px;height:80px;font-size:2rem;background:#6C3483!important;">
                        @if($user->profile && $user->profile->foto && file_exists(public_path('uploads/profil/'.$user->profile->foto)))
                            <img src="{{ asset('uploads/profil/'.$user->profile->foto) }}" class="rounded-circle" style="width:80px;height:80px;object-fit:cover;">
                        @else {{ strtoupper(substr($user->nama, 0, 1)) }} @endif
                    </div>
                </div>
                <form method="POST" action="{{ route('pelanggan.profil.update') }}" enctype="multipart/form-data">
                    @csrf @method('PUT')
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama <span class="text-danger">*</span></label>
                        <input type="text" name="nama" class="form-control" value="{{ old('nama', $user->nama) }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Email</label>
                        <input type="email" class="form-control" value="{{ $user->email }}" disabled>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Bio</label>
                        <textarea name="bio" class="form-control" rows="3" placeholder="Ceritakan tentang diri Anda...">{{ old('bio', optional($user->profile)->bio) }}</textarea>
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Foto Profil</label>
                        <input type="file" name="foto" class="form-control" accept="image/jpg,image/jpeg,image/png">
                        <div class="form-text">Format: JPG, PNG. Maks. 2MB.</div>
                    </div>
                    <button type="submit" class="btn btn-primary px-4"><i class="bi bi-save me-2"></i>Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
