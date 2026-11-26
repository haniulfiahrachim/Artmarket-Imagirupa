@extends('layouts.dashboard')
@section('title', 'Kelola User')
@section('page-title', 'Kelola User')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h5 class="fw-bold mb-1">Daftar Pengguna</h5>
        <p class="text-muted small mb-0">Total {{ $users->total() }} pengguna terdaftar</p>
    </div>
</div>

{{-- Filter --}}
<div class="card mb-4">
    <div class="card-body py-3">
        <form method="GET" class="row g-2 align-items-end">
            <div class="col-md-5">
                <label class="form-label small fw-semibold text-muted mb-1">Cari Pengguna</label>
                <input type="text" name="search" class="form-control"
                    placeholder="Cari nama atau email..."
                    value="{{ request('search') }}">
            </div>
            <div class="col-md-3">
                <label class="form-label small fw-semibold text-muted mb-1">Filter Role</label>
                <select name="role" class="form-select">
                    <option value="">Semua Role</option>
                    <option value="seniman"   {{ request('role')=='seniman'   ? 'selected' : '' }}>Seniman</option>
                    <option value="pelanggan" {{ request('role')=='pelanggan' ? 'selected' : '' }}>Pelanggan</option>
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">
                    <i class="bi bi-funnel me-1"></i>Filter
                </button>
            </div>
            @if(request('search') || request('role'))
            <div class="col-md-2">
                <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary w-100">
                    <i class="bi bi-x me-1"></i>Reset
                </a>
            </div>
            @endif
        </form>
    </div>
</div>

{{-- Stats bar --}}
<div class="row g-3 mb-4">
    @php
        $totalSeniman   = \App\Models\User::where('role','seniman')->count();
        $totalPelanggan = \App\Models\User::where('role','pelanggan')->count();
        $pendingVerif   = \App\Models\User::where('role','seniman')->where('status_akun','pending')->count();
    @endphp
    <div class="col-6 col-md-3">
        <div class="card p-3 text-center">
            <div class="fw-bold fs-4" style="color:#6C3483;">{{ $users->total() }}</div>
            <div class="text-muted small">Total User</div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card p-3 text-center">
            <div class="fw-bold fs-4 text-warning">{{ $totalSeniman }}</div>
            <div class="text-muted small">Seniman</div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card p-3 text-center">
            <div class="fw-bold fs-4 text-info">{{ $totalPelanggan }}</div>
            <div class="text-muted small">Pelanggan</div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card p-3 text-center">
            <div class="fw-bold fs-4 text-danger">{{ $pendingVerif }}</div>
            <div class="text-muted small">Perlu Verifikasi</div>
        </div>
    </div>
</div>

{{-- Table --}}
<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0 align-middle">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Pengguna</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Bergabung</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $i => $user)
                    <tr>
                        <td class="text-muted small">{{ $users->firstItem() + $i }}</td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <div class="rounded-circle text-white d-flex align-items-center justify-content-center fw-bold flex-shrink-0"
                                    style="width:36px;height:36px;font-size:13px;background:#6C3483;">
                                    @if($user->profile && $user->profile->foto && file_exists(public_path('uploads/profil/'.$user->profile->foto)))
                                        <img src="{{ asset('uploads/profil/'.$user->profile->foto) }}"
                                            style="width:36px;height:36px;object-fit:cover;border-radius:50%;">
                                    @else
                                        {{ strtoupper(substr($user->nama, 0, 1)) }}
                                    @endif
                                </div>
                                <div>
                                    <div class="fw-semibold small">{{ $user->nama }}</div>
                                    @if($user->profile && $user->profile->kota)
                                        <div class="text-muted" style="font-size:0.72rem;">
                                            <i class="bi bi-geo-alt me-1"></i>{{ $user->profile->kota }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td class="small text-muted">{{ $user->email }}</td>
                        <td>
                            <span class="badge {{ $user->role === 'seniman' ? 'bg-warning text-dark' : 'bg-info' }}">
                                {{ ucfirst($user->role) }}
                            </span>
                        </td>
                        <td>
                            @if($user->status_akun === 'verified')
                                <span class="badge bg-success">
                                    <i class="bi bi-patch-check-fill me-1"></i>Verified
                                </span>
                            @else
                                <span class="badge bg-secondary">
                                    <i class="bi bi-hourglass me-1"></i>Pending
                                </span>
                            @endif
                        </td>
                        <td class="small text-muted">{{ $user->created_at->format('d M Y') }}</td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="{{ route('admin.users.show', $user) }}"
                                    class="btn btn-sm btn-outline-primary" title="Detail">
                                    <i class="bi bi-eye"></i>
                                </a>
                                @if($user->isSeniman() && !$user->isVerified())
                                    <form method="POST" action="{{ route('admin.users.verifikasi', $user) }}">
                                        @csrf
                                        <button class="btn btn-sm btn-success" title="Verifikasi">
                                            <i class="bi bi-check-lg"></i>
                                        </button>
                                    </form>
                                @elseif($user->isSeniman() && $user->isVerified())
                                    <form method="POST" action="{{ route('admin.users.tolak', $user) }}">
                                        @csrf
                                        <button class="btn btn-sm btn-outline-warning" title="Batalkan Verifikasi">
                                            <i class="bi bi-x-lg"></i>
                                        </button>
                                    </form>
                                @endif
                                <form method="POST" action="{{ route('admin.users.destroy', $user) }}"
                                    onsubmit="return confirm('Hapus user {{ addslashes($user->nama) }}?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger" title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-5 text-muted">
                            <i class="bi bi-people fs-2 d-block mb-2 opacity-25"></i>
                            Tidak ada pengguna ditemukan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($users->hasPages())
    <div class="card-footer">
        {{ $users->withQueryString()->links() }}
    </div>
    @endif
</div>
@endsection