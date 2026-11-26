<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title', 'Dashboard'); ?> - Imagirupa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #6C3483;
            --primary-dark: #4A235A;
            --sidebar-bg: #1a0a2e;
            --sidebar-width: 250px;
            --accent: #F39C12;
        }
        body { font-family: 'Inter', sans-serif; background: #f4f5f7; }
        .sidebar {
            position: fixed; top: 0; left: 0; height: 100vh;
            width: var(--sidebar-width); background: var(--sidebar-bg);
            overflow-y: auto; z-index: 1000; transition: transform 0.3s ease;
        }
        .sidebar-brand { padding: 1.5rem 1.25rem; border-bottom: 1px solid rgba(255,255,255,0.08); }
        .sidebar-brand a { font-family: 'Playfair Display', serif; font-size: 1.2rem; font-weight: 700; color: #fff; text-decoration: none; }
        .sidebar-nav { padding: 1rem 0; }
        .sidebar-nav .nav-item { margin: 2px 0.75rem; }
        .sidebar-nav .nav-link {
            color: rgba(255,255,255,0.65); border-radius: 8px;
            padding: 0.6rem 1rem; font-size: 0.875rem; font-weight: 500;
            display: flex; align-items: center; gap: 0.65rem; transition: all 0.2s;
        }
        .sidebar-nav .nav-link:hover, .sidebar-nav .nav-link.active {
            color: #fff; background: rgba(255,255,255,0.1);
        }
        .sidebar-nav .nav-link.active { background: var(--primary); }
        .sidebar-section-title { color: rgba(255,255,255,0.35); font-size: 0.7rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.08em; padding: 1rem 1.75rem 0.3rem; }
        .main-content { margin-left: var(--sidebar-width); min-height: 100vh; }
        .topbar { background: #fff; padding: 0.75rem 1.5rem; box-shadow: 0 1px 4px rgba(0,0,0,0.08); display: flex; align-items: center; justify-content: space-between; position: sticky; top: 0; z-index: 100; }
        .content-area { padding: 1.5rem; }
        .stat-card { background: #fff; border-radius: 12px; padding: 1.25rem; box-shadow: 0 2px 10px rgba(0,0,0,0.06); border: none; }
        .stat-card .stat-icon { width: 48px; height: 48px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1.4rem; }
        .card { border: none; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.06); }
        .card-header { background: #fff; border-bottom: 1px solid #f0f0f0; font-weight: 600; border-radius: 12px 12px 0 0 !important; }
        .btn-primary { background: var(--primary); border-color: var(--primary); }
        .btn-primary:hover { background: var(--primary-dark); border-color: var(--primary-dark); }
        .text-primary { color: var(--primary) !important; }
        .badge-status-pending { background: #FFF3CD; color: #856404; }
        .table th { font-size: 0.8rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; color: #666; background: #fafafa; }
        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.show { transform: translateX(0); }
            .main-content { margin-left: 0; }
        }
    </style>
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-brand">
            <a href="<?php echo e(route('home')); ?>">
                <img src="<?php echo e(asset('img/imagirupa.png')); ?>" 
                    alt="Imagirupa Logo"
                    style="height:55px; width:auto;">
            </a>
        </div>
        <div class="sidebar-nav">
            <?php if(auth()->user()->isAdmin()): ?>
                <?php echo $__env->make('layouts.partials.sidebar-admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php elseif(auth()->user()->isSeniman()): ?>
                <?php echo $__env->make('layouts.partials.sidebar-seniman', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php else: ?>
                <?php echo $__env->make('layouts.partials.sidebar-pelanggan', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>
        </div>
        <div class="p-3 mt-auto border-top border-secondary">
            <div class="d-flex align-items-center gap-2 mb-2">
                <span class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center" style="width:32px;height:32px;font-size:13px;">
                    <?php echo e(strtoupper(substr(auth()->user()->nama, 0, 1))); ?>

                </span>
                <div>
                    <div class="text-white small fw-semibold" style="line-height:1.1"><?php echo e(auth()->user()->nama); ?></div>
                    <div class="text-white-50" style="font-size:0.7rem;"><?php echo e(ucfirst(auth()->user()->role)); ?></div>
                </div>
            </div>
            <form method="POST" action="<?php echo e(route('logout')); ?>">
                <?php echo csrf_field(); ?>
                <button class="btn btn-sm btn-outline-light w-100 mt-1"><i class="bi bi-box-arrow-right me-1"></i>Logout</button>
            </form>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Topbar -->
        <div class="topbar">
            <div class="d-flex align-items-center gap-3">
                <button class="btn btn-sm btn-light d-md-none" onclick="document.getElementById('sidebar').classList.toggle('show')">
                    <i class="bi bi-list fs-5"></i>
                </button>
                <h6 class="mb-0 fw-semibold text-secondary"><?php echo $__env->yieldContent('page-title', 'Dashboard'); ?></h6>
            </div>
            <div class="d-flex align-items-center gap-3">
                <a href="<?php echo e(route('gallery')); ?>" class="btn btn-sm btn-outline-secondary">
                    <i class="bi bi-shop me-1"></i>Marketplace
                </a>
            </div>
        </div>

        <!-- Alerts -->
        <div class="content-area pb-0">
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
            <?php if($errors->any()): ?>
                <div class="alert alert-danger alert-dismissible fade show">
                    <i class="bi bi-exclamation-circle me-2"></i>
                    <ul class="mb-0 ps-3">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>
        </div>

        <div class="content-area">
            <?php echo $__env->yieldContent('content'); ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH C:\laragon\www\imagirupa\resources\views/layouts/dashboard.blade.php ENDPATH**/ ?>