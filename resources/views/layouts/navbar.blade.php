<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">POS</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" 
                       href="{{ route('dashboard') }}">
                        Dashboard
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ Request::is('admin/users*') ? 'active' : '' }}" 
                       href="{{ route('admin.users') }}">
                        Users
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ Request::is('produk') ? 'active' : '' }}" 
                       href="{{ route('admin.produk.index') }}">
                        Produk
                    </a>
                </li>
                <li class="nav-item">
    <a class="nav-link {{ Request::is('admin/penjualan*') ? 'active' : '' }}"
       href="{{ route('admin.penjualan.index') }}">
        Penjualan
    </a>
</li>

            </ul>

            <form class="d-flex" action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger">
                    Logout
                </button>
            </form>

        </div>
    </div>
</nav>