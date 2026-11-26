<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title', 'Imagirupa Art Market'); ?></title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #f57e10;
            --primary-dark: #f16a10;
            --accent: #F39C12;
            --light-bg: #FAF9FF;
            --card-shadow: 0 4px 20px rgba(108,52,131,0.10);
        }
        body { font-family: 'Inter', sans-serif; background: var(--light-bg); }
        .navbar-brand { font-family: 'Playfair Display', serif; font-weight: 700; color: var(--primary) !important; font-size: 1.5rem; }
        .navbar { background: #fff; box-shadow: 0 2px 12px rgba(0,0,0,0.07); }
        .btn-primary { background: var(--primary); border-color: var(--primary); }
        .btn-primary:hover { background: var(--primary-dark); border-color: var(--primary-dark); }
        .btn-outline-primary { color: var(--primary); border-color: var(--primary); }
        .btn-outline-primary:hover { background: var(--primary); border-color: var(--primary); }
        .text-primary { color: var(--primary) !important; }
        .bg-primary { background: var(--primary) !important; }
        .card { border: none; box-shadow: var(--card-shadow); border-radius: 12px; }
        .footer { background: var(--primary-dark); color: #fff; padding: 2rem 0; margin-top: 4rem; }
        .nav-link { color: #555 !important; font-weight: 500; }
        .nav-link:hover, .nav-link.active { color: var(--primary) !important; }
        .dropdown-item:active { background: var(--primary); }
    </style>
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="<?php echo e(route('home')); ?>">
                <img src="<?php echo e(asset('img/imagirupa.png')); ?>" 
                    alt="Imagirupa Logo"
                    style="height:55px; width:auto;">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMain">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navMain">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link <?php echo e(request()->routeIs('home') ? 'active' : ''); ?>" href="<?php echo e(route('home')); ?>">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo e(request()->routeIs('gallery*') ? 'active' : ''); ?>" href="<?php echo e(route('gallery')); ?>">Galeri</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo e(request()->routeIs('seniman.index') || request()->routeIs('seniman.profile.public') ? 'active' : ''); ?>" href="<?php echo e(route('seniman.index')); ?>">Seniman</a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto align-items-center gap-2">
                    <?php if(auth()->guard()->guest()): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo e(route('login')); ?>">Masuk</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-primary btn-sm px-3" href="<?php echo e(route('register')); ?>">Daftar</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center gap-2" href="#" data-bs-toggle="dropdown">
                                <span class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center" style="width:32px;height:32px;font-size:14px;">
                                    <?php echo e(strtoupper(substr(auth()->user()->nama, 0, 1))); ?>

                                </span>
                                <?php echo e(auth()->user()->nama); ?>

                            </a>
                            <ul class="dropdown-menu dropdown-menu-end shadow">
                                <?php if(auth()->user()->isAdmin()): ?>
                                    <li><a class="dropdown-item" href="<?php echo e(route('admin.dashboard')); ?>"><i class="bi bi-speedometer2 me-2"></i>Dashboard Admin</a></li>
                                <?php elseif(auth()->user()->isSeniman()): ?>
                                    <li><a class="dropdown-item" href="<?php echo e(route('seniman.dashboard')); ?>"><i class="bi bi-speedometer2 me-2"></i>Dashboard</a></li>
                                    <li><a class="dropdown-item" href="<?php echo e(route('seniman.profil.edit')); ?>"><i class="bi bi-person me-2"></i>Profil Saya</a></li>
                                <?php else: ?>
                                    <li><a class="dropdown-item" href="<?php echo e(route('pelanggan.dashboard')); ?>"><i class="bi bi-speedometer2 me-2"></i>Dashboard</a></li>
                                    <li><a class="dropdown-item" href="<?php echo e(route('pelanggan.profil.edit')); ?>"><i class="bi bi-person me-2"></i>Profil Saya</a></li>
                                <?php endif; ?>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="<?php echo e(route('logout')); ?>">
                                        <?php echo csrf_field(); ?>
                                        <button class="dropdown-item text-danger"><i class="bi bi-box-arrow-right me-2"></i>Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Alerts -->
    <?php if(session('success') || session('error') || session('warning')): ?>
    <div class="container mt-3">
        <?php if(session('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle me-2"></i><?php echo e(session('success')); ?>

                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>
        <?php if(session('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-circle me-2"></i><?php echo e(session('error')); ?>

                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>
        <?php if(session('warning')): ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle me-2"></i><?php echo e(session('warning')); ?>

                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>
    </div>
    <?php endif; ?>

    <?php echo $__env->yieldContent('content'); ?>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <h5 class="fw-bold"><i class="bi bi-palette2 me-1"></i>Imagirupa Art Market</h5>
                    <p class="text-white-50 small">Platform marketplace karya seni digital dan fisik untuk komunitas kreatif Pontianak.</p>
                </div>
                <div class="col-md-4 mb-3">
                    <h6 class="fw-semibold">Navigasi</h6>
                    <ul class="list-unstyled">
                        <li><a href="<?php echo e(route('home')); ?>" class="text-white-50 text-decoration-none small">Beranda</a></li>
                        <li><a href="<?php echo e(route('gallery')); ?>" class="text-white-50 text-decoration-none small">Galeri Karya</a></li>
                        <li><a href="<?php echo e(route('register')); ?>" class="text-white-50 text-decoration-none small">Daftar Seniman</a></li>
                    </ul>
                </div>
                <div class="col-md-4 mb-3">
                    <h6 class="fw-semibold">Kontak</h6>
                    <p class="text-white-50 small"><i class="bi bi-geo-alt me-1"></i>Pontianak, Kalimantan Barat</p>
                    <p class="text-white-50 small"><i class="bi bi-envelope me-1"></i>imagirupa@gmail.com</p>
                </div>
            </div>
            <hr class="border-secondary">
            <p class="text-center text-white-50 small mb-0">&copy; <?php echo e(date('Y')); ?> Imagirupa Art Market. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH C:\laragon\www\imagirupa\resources\views/layouts/app.blade.php ENDPATH**/ ?>