<div class="sidebar-section-title">Utama</div>
<div class="nav-item">
    <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
        <i class="bi bi-speedometer2"></i> Dashboard
    </a>
</div>

<div class="sidebar-section-title">Manajemen</div>
<div class="nav-item">
    <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->routeIs('admin.users*') ? 'active' : '' }}">
        <i class="bi bi-people"></i> Kelola User
    </a>
</div>
<div class="nav-item">
    <a href="{{ route('admin.karyas.index') }}" class="nav-link {{ request()->routeIs('admin.karyas*') ? 'active' : '' }}">
        <i class="bi bi-images"></i> Kelola Karya
    </a>
</div>
<div class="nav-item">
    <a href="{{ route('admin.transaksi.index') }}" class="nav-link {{ request()->routeIs('admin.transaksi*') ? 'active' : '' }}">
        <i class="bi bi-receipt"></i> Kelola Transaksi
    </a>
</div>

<div class="sidebar-section-title">Laporan</div>
<div class="nav-item">
    <a href="{{ route('admin.laporan') }}" class="nav-link {{ request()->routeIs('admin.laporan') ? 'active' : '' }}">
        <i class="bi bi-bar-chart"></i> Laporan Sistem
    </a>
</div>
