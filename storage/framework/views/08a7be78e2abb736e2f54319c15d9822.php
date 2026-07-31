<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('layouts.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<div class="container py-4">

    <div class="text-center mb-5">
        <h2 class="fw-bold text-dark mb-1">Ringkasan Hari Ini</h2>
        <p class="text-muted mb-0">
            <i class="bi bi-calendar-event me-1"></i>
            <?php echo e($tanggalHariIni->translatedFormat('l, d F Y')); ?>

        </p>
    </div>

    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('viewAny', App\Models\User::class)): ?>
        <div class="mb-5">
            <div class="d-flex align-items-center mb-3">
                <div class="bg-primary rounded-pill me-2" style="width: 4px; height: 20px;"></div>
                <h5 class="fw-bold text-dark mb-0">Penjualan Hari Ini</h5>
            </div>

            <div class="row g-3">
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm rounded-3 h-100">
                        <div class="card-body p-4 d-flex align-items-center justify-content-between">
                            <div>
                                <span class="text-muted small text-uppercase fw-semibold tracking-wider">Total Nilai Penjualan</span>
                                <h3 class="fw-bold text-primary mb-0 mt-1">
                                    Rp <?php echo e(number_format($ringkasan['total_penjualan'] ?? 0, 0, ',', '.')); ?>

                                </h3>
                            </div>
                            <div class="p-3 bg-primary bg-opacity-10 text-primary rounded-circle">
                                <i class="bi bi-currency-dollar fs-3"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card border-0 shadow-sm rounded-3 h-100">
                        <div class="card-body p-4 d-flex align-items-center justify-content-between">
                            <div>
                                <span class="text-muted small text-uppercase fw-semibold tracking-wider">Jumlah Transaksi</span>
                                <h3 class="fw-bold text-dark mb-0 mt-1">
                                    <?php echo e($ringkasan['total_transaksi'] ?? 0); ?> <span class="fs-6 font-normal text-muted">Transaksi</span>
                                </h3>
                            </div>
                            <div class="p-3 bg-info bg-opacity-10 text-info rounded-circle">
                                <i class="bi bi-receipt fs-3"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-5">
            <div class="d-flex align-items-center mb-3">
                <div class="bg-success rounded-pill me-2" style="width: 4px; height: 20px;"></div>
                <h5 class="fw-bold text-dark mb-0">Status Pembayaran</h5>
            </div>

            <div class="row g-3">
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm rounded-3">
                        <div class="card-body p-4 d-flex align-items-center justify-content-between">
                            <div>
                                <span class="text-muted small text-uppercase fw-semibold">Pembayaran Tunai</span>
                                <h4 class="fw-bold text-success mb-0 mt-1">
                                    Rp <?php echo e(number_format($ringkasan['total_cash'] ?? 0, 0, ',', '.')); ?>

                                </h4>
                            </div>
                            <div class="p-3 bg-success bg-opacity-10 text-success rounded-circle">
                                <i class="bi bi-wallet2 fs-4"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card border-0 shadow-sm rounded-3">
                        <div class="card-body p-4 d-flex align-items-center justify-content-between">
                            <div>
                                <span class="text-muted small text-uppercase fw-semibold">Pembayaran Non-Tunai</span>
                                <h4 class="fw-bold text-indigo mb-0 mt-1" style="color: #6610f2;">
                                    Rp <?php echo e(number_format($ringkasan['total_non_tunai'] ?? 0, 0, ',', '.')); ?>

                                </h4>
                            </div>
                            <div class="p-3 bg-purple bg-opacity-10 text-purple rounded-circle" style="background-color: #e0cffc; color: #6610f2;">
                                <i class="bi bi-credit-card fs-4"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <div class="mb-5">
        <div class="d-flex align-items-center mb-3">
            <div class="bg-warning rounded-pill me-2" style="width: 4px; height: 20px;"></div>
            <h5 class="fw-bold text-dark mb-0">Critical Inventory Status</h5>
        </div>

        <div class="row g-4">
            <div class="col-md-6">
                <div class="card border-0 shadow-sm rounded-3 h-100">
                    <div class="card-header bg-white border-0 pt-4 px-4 pb-0 d-flex justify-content-between align-items-center">
                        <h6 class="fw-bold text-warning mb-0">
                            <i class="bi bi-exclamation-triangle me-1"></i> Produk Stok Rendah
                        </h6>
                    </div>
                    <div class="card-body p-4">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th style="width: 10%;">#</th>
                                        <th>Nama Produk</th>
                                        <th class="text-end">Sisa Stok</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__empty_1 = true; $__currentLoopData = $produkStokRendah; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $produk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <tr>
                                            <td><?php echo e($produkStokRendah->firstItem() + $index); ?></td>
                                            <td class="fw-semibold text-dark"><?php echo e($produk->nama); ?></td>
                                            <td class="text-end">
                                                <span class="badge bg-warning text-dark"><?php echo e($produk->stok); ?></span>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <tr>
                                            <td colspan="3" class="text-muted text-center py-4">
                                                <i class="bi bi-check-circle text-success fs-4 d-block mb-1"></i>
                                                Seluruh produk berada dalam kondisi stok aman.
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-3">
                            <?php echo e($produkStokRendah->links()); ?>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card border-0 shadow-sm rounded-3 h-100">
                    <div class="card-header bg-white border-0 pt-4 px-4 pb-0 d-flex justify-content-between align-items-center">
                        <h6 class="fw-bold text-danger mb-0">
                            <i class="bi bi-x-circle me-1"></i> Produk Habis Stok
                        </h6>
                    </div>
                    <div class="card-body p-4">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th style="width: 10%;">#</th>
                                        <th>Nama Produk</th>
                                        <th class="text-end">Stok</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__empty_1 = true; $__currentLoopData = $produkStokHabis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $produk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <tr>
                                            <td><?php echo e($produkStokHabis->firstItem() + $index); ?></td>
                                            <td class="fw-semibold text-dark"><?php echo e($produk->nama); ?></td>
                                            <td class="text-end">
                                                <span class="badge bg-danger"><?php echo e($produk->stok); ?></span>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <tr>
                                            <td colspan="3" class="text-muted text-center py-4">
                                                <i class="bi bi-check-circle text-success fs-4 d-block mb-1"></i>
                                                Tidak ada produk yang habis.
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-3">
                            <?php echo e($produkStokHabis->links()); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mb-5">
        <div class="d-flex align-items-center mb-3">
            <div class="bg-info rounded-pill me-2" style="width: 4px; height: 20px;"></div>
            <h5 class="fw-bold text-dark mb-0">Best Seller Products</h5>
        </div>

        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-body p-4">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Nama Produk</th>
                                <th class="text-center">Sisa Stok</th>
                                <th class="text-end">Unit Terjual</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $produkTerlaris; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $produk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td class="fw-semibold text-dark"><?php echo e($produk->nama); ?></td>
                                    <td class="text-center">
                                        <span class="badge bg-secondary bg-opacity-20 text-dark"><?php echo e($produk->stok); ?></span>
                                    </td>
                                    <td class="text-end fw-bold text-primary">
                                        <?php echo e($produk->total_terjual); ?> <small class="fw-normal text-muted">unit</small>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="3" class="text-muted text-center py-4">
                                        Belum ada data penjualan produk terlaris.
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\APK_POS\resources\views/dashboard.blade.php ENDPATH**/ ?>