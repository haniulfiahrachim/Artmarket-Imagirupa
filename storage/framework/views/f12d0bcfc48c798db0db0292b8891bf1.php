<?php $__env->startSection('title', 'Masuk - Imagirupa'); ?>

<?php $__env->startPush('styles'); ?>
<style>

body{
    min-height:100vh;
    background:
        radial-gradient(circle at top left, rgba(255,90,9,0.08), transparent 30%),
        radial-gradient(circle at bottom right, rgba(44,62,80,0.05), transparent 30%),
        linear-gradient(135deg,#F5F5F5 0%,#FFFFFF 100%);
    font-family:'Inter',sans-serif;
    color:#2C3E50;
    position:relative;
    overflow-x:hidden;
}

/* Background Pattern */
body::before{
    content:'';
    position:fixed;
    inset:0;
    background-image:
        linear-gradient(rgba(0,0,0,0.015) 1px, transparent 1px),
        linear-gradient(90deg, rgba(0,0,0,0.015) 1px, transparent 1px);
    background-size:40px 40px;
    pointer-events:none;
}

/* Auth Card */
.auth-card{
    background:#FFFFFF;
    border-radius:30px;
    box-shadow:
        0 20px 50px rgba(0,0,0,0.08),
        0 5px 20px rgba(0,0,0,0.04);
    padding:2.8rem;
    max-width:430px;
    width:100%;
    border:1px solid #EEEEEE;
    position:relative;
    overflow:hidden;
}

/* Decorative Gradient */
.auth-card::before{
    content:'';
    position:absolute;
    width:220px;
    height:220px;
    background:rgba(255,90,9,0.05);
    border-radius:50%;
    top:-120px;
    right:-100px;
}

.auth-card::after{
    content:'';
    position:absolute;
    width:140px;
    height:140px;
    background:rgba(44,62,80,0.04);
    border-radius:50%;
    bottom:-70px;
    left:-60px;
}

/* Logo */
.auth-logo{
    position:relative;
    z-index:2;
}

.auth-logo img{
    height:58px;
    width:auto;
    filter:drop-shadow(0 4px 10px rgba(0,0,0,0.08));
}

/* Heading */
h5{
    color:#2C3E50;
    font-weight:700;
    letter-spacing:-0.3px;
}

.text-muted{
    color:#6B7280 !important;
}

/* Form */
.form-label{
    color:#374151;
    font-weight:600;
    margin-bottom:0.45rem;
}

.form-control{
    min-height:50px;
    border-radius:14px;
    border:1px solid #E5E7EB;
    background:#FAFAFA;
    color:#2C3E50;
    padding:0.75rem 1rem;
    transition:0.3s;
}

.form-control::placeholder{
    color:#9CA3AF;
}

.form-control:focus{
    border-color:#FF5A09;
    background:#FFFFFF;
    box-shadow:0 0 0 0.18rem rgba(255,90,9,0.12);
}

.form-check-label{
    color:#6B7280;
}

/* Button */
.btn-primary{
    background:#FF5A09 !important;
    border:none !important;
    border-radius:14px;
    font-weight:600;
    min-height:50px;
    box-shadow:0 10px 20px rgba(255,90,9,0.18);
    transition:0.3s;
}

.btn-primary:hover{
    background:#E74C3C !important;
    transform:translateY(-2px);
}

/* Divider */
.divider{
    position:relative;
    text-align:center;
    margin:1.7rem 0;
}

.divider::before{
    content:'';
    position:absolute;
    top:50%;
    left:0;
    right:0;
    height:1px;
    background:#E5E7EB;
}

.divider span{
    background:#FFFFFF;
    padding:0 1rem;
    position:relative;
    color:#9CA3AF;
    font-size:0.82rem;
}

/* Alert */
.alert{
    border:none;
    border-radius:14px;
    font-size:0.85rem;
    padding:0.9rem 1rem;
}

.alert-danger{
    background:#FEF2F2;
    color:#B91C1C;
}

/* Demo Box */
.demo-box{
    background:#FFF7F2;
    border:1px solid #FFE1CF;
    border-radius:16px;
    padding:1rem;
    font-size:0.82rem;
    color:#4B5563;
}

.demo-box .fw-semibold{
    color:#FF5A09 !important;
}

/* Register Link */
.text-center a{
    color:#FF5A09 !important;
    transition:0.2s;
}

.text-center a:hover{
    color:#E74C3C !important;
}

/* Responsive */
@media(max-width:576px){

    .auth-card{
        padding:2rem 1.5rem;
        border-radius:24px;
    }

}

</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex align-items-center justify-content-center" style="min-height:85vh;padding:2rem 1rem;">
    <div class="auth-card">
        <div class="text-center mb-4">
            <div class="auth-logo">
                <img src="<?php echo e(asset('img/imagirupa.png')); ?>" 
                    alt="Imagirupa Logo"
                    style="height:55px; width:auto;">
            </div>
            <h5 class="mt-2 fw-semibold text-dark">Selamat Datang Kembali</h5>
            <p class="text-muted small">Masuk ke akun Anda untuk melanjutkan</p>
        </div>

        <?php if($errors->any()): ?>
        <div class="alert alert-danger py-2 small">
            <i class="bi bi-exclamation-circle me-1"></i><?php echo e($errors->first()); ?>

        </div>
        <?php endif; ?>

        <form method="POST" action="<?php echo e(route('login')); ?>">
            <?php echo csrf_field(); ?>
            <div class="mb-3">
                <label class="form-label fw-semibold small">Email</label>
                <input type="email" name="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                    placeholder="nama@email.com" value="<?php echo e(old('email')); ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold small">Password</label>
                <input type="password" name="password" class="form-control" placeholder="••••••••" required>
            </div>
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember">
                    <label class="form-check-label small" for="remember">Ingat saya</label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary w-100 py-2 fw-semibold">
                <i class="bi bi-box-arrow-in-right me-2"></i>Masuk
            </button>
        </form>

        <div class="divider"><span>atau</span></div>

        

        <p class="text-center small text-muted mb-0">
            Belum punya akun? <a href="<?php echo e(route('register')); ?>" class="text-decoration-none fw-semibold" style="color:#6C3483">Daftar sekarang</a>
        </p>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\imagirupa\resources\views/auth/login.blade.php ENDPATH**/ ?>