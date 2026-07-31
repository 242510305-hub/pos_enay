@extends('layouts.app')

@section('title', 'Produk')

@section('content')

@include('layouts.navbar')

<div class="container py-4">

    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3 border-bottom pb-3">
        <div>
            <h1 class="h3 font-weight-bold text-dark mb-1">Daftar Produk</h1>
            <p class="text-muted small mb-0">Kelola item produk, harga, serta ketersediaan stok</p>
        </div>
        <div>
            @can('create', App\Models\Produk::class)
                <a href="{{ route('admin.produk.create') }}" class="btn btn-primary px-3 py-2 shadow-sm d-inline-flex align-items-center gap-2">
                    <i class="bi bi-plus-lg"></i>
                    <span>Tambah Produk</span>
                </a>
            @endcan
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-3">
        <div class="card-body p-4">

            <form action="{{ route('admin.produk.index') }}" method="GET" class="mb-4">
                <div class="row">
                    <div class="col-md-5 col-lg-4">
                        <div class="input-group">
                            <input
                                type="text"
                                name="search"
                                value="{{ request('search') }}"
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
                        @forelse ($products as $product)
                            <tr>
                                <th scope="row">{{ $products->firstItem() + $loop->index }}</th>
                                <td>
                                    @if($product->foto)
                                        <img src="{{ asset('storage/'.$product->foto) }}"
                                             alt="{{ $product->nama }}"
                                             class="rounded border object-fit-cover"
                                             style="width: 50px; height: 50px;">
                                    @else
                                        <div class="bg-light rounded border d-flex align-items-center justify-content-center text-muted"
                                             style="width: 50px; height: 50px; font-size: 10px;">
                                            No Image
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    <span class="fw-semibold text-dark">{{ $product->nama }}</span>
                                </td>
                                <td class="text-secondary small">
                                    {{ $product->user->name ?? '-' }}
                                </td>
                                <td class="text-muted">
                                    Rp {{ number_format($product->harga_beli, 0, ',', '.') }}
                                </td>
                                <td class="fw-semibold text-success">
                                    Rp {{ number_format($product->harga_jual, 0, ',', '.') }}
                                </td>
                                <td class="text-center">
                                    <span class="badge {{ $product->stok > 10 ? 'bg-success bg-opacity-10 text-success' : ($product->stok > 0 ? 'bg-warning bg-opacity-20 text-dark' : 'bg-danger bg-opacity-10 text-danger') }}">
                                        {{ $product->stok }}
                                    </span>
                                </td>
                                <td class="text-end">
                                    <div class="d-inline-flex gap-1">
                                        @can('update', $product)
                                            <a href="{{ route('admin.produk.edit', $product) }}" class="btn btn-sm btn-outline-warning">
                                                Edit
                                            </a>
                                        @endcan

                                        @can('delete', $product)
                                            <form action="{{ route('admin.produk.destroy', $product) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="btn btn-sm btn-outline-danger"
                                                        onclick="return confirm('Apakah anda yakin akan menghapus produk ini?')">
                                                    Hapus
                                                </button>
                                            </form>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-5 text-muted">
                                    <i class="bi bi-box-seam fs-2 d-block mb-2"></i>
                                    <span>Data produk tidak ditemukan.</span>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($products->hasPages())
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mt-4 pt-3 border-top gap-2">
                    <div class="text-muted small">
                        Showing {{ $products->firstItem() }} to {{ $products->lastItem() }} of {{ $products->total() }} results
                    </div>
                    <div>
                        {{ $products->links() }}
                    </div>
                </div>
            @endif

        </div>
    </div>

</div>

@endsection