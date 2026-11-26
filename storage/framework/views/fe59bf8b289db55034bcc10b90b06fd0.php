
<?php $__env->startSection('title', 'SPK Produk Terlaris'); ?>
<?php $__env->startSection('page-title', 'Sistem Pendukung Keputusan'); ?>

<?php $__env->startPush('styles'); ?>
<style>
    .spk-header {
        background: linear-gradient(135deg, #6C3483, #9B59B6);
        border-radius: 16px;
        color: #fff;
        padding: 1.5rem 2rem;
        margin-bottom: 1.5rem;
    }
    .spk-header h4 { font-family: 'Playfair Display', serif; margin: 0; }
    .spk-header p  { margin: 0; opacity: .8; font-size: .88rem; }

    /* Bobot card */
    .bobot-card {
        background: #fff;
        border: 1.5px solid #e0d0f5;
        border-radius: 14px;
        padding: 1.1rem 1rem;
        text-align: center;
        height: 100%;
    }
    .bobot-card .bobot-code {
        font-size: .72rem; font-weight: 700; text-transform: uppercase;
        letter-spacing: .06em; color: #6C3483; margin-bottom: 4px;
    }
    .bobot-card .bobot-nama {
        font-size: .82rem; color: #555; margin-bottom: 6px; line-height: 1.3;
    }
    .bobot-card .bobot-persen {
        font-size: 1.7rem; font-weight: 800; color: #6C3483; line-height: 1;
    }
    .bobot-card .bobot-type {
        font-size: .68rem; background: #e8f5e9; color: #2e7d32;
        padding: 2px 8px; border-radius: 10px; display: inline-block; margin-top: 4px;
    }

    /* Tab style */
    .spk-tabs .nav-link {
        border-radius: 10px 10px 0 0;
        font-weight: 600;
        color: #6C3483;
        border: 1.5px solid transparent;
    }
    .spk-tabs .nav-link.active {
        color: #fff;
        background: #6C3483;
        border-color: #6C3483;
    }
    .spk-tabs .nav-link:not(.active):hover {
        border-color: #d0b8e8;
        background: #f5f0ff;
    }

    /* Table */
    .spk-table thead th {
        background: #f5f0ff;
        color: #4A235A;
        font-size: .78rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .04em;
        vertical-align: middle;
        white-space: nowrap;
    }
    .spk-table tbody td {
        vertical-align: middle;
        font-size: .88rem;
    }
    .rank-badge {
        width: 32px; height: 32px;
        border-radius: 50%;
        display: inline-flex; align-items: center; justify-content: center;
        font-weight: 800; font-size: .85rem; flex-shrink: 0;
    }
    .rank-1 { background: #FFD700; color: #7a5700; }
    .rank-2 { background: #C0C0C0; color: #555; }
    .rank-3 { background: #CD7F32; color: #fff; }
    .rank-n { background: #f0e8fb; color: #6C3483; }

    .score-bar-wrap { display: flex; align-items: center; gap: 8px; min-width: 130px; }
    .score-bar {
        flex: 1; height: 8px; border-radius: 99px;
        background: #f0e8fb; overflow: hidden;
    }
    .score-bar-fill {
        height: 100%;
        background: linear-gradient(to right, #9B59B6, #6C3483);
        border-radius: 99px;
        transition: width .6s ease;
    }

    .max-chip {
        background: #fff3cd; color: #856404;
        padding: 2px 8px; border-radius: 8px;
        font-size: .7rem; font-weight: 700;
    }

    .formula-box {
        background: #f8f4ff;
        border: 1.5px solid #d8c8f0;
        border-radius: 12px;
        padding: 1rem 1.25rem;
        font-family: 'Courier New', monospace;
        font-size: .85rem;
        line-height: 1.9;
        color: #4A235A;
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>


<div class="spk-header d-flex align-items-center justify-content-between flex-wrap gap-3">
    <div>
        <h5>Perangkingan Produk Terlaris Art Market Imagirupa Berdasarkan Kriteria Penjualan, Rating, dan Ulasan</h5>
    </div>
    <div class="text-end">
        <div style="font-size:.78rem;opacity:.75;">Total Produk Dianalisis</div>
        <div style="font-size:2.2rem;font-weight:800;line-height:1;"><?php echo e($matriksX->count()); ?></div>
        <div style="font-size:.72rem;opacity:.7;">karya seni</div>
    </div>
</div>


<div class="card mb-4">
    <div class="card-header py-3 d-flex align-items-center gap-2">
        <i class="bi bi-sliders2 text-primary"></i>
        <span class="fw-semibold">Parameter Bobot Kriteria</span>
        <?php $totalBobot = array_sum($bobot) * 100; ?>
        <span class="badge <?php echo e(abs($totalBobot - 100) < 0.01 ? 'bg-success' : 'bg-danger'); ?> ms-auto">
            Total: <?php echo e(number_format($totalBobot, 0)); ?>%
        </span>
    </div>
    <div class="card-body">
        <div class="row g-3">
            <div class="col-6 col-md-4">
                <div class="bobot-card">
                    <div class="bobot-code">C1</div>
                    <div class="bobot-nama">Penjualan</div>
                    <div class="bobot-persen"><?php echo e(number_format($bobot['c1'] * 100, 0)); ?>%</div>
                    <div class="bobot-type">Benefit</div>
                </div>
            </div>
            <div class="col-6 col-md-4">
                <div class="bobot-card">
                    <div class="bobot-code">C2</div>
                    <div class="bobot-nama">Rating Produk</div>
                    <div class="bobot-persen"><?php echo e(number_format($bobot['c2'] * 100, 0)); ?>%</div>
                    <div class="bobot-type">Benefit</div>
                </div>
            </div>
            <div class="col-6 col-md-4">
                <div class="bobot-card">
                    <div class="bobot-code">C3</div>
                    <div class="bobot-nama">Ulasan Positif</div>
                    <div class="bobot-persen"><?php echo e(number_format($bobot['c3'] * 100, 0)); ?>%</div>
                    <div class="bobot-type">Benefit</div>
                </div>
            </div>
        </div>

        
        <div class="mt-3 formula-box">
            <div class="fw-bold mb-1" style="font-family:'Inter',sans-serif;font-size:.8rem;color:#6C3483;">
                Rumus SAW (Metode Simple Additive Weighting):
            </div>
            <div>Normalisasi (Benefit): <strong>r<sub>ij</sub> = x<sub>ij</sub> / max(x<sub>j</sub>)</strong></div>
            <div>Nilai Preferensi: <strong>V<sub>i</sub> = Σ (w<sub>j</sub> × r<sub>ij</sub>)</strong></div>
            <div class="mt-1" style="font-size:.78rem;color:#888;font-family:'Inter',sans-serif;">
                w<sub>C1</sub>=<?php echo e($bobot['c1']); ?>&nbsp; w<sub>C2</sub>=<?php echo e($bobot['c2']); ?>&nbsp; w<sub>C3</sub>=<?php echo e($bobot['c3']); ?>&nbsp;|&nbsp;
                X-Max: C1=<?php echo e($maxC1); ?>, C2=<?php echo e($maxC2); ?>, C3=<?php echo e($maxC3); ?>

            </div>
        </div>
    </div>
</div>


<ul class="nav spk-tabs mb-0" id="spkTab">
    <li class="nav-item">
        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#tabRanking">
            <i class="bi bi-trophy me-1"></i>Hasil Perangkingan
        </button>
    </li>
    <li class="nav-item">
        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tabMatriksX">
            <i class="bi bi-table me-1"></i>Data Awal (Matriks X)
        </button>
    </li>
    <li class="nav-item">
        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tabMatriksR">
            <i class="bi bi-grid me-1"></i>Normalisasi (Matriks R)
        </button>
    </li>
</ul>

<div class="tab-content">

    
    <div class="tab-pane fade show active" id="tabRanking">
        <div class="card" style="border-radius:0 12px 12px 12px;">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <span class="fw-semibold">
                    <i class="bi bi-sort-down me-2 text-primary"></i>
                    Perangkingan Produk Berdasarkan Nilai Preferensi (V)
                </span>
                <span class="text-muted small">Semakin tinggi nilai V → semakin populer</span>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table spk-table mb-0">
                        <thead>
                            <tr>
                                <th class="ps-3">Rank</th>
                                <th>Karya</th>
                                <th>Seniman</th>
                                <th class="text-center">C1<br><small class="fw-normal text-muted">Terjual</small></th>
                                <th class="text-center">C2<br><small class="fw-normal text-muted">Rating</small></th>
                                <th class="text-center">C3<br><small class="fw-normal text-muted">Ulasan ⭐≥4</small></th>
                                <th>Nilai V</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $perangkingan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr class="<?php echo e($i === 0 ? 'table-warning' : ($i === 1 ? 'table-light' : '')); ?>">
                                <td class="ps-3">
                                    <div class="rank-badge <?php echo e($i === 0 ? 'rank-1' : ($i === 1 ? 'rank-2' : ($i === 2 ? 'rank-3' : 'rank-n'))); ?>">
                                        <?php echo e($i + 1); ?>

                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <div style="width:40px;height:40px;border-radius:8px;overflow:hidden;background:linear-gradient(135deg,#9B59B6,#6C3483);flex-shrink:0;display:flex;align-items:center;justify-content:center;font-size:1.1rem;">
                                            <?php if($item['gambar'] && file_exists(public_path('uploads/karya/'.$item['gambar']))): ?>
                                                <img src="<?php echo e(asset('uploads/karya/'.$item['gambar'])); ?>" style="width:40px;height:40px;object-fit:cover;">
                                            <?php else: ?> 🎨 <?php endif; ?>
                                        </div>
                                        <div>
                                            <div class="fw-semibold small"><?php echo e(Str::limit($item['judul'], 28)); ?></div>
                                            <span class="badge <?php echo e($item['status'] === 'tersedia' ? 'bg-success' : 'bg-danger'); ?>" style="font-size:.62rem;">
                                                <?php echo e(ucfirst($item['status'])); ?>

                                            </span>
                                        </div>
                                    </div>
                                </td>
                                <td class="small text-muted"><?php echo e(Str::limit($item['seniman'], 18)); ?></td>
                                <td class="text-center fw-bold" style="color:#6C3483;"><?php echo e($item['c1']); ?></td>
                                <td class="text-center">
                                    <?php if($item['c2'] > 0): ?>
                                        <span class="fw-bold"><?php echo e($item['c2']); ?></span>
                                        <span style="color:#F39C12;font-size:.75rem;">★</span>
                                    <?php else: ?>
                                        <span class="text-muted small">-</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center fw-bold text-success"><?php echo e($item['c3']); ?></td>
                                <td>
                                    <div class="score-bar-wrap">
                                        <div class="score-bar">
                                            <div class="score-bar-fill" style="width:<?php echo e($item['v'] * 100); ?>%;"></div>
                                        </div>
                                        <span class="fw-bold" style="color:#6C3483;font-size:.88rem;white-space:nowrap;">
                                            <?php echo e(number_format($item['v'], 4)); ?>

                                        </span>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="7" class="text-center py-5 text-muted">
                                    <i class="bi bi-inbox fs-2 d-block mb-2 opacity-25"></i>
                                    Belum ada data karya.
                                </td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            
            <?php if($perangkingan->count() >= 1): ?>
            <div class="card-footer py-3 bg-light">
                <div class="d-flex justify-content-center align-items-end gap-3 flex-wrap">
                    <?php $__currentLoopData = [1, 0, 2]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pos): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if(isset($perangkingan[$pos])): ?>
                        <?php
                            $item = $perangkingan[$pos];
                            $heights = [1 => '80px', 0 => '100px', 2 => '64px'];
                            $medals  = [1 => '🥈', 0 => '🥇', 2 => '🥉'];
                        ?>
                        <div class="text-center">
                            <div class="fw-semibold small mb-1"><?php echo e(Str::limit($item['judul'], 18)); ?></div>
                            <div style="font-size:1.6rem;"><?php echo e($medals[$pos]); ?></div>
                            <div class="rounded-3 d-flex align-items-center justify-content-center fw-bold"
                                 style="height:<?php echo e($heights[$pos]); ?>;width:80px;background:<?php echo e($pos===0 ? '#FFD700' : ($pos===1 ? '#C0C0C0' : '#CD7F32')); ?>;color:<?php echo e($pos===0 ? '#7a5700' : '#fff'); ?>;font-size:1.1rem;margin:auto;">
                                <?php echo e($pos + 1); ?>

                            </div>
                            <div class="mt-1 fw-bold" style="color:#6C3483;font-size:.82rem;">
                                V=<?php echo e(number_format($item['v'], 4)); ?>

                            </div>
                        </div>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>

    
    <div class="tab-pane fade" id="tabMatriksX">
        <div class="card" style="border-radius:0 12px 12px 12px;">
            <div class="card-header py-3">
                <span class="fw-semibold">
                    <i class="bi bi-table me-2 text-primary"></i>
                    Data Awal — Matriks X (Nilai Kriteria Mentah)
                </span>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table spk-table mb-0">
                        <thead>
                            <tr>
                                <th class="ps-3">No</th>
                                <th>Nama Karya / Produk</th>
                                <th class="text-center">C1<br><small class="fw-normal text-muted">Penjualan (unit)</small></th>
                                <th class="text-center">C2<br><small class="fw-normal text-muted">Rating (1–5)</small></th>
                                <th class="text-center">C3<br><small class="fw-normal text-muted">Ulasan Positif</small></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $matriksX; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td class="ps-3 text-muted small"><?php echo e($i + 1); ?></td>
                                <td class="fw-semibold small"><?php echo e($item['judul']); ?></td>
                                <td class="text-center">
                                    <?php echo e($item['c1']); ?>

                                    <?php if($item['c1'] == $maxC1 && $maxC1 > 0): ?>
                                        <span class="max-chip ms-1">MAX</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php echo e($item['c2'] > 0 ? $item['c2'] : '-'); ?>

                                    <?php if($item['c2'] == $maxC2 && $maxC2 > 0): ?>
                                        <span class="max-chip ms-1">MAX</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php echo e($item['c3']); ?>

                                    <?php if($item['c3'] == $maxC3 && $maxC3 > 0): ?>
                                        <span class="max-chip ms-1">MAX</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                        <tfoot>
                            <tr style="background:#4A235A;color:#fff;font-weight:700;">
                                <td class="ps-3" colspan="2">NILAI MAKSIMUM (X-Max)</td>
                                <td class="text-center"><?php echo e($maxC1); ?></td>
                                <td class="text-center"><?php echo e($maxC2); ?></td>
                                <td class="text-center"><?php echo e($maxC3); ?></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

    
    <div class="tab-pane fade" id="tabMatriksR">
        <div class="card" style="border-radius:0 12px 12px 12px;">
            <div class="card-header py-3">
                <span class="fw-semibold">
                    <i class="bi bi-grid me-2 text-primary"></i>
                    Normalisasi — Matriks R &amp; Nilai Preferensi (V)
                </span>
                <span class="ms-2 text-muted small">
                    r<sub>ij</sub> = x<sub>ij</sub> / Max(x<sub>j</sub>)
                </span>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table spk-table mb-0">
                        <thead>
                            <tr>
                                <th class="ps-3">No</th>
                                <th>Nama Karya / Produk</th>
                                <th class="text-center">r<sub>C1</sub><br><small class="fw-normal text-muted">Penjualan</small></th>
                                <th class="text-center">r<sub>C2</sub><br><small class="fw-normal text-muted">Rating</small></th>
                                <th class="text-center">r<sub>C3</sub><br><small class="fw-normal text-muted">Ulasan+</small></th>
                                <th class="text-center">
                                    Nilai V<br>
                                    <small class="fw-normal text-muted">
                                        <?php echo e($bobot['c1']); ?>r₁+<?php echo e($bobot['c2']); ?>r₂+<?php echo e($bobot['c3']); ?>r₃
                                    </small>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $matriksR->sortBy('judul')->values(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td class="ps-3 text-muted small"><?php echo e($i + 1); ?></td>
                                <td class="fw-semibold small"><?php echo e($item['judul']); ?></td>
                                <td class="text-center small"><?php echo e(number_format($item['r1'], 4)); ?></td>
                                <td class="text-center small"><?php echo e(number_format($item['r2'], 4)); ?></td>
                                <td class="text-center small"><?php echo e(number_format($item['r3'], 4)); ?></td>
                                <td class="text-center">
                                    <span class="fw-bold" style="color:#6C3483;">
                                        <?php echo e(number_format($item['v'], 4)); ?>

                                    </span>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                        <tfoot>
                            <tr style="background:#f5f0ff;">
                                <td class="ps-3" colspan="2" style="font-weight:700;color:#6C3483;">
                                    BOBOT (w<sub>j</sub>)
                                </td>
                                <td class="text-center fw-bold" style="color:#6C3483;"><?php echo e($bobot['c1']); ?></td>
                                <td class="text-center fw-bold" style="color:#6C3483;"><?php echo e($bobot['c2']); ?></td>
                                <td class="text-center fw-bold" style="color:#6C3483;"><?php echo e($bobot['c3']); ?></td>
                                <td class="text-center">
                                    <span class="badge bg-success">Σw = <?php echo e(array_sum($bobot)); ?></span>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\imagirupa\resources\views/admin/spk/index.blade.php ENDPATH**/ ?>