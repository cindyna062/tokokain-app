@extends('ecommerce.layouts.app')

@section('content')
    <div class="container my-5">
        <h3 class="mb-4">Produk Terbaru</h3>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            @foreach ($produkTerbaru as $produk)
                <div class="col">
                    <div class="card h-100 shadow-sm">
                        @php
                            $images = json_decode($produk->gambarproduk, true);
                            $firstImage = $images[0] ?? 'default-image.jpg'; // Fallback to default image
                        @endphp
                        <a href="{{ route('produk.show', $produk->id) }}">
                            <img src="{{ asset('storage/' . $firstImage) }}" class="card-img-top"
                                alt="{{ $produk->namaproduk }}" style="height: 250px; object-fit: cover;">
                            <div class="card-body">
                                <h5 class="card-title">{{ $produk->namaproduk }}</h5>
                                <p class="card-text">
                                    <strong>Harga:</strong> Rp {{ number_format($produk->harga, 0, ',', '.') }}
                                </p>
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
