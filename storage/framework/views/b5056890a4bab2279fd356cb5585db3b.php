<?php $__env->startSection('title', 'Seniman - Imagirupa Art Market'); ?>

<?php $__env->startPush('styles'); ?>
<style>
    <style>

body{
    background:#F5F5F5;
    color:#2C3E50;
    font-family:'Inter',sans-serif;
}

/* ===== HERO ===== */
.page-hero{
    background:
        radial-gradient(circle at top left, rgba(255,90,9,0.08), transparent 30%),
        radial-gradient(circle at bottom right, rgba(44,62,80,0.05), transparent 30%),
        linear-gradient(135deg,#FFFFFF 0%,#F8F9FA 100%);
    padding:4rem 0 6rem;
    position:relative;
    overflow:hidden;
    border-bottom:1px solid #ECECEC;
}

.page-hero::before{
    content:'';
    position:absolute;
    inset:0;
    background-image:
        linear-gradient(rgba(0,0,0,0.015) 1px, transparent 1px),
        linear-gradient(90deg, rgba(0,0,0,0.015) 1px, transparent 1px);
    background-size:40px 40px;
}

.page-hero h1{
    font-family:'Playfair Display',serif;
    font-size:3rem;
    font-weight:700;
    color:#2C3E50;
    line-height:1.2;
    letter-spacing:-1px;
}

.page-hero h1 span{
    color:#FF5A09 !important;
}

.page-hero p{
    color:#6B7280 !important;
}

/* ===== FILTER ===== */
.filter-card{
    background:#FFFFFF;
    border-radius:28px;
    box-shadow:
        0 10px 30px rgba(0,0,0,0.05),
        0 2px 10px rgba(0,0,0,0.03);
    border:1px solid #EEEEEE;
    margin-top:-3rem;
    position:relative;
    z-index:10;
}

.search-bar .form-control,
.form-select,
.input-group-text{
    border:1px solid #E5E7EB;
    background:#FAFAFA;
    min-height:48px;
}

.search-bar .form-control:focus,
.form-select:focus{
    border-color:#FF5A09;
    box-shadow:0 0 0 0.15rem rgba(255,90,9,0.15);
}

.input-group-text{
    border-radius:14px 0 0 14px;
}

.search-bar .form-control{
    border-radius:0 14px 14px 0;
}

.form-select{
    border-radius:14px;
}

/* ===== FILTER CHIP ===== */
.filter-chip{
    display:inline-flex;
    align-items:center;
    padding:0.45rem 1rem;
    border-radius:999px;
    border:1px solid #E5E7EB;
    background:#FFFFFF;
    color:#6B7280;
    font-size:0.78rem;
    font-weight:500;
    text-decoration:none;
    transition:0.3s;
}

.filter-chip:hover,
.filter-chip.active{
    background:#FF5A09;
    border-color:#FF5A09;
    color:#FFFFFF;
}

/* ===== CARD ===== */
.seniman-card{
    border:none;
    border-radius:26px;
    overflow:hidden;
    background:#FFFFFF;
    transition:0.35s ease;
    box-shadow:
        0 6px 18px rgba(0,0,0,0.05),
        0 2px 8px rgba(0,0,0,0.03);
}

.seniman-card:hover{
    transform:translateY(-8px);
    box-shadow:
        0 20px 40px rgba(0,0,0,0.10),
        0 5px 15px rgba(255,90,9,0.08);
}

/* ===== COVER ===== */
.seniman-cover{
    height:130px;
    position:relative;
    background:
        radial-gradient(circle at top left, rgba(255,255,255,0.15), transparent 30%),
        linear-gradient(135deg,#2C3E50 0%,#34495E 100%);
}

.seniman-cover.cover-1,
.seniman-cover.cover-2,
.seniman-cover.cover-3,
.seniman-cover.cover-4,
.seniman-cover.cover-5,
.seniman-cover.cover-6{
    background:
        radial-gradient(circle at top left, rgba(255,255,255,0.12), transparent 30%),
        linear-gradient(135deg,#2C3E50 0%,#34495E 100%);
}

/* ===== AVATAR ===== */
.avatar-wrap{
    position:absolute;
    bottom:-38px;
    left:50%;
    transform:translateX(-50%);
}

.seniman-avatar{
    width:78px;
    height:78px;
    border-radius:50%;
    border:4px solid #FFFFFF;
    box-shadow:
        0 8px 20px rgba(0,0,0,0.12),
        0 4px 10px rgba(255,90,9,0.06);
    object-fit:cover;
    background:#FFFFFF;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:1.9rem;
    font-weight:700;
    color:#FF5A09;
    overflow:hidden;
}

.seniman-avatar img{
    width:100%;
    height:100%;
    object-fit:cover;
}

/* ===== BODY ===== */
.seniman-body{
    padding:3rem 1.5rem 1.5rem;
    text-align:center;
}

.seniman-name{
    font-family:'Playfair Display',serif;
    font-size:1.2rem;
    font-weight:700;
    color:#2C3E50;
    margin-bottom:0.25rem;
}

.seniman-spec{
    font-size:0.78rem;
    color:#FF5A09;
    font-weight:600;
    text-transform:uppercase;
    letter-spacing:0.06em;
    margin-bottom:0.4rem;
}

.seniman-kota{
    font-size:0.78rem;
    color:#9CA3AF;
}

.seniman-bio{
    font-size:0.83rem;
    color:#6B7280;
    line-height:1.7;
    margin:0.9rem 0;
    min-height:70px;
}

/* ===== STATS ===== */
.seniman-stats{
    display:flex;
    justify-content:center;
    gap:1.8rem;
    padding:1rem 0;
    border-top:1px solid #F3F4F6;
    border-bottom:1px solid #F3F4F6;
    margin:1rem 0;
}

.stat-num{
    font-weight:700;
    color:#FF5A09;
    font-size:1.15rem;
    display:block;
}

.stat-lbl{
    font-size:0.68rem;
    color:#9CA3AF;
    text-transform:uppercase;
    letter-spacing:0.05em;
}

/* ===== PREVIEW KARYA ===== */
.preview-karya{
    display:flex;
    gap:6px;
    justify-content:center;
    margin-bottom:1rem;
}

.preview-karya-item{
    width:54px;
    height:54px;
    border-radius:12px;
    overflow:hidden;
    background:#F3F4F6;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:1.2rem;
    flex-shrink:0;
    border:1px solid #EEEEEE;
}

.preview-karya-item img{
    width:100%;
    height:100%;
    object-fit:cover;
}

/* ===== SOSMED ===== */
.sosmed-mini a{
    display:inline-flex;
    width:30px;
    height:30px;
    border-radius:50%;
    align-items:center;
    justify-content:center;
    background:#FFF3EC !important;
    color:#FF5A09;
    font-size:0.82rem;
    text-decoration:none;
    transition:0.3s;
}

.sosmed-mini a:hover{
    background:#FF5A09 !important;
    color:#FFFFFF;
    transform:translateY(-2px);
}

/* ===== BUTTON ===== */
.btn-lihat-profil{
    background:#FF5A09;
    color:#FFFFFF;
    border:none;
    border-radius:999px;
    padding:0.65rem 1.5rem;
    font-size:0.85rem;
    font-weight:600;
    text-decoration:none;
    display:inline-block;
    transition:0.3s;
    box-shadow:0 10px 20px rgba(255,90,9,0.18);
}

.btn-lihat-profil:hover{
    background:#E74C3C;
    color:#FFFFFF;
    transform:translateY(-2px);
}

/* ===== BUTTON GLOBAL ===== */
.btn-primary{
    background:#FF5A09 !important;
    border:none !important;
    border-radius:14px;
    font-weight:600;
    box-shadow:0 8px 18px rgba(255,90,9,0.20);
}

.btn-primary:hover{
    background:#E74C3C !important;
}

.btn-outline-secondary{
    border-radius:14px;
}

.btn-outline-primary{
    border-color:#FF5A09;
    color:#FF5A09;
    border-radius:14px;
    font-weight:600;
}

.btn-outline-primary:hover{
    background:#FF5A09;
    border-color:#FF5A09;
    color:#FFFFFF;
}

/* ===== RESULT ===== */
h5{
    color:#2C3E50 !important;
}

h5 span{
    color:#FF5A09 !important;
}

/* ===== EMPTY ===== */
.empty-state{
    text-align:center;
    padding:5rem 0;
    color:#9CA3AF;
}

.empty-state i{
    font-size:4rem;
    display:block;
    margin-bottom:1rem;
    opacity:0.35;
}

/* ===== PAGINATION ===== */
.pagination{
    gap:0.5rem;
}

.page-link{
    border:none;
    border-radius:12px !important;
    color:#2C3E50;
    background:#FFFFFF;
    box-shadow:0 2px 8px rgba(0,0,0,0.04);
    min-width:42px;
    text-align:center;
}

.page-link:hover{
    background:#FFF3EC;
    color:#FF5A09;
}

.page-item.active .page-link{
    background:#FF5A09;
    color:#FFFFFF;
}

/* ===== RESPONSIVE ===== */
@media(max-width:768px){

    .page-hero{
        padding:3rem 0 5rem;
    }

    .page-hero h1{
        font-size:2.1rem;
    }

    .filter-card{
        border-radius:22px;
    }

    .seniman-bio{
        min-height:auto;
    }

}

</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>


<div class="page-hero">
    <div class="container text-center position-relative">
        <p class="text-white-50 small fw-semibold mb-2 text-uppercase letter-spacing-1">✦ Komunitas Kreatif Imagirupa</p>
        <h1 style="font-family:'Playfair Display',serif;font-size:2.8rem;font-weight:700;color:#0b0a13;line-height:1.2;">
            Temui Para Seniman<br>
            <span style="color:#F39C12;">Berbakat Pontianak</span>
        </h1>
        <p class="text-white-50 mt-3 mb-0" style="max-width:520px;margin:auto;font-size:1rem;">
            Jelajahi profil, karya, dan portofolio seniman-seniman terbaik dari Kalimantan Barat.
        </p>
    </div>
</div>

<div class="container pb-5">

    
    <div class="filter-card p-4 mb-5">
        <form method="GET" action="<?php echo e(route('seniman.index')); ?>">
            <div class="row g-3 align-items-end">
                <div class="col-md-5 search-bar">
                    <label class="form-label small fw-semibold text-muted mb-1">Cari Seniman</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0">
                            <i class="bi bi-search text-muted"></i>
                        </span>
                        <input type="text" name="search" class="form-control border-start-0"
                            placeholder="Nama, spesialisasi, atau kota..."
                            value="<?php echo e(request('search')); ?>">
                    </div>
                </div>
                <div class="col-md-4">
                    <label class="form-label small fw-semibold text-muted mb-1">Spesialisasi</label>
                    <select name="spesialisasi" class="form-select">
                        <option value="">Semua Spesialisasi</option>
                        <?php $__currentLoopData = $spesialisasiList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($sp); ?>" <?php echo e(request('spesialisasi') === $sp ? 'selected' : ''); ?>>
                                <?php echo e($sp); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100 py-2">
                        <i class="bi bi-funnel me-1"></i>Filter
                    </button>
                </div>
                <?php if(request('search') || request('spesialisasi')): ?>
                <div class="col-md-1">
                    <a href="<?php echo e(route('seniman.index')); ?>" class="btn btn-outline-secondary w-100 py-2" title="Reset">
                        <i class="bi bi-x-lg"></i>
                    </a>
                </div>
                <?php endif; ?>
            </div>

            
            <?php if($spesialisasiList->count() > 0): ?>
            <div class="mt-3 d-flex flex-wrap gap-2 align-items-center">
                <span class="text-muted small me-1">Filter cepat:</span>
                <a href="<?php echo e(route('seniman.index')); ?>" class="filter-chip <?php echo e(!request('spesialisasi') ? 'active' : ''); ?>">
                    Semua
                </a>
                <?php $__currentLoopData = $spesialisasiList->take(8); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e(route('seniman.index', ['spesialisasi' => $sp])); ?>"
                    class="filter-chip <?php echo e(request('spesialisasi') === $sp ? 'active' : ''); ?>">
                    <?php echo e($sp); ?>

                </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <?php endif; ?>
        </form>
    </div>

    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h5 class="fw-bold mb-0" style="color:#1a0a2e;">
                <?php echo e($senimans->total()); ?> Seniman
                <?php if(request('search')): ?>
                    untuk "<span style="color:#6C3483"><?php echo e(request('search')); ?></span>"
                <?php endif; ?>
            </h5>
            <p class="text-muted small mb-0">Semua seniman terverifikasi di platform Imagirupa</p>
        </div>
    </div>

    
    <?php if($senimans->count() > 0): ?>
    <div class="row g-4">
        <?php $__currentLoopData = $senimans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $seniman): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
            $covers = ['cover-1','cover-2','cover-3','cover-4','cover-5','cover-6'];
            $coverClass = $covers[$i % count($covers)];
            $previewKaryas = $seniman->karyas()->where('status_karya','tersedia')->latest()->limit(3)->get();
        ?>
        <div class="col-sm-6 col-lg-4">
            <div class="seniman-card h-100">
                
                <div class="seniman-cover <?php echo e($coverClass); ?>">
                    
                    <svg style="position:absolute;bottom:0;left:0;right:0;opacity:0.08" viewBox="0 0 400 80" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="50" cy="80" r="60" fill="white"/>
                        <circle cx="200" cy="60" r="80" fill="white"/>
                        <circle cx="370" cy="70" r="50" fill="white"/>
                    </svg>
                    <div class="avatar-wrap">
                        <div class="seniman-avatar">
                            <?php if($seniman->profile && $seniman->profile->foto && file_exists(public_path('uploads/profil/'.$seniman->profile->foto))): ?>
                                <img src="<?php echo e(asset('uploads/profil/'.$seniman->profile->foto)); ?>" alt="<?php echo e($seniman->nama); ?>">
                            <?php else: ?>
                                <?php echo e(strtoupper(substr($seniman->nama, 0, 1))); ?>

                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                
                <div class="seniman-body">
                    <div class="seniman-name"><?php echo e($seniman->nama); ?></div>

                    <?php if($seniman->profile && $seniman->profile->spesialisasi): ?>
                        <div class="seniman-spec">
                            <i class="bi bi-brush me-1"></i><?php echo e($seniman->profile->spesialisasi); ?>

                        </div>
                    <?php endif; ?>

                    <?php if($seniman->profile && $seniman->profile->kota): ?>
                        <div class="seniman-kota">
                            <i class="bi bi-geo-alt me-1"></i><?php echo e($seniman->profile->kota); ?>

                        </div>
                    <?php endif; ?>

                    <?php if($seniman->profile && $seniman->profile->bio): ?>
                        <p class="seniman-bio"><?php echo e(Str::limit($seniman->profile->bio, 90)); ?></p>
                    <?php else: ?>
                        <p class="seniman-bio text-muted fst-italic">Belum ada bio.</p>
                    <?php endif; ?>

                    
                    <?php if($previewKaryas->count() > 0): ?>
                    <div class="preview-karya">
                        <?php $__currentLoopData = $previewKaryas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="preview-karya-item" title="<?php echo e($kp->judul); ?>">
                            <?php if($kp->gambar && file_exists(public_path('uploads/karya/'.$kp->gambar))): ?>
                                <img src="<?php echo e(asset('uploads/karya/'.$kp->gambar)); ?>" alt="<?php echo e($kp->judul); ?>">
                            <?php else: ?>
                                🎨
                            <?php endif; ?>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php if($seniman->total_karya > 3): ?>
                        <div class="preview-karya-item" style="background:#f5f0ff;color:#6C3483;font-size:0.75rem;font-weight:700;">
                            +<?php echo e($seniman->total_karya - 3); ?>

                        </div>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>

                    
                    <div class="seniman-stats">
                        <div>
                            <span class="stat-num"><?php echo e($seniman->total_karya); ?></span>
                            <span class="stat-lbl">Karya</span>
                        </div>
                        <div>
                            <span class="stat-num"><?php echo e($seniman->total_terjual); ?></span>
                            <span class="stat-lbl">Terjual</span>
                        </div>
                        <div>
                            <span class="stat-num"><?php echo e($seniman->created_at->format('Y')); ?></span>
                            <span class="stat-lbl">Bergabung</span>
                        </div>
                    </div>

                    
                    <?php if($seniman->profile): ?>
                    <div class="sosmed-mini mb-3 d-flex justify-content-center gap-1 flex-wrap">
                        <?php $__currentLoopData = $seniman->profile->sosmed; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="<?php echo e($sm['url']); ?>" target="_blank" title="<?php echo e($sm['name']); ?>"
                            style="background:#f5f0ff;">
                            <i class="bi <?php echo e($sm['icon']); ?>"></i>
                        </a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <?php endif; ?>

                    <a href="<?php echo e(route('seniman.profile.public', $seniman)); ?>" class="btn-lihat-profil">
                        <i class="bi bi-person-lines-fill me-1"></i>Lihat Profil
                    </a>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    
    <?php if($senimans->hasPages()): ?>
    <div class="d-flex justify-content-center mt-5">
        <?php echo e($senimans->links()); ?>

    </div>
    <?php endif; ?>

    <?php else: ?>
    <div class="empty-state">
        <i class="bi bi-people"></i>
        <h5>Tidak ada seniman ditemukan</h5>
        <p class="small">Coba ubah kata kunci pencarian atau filter Anda.</p>
        <a href="<?php echo e(route('seniman.index')); ?>" class="btn btn-outline-primary mt-2">Reset Filter</a>
    </div>
    <?php endif; ?>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\imagirupa\resources\views/public/seniman/index.blade.php ENDPATH**/ ?>