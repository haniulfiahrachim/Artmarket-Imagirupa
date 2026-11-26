<div class="sidebar-section-title">Utama</div>
<div class="nav-item">
    <a href="{{ route('pelanggan.dashboard') }}" class="nav-link {{ request()->routeIs('pelanggan.dashboard') ? 'active' : '' }}">
        <i class="bi bi-speedometer2"></i> Dashboard
    </a>
</div>
<div class="nav-item">
    <a href="{{ route('gallery') }}" class="nav-link">
        <i class="bi bi-shop"></i> Galeri Karya
    </a>
</div>

<div class="sidebar-section-title">Pesanan</div>
<div class="nav-item">
    <a href="{{ route('pelanggan.pesanan.index') }}" class="nav-link {{ request()->routeIs('pelanggan.pesanan*') ? 'active' : '' }}">
        <i class="bi bi-bag"></i> Riwayat Pesanan
    </a>
</div>

<div class="sidebar-section-title">Akun</div>
<div class="nav-item">
    <a href="{{ route('pelanggan.profil.edit') }}" class="nav-link {{ request()->routeIs('pelanggan.profil*') ? 'active' : '' }}">
        <i class="bi bi-person-circle"></i> Profil Saya
    </a>
</div>
