@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

@include('layouts.navbar')

<div class="container py-4">

    <div class="text-center mb-5">
        <h2 class="fw-bold text-dark mb-1">Ringkasan Hari Ini</h2>
        <p class="text-muted mb-0">
            <i class="bi bi-calendar-event me-1"></i>
            {{ $tanggalHariIni->translatedFormat('l, d F Y') }}
        </p>
    </div>

    @can('viewAny', App\Models\User::class)
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
                                    Rp {{ number_format($ringkasan['total_penjualan'] ?? 0, 0, ',', '.') }}
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
                                    {{ $ringkasan['total_transaksi'] ?? 0 }} <span class="fs-6 font-normal text-muted">Transaksi</span>
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
                                    Rp {{ number_format($ringkasan['total_cash'] ?? 0, 0, ',', '.') }}
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
                                    Rp {{ number_format($ringkasan['total_non_tunai'] ?? 0, 0, ',', '.') }}
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
    @endcan

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
                                    @forelse ($produkStokRendah as $index => $produk)
                                        <tr>
                                            <td>{{ $produkStokRendah->firstItem() + $index }}</td>
                                            <td class="fw-semibold text-dark">{{ $produk->nama }}</td>
                                            <td class="text-end">
                                                <span class="badge bg-warning text-dark">{{ $produk->stok }}</span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-muted text-center py-4">
                                                <i class="bi bi-check-circle text-success fs-4 d-block mb-1"></i>
                                                Seluruh produk berada dalam kondisi stok aman.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-3">
                            {{ $produkStokRendah->links() }}
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
                                    @forelse ($produkStokHabis as $index => $produk)
                                        <tr>
                                            <td>{{ $produkStokHabis->firstItem() + $index }}</td>
                                            <td class="fw-semibold text-dark">{{ $produk->nama }}</td>
                                            <td class="text-end">
                                                <span class="badge bg-danger">{{ $produk->stok }}</span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-muted text-center py-4">
                                                <i class="bi bi-check-circle text-success fs-4 d-block mb-1"></i>
                                                Tidak ada produk yang habis.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-3">
                            {{ $produkStokHabis->links() }}
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
                            @forelse ($produkTerlaris as $produk)
                                <tr>
                                    <td class="fw-semibold text-dark">{{ $produk->nama }}</td>
                                    <td class="text-center">
                                        <span class="badge bg-secondary bg-opacity-20 text-dark">{{ $produk->stok }}</span>
                                    </td>
                                    <td class="text-end fw-bold text-primary">
                                        {{ $produk->total_terjual }} <small class="fw-normal text-muted">unit</small>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-muted text-center py-4">
                                        Belum ada data penjualan produk terlaris.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection