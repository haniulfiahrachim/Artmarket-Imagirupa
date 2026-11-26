<div class="sidebar-section-title">Utama</div>
<div class="nav-item">
    <a href="{{ route('seniman.dashboard') }}" class="nav-link {{ request()->routeIs('seniman.dashboard') ? 'active' : '' }}">
        <i class="bi bi-speedometer2"></i> Dashboard
    </a>
</div>

<div class="sidebar-section-title">Karya</div>
<div class="nav-item">
    <a href="{{ route('seniman.karya.index') }}" class="nav-link {{ request()->routeIs('seniman.karya*') ? 'active' : '' }}">
        <i class="bi bi-images"></i> Kelola Karya
    </a>
</div>
<div class="nav-item">
    <a href="{{ route('seniman.karya.create') }}" class="nav-link {{ request()->routeIs('seniman.karya.create') ? 'active' : '' }}">
        <i class="bi bi-plus-circle"></i> Upload Karya
    </a>
</div>

<div class="sidebar-section-title">Pesanan</div>
<div class="nav-item">
    <a href="{{ route('seniman.pesanan.index') }}" class="nav-link {{ request()->routeIs('seniman.pesanan*') ? 'active' : '' }}">
        <i class="bi bi-bag-check"></i> Pesanan Masuk
    </a>
</div>

<div class="sidebar-section-title">Akun</div>
<div class="nav-item">
    <a href="{{ route('seniman.profil.edit') }}" class="nav-link {{ request()->routeIs('seniman.profil*') ? 'active' : '' }}">
        <i class="bi bi-person-circle"></i> Profil Saya
    </a>
</div>
