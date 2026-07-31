<?php $__env->startSection('title', 'Produk'); ?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('layouts.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<div class="container py-4">

    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3 border-bottom pb-3">
        <div>
            <h1 class="h3 font-weight-bold text-dark mb-1">Daftar Produk</h1>
            <p class="text-muted small mb-0">Kelola item produk, harga, serta ketersediaan stok</p>
        </div>
        <div>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create', App\Models\Produk::class)): ?>
                <a href="<?php echo e(route('admin.produk.create')); ?>" class="btn btn-primary px-3 py-2 shadow-sm d-inline-flex align-items-center gap-2">
                    <i class="bi bi-plus-lg"></i>
                    <span>Tambah Produk</span>
                </a>
            <?php endif; ?>
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-3">
        <div class="card-body p-4">

            <form action="<?php echo e(route('admin.produk.index')); ?>" method="GET" class="mb-4">
                <div class="row">
                    <div class="col-md-5 col-lg-4">
                        <div class="input-group">
                            <input
                                type="text"
                                name="search"
                                value="<?php echo e(request('search')); ?>"
                                class="form-control"
                                placeholder="Cari nama produk..."
                            >
                            <button class="btn btn-outline-primary" type="submit">
                                Cari
                            </button>
                        </div>
                    </div>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th scope="col" style="width: 5%">#</th>
                            <th scope="col" style="width: 10%">Foto</th>
                            <th scope="col">Nama Produk</th>
                            <th scope="col">Dibuat Oleh</th>
                            <th scope="col">Harga Beli</th>
                            <th scope="col">Harga Jual</th>
                            <th scope="col" class="text-center">Stok</th>
                            <th scope="col" class="text-end" style="width: 15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <th scope="row"><?php echo e($products->firstItem() + $loop->index); ?></th>
                                <td>
                                    <?php if($product->foto): ?>
                                        <img src="<?php echo e(asset('storage/'.$product->foto)); ?>"
                                             alt="<?php echo e($product->nama); ?>"
                                             class="rounded border object-fit-cover"
                                             style="width: 50px; height: 50px;">
                                    <?php else: ?>
                                        <div class="bg-light rounded border d-flex align-items-center justify-content-center text-muted"
                                             style="width: 50px; height: 50px; font-size: 10px;">
                                            No Image
                                        </div>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <span class="fw-semibold text-dark"><?php echo e($product->nama); ?></span>
                                </td>
                                <td class="text-secondary small">
                                    <?php echo e($product->user->name ?? '-'); ?>

                                </td>
                                <td class="text-muted">
                                    Rp <?php echo e(number_format($product->harga_beli, 0, ',', '.')); ?>

                                </td>
                                <td class="fw-semibold text-success">
                                    Rp <?php echo e(number_format($product->harga_jual, 0, ',', '.')); ?>

                                </td>
                                <td class="text-center">
                                    <span class="badge <?php echo e($product->stok > 10 ? 'bg-success bg-opacity-10 text-success' : ($product->stok > 0 ? 'bg-warning bg-opacity-20 text-dark' : 'bg-danger bg-opacity-10 text-danger')); ?>">
                                        <?php echo e($product->stok); ?>

                                    </span>
                                </td>
                                <td class="text-end">
                                    <div class="d-inline-flex gap-1">
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update', $product)): ?>
                                            <a href="<?php echo e(route('admin.produk.edit', $product)); ?>" class="btn btn-sm btn-outline-warning">
                                                Edit
                                            </a>
                                        <?php endif; ?>

                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete', $product)): ?>
                                            <form action="<?php echo e(route('admin.produk.destroy', $product)); ?>" method="POST" class="d-inline">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="submit"
                                                        class="btn btn-sm btn-outline-danger"
                                                        onclick="return confirm('Apakah anda yakin akan menghapus produk ini?')">
                                                    Hapus
                                                </button>
                                            </form>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="8" class="text-center py-5 text-muted">
                                    <i class="bi bi-box-seam fs-2 d-block mb-2"></i>
                                    <span>Data produk tidak ditemukan.</span>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <?php if($products->hasPages()): ?>
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mt-4 pt-3 border-top gap-2">
                    <div class="text-muted small">
                        Showing <?php echo e($products->firstItem()); ?> to <?php echo e($products->lastItem()); ?> of <?php echo e($products->total()); ?> results
                    </div>
                    <div>
                        <?php echo e($products->links()); ?>

                    </div>
                </div>
            <?php endif; ?>

        </div>
    </div>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\APK_POS\resources\views/Produk/index.blade.php ENDPATH**/ ?>