@extends('layouts.app')

@section('title', 'Penjualan')

@section('content')

@include('layouts.navbar')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<div class="container py-4">

    <div class="p-4 mb-4 rounded-3 text-white shadow-sm" style="background-color: #0d6efd;">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
            <div>
                <h1 class="h3 fw-bold mb-1 text-white">Riwayat Penjualan</h1>
                <p class="mb-0 text-white-50 small">Kelola transaksi, cetak struk, dan pantau status pembayaran kasir</p>
            </div>
            <div>
                <a href="{{ route('admin.penjualan.create') }}" class="btn btn-light fw-bold px-3 py-2 shadow-sm d-inline-flex align-items-center gap-2 text-primary">
                    <i class="bi bi-plus-circle-fill"></i>
                    <span>Tambah Transaksi Baru</span>
                </a>
            </div>
        </div>
    </div>

    @if(session('errors'))
        <div class="alert alert-danger border-0 shadow-sm alert-dismissible fade show mb-4" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('errors') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm alert-dismissible fade show mb-4" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row g-3 mb-4">
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm rounded-3 text-white" style="background-color: #0d6efd;">
                <div class="card-body p-3 d-flex align-items-center justify-content-between">
                    <div>
                        <span class="small fw-bold text-uppercase d-block mb-1 text-white-50" style="font-size: 11px;">Total Entri</span>
                        <h3 class="fw-bold mb-0 text-white">{{ $sales->total() }}</h3>
                    </div>
                    <div class="p-2 bg-white bg-opacity-25 rounded-3 text-white">
                        <i class="bi bi-receipt fs-3"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm rounded-3 text-white" style="background-color: #198754;">
                <div class="card-body p-3 d-flex align-items-center justify-content-between">
                    <div>
                        <span class="small fw-bold text-uppercase d-block mb-1 text-white-50" style="font-size: 11px;">Lunas</span>
                        <h3 class="fw-bold mb-0 text-white">
                            {{ $sales->where('status', 'lunas')->count() }}
                        </h3>
                    </div>
                    <div class="p-2 bg-white bg-opacity-25 rounded-3 text-white">
                        <i class="bi bi-check-all fs-3"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm rounded-3 text-white" style="background-color: #0dcaf0;">
                <div class="card-body p-3 d-flex align-items-center justify-content-between">
                    <div>
                        <span class="small fw-bold text-uppercase d-block mb-1 text-white-50" style="font-size: 11px;">Metode Tunai</span>
                        <h3 class="fw-bold mb-0 text-white">
                            {{ $sales->where('metode_pembayaran', 'tunai')->count() }}
                        </h3>
                    </div>
                    <div class="p-2 bg-white bg-opacity-25 rounded-3 text-white">
                        <i class="bi bi-cash-stack fs-3"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm rounded-3 text-white" style="background-color: #6c757d;">
                <div class="card-body p-3 d-flex align-items-center justify-content-between">
                    <div>
                        <span class="small fw-bold text-uppercase d-block mb-1 text-white-50" style="font-size: 11px;">Non-Tunai</span>
                        <h3 class="fw-bold mb-0 text-white">
                            {{ $sales->where('metode_pembayaran', '!=', 'tunai')->count() }}
                        </h3>
                    </div>
                    <div class="p-2 bg-white bg-opacity-25 rounded-3 text-white">
                        <i class="bi bi-credit-card fs-3"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-5 col-lg-4">
            <form action="{{ route('admin.penjualan.index') }}" method="GET">
                <div class="input-group rounded-3 overflow-hidden border">
                    <span class="input-group-text bg-primary text-white border-0">
                        <i class="bi bi-search"></i>
                    </span>
                    <input 
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        class="form-control bg-light border-0"
                        placeholder="Cari nota, kasir, atau status..."
                    >
                    <button class="btn btn-primary px-3" type="submit">
                        Cari
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="d-flex flex-column gap-3 mb-4">
        @forelse($sales as $sale)
            <div class="card border-0 shadow-sm rounded-3" style="background-color: #e9ecef;">
                <div class="card-body p-3 d-flex flex-column flex-lg-row align-items-lg-center justify-content-between gap-3">
                    
                    <div class="d-flex align-items-center gap-3">
                        <span class="fw-bold text-dark fs-6" style="min-width: 20px;">{{ $sales->firstItem() + $loop->index }}</span>
                        
                        <div class="d-flex align-items-center gap-2 bg-white px-3 py-2 rounded-3 shadow-sm border">
                            <div class="p-2 rounded-circle text-primary" style="background-color: #cfe2f3;">
                                <i class="bi bi-calendar-event"></i>
                            </div>
                            <div>
                                <span class="fw-bold text-dark d-block small">
                                    {{ $sale->created_at->translatedFormat('d M Y') }}
                                </span>
                                <small class="text-muted" style="font-size: 11px;">
                                    <i class="bi bi-clock me-1 text-primary"></i>{{ $sale->created_at->translatedFormat('H:i:s') }} WIB
                                </small>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex align-items-center gap-2">
                        <div class="rounded-circle text-white fw-bold d-flex align-items-center justify-content-center shadow-sm" style="width: 34px; height: 34px; font-size: 13px; background-color: #0dcaf0;">
                            {{ strtoupper(substr($sale->user->name ?? 'U', 0, 1)) }}
                        </div>
                        <span class="fw-semibold text-dark">{{ $sale->user->name ?? '-' }}</span>
                    </div>

                    <div>
                        <span class="fw-bold fs-6" style="color: #198754;">
                            Rp {{ number_format($sale->total_pembayaran, 0, ',', '.') }}
                        </span>
                    </div>

                    <div>
                        @php
                            $metode = strtolower($sale->metode_pembayaran);
                            $badgeBg = ($metode == 'tunai' || $metode == 'cash') ? '#0dcaf0' : '#0d6efd';
                        @endphp
                        <span class="badge rounded-pill px-3 py-2 text-white shadow-sm" style="background-color: {{ $badgeBg }}; font-size: 12px;">
                            <i class="bi {{ ($metode == 'tunai' || $metode == 'cash') ? 'bi-cash' : 'bi-credit-card' }} me-1"></i>
                            {{ strtoupper($sale->metode_pembayaran) }}
                        </span>
                    </div>

                    <div>
                        @php
                            $status = strtolower($sale->status);
                            $isLunas = ($status == 'lunas' || $status == 'paid' || $status == 'completed');
                        @endphp
                        <span class="badge rounded-pill px-3 py-2 text-dark border shadow-sm" style="background-color: #dee2e6; font-size: 12px;">
                            <i class="bi {{ $isLunas ? 'bi-hourglass-split' : 'bi-hourglass-split' }} me-1"></i>
                            {{ strtoupper($sale->status) }}
                        </span>
                    </div>

                    <div class="d-flex align-items-center gap-1">
                        <a href="{{ route('admin.penjualan.show', $sale->id) }}" class="btn btn-sm btn-info text-white shadow-sm px-3" title="Detail">
                            <i class="bi bi-eye-fill"></i> Edit
                        </a>

                        @can('view', $sale)
                            <a href="{{ route('admin.penjualan.edit', $sale->id) }}" class="btn btn-sm text-white shadow-sm px-3" style="background-color: #6c757d;" title="Edit">
                                <i class="bi bi-pencil-fill"></i> Edit
                            </a>
                        @endcan

                        @can('delete', $sale)
                            <form action="{{ route('admin.penjualan.destroy', $sale->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger text-white shadow-sm px-3"
                                        title="Hapus"
                                        onclick="return confirm('Apakah Anda yakin akan menghapus data penjualan ini?')">
                                    <i class="bi bi-trash-fill"></i> Hapus
                                </button>
                            </form>
                        @endcan
                    </div>

                </div>
            </div>
        @empty
            <div class="card border-0 shadow-sm p-5 text-center text-muted rounded-3" style="background-color: #e9ecef;">
                <i class="bi bi-receipt-cutoff fs-1 text-primary d-block mb-2"></i>
                <span class="fw-semibold text-primary">Data transaksi penjualan tidak ditemukan.</span>
            </div>
        @endforelse
    </div>

    @if($sales->hasPages())
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mt-3 pt-2 gap-2">
            <div class="text-muted small">
                Showing {{ $sales->firstItem() }} to {{ $sales->lastItem() }} of {{ $sales->total() }} results
            </div>
            <div>
                {{ $sales->links() }}
            </div>
        </div>
    @endif

</div>

@endsection