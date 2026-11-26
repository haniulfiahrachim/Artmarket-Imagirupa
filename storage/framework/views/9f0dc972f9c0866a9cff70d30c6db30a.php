<?php $__env->startSection('title', 'Imagirupa Art Market - Platform Karya Seni Pontianak'); ?>

<?php $__env->startPush('styles'); ?>
<style>
/* ─── Google Fonts ─────────────────────────────────────────── */
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&display=swap');

/* ─── Root ─────────────────────────────────────────────────── */
:root{
    --orange:#FF5A09;
    --orange-light:#FFF3EC;
    --dark:#2C3E50;
    --dark2:#34495E;
    --gray:#F5F5F5;
    --text-muted:#6B7280;
}

*{ box-sizing:border-box; }
body{ background:var(--gray); color:var(--dark); font-family:'Inter',sans-serif; }

/* ─── Navbar override ──────────────────────────────────────── */
.navbar{ background:#fff !important; box-shadow:0 2px 12px rgba(0,0,0,0.05); }
.navbar .nav-link{ color:var(--dark) !important; font-weight:500; }
.navbar .nav-link:hover{ color:var(--orange) !important; }

/* ─── HERO ─────────────────────────────────────────────────── */
.hero{
    min-height:92vh;
    display:flex;
    align-items:center;
    position:relative;
    overflow:hidden;
    background:
        radial-gradient(ellipse 70% 60% at 0% 0%, rgba(255,90,9,0.10) 0%, transparent 60%),
        radial-gradient(ellipse 60% 50% at 100% 100%, rgba(44,62,80,0.08) 0%, transparent 60%),
        linear-gradient(160deg,#EDF0FF 0%,#FDF6F2 55%,#FFF 100%);
}

/* subtle dot-grid */
.hero::before{
    content:'';
    position:absolute;
    inset:0;
    background-image:radial-gradient(circle, rgba(0,0,0,0.06) 1px, transparent 1px);
    background-size:28px 28px;
    pointer-events:none;
}

/* floating blobs */
.hero-blob{
    position:absolute;
    border-radius:50%;
    filter:blur(60px);
    pointer-events:none;
    opacity:0.45;
}
.blob-1{ width:380px;height:380px;background:#FF5A09;top:-120px;right:5%;opacity:0.08; }
.blob-2{ width:260px;height:260px;background:#3498DB;bottom:0;left:-60px;opacity:0.07; }

.hero-badge{
    display:inline-flex;
    align-items:center;
    gap:6px;
    background:#fff;
    border:1.5px solid #E5E7EB;
    color:var(--dark);
    padding:.45rem 1.1rem;
    border-radius:999px;
    font-size:.82rem;
    font-weight:600;
    box-shadow:0 4px 14px rgba(0,0,0,0.05);
    margin-bottom:1.3rem;
}

.hero-title{
    font-family:'Playfair Display',serif;
    font-size:3.8rem;
    font-weight:700;
    line-height:1.12;
    color:var(--dark);
    letter-spacing:-.5px;
}

.hero-title .accent{ color:var(--orange); }
.hero-title .italic{ font-style:italic; color:var(--dark2); }

.hero-subtitle{
    color:var(--text-muted);
    font-size:1.05rem;
    line-height:1.85;
    max-width:520px;
}

/* ─── Hero image ───────────────────────────────────────────── */
.hero-img-wrap{
    position:relative;
    display:flex;
    align-items:center;
    justify-content:center;
}

/* ring animations */
.hero-ring{
    position:absolute;
    border-radius:50%;
    border:1.5px dashed rgba(255,90,9,0.25);
    animation:spin 18s linear infinite;
}
.hero-ring-2{ animation-direction:reverse; animation-duration:24s; border-color:rgba(44,62,80,0.12); }
@keyframes spin{ to{ transform:rotate(360deg); } }

.hero-logo{
    width:280px;
    height:280px;
    object-fit:cover;
    position:relative;
    z-index:2;
    border-radius:40px;
    filter:drop-shadow(0 24px 40px rgba(0,0,0,0.15));
    animation:floatY 4s ease-in-out infinite;
}
@keyframes floatY{
    0%,100%{ transform:translateY(0); }
    50%{ transform:translateY(-12px); }
}

/* badge chips floating around logo */
.hero-chip{
    position:absolute;
    background:#fff;
    border:1px solid #eee;
    border-radius:12px;
    padding:.4rem .85rem;
    font-size:.72rem;
    font-weight:700;
    color:var(--dark);
    box-shadow:0 6px 18px rgba(0,0,0,0.08);
    white-space:nowrap;
    z-index:3;
    animation:floatY 4s ease-in-out infinite;
}
.chip-1{ top:10%;  left:-10%; animation-delay:.5s; }
.chip-2{ top:10%;  right:-10%; animation-delay:1s; }
.chip-3{ bottom:12%; left:-8%; animation-delay:1.5s; }
.chip-4{ bottom:12%; right:-8%; animation-delay:0s; }

/* ─── Stats strip ──────────────────────────────────────────── */
.stats-strip{
    background:#fff;
    box-shadow:0 4px 24px rgba(0,0,0,0.06);
    padding:1.6rem 0;
}

.stat-item .num{
    font-family:'Playfair Display',serif;
    font-size:2rem;
    font-weight:700;
    color:var(--orange);
    line-height:1;
}

.stat-item .lbl{
    font-size:.75rem;
    color:var(--text-muted);
    margin-top:4px;
}

/* ─── Section shared ───────────────────────────────────────── */
.section-label{
    font-size:.78rem;
    font-weight:700;
    text-transform:uppercase;
    letter-spacing:.1em;
    color:var(--orange);
}

.section-title{
    font-family:'Playfair Display',serif;
    font-size:2.2rem;
    font-weight:700;
    color:var(--dark);
    line-height:1.25;
} 

/* ─── Tab filter ───────────────────────────────────────────── */
.tab-filter{
    display:flex;
    gap:.5rem;
    flex-wrap:wrap;
    margin-bottom:1.75rem;
}

.tab-btn{
    padding:.45rem 1.15rem;
    border-radius:999px;
    border:1.5px solid #E5E7EB;
    background:#fff;
    color:var(--dark);
    font-size:.82rem;
    font-weight:600;
    cursor:pointer;
    transition:.2s;
    text-decoration:none;
}
.tab-btn:hover{ border-color:var(--orange); color:var(--orange); }
.tab-btn.active{
    background:var(--orange);
    border-color:var(--orange);
    color:#fff;
    box-shadow:0 6px 16px rgba(255,90,9,0.25);
}

/* ─── Karya card ───────────────────────────────────────────── */
.karya-card{
    border:none;
    border-radius:20px;
    overflow:hidden;
    background:#fff;
    transition:.3s ease;
    box-shadow:0 4px 16px rgba(0,0,0,0.06);
}
.karya-card:hover{
    transform:translateY(-7px);
    box-shadow:0 18px 38px rgba(0,0,0,0.10);
}
.karya-img-wrap{
    height:220px;
    overflow:hidden;
    background:#F3F4F6;
    position:relative;
}
.karya-img-wrap img{
    width:100%;height:100%;
    object-fit:cover;
    transition:.4s ease;
}
.karya-card:hover .karya-img-wrap img{ transform:scale(1.06); }

.karya-badge{
    position:absolute;
    top:10px;left:10px;
    font-size:.65rem;
    font-weight:700;
    padding:.25rem .65rem;
    border-radius:20px;
}

.price-tag{
    color:var(--orange);
    font-size:1.05rem;
    font-weight:700;
}

/* ─── Feature cards ────────────────────────────────────────── */
.feature-card{
    background:#fff;
    border-radius:20px;
    padding:1.75rem;
    border:1.5px solid #F0F0F0;
    transition:.3s;
}
.feature-card:hover{
    border-color:var(--orange);
    box-shadow:0 12px 30px rgba(255,90,9,0.08);
    transform:translateY(-4px);
}
.feat-icon{
    width:52px;height:52px;
    border-radius:14px;
    background:var(--orange-light);
    color:var(--orange);
    display:flex;align-items:center;justify-content:center;
    font-size:1.4rem;
    margin-bottom:1rem;
}

/* ─── Artist card ──────────────────────────────────────────── */
.artist-card{
    border:none;
    border-radius:20px;
    overflow:hidden;
    background:#fff;
    box-shadow:0 4px 16px rgba(0,0,0,0.06);
    transition:.3s;
}
.artist-card:hover{
    transform:translateY(-6px);
    box-shadow:0 16px 36px rgba(0,0,0,0.10);
}

/* ─── CTA ──────────────────────────────────────────────────── */
.cta-section{
    background:linear-gradient(135deg,var(--dark) 0%,var(--dark2) 100%);
    border-radius:28px;
    padding:5rem 2rem;
    color:#fff;
    position:relative;
    overflow:hidden;
}
.cta-section::after{
    content:'';
    position:absolute;
    width:500px;height:500px;
    background:rgba(255,90,9,0.08);
    border-radius:50%;
    bottom:-220px;right:-160px;
}

/* ─── Buttons ──────────────────────────────────────────────── */
.btn{ border-radius:14px; padding:.8rem 1.5rem; font-weight:600; transition:.25s; }
.btn-orange{
    background:var(--orange);
    color:#fff;
    border:none;
    box-shadow:0 8px 20px rgba(255,90,9,0.25);
}
.btn-orange:hover{ background:#E04D07; color:#fff; transform:translateY(-2px); }
.btn-outline-orange{ border:2px solid var(--orange); color:var(--orange); background:transparent; }
.btn-outline-orange:hover{ background:var(--orange); color:#fff; }
.btn-outline-dark-custom{ border:1.5px solid #D1D5DB; color:var(--dark); background:#fff; }
.btn-outline-dark-custom:hover{ background:var(--dark); color:#fff; }

/* ─── Responsive ───────────────────────────────────────────── */
@media(max-width:991px){
    .hero{ padding:5rem 0; text-align:center; }
    .hero-title{ font-size:2.8rem; }
    .hero-subtitle{ margin:auto; }
    .hero-img-wrap{ margin-top:3rem; }
    .hero-chip{ display:none; }
}
@media(max-width:576px){
    .hero-title{ font-size:2.2rem; }
    .section-title{ font-size:1.75rem; }
    .hero-logo{ width:200px;height:200px; }
}
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>


<section class="hero">
    <div class="hero-blob blob-1"></div>
    <div class="hero-blob blob-2"></div>

    <div class="container position-relative">
        <div class="row align-items-center g-5">

            
            <div class="col-lg-6">
                <span class="hero-badge">
                    <i class="bi bi-geo-alt-fill text-warning"></i>
                    Komunitas Seniman Pontianak
                </span>

                <h1 class="hero-title">
                    Selamat Datang<br>
                    di <span class="italic">Art Market</span><br>
                    <span class="accent">Imagirupa</span>
                </h1>

                <p class="hero-subtitle mt-3 mb-4">
                    Temukan karya seni unik dari seniman berbakat Kalimantan Barat.
                    Beli, jual, dan berinteraksi langsung dengan para kreator.
                </p>

                <div class="d-flex gap-3 flex-wrap">
                    <a href="<?php echo e(route('gallery')); ?>" class="btn btn-orange btn-lg px-4">
                        <i class="bi bi-images me-2"></i>Jelajahi Galeri
                    </a>
                    <?php if(auth()->guard()->guest()): ?>
                    <a href="<?php echo e(route('register')); ?>" class="btn btn-outline-dark-custom btn-lg px-4">
                        <i class="bi bi-person-plus me-2"></i>Daftar Sekarang
                    </a>
                    <?php endif; ?>
                </div>
            </div>

            
            <div class="col-lg-6">
                <div class="hero-img-wrap">
                    
                    <div class="hero-ring" style="width:340px;height:340px;"></div>
                    <div class="hero-ring hero-ring-2" style="width:420px;height:420px;"></div>

                    
                    <img src="<?php echo e(asset('img/logo.png')); ?>"
                         alt="Imagirupa"
                         class="hero-logo">

                    
                    <div class="hero-chip chip-1">
                        <i class="bi bi-palette2 me-1" style="color:var(--orange);"></i>Seni Digital
                    </div>
                    <div class="hero-chip chip-2">
                        <i class="bi bi-patch-check-fill me-1" style="color:#27AE60;"></i>Terverifikasi
                    </div>
                    <div class="hero-chip chip-3">
                        <i class="bi bi-shield-check me-1" style="color:#3498DB;"></i>Transaksi Aman
                    </div>
                    <div class="hero-chip chip-4">
                        <i class="bi bi-geo-alt me-1" style="color:var(--orange);"></i>Pontianak
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>




<section class="py-5 mt-2">
    <div class="container">
        <div class="row align-items-end mb-2">
            <div class="col">
                <div class="section-label mb-1">✦ Temukan Karya Seni</div>
                <h2 class="section-title mb-0">Koleksi Pilihan</h2>
            </div>
            <div class="col-auto">
                <a href="<?php echo e(route('gallery')); ?>" class="btn btn-outline-orange btn-sm px-4">
                    Lihat Semua <i class="bi bi-arrow-right ms-1"></i>
                </a>
            </div>
        </div>

        
        <div class="tab-filter mt-3">
            <a href="<?php echo e(route('home')); ?>#karya" class="tab-btn <?php echo e(!request('tab') || request('tab')=='terlaris' ? 'active' : ''); ?>" id="btn-terlaris" onclick="switchTab('terlaris',this);return false;">
                <i class="bi bi-fire me-1"></i>Terpopuler
            </a>
            <a href="#karya" class="tab-btn <?php echo e(request('tab')=='termurah' ? 'active' : ''); ?>" id="btn-termurah" onclick="switchTab('termurah',this);return false;">
                <i class="bi bi-arrow-down-circle me-1"></i>Harga Termurah
            </a>
            <a href="#karya" class="tab-btn <?php echo e(request('tab')=='tertinggi' ? 'active' : ''); ?>" id="btn-tertinggi" onclick="switchTab('tertinggi',this);return false;">
                <i class="bi bi-arrow-up-circle me-1"></i>Harga Tertinggi
            </a>
        </div>

        
        <div id="tab-terlaris" class="tab-pane">
            <?php
                $terlaris = \App\Models\Karya::with('seniman.profile')
                    ->where('status_karya','tersedia')
                    ->withCount('pesanans')
                    ->orderByDesc('pesanans_count')
                    ->limit(6)->get();
            ?>
            <div class="row g-4" id="karya">
                <?php $__empty_1 = true; $__currentLoopData = $terlaris; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $karya): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="col-sm-6 col-lg-4">
                    <?php echo $__env->make('public.partials.karya-card', ['karya' => $karya, 'badgeLabel' => '🔥 Terpopuler', 'badgeClass' => 'bg-danger'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="col-12 text-center py-5 text-muted">
                    <i class="bi bi-images fs-1 d-block mb-2 opacity-25"></i>Belum ada karya tersedia.
                </div>
                <?php endif; ?>
            </div>
        </div>

        
        <div id="tab-termurah" class="tab-pane d-none">
            <?php
                $termurah = \App\Models\Karya::with('seniman.profile')
                    ->where('status_karya','tersedia')
                    ->orderBy('harga','asc')
                    ->limit(6)->get();
            ?>
            <div class="row g-4">
                <?php $__empty_1 = true; $__currentLoopData = $termurah; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $karya): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="col-sm-6 col-lg-4">
                    <?php echo $__env->make('public.partials.karya-card', ['karya' => $karya, 'badgeLabel' => '💰 Termurah', 'badgeClass' => 'bg-success'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="col-12 text-center py-5 text-muted">
                    <i class="bi bi-images fs-1 d-block mb-2 opacity-25"></i>Belum ada karya tersedia.
                </div>
                <?php endif; ?>
            </div>
        </div>

        
        <div id="tab-tertinggi" class="tab-pane d-none">
            <?php
                $tertinggi = \App\Models\Karya::with('seniman.profile')
                    ->where('status_karya','tersedia')
                    ->orderByDesc('harga')
                    ->limit(6)->get();
            ?>
            <div class="row g-4">
                <?php $__empty_1 = true; $__currentLoopData = $tertinggi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $karya): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="col-sm-6 col-lg-4">
                    <?php echo $__env->make('public.partials.karya-card', ['karya' => $karya, 'badgeLabel' => '👑 Premium', 'badgeClass' => 'bg-warning text-dark'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="col-12 text-center py-5 text-muted">
                    <i class="bi bi-images fs-1 d-block mb-2 opacity-25"></i>Belum ada karya tersedia.
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>


<section class="py-5" style="background:#fff;">
    <div class="container">
        <div class="text-center mb-5">
            <div class="section-label mb-1">✦ Kenapa Imagirupa?</div>
            <h2 class="section-title">Platform Terpercaya untuk<br>Seniman & Kolektor</h2>
        </div>
        <div class="row g-4">
            <?php $__currentLoopData = [
                ['bi-shield-check', 'Transaksi Aman',         'Setiap transaksi diverifikasi admin. Pembayaran manual dengan konfirmasi bukti transfer.'],
                ['bi-chat-dots',    'Chat Langsung',           'Komunikasi langsung antara seniman dan pelanggan terkait karya dan proses pengiriman.'],
                ['bi-patch-check',  'Seniman Terverifikasi',   'Semua seniman melalui proses verifikasi admin untuk memastikan kualitas dan keaslian karya.'],
                ['bi-truck',        'Opsi Pengiriman',         'Pilih layanan antar ke alamat Anda atau ambil sendiri ke lokasi Imagirupa secara gratis.'],
                ['bi-images',       'Galeri Digital',          'Jelajahi ratusan karya seni original dari seniman berbakat Kalimantan Barat.'],
                ['bi-bar-chart',    'Laporan Transparan',      'Admin memantau seluruh transaksi untuk memastikan proses berjalan adil dan terpercaya.'],
            ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as [$icon, $title, $desc]): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-4">
                <div class="feature-card h-100">
                    <div class="feat-icon"><i class="bi <?php echo e($icon); ?>"></i></div>
                    <h6 class="fw-bold mb-2"><?php echo e($title); ?></h6>
                    <p class="text-muted small mb-0"><?php echo e($desc); ?></p>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>


<section class="py-5">
    <div class="container">
        <div class="row align-items-end mb-4">
            <div class="col">
                <div class="section-label mb-1">✦ Kreator Berbakat</div>
                <h2 class="section-title mb-0">Seniman Pilihan</h2>
            </div>
            <div class="col-auto">
                <a href="<?php echo e(route('seniman.index')); ?>" class="btn btn-outline-orange btn-sm px-4">
                    Lihat Semua <i class="bi bi-arrow-right ms-1"></i>
                </a>
            </div>
        </div>

        <?php
            $featuredSeniman = \App\Models\User::with(['profile','karyas'])
                ->where('role','seniman')->where('status_akun','verified')
                ->withCount(['karyas as total_karya' => fn($q) => $q->where('status_karya','tersedia')])
                ->orderByDesc('total_karya')->limit(4)->get();
            $coverColors = [
                'linear-gradient(135deg,#1a0a2e,#6C3483)',
                'linear-gradient(135deg,#2c3e50,#3498db)',
                'linear-gradient(135deg,#1a472a,#27ae60)',
                'linear-gradient(135deg,#7b2d00,#e67e22)',
            ];
        ?>

        <div class="row g-4">
            <?php $__currentLoopData = $featuredSeniman; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $idx => $sn): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-sm-6 col-lg-3">
                <a href="<?php echo e(route('seniman.profile.public', $sn)); ?>" class="text-decoration-none">
                    <div class="artist-card h-100">
                        
                        <div style="height:90px;<?php echo e($coverColors[$idx % 4]); ?>;position:relative;">
                            <div style="position:absolute;bottom:-32px;left:50%;transform:translateX(-50%);width:64px;height:64px;border-radius:50%;border:3px solid #fff;overflow:hidden;background:#6C3483;display:flex;align-items:center;justify-content:center;font-size:1.5rem;font-weight:700;color:#fff;box-shadow:0 6px 16px rgba(0,0,0,0.15);">
                                <?php if($sn->profile && $sn->profile->foto && file_exists(public_path('uploads/profil/'.$sn->profile->foto))): ?>
                                    <img src="<?php echo e(asset('uploads/profil/'.$sn->profile->foto)); ?>" style="width:64px;height:64px;object-fit:cover;">
                                <?php else: ?>
                                    <?php echo e(strtoupper(substr($sn->nama,0,1))); ?>

                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="card-body text-center pt-5 pb-3 px-3">
                            <div class="fw-bold text-dark mb-1" style="font-family:'Playfair Display',serif;font-size:1rem;">
                                <?php echo e($sn->nama); ?>

                            </div>
                            <?php if($sn->profile && $sn->profile->spesialisasi): ?>
                            <div style="font-size:.7rem;color:var(--orange);font-weight:700;text-transform:uppercase;letter-spacing:.06em;margin-bottom:4px;">
                                <?php echo e(Str::limit($sn->profile->spesialisasi, 28)); ?>

                            </div>
                            <?php endif; ?>
                            <?php if($sn->profile && $sn->profile->kota): ?>
                            <div style="font-size:.75rem;color:#aaa;">
                                <i class="bi bi-geo-alt me-1"></i><?php echo e($sn->profile->kota); ?>

                            </div>
                            <?php endif; ?>

                            
                            <div class="mt-2 d-flex justify-content-center gap-1 flex-wrap">
                                <?php $__currentLoopData = ($sn->profile ? $sn->profile->sosmed : []); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <span style="width:24px;height:24px;border-radius:50%;background:#FFF3EC;color:var(--orange);display:inline-flex;align-items:center;justify-content:center;font-size:.68rem;">
                                    <i class="bi <?php echo e($sm['icon']); ?>"></i>
                                </span>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>

                            <div class="mt-2 pt-2 border-top" style="font-size:.75rem;color:#aaa;">
                                <i class="bi bi-images me-1"></i><?php echo e($sn->total_karya); ?> karya tersedia
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>


<section class="py-5">
    <div class="container">
        <div class="cta-section text-center">
            <div class="section-label mb-2" style="color:rgba(255,90,9,0.8);">✦ Bergabung Sekarang</div>
            <h2 class="mb-3" style="font-family:'Playfair Display',serif;font-size:2.2rem;">
                Mulai Perjalanan Seni Anda
            </h2>
            <p class="mb-4" style="color:rgba(255,255,255,0.65);max-width:480px;margin:auto;">
                Bergabunglah bersama komunitas seniman dan kolektor Imagirupa dari Pontianak, Kalimantan Barat.
            </p>
            <div class="d-flex gap-3 justify-content-center flex-wrap">
                <?php if(auth()->guard()->guest()): ?>
                <a href="<?php echo e(route('register')); ?>" class="btn btn-orange btn-lg px-5">
                    <i class="bi bi-person-plus me-2"></i>Daftar Gratis
                </a>
                <a href="<?php echo e(route('gallery')); ?>" class="btn btn-outline-dark-custom btn-lg px-5">
                    <i class="bi bi-images me-2"></i>Lihat Galeri
                </a>
                <?php else: ?>
                <a href="<?php echo e(route('gallery')); ?>" class="btn btn-orange btn-lg px-5">
                    <i class="bi bi-images me-2"></i>Jelajahi Galeri
                </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
function switchTab(tab, el) {
    // Sembunyikan semua pane
    document.querySelectorAll('.tab-pane').forEach(p => p.classList.add('d-none'));
    // Hapus active semua btn
    document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
    // Tampilkan pane yang dipilih
    document.getElementById('tab-' + tab).classList.remove('d-none');
    // Set active btn
    el.classList.add('active');
}
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\imagirupa\resources\views/public/home.blade.php ENDPATH**/ ?>