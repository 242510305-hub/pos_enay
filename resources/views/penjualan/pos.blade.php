@extends('layouts.app')

@section('title', 'POS')

@section('content')

@if(session('errors'))
    <div class="alert alert-danger">
        {{ session('errors') }}
    </div>
@endif

<div class="container">

    <h4>Tambah dan Edit</h4>

    <div class="row">

        {{-- ==================== PRODUK ==================== --}}
        <div class="col-md-6">

            <div class="card">

                <div class="card-body" style="max-height:70vh; overflow:auto">

                    {{-- SEARCH --}}
                    <div class="mb-3">
                        <form method="GET" action="{{ route('admin.penjualan.create') }}">

                            <input type="text"
                                name="search"
                                value="{{ request('search') }}"
                                class="form-control"
                                placeholder="Cari produk..."
                                onkeyup="this.form.submit()">

                        </form>
                    </div>

                    {{-- LIST PRODUK --}}
                    @foreach ($products as $product)

                    <form method="POST"
                        action="{{ route('admin.itempenjualan.store') }}"
                        class="row mb-2">

                        @csrf

                        {{-- PRODUCT ID --}}
                        <input type="hidden"
                            name="product_id"
                            value="{{ $product->id }}">

                        {{-- PRODUK --}}
                        <div class="col">

                            <button type="submit"
                                class="btn btn-outline-primary w-100 text-start p-2"
                                {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}>

                                <div class="d-flex align-items-center gap-2">

                                    {{-- FOTO --}}
                                    <img src="{{ asset('storage/' . $product->foto) }}"
                                        alt="Gambar"
                                        class="rounded-circle"
                                        style="width:45px; height:45px; object-fit:cover;">

                                    {{-- NAMA & HARGA --}}
                                    <div>
                                        <div class="fw-semibold">
                                            {{ $product->nama }}
                                        </div>

                                        <small class="text-muted">
                                            Rp {{ number_format($product->harga_jual) }}
                                        </small>
                                    </div>

                                </div>

                            </button>

                        </div>

                        {{-- QTY --}}
                        <div class="col-3">

                            <input type="number"
                                name="quantity"
                                value="1"
                                min="1"
                                class="form-control"
                                {{ $sale->status === 'COMPLETED' ? 'readonly' : '' }}>

                        </div>

                        {{-- BUTTON + --}}
                        <div class="col-2">

                            <button type="submit"
                                class="btn btn-primary w-100"
                                {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}>

                                +

                            </button>

                        </div>

                    </form>

                    @endforeach

                </div>

            </div>

        </div>

        {{-- ==================== KERANJANG ==================== --}}
        <div class="col-md-6">

            <div class="card">

                <div class="card-body">

                    <table class="table table-bordered mb-0">

                        <thead>
                            <tr>
                                <th>Produk</th>
                                <th>Harga</th>
                                <th>Qty</th>
                                <th>Subtotal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse ($sale->itemPenjualan as $item)

                            <tr>

                                <td>{{ $item->produk->nama }}</td>

                                <td>
                                    Rp {{ number_format($item->produk->harga_jual) }}
                                </td>

                                <td>

                                    <form method="POST"
                                        action="{{ route('admin.itempenjualan.update', $item->id) }}">

                                        @csrf
                                        @method('PUT')

                                        <input type="number"
                                            name="quantity"
                                            value="{{ $item->kuantitas }}"
                                            min="1"
                                            class="form-control form-control-sm"
                                            onchange="this.form.submit()">

                                    </form>

                                </td>

                                <td>
                                    Rp {{ number_format($item->subtotal) }}
                                </td>
                                
                                @can('delete', $item)
                                <td>
                                    <form method="POST"
                                        action="{{ route('admin.itempenjualan.destroy', $item->id) }}">

                                        @csrf
                                        @method('DELETE')

                                        <button class="btn btn-danger btn-sm">
                                            Hapus
                                        </button>

                                    </form>
                                @endcan
                                </td>

                            </tr>

                            @empty

                            <tr>
                                <td colspan="5" class="text-center text-muted">
                                    Keranjang kosong
                                </td>
                            </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

                {{-- FOOTER --}}
                <div class="card-footer">

                    <strong>
                        Rp {{ number_format($sale->total_pembayaran) }}
                    </strong>

                    {{-- CHECKOUT --}}
<form method="POST"
    action="{{ route('admin.penjualan.update', $sale->id) }}"
    class="mt-2"
    onsubmit="return confirm('Yakin ingin checkout?')">

    @csrf
    @method('PUT')

</form>

                        <select name="payment_method" class="form-select mb-2">

                            <option value="">
                                Pilih Pembayaran
                            </option>

                            <option value="CASH">
                                CASH
                            </option>

                            <option value="QRIS">
                                QRIS
                            </option>

                        </select>

                        <button
                            class="btn btn-success w-100"
                            {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}>

                            Checkout

                        </button>
                    </form>
                    @can('delete', $sale)

                    {{-- BATAL --}}
                    <form method="POST"
                        action="{{ route('admin.penjualan.destroy', $sale->id) }}"
                        onsubmit="return confirm('Yakin ingin membatalkan transaksi?')">

                        @csrf
                        @method('DELETE')

                        <button
                            class="btn btn-outline-danger w-100 mt-2"
                            {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}>

                            Batal Transaksi

                        </button>

                    </form>
                    @endcan
                </div>

            </div>

        </div>

    </div>

</div>

@endsection