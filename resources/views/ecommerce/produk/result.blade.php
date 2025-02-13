@extends('ecommerce.layouts.app')

@section('content')
<div class="container mt-4">
    <h3 class="mb-3 mt-4">Hasil Pencarian untuk "{{ $query }}"</h3>

    @if($results->isEmpty())
        <div class="alert alert-warning">Tidak ada hasil yang ditemukan.</div>
    @else
        <div class="row">
            @foreach($results as $produk)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        @php
                            $images = json_decode($produk->gambarproduk, true);
                            $firstImage = $images[0] ?? 'default-image.jpg'; // Fallback to default image
                        @endphp
                        <img src="{{ asset('storage/' . $firstImage) }}" class="card-img-top" alt="{{ $produk->namaproduk }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $produk->namaproduk }}</h5>
                            <p class="card-text">{{ Str::limit($produk->deskripsi, 100) }}</p>
                            <p class="card-text"><strong>Harga:</strong> Rp{{ number_format($produk->harga, 0, ',', '.') }}</p>
                            <p class="card-text"><strong>Stok:</strong> {{ $produk->stok }}</p>
                            <a href="#" class="btn btn-primary">Lihat Detail</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
