<?php $__env->startSection('title', 'Login - POS System'); ?>

<?php $__env->startSection('content'); ?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<div class="min-vh-100 d-flex align-items-center justify-content-center py-5" style="background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 50%, #004085 100%);">

    <div class="card border-0 shadow-lg rounded-4 overflow-hidden" style="width: 100%; max-width: 400px;">
        
        <div class="text-white p-4 text-center" style="background-color: #004085;">
            <div class="d-inline-flex align-items-center justify-content-center bg-white rounded-circle p-3 mb-2 shadow-sm" style="width: 60px; height: 60px;">
                <i class="bi bi-cart-check-fill fs-2" style="color: #0d6efd;"></i>
            </div>
            <h4 class="fw-bold mb-0">Login POS</h4>
            <p class="small text-white-50 mb-0">Masuk untuk mengelola transaksi</p>
        </div>

        <div class="card-body p-4 bg-white">

            <?php if(session('error')): ?>
                <div class="alert alert-danger border-0 text-danger small py-2 px-3 mb-3 d-flex align-items-center gap-2" style="background-color: #f8d7da;">
                    <i class="bi bi-exclamation-circle-fill"></i>
                    <span><?php echo e(session('error')); ?></span>
                </div>
            <?php endif; ?>

            <form action="<?php echo e(route('auth')); ?>" method="POST">
                <?php echo csrf_field(); ?>

                <div class="mb-3">
                    <label class="form-label fw-bold text-dark small mb-1">
                        <i class="bi bi-envelope-fill me-1 text-primary"></i> Alamat Email
                    </label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-primary text-primary">
                            <i class="bi bi-envelope"></i>
                        </span>
                        <input 
                            type="email" 
                            name="email" 
                            value="<?php echo e(old('email')); ?>"
                            class="form-control border-primary bg-light <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                            placeholder="nama@email.com"
                            required
                        >
                    </div>
                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="badge text-bg-danger mt-1 fw-normal w-100 text-start py-1 px-2">
                            <i class="bi bi-exclamation-triangle me-1"></i> <?php echo e($message); ?>

                        </div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold text-dark small mb-1">
                        <i class="bi bi-lock-fill me-1 text-primary"></i> Password
                    </label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-primary text-primary">
                            <i class="bi bi-key"></i>
                        </span>
                        <input 
                            type="password" 
                            name="password" 
                            class="form-control border-primary bg-light <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                            placeholder="••••••••"
                            required
                        >
                    </div>
                    <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="badge text-bg-danger mt-1 fw-normal w-100 text-start py-1 px-2">
                            <i class="bi bi-exclamation-triangle me-1"></i> <?php echo e($message); ?>

                        </div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <button type="submit" class="btn btn-primary w-100 py-2 fw-bold rounded-3 shadow-sm d-flex align-items-center justify-content-center gap-2" style="background-color: #0d6efd; border: none;">
                    <i class="bi bi-box-arrow-in-right fs-5"></i>
                    <span>Masuk ke Sistem</span>
                </button>
            </form>

        </div>

        <div class="card-footer bg-light text-center py-3 border-0">
            <small class="text-muted" style="font-size: 12px;">
                POS System &copy; <?php echo e(date('Y')); ?>

            </small>
        </div>

    </div>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\APK_POS\resources\views/login.blade.php ENDPATH**/ ?>