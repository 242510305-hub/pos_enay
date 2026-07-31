<?php $__env->startSection('title', 'Users'); ?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('layouts.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<div class="container py-4">

    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3 border-bottom pb-3">
        <div>
            <h1 class="h3 font-weight-bold text-dark mb-1">Halaman Users</h1>
            <p class="text-muted small mb-0">Kelola pengguna dan hak akses sistem</p>
        </div>
        <div>
            <a href="<?php echo e(route('admin.users.create')); ?>" class="btn btn-primary px-3 py-2 shadow-sm d-inline-flex align-items-center gap-2">
                <i class="bi bi-plus-lg"></i>
                <span>Tambah User</span>
            </a>
        </div>
    </div>

    <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo e(session('success')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="card border-0 shadow-sm rounded-3">
        <div class="card-body p-4">

            <form action="<?php echo e(route('admin.users')); ?>" method="GET" class="mb-4">
                <div class="row">
                    <div class="col-md-5 col-lg-4">
                        <div class="input-group">
                            <input
                                type="text"
                                name="search"
                                value="<?php echo e(request('search')); ?>"
                                class="form-control"
                                placeholder="Search nama atau email user..."
                            >
                            <button class="btn btn-outline-primary" type="submit">
                                Search
                            </button>
                        </div>
                    </div>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th scope="col" style="width: 5%">#</th>
                            <th scope="col">User</th>
                            <th scope="col">Email</th>
                            <th scope="col">Role</th>
                            <th scope="col" class="text-end" style="width: 20%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $users ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <th scope="row"><?php echo e($loop->iteration); ?></th>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="rounded-circle bg-primary bg-opacity-10 text-primary fw-bold d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
                                            <?php echo e(strtoupper(substr($user->name, 0, 2))); ?>

                                        </div>
                                        <span class="fw-semibold text-dark"><?php echo e($user->name); ?></span>
                                    </div>
                                </td>
                                <td class="text-secondary"><?php echo e($user->email); ?></td>
                                <td>
                                    <span class="badge <?php echo e($user->role_id == 1 ? 'bg-primary' : 'bg-info'); ?>">
                                        <?php echo e($user->role_id == 1 ? 'Admin' : 'Kasir'); ?>

                                    </span>
                                </td>
                                <td class="text-end">
                                    <div class="d-inline-flex gap-2">
                                        <a href="<?php echo e(route('admin.users.edit', $user->id)); ?>" class="btn btn-sm btn-outline-warning">
                                            Edit
                                        </a>

                                        <form
                                            action="<?php echo e(route('admin.users.destroy', $user->id)); ?>"
                                            method="POST"
                                            class="d-inline"
                                        >
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>

                                            <button
                                                type="submit"
                                                class="btn btn-sm btn-outline-danger"
                                                onclick="return confirm('Apakah anda yakin akan menghapus user ini?')"
                                            >
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="5" class="text-center py-4 text-muted">
                                    Tidak ada data user yang ditemukan.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <?php if(isset($users) && method_exists($users, 'links')): ?>
                <div class="mt-3">
                    <?php echo e($users->links()); ?>

                </div>
            <?php endif; ?>

        </div>
    </div>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\APK_POS\resources\views/users/index.blade.php ENDPATH**/ ?>