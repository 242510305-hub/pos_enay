@extends('layouts.app')

@section('title', 'Tambah Produk')

@section('content')
<div class="container py-4">
    <div class="card border-0 shadow-sm rounded-3">
        <div class="card-body p-4">
            <h4 class="card-title mb-4">Tambah Produk Baru</h4>

            <form action="{{ route('admin.produk.store') }}" 
                  method="POST"
                  enctype="multipart/form-data">
                @include('Produk._form')
            </form>
        </div>
    </div>
</div>
@endsection