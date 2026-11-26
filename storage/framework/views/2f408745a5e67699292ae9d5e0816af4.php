<?php $__env->startSection('title', $user->nama . ' - Seniman Imagirupa'); ?>

<?php $__env->startPush('styles'); ?>
<style>
    <style>

body{
    background:#F5F5F5;
    color:#2C3E50;
    font-family:'Inter',sans-serif;
}

/* ===== HERO ===== */
.profile-hero{
    background:
        radial-gradient(circle at top left, rgba(255,90,9,0.08), transparent 30%),
        radial-gradient(circle at bottom right, rgba(44,62,80,0.05), transparent 30%),
        linear-gradient(135deg,#FFFFFF 0%,#F8F9FA 100%);
    position:relative;
    overflow:hidden;
    border-bottom:1px solid #ECECEC;
}

.profile-cover{
    height:240px;
    position:relative;
    overflow:hidden;
}

.profile-cover::before{
    content:'';
    position:absolute;
    inset:0;
    background-image:
        linear-gradient(rgba(0,0,0,0.015) 1px, transparent 1px),
        linear-gradient(90deg, rgba(0,0,0,0.015) 1px, transparent 1px);
    background-size:40px 40px;
}

.cover-deco{
    position:absolute;
    border-radius:50%;
    background:rgba(255,90,9,0.06);
}

/* ===== PROFILE BAR ===== */
.profile-info-bar{
    background:#FFFFFF;
    box-shadow:
        0 8px 24px rgba(0,0,0,0.05),
        0 2px 8px rgba(0,0,0,0.03);
    border-bottom:1px solid #F0F0F0;
}

.profile-info-inner{
    padding:0 0 1.5rem;
    position:relative;
}

.avatar-section{
    display:flex;
    align-items:flex-end;
    gap:1.5rem;
    padding-bottom:1rem;
    margin-top:-60px;
    position:relative;
    z-index:5;
}

.profile-avatar{
    width:120px;
    height:120px;
    border-radius:50%;
    border:5px solid #FFFFFF;
    background:#FFFFFF;
    box-shadow:
        0 10px 30px rgba(0,0,0,0.12),
        0 4px 10px rgba(255,90,9,0.08);
    overflow:hidden;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:3rem;
    font-weight:700;
    color:#FF5A09;
    flex-shrink:0;
}

.profile-avatar img{
    width:100%;
    height:100%;
    object-fit:cover;
}

.profile-name{
    font-family:'Playfair Display',serif;
    font-size:2.2rem;
    font-weight:700;
    color:#2C3E50;
    line-height:1.2;
}

.profile-spec{
    color:#FF5A09;
    font-weight:600;
    font-size:0.85rem;
    letter-spacing:.08em;
    text-transform:uppercase;
}

.profile-meta span{
    display:inline-flex;
    align-items:center;
    gap:5px;
    color:#6B7280;
    font-size:0.82rem;
    margin-right:1rem;
}

.verified-badge{
    display:inline-flex;
    align-items:center;
    gap:5px;
    background:#FFF3EC;
    color:#FF5A09;
    border-radius:999px;
    padding:0.35rem 0.85rem;
    font-size:0.75rem;
    font-weight:600;
    border:1px solid #FFD6BF;
}

/* ===== SOSMED ===== */
.sosmed-strip{
    display:flex;
    flex-wrap:wrap;
    gap:0.6rem;
    margin-top:1rem;
}

.sosmed-btn{
    display:inline-flex;
    align-items:center;
    gap:6px;
    padding:0.5rem 1rem;
    border-radius:999px;
    font-size:0.78rem;
    font-weight:600;
    text-decoration:none;
    transition:0.3s;
    border:1px solid #E5E7EB !important;
    background:#FFFFFF !important;
    color:#2C3E50 !important;
}

.sosmed-btn:hover{
    background:#FFF3EC !important;
    color:#FF5A09 !important;
    transform:translateY(-2px);
}

/* ===== STATS ===== */
.stats-strip{
    display:flex;
    gap:2rem;
    border-top:1px solid #F1F1F1;
    margin-top:1.3rem;
    padding-top:1rem;
}

.stat-item-v{
    text-align:center;
}

.stat-item-v .num{
    font-size:1.7rem;
    font-weight:700;
    color:#FF5A09;
    font-family:'Playfair Display',serif;
}

.stat-item-v .lbl{
    font-size:0.72rem;
    color:#9CA3AF;
    text-transform:uppercase;
    letter-spacing:.06em;
}

/* ===== CONTENT ===== */
.content-wrap{
    padding:2.5rem 0 4rem;
}

/* ===== TABS ===== */
.tab-nav{
    display:flex;
    gap:0.5rem;
    border-bottom:1px solid #EEEEEE;
    margin-bottom:2rem;
    overflow-x:auto;
}

.tab-btn{
    padding:0.8rem 1.3rem;
    font-weight:600;
    font-size:0.88rem;
    color:#6B7280;
    border:none;
    background:#FFFFFF;
    cursor:pointer;
    border-radius:14px 14px 0 0;
    transition:0.3s;
    display:flex;
    align-items:center;
    gap:6px;
}

.tab-btn:hover{
    color:#FF5A09;
    background:#FFF7F2;
}

.tab-btn.active{
    background:#FF5A09;
    color:#FFFFFF;
}

.tab-content-pane{
    display:none;
}

.tab-content-pane.active{
    display:block;
}

/* ===== SECTION ===== */
.section-heading{
    font-family:'Playfair Display',serif;
    font-size:1.4rem;
    font-weight:700;
    color:#2C3E50;
    margin-bottom:1.2rem;
    display:flex;
    align-items:center;
    gap:0.5rem;
}

.section-heading::after{
    content:'';
    flex:1;
    height:2px;
    background:linear-gradient(to right,#FF5A09,transparent);
    margin-left:0.8rem;
}

/* ===== BIO ===== */
.bio-card{
    background:#FFFFFF;
    border-radius:20px;
    padding:1.5rem;
    border:1px solid #EEEEEE;
    line-height:1.9;
    color:#4B5563;
    box-shadow:0 4px 15px rgba(0,0,0,0.03);
}

/* ===== KARYA ===== */
.karya-card-port{
    border:none;
    border-radius:22px;
    overflow:hidden;
    background:#FFFFFF;
    transition:0.35s ease;
    box-shadow:
        0 6px 18px rgba(0,0,0,0.05),
        0 2px 8px rgba(0,0,0,0.03);
}

.karya-card-port:hover{
    transform:translateY(-8px);
    box-shadow:
        0 20px 40px rgba(0,0,0,0.10),
        0 5px 15px rgba(255,90,9,0.08);
}

.karya-img-wrap{
    height:220px;
    overflow:hidden;
    background:#F3F4F6;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:3rem;
    position:relative;
}

.karya-img-wrap img{
    width:100%;
    height:100%;
    object-fit:cover;
    transition:0.4s ease;
}

.karya-card-port:hover img{
    transform:scale(1.05);
}

.karya-status-badge{
    position:absolute;
    top:12px;
    right:12px;
    font-size:0.68rem;
    font-weight:700;
    padding:0.35rem 0.7rem;
    border-radius:999px;
}

.karya-price{
    color:#FF5A09;
    font-weight:700;
    font-size:1.05rem;
}

/* ===== SIDEBAR ===== */
.sidebar-card{
    background:#FFFFFF;
    border-radius:22px;
    box-shadow:
        0 6px 18px rgba(0,0,0,0.05),
        0 2px 8px rgba(0,0,0,0.03);
    padding:1.5rem;
    margin-bottom:1.5rem;
    border:none;
}

.info-row{
    display:flex;
    align-items:flex-start;
    gap:0.8rem;
    padding:0.8rem 0;
    border-bottom:1px solid #F3F4F6;
    font-size:0.85rem;
}

.info-row:last-child{
    border-bottom:none;
}

.info-row .icon{
    color:#FF5A09;
    font-size:1rem;
    flex-shrink:0;
    margin-top:2px;
}

.info-row .lbl{
    color:#9CA3AF;
    font-size:0.72rem;
    display:block;
}

.info-row .val{
    color:#374151;
}

/* ===== BUTTONS ===== */
.btn{
    border-radius:14px;
    font-weight:600;
    transition:0.3s;
}

.btn-primary{
    background:#FF5A09 !important;
    border:none !important;
    box-shadow:0 10px 20px rgba(255,90,9,0.20);
}

.btn-primary:hover{
    background:#E74C3C !important;
    transform:translateY(-2px);
}

.btn-outline-primary{
    border:1px solid #FF5A09;
    color:#FF5A09;
}

.btn-outline-primary:hover{
    background:#FF5A09;
    color:#FFFFFF;
}

.btn-outline-secondary{
    border:1px solid #D1D5DB;
    color:#2C3E50;
    background:#FFFFFF;
}

.btn-outline-secondary:hover{
    background:#2C3E50;
    color:#FFFFFF;
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
@media(max-width:767px){

    .profile-cover{
        height:160px;
    }

    .profile-avatar{
        width:90px;
        height:90px;
        font-size:2rem;
    }

    .profile-name{
        font-size:1.6rem;
    }

    .avatar-section{
        margin-top:-45px;
        gap:1rem;
        flex-wrap:wrap;
    }

    .stats-strip{
        gap:1rem;
        flex-wrap:wrap;
    }

    .stat-item-v .num{
        font-size:1.3rem;
    }

}

</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>


<div class="profile-hero">
    <div class="profile-cover">
        
        <div class="cover-deco" style="width:300px;height:300px;top:-100px;right:-80px;"></div>
        <div class="cover-deco" style="width:150px;height:150px;bottom:-50px;left:100px;"></div>
        <div class="cover-deco" style="width:80px;height:80px;top:30px;left:40%;"></div>
        
        <div class="position-absolute bottom-0 start-0 p-3">
            <a href="<?php echo e(route('seniman.index')); ?>" class="text-white-50 text-decoration-none small">
                <i class="bi bi-arrow-left me-1"></i>Semua Seniman
            </a>
        </div>
    </div>
</div>


<div class="profile-info-bar">
    <div class="container">
        <div class="profile-info-inner">
            <div class="row">
                <div class="col-lg-8">
                    
                    <div class="avatar-section">
                        <div class="profile-avatar">
                            <?php if($user->profile && $user->profile->foto && file_exists(public_path('uploads/profil/'.$user->profile->foto))): ?>
                                <img src="<?php echo e(asset('uploads/profil/'.$user->profile->foto)); ?>" alt="<?php echo e($user->nama); ?>">
                            <?php else: ?>
                                <?php echo e(strtoupper(substr($user->nama, 0, 1))); ?>

                            <?php endif; ?>
                        </div>
                        <div class="profile-main-info">
                            <div class="d-flex align-items-center gap-2 flex-wrap mb-1">
                                <h1 class="profile-name mb-0"><?php echo e($user->nama); ?></h1>
                                <span class="verified-badge">
                                    <i class="bi bi-patch-check-fill"></i> Verified
                                </span>
                            </div>
                            <?php if($user->profile && $user->profile->spesialisasi): ?>
                                <div class="profile-spec">
                                    <i class="bi bi-brush me-1"></i><?php echo e($user->profile->spesialisasi); ?>

                                </div>
                            <?php endif; ?>
                            <div class="profile-meta">
                                <?php if($user->profile && $user->profile->kota): ?>
                                    <span><i class="bi bi-geo-alt"></i><?php echo e($user->profile->kota); ?></span>
                                <?php endif; ?>
                                <span><i class="bi bi-calendar3"></i>Bergabung <?php echo e($user->created_at->format('M Y')); ?></span>
                            </div>
                        </div>
                    </div>

                    
                    <?php if($user->profile && count($user->profile->sosmed) > 0): ?>
                    <div class="sosmed-strip">
                        <?php $__currentLoopData = $user->profile->sosmed; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="<?php echo e($sm['url']); ?>" target="_blank" rel="noopener"
                            class="sosmed-btn"
                            style="color:<?php echo e($sm['color']); ?>;border-color:<?php echo e($sm['color']); ?>20;background:<?php echo e($sm['color']); ?>0d;">
                            <i class="bi <?php echo e($sm['icon']); ?>"></i>
                            <?php echo e($sm['label']); ?>

                        </a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <?php endif; ?>

                    
                    <div class="stats-strip">
                        <div class="stat-item-v">
                            <div class="num"><?php echo e($stats['total_karya']); ?></div>
                            <div class="lbl">Total Karya</div>
                        </div>
                        <div class="stat-item-v">
                            <div class="num"><?php echo e($stats['karya_tersedia']); ?></div>
                            <div class="lbl">Tersedia</div>
                        </div>
                        <div class="stat-item-v">
                            <div class="num"><?php echo e($stats['karya_terjual']); ?></div>
                            <div class="lbl">Terjual</div>
                        </div>
                    </div>
                </div>

                
                <div class="col-lg-4 d-flex align-items-end justify-content-lg-end pt-3 pt-lg-0">
                    <div class="d-flex flex-column gap-2">
                        <?php if(auth()->guard()->check()): ?>
                            <?php if(auth()->user()->isPelanggan() && $stats['karya_tersedia'] > 0): ?>
                            <a href="<?php echo e(route('gallery')); ?>?search=<?php echo e(urlencode($user->nama)); ?>"
                                class="btn btn-primary px-4 py-2">
                                <i class="bi bi-bag-plus me-2"></i>Beli Karya
                            </a>
                            <?php endif; ?>
                        <?php else: ?>
                            <?php if($stats['karya_tersedia'] > 0): ?>
                            <a href="<?php echo e(route('login')); ?>" class="btn btn-primary px-4 py-2">
                                <i class="bi bi-bag-plus me-2"></i>Beli Karya
                            </a>
                            <?php endif; ?>
                        <?php endif; ?>
                        <?php if($user->profile && $user->profile->link_portofolio): ?>
                        <a href="<?php echo e($user->profile->link_portofolio); ?>" target="_blank"
                            class="btn btn-outline-secondary px-4 py-2">
                            <i class="bi bi-briefcase me-2"></i>Lihat Portofolio
                        </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="content-wrap">
    <div class="container">
        <div class="row g-4">

            
            <div class="col-lg-8">

                
                <div class="tab-nav">
                    <button class="tab-btn active" onclick="switchTab('karya', this)">
                        <i class="bi bi-images"></i>Karya
                        <span class="badge rounded-pill ms-1" style="background:#6C3483;font-size:0.65rem;"><?php echo e($stats['total_karya']); ?></span>
                    </button>
                    <button class="tab-btn" onclick="switchTab('tentang', this)">
                        <i class="bi bi-person"></i>Tentang
                    </button>
                    <?php if($karyaFeatured->count() > 0): ?>
                    <button class="tab-btn" onclick="switchTab('featured', this)">
                        <i class="bi bi-star"></i>Featured
                    </button>
                    <?php endif; ?>
                </div>

                
                <div id="tab-karya" class="tab-content-pane active">
                    <div class="row g-3">
                        <?php $__empty_1 = true; $__currentLoopData = $karyas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $karya): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="col-sm-6 col-md-4">
                            <a href="<?php echo e(route('gallery.show', $karya)); ?>" class="text-decoration-none">
                                <div class="karya-card-port h-100">
                                    <div class="karya-img-wrap">
                                        <?php if($karya->gambar && file_exists(public_path('uploads/karya/'.$karya->gambar))): ?>
                                            <img src="<?php echo e(asset('uploads/karya/'.$karya->gambar)); ?>" alt="<?php echo e($karya->judul); ?>">
                                        <?php else: ?>
                                            🎨
                                        <?php endif; ?>
                                        
                                    </div>
                                    <div class="card-body p-3">
                                        <div class="fw-bold text-dark small mb-1"><?php echo e($karya->judul); ?></div>
                                        <div class="text-muted" style="font-size:0.75rem;line-height:1.4;">
                                            <?php echo e(Str::limit($karya->deskripsi, 55)); ?>

                                        </div>
                                        <div class="d-flex justify-content-between align-items-center mt-2">
                                            <span class="karya-price"><?php echo e($karya->harga_format); ?></span>
                                            <?php if($karya->status_karya === 'tersedia'): ?>
                                            <span class="badge bg-success-subtle text-success small">Tersedia</span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <div class="col-12 text-center py-5 text-muted">
                            <i class="bi bi-images fs-1 d-block mb-3 opacity-25"></i>
                            <p>Belum ada karya yang dipajang.</p>
                        </div>
                        <?php endif; ?>
                    </div>

                    <?php if($karyas->hasPages()): ?>
                    <div class="d-flex justify-content-center mt-4">
                        <?php echo e($karyas->links()); ?>

                    </div>
                    <?php endif; ?>
                </div>

                
                <div id="tab-tentang" class="tab-content-pane">
                    <div class="mb-4">
                        <div class="section-heading"><i class="bi bi-person-circle text-primary"></i>Tentang Saya</div>
                        <?php if($user->profile && $user->profile->bio): ?>
                            <div class="bio-card">
                                <?php echo nl2br(e($user->profile->bio)); ?>

                            </div>
                        <?php else: ?>
                            <p class="text-muted fst-italic">Belum ada bio yang ditambahkan.</p>
                        <?php endif; ?>
                    </div>

                    <?php if($user->profile && $user->profile->spesialisasi): ?>
                    <div class="mb-4">
                        <div class="section-heading"><i class="bi bi-brush text-primary"></i>Spesialisasi</div>
                        <div class="d-flex flex-wrap gap-2">
                            <?php $__currentLoopData = explode(',', $user->profile->spesialisasi); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <span class="badge rounded-pill px-3 py-2" style="background:#f0e6ff;color:#6C3483;font-size:0.85rem;">
                                <?php echo e(trim($sp)); ?>

                            </span>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                    <?php endif; ?>

                    <div class="mb-4">
                        <div class="section-heading"><i class="bi bi-share text-primary"></i>Media Sosial</div>
                        <?php if($user->profile && count($user->profile->sosmed) > 0): ?>
                        <div class="row g-3">
                            <?php $__currentLoopData = $user->profile->sosmed; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-sm-6">
                                <a href="<?php echo e($sm['url']); ?>" target="_blank" rel="noopener"
                                    class="d-flex align-items-center gap-3 p-3 rounded-3 text-decoration-none"
                                    style="background:<?php echo e($sm['color']); ?>0d;border:1.5px solid <?php echo e($sm['color']); ?>20;transition:all .2s;"
                                    onmouseover="this.style.background='<?php echo e($sm['color']); ?>18'"
                                    onmouseout="this.style.background='<?php echo e($sm['color']); ?>0d'">
                                    <div class="d-flex align-items-center justify-content-center rounded-circle"
                                        style="width:42px;height:42px;background:<?php echo e($sm['color']); ?>;flex-shrink:0;">
                                        <i class="bi <?php echo e($sm['icon']); ?> text-white" style="font-size:1.1rem;"></i>
                                    </div>
                                    <div>
                                        <div class="fw-semibold small" style="color:<?php echo e($sm['color']); ?>;"><?php echo e($sm['name']); ?></div>
                                        <div class="text-muted" style="font-size:0.75rem;"><?php echo e($sm['label']); ?></div>
                                    </div>
                                    <i class="bi bi-arrow-up-right ms-auto text-muted small"></i>
                                </a>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <?php else: ?>
                            <p class="text-muted fst-italic small">Belum ada media sosial yang ditambahkan.</p>
                        <?php endif; ?>
                    </div>
                </div>

                
                <?php if($karyaFeatured->count() > 0): ?>
                <div id="tab-featured" class="tab-content-pane">
                    <div class="section-heading"><i class="bi bi-star-fill text-warning"></i>Karya Unggulan</div>
                    <div class="row g-4">
                        <?php $__currentLoopData = $karyaFeatured; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kf): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-12">
                            <a href="<?php echo e(route('gallery.show', $kf)); ?>" class="text-decoration-none">
                                <div class="card border-0 shadow-sm overflow-hidden" style="border-radius:16px;">
                                    <div class="row g-0">
                                        <div class="col-md-5">
                                            <div style="height:220px;overflow:hidden;background:linear-gradient(135deg,#9B59B6,#6C3483);display:flex;align-items:center;justify-content:center;font-size:4rem;">
                                                <?php if($kf->gambar && file_exists(public_path('uploads/karya/'.$kf->gambar))): ?>
                                                    <img src="<?php echo e(asset('uploads/karya/'.$kf->gambar)); ?>" style="width:100%;height:220px;object-fit:cover;">
                                                <?php else: ?> 🎨 <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-7 d-flex align-items-center">
                                            <div class="p-4">
                                                <span class="badge bg-warning text-dark mb-2"><i class="bi bi-star-fill me-1"></i>Featured</span>
                                                <h5 class="fw-bold text-dark"><?php echo e($kf->judul); ?></h5>
                                                <p class="text-muted small"><?php echo e(Str::limit($kf->deskripsi, 120)); ?></p>
                                                <div class="fw-bold fs-5" style="color:#6C3483;"><?php echo e($kf->harga_format); ?></div>
                                                <div class="mt-2 btn btn-primary btn-sm">
                                                    Lihat Detail <i class="bi bi-arrow-right ms-1"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
                <?php endif; ?>

            </div>

            
            <div class="col-lg-4">

                
                <div class="sidebar-card">
                    <div class="fw-bold mb-3" style="color:#1a0a2e;font-size:0.95rem;">
                        <i class="bi bi-info-circle me-2 text-primary"></i>Info Seniman
                    </div>
                    <?php if($user->profile && $user->profile->kota): ?>
                    <div class="info-row">
                        <i class="bi bi-geo-alt icon"></i>
                        <div>
                            <span class="lbl">Lokasi</span>
                            <span class="val"><?php echo e($user->profile->kota); ?></span>
                        </div>
                    </div>
                    <?php endif; ?>
                    <?php if($user->profile && $user->profile->spesialisasi): ?>
                    <div class="info-row">
                        <i class="bi bi-brush icon"></i>
                        <div>
                            <span class="lbl">Spesialisasi</span>
                            <span class="val"><?php echo e($user->profile->spesialisasi); ?></span>
                        </div>
                    </div>
                    <?php endif; ?>
                    <div class="info-row">
                        <i class="bi bi-calendar3 icon"></i>
                        <div>
                            <span class="lbl">Bergabung Sejak</span>
                            <span class="val"><?php echo e($user->created_at->translatedFormat('d F Y')); ?></span>
                        </div>
                    </div>
                    <div class="info-row">
                        <i class="bi bi-images icon"></i>
                        <div>
                            <span class="lbl">Total Karya</span>
                            <span class="val"><?php echo e($stats['total_karya']); ?> karya (<?php echo e($stats['karya_tersedia']); ?> tersedia)</span>
                        </div>
                    </div>
                    <div class="info-row">
                        <i class="bi bi-bag-check icon"></i>
                        <div>
                            <span class="lbl">Karya Terjual</span>
                            <span class="val"><?php echo e($stats['karya_terjual']); ?> karya</span>
                        </div>
                    </div>
                </div>

                
                <?php if($user->profile && count($user->profile->sosmed) > 0): ?>
                <div class="sidebar-card">
                    <div class="fw-bold mb-3" style="color:#1a0a2e;font-size:0.95rem;">
                        <i class="bi bi-share me-2 text-primary"></i>Media Sosial
                    </div>
                    <div class="d-flex flex-column gap-2">
                        <?php $__currentLoopData = $user->profile->sosmed; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="<?php echo e($sm['url']); ?>" target="_blank" rel="noopener"
                            class="d-flex align-items-center gap-3 text-decoration-none p-2 rounded-2"
                            style="transition:background .15s;"
                            onmouseover="this.style.background='#f5f0ff'"
                            onmouseout="this.style.background='transparent'">
                            <div class="d-flex align-items-center justify-content-center rounded-circle"
                                style="width:36px;height:36px;background:<?php echo e($sm['color']); ?>;flex-shrink:0;">
                                <i class="bi <?php echo e($sm['icon']); ?> text-white" style="font-size:0.95rem;"></i>
                            </div>
                            <div class="flex-grow-1">
                                <div class="fw-semibold" style="font-size:0.82rem;color:#333;"><?php echo e($sm['name']); ?></div>
                                <div class="text-muted" style="font-size:0.74rem;"><?php echo e($sm['label']); ?></div>
                            </div>
                            <i class="bi bi-arrow-up-right text-muted" style="font-size:0.8rem;"></i>
                        </a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
                <?php endif; ?>

                
                <?php if($stats['karya_tersedia'] > 0): ?>
                <div class="sidebar-card text-center" style="background:linear-gradient(135deg,#1a0a2e,#6C3483);color:#fff;">
                    <div style="font-size:2.5rem;margin-bottom:.5rem;">🎨</div>
                    <div class="fw-bold mb-1"><?php echo e($stats['karya_tersedia']); ?> Karya Tersedia</div>
                    <p class="text-white-50 small mb-3">Dapatkan karya original dari <?php echo e($user->nama); ?></p>
                    <?php if(auth()->guard()->check()): ?>
                        <?php if(auth()->user()->isPelanggan()): ?>
                        <a href="<?php echo e(route('gallery')); ?>?search=<?php echo e(urlencode($user->nama)); ?>"
                            class="btn btn-warning btn-sm fw-semibold w-100">
                            <i class="bi bi-bag-plus me-1"></i>Beli Karya Sekarang
                        </a>
                        <?php endif; ?>
                    <?php else: ?>
                        <a href="<?php echo e(route('login')); ?>" class="btn btn-warning btn-sm fw-semibold w-100">
                            <i class="bi bi-bag-plus me-1"></i>Login untuk Memesan
                        </a>
                    <?php endif; ?>
                </div>
                <?php endif; ?>

                
                <?php
                    $senimanlain = \App\Models\User::with('profile')
                        ->where('role','seniman')
                        ->where('status_akun','verified')
                        ->where('id','!=',$user->id)
                        ->inRandomOrder()
                        ->limit(4)
                        ->get();
                ?>
                <?php if($senimanlain->count() > 0): ?>
                <div class="sidebar-card">
                    <div class="fw-bold mb-3" style="color:#1a0a2e;font-size:0.95rem;">
                        <i class="bi bi-people me-2 text-primary"></i>Seniman Lainnya
                    </div>
                    <div class="d-flex flex-column gap-3">
                        <?php $__currentLoopData = $senimanlain; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="<?php echo e(route('seniman.profile.public', $sl)); ?>"
                            class="d-flex align-items-center gap-3 text-decoration-none p-2 rounded-2"
                            style="transition:background .15s;"
                            onmouseover="this.style.background='#f5f0ff'"
                            onmouseout="this.style.background='transparent'">
                            <div class="rounded-circle d-flex align-items-center justify-content-center fw-bold text-white flex-shrink-0"
                                style="width:40px;height:40px;font-size:1rem;background:#6C3483;overflow:hidden;">
                                <?php if($sl->profile && $sl->profile->foto && file_exists(public_path('uploads/profil/'.$sl->profile->foto))): ?>
                                    <img src="<?php echo e(asset('uploads/profil/'.$sl->profile->foto)); ?>" style="width:40px;height:40px;object-fit:cover;">
                                <?php else: ?>
                                    <?php echo e(strtoupper(substr($sl->nama, 0, 1))); ?>

                                <?php endif; ?>
                            </div>
                            <div class="flex-grow-1 overflow-hidden">
                                <div class="fw-semibold text-dark" style="font-size:0.85rem;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;"><?php echo e($sl->nama); ?></div>
                                <div class="text-muted" style="font-size:0.72rem;">
                                    <?php echo e(optional($sl->profile)->spesialisasi ?? 'Seniman'); ?>

                                </div>
                            </div>
                            <i class="bi bi-chevron-right text-muted small flex-shrink-0"></i>
                        </a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <div class="mt-3 text-center">
                        <a href="<?php echo e(route('seniman.index')); ?>" class="btn btn-sm btn-outline-primary w-100">
                            Lihat Semua Seniman
                        </a>
                    </div>
                </div>
                <?php endif; ?>

            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
function switchTab(tabName, btn) {
    // Hide all tab panes
    document.querySelectorAll('.tab-content-pane').forEach(p => p.classList.remove('active'));
    document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));

    // Show target
    const target = document.getElementById('tab-' + tabName);
    if (target) target.classList.add('active');
    btn.classList.add('active');
}
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\imagirupa\resources\views/public/seniman/show.blade.php ENDPATH**/ ?>