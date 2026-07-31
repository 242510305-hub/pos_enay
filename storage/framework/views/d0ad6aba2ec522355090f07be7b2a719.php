<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">POS</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                
                <li class="nav-item">
                    <a class="nav-link <?php echo e(Request::is('dashboard') ? 'active' : ''); ?>" 
                       href="<?php echo e(route('dashboard')); ?>">
                        Dashboard
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?php echo e(Request::is('admin/users*') ? 'active' : ''); ?>" 
                       href="<?php echo e(route('admin.users')); ?>">
                        Users
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?php echo e(Request::is('produk') ? 'active' : ''); ?>" 
                       href="<?php echo e(route('admin.produk.index')); ?>">
                        Produk
                    </a>
                </li>
                <li class="nav-item">
    <a class="nav-link <?php echo e(Request::is('admin/penjualan*') ? 'active' : ''); ?>"
       href="<?php echo e(route('admin.penjualan.index')); ?>">
        Penjualan
    </a>
</li>

            </ul>

            <form class="d-flex" action="<?php echo e(route('logout')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <button type="submit" class="btn btn-danger">
                    Logout
                </button>
            </form>

        </div>
    </div>
</nav><?php /**PATH C:\laragon\www\APK_POS\resources\views/layouts/navbar.blade.php ENDPATH**/ ?>