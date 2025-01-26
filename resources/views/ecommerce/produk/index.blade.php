@extends('ecommerce.layouts.app')

@section('content')
    <div class="container my-5">
        <h3 class="mb-4">Daftar Produk</h3>

        <!-- Tab Filter Kategori -->
        <ul class="nav nav-tabs" id="categoryTab" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="all-tab" data-bs-toggle="tab" href="#all" role="tab"
                    aria-controls="all" aria-selected="true">Semua</a>
            </li>
            @foreach ($kategoris as $kategori)
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="category-{{ $kategori->id }}-tab" data-bs-toggle="tab"
                        href="#category-{{ $kategori->id }}" role="tab" aria-controls="category-{{ $kategori->id }}"
                        aria-selected="false">{{ $kategori->kategori_produk }}</a>
                </li>
            @endforeach
        </ul>

        <div class="tab-content mt-3" id="categoryTabContent">
            <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
                <div class="row row-cols-1 row-cols-md-3 g-4">
                    @foreach ($produks as $produk)
                        <div class="col">
                            <div class="card h-100 shadow-sm">
                                @php
                                    // Decode JSON images and get the first image
                                    $images = json_decode($produk->gambarproduk, true);
                                    $firstImage = $images[0] ?? 'default-image.jpg'; // Fallback to default image
                                @endphp
                                <a href="{{ route('produk.show', $produk->id) }}">
                                    <img src="{{ asset('storage/' . $firstImage) }}" class="card-img-top"
                                        alt="{{ $produk->namaproduk }}" style="height: 250px; object-fit: cover;">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $produk->namaproduk }}</h5>
                                        <p class="card-text">
                                            <strong></strong> Rp {{ number_format($produk->harga, 0, ',', '.') }}
                                        </p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Tab untuk filter kategori -->
            @foreach ($kategoris as $kategori)
                <div class="tab-pane fade" id="category-{{ $kategori->id }}" role="tabpanel"
                    aria-labelledby="category-{{ $kategori->id }}-tab">
                    <div class="row row-cols-1 row-cols-md-3 g-4">
                        @foreach ($produks->where('kategori_id', $kategori->id) as $produk)
                            <div class="col">
                                <div class="card h-100 shadow-sm">
                                    @php
                                        // Decode JSON images and get the first image
                                        $images = json_decode($produk->gambarproduk, true);
                                        $firstImage = $images[0] ?? 'default-image.jpg'; // Fallback to default image
                                    @endphp
                                    <a href="{{ route('produk.show', $produk->id) }}">
                                        <img src="{{ asset('storage/' . $firstImage) }}" class="card-img-top"
                                            alt="{{ $produk->namaproduk }}" style="height: 250px; object-fit: cover;">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $produk->namaproduk }}</h5>
                                            <p class="card-text">
                                                <strong></strong> Rp {{ number_format($produk->harga, 0, ',', '.') }}
                                            </p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
