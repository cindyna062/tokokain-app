@extends('ecommerce.layouts.app')

@section('content')
    <div class="container my-5">
        <div class="row">
            <div class="col-md-6">
                @php
                    // Decode JSON images
                    $images = json_decode($produk->gambarproduk, true);
                @endphp
                @if (!empty($images) && is_array($images))
                    <div id="productCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @foreach ($images as $index => $image)
                                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                    <img src="{{ asset('storage/' . $image) }}" alt="Product Image {{ $index + 1 }}"
                                        class="d-block w-100 img-fluid">
                                </div>
                            @endforeach
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#productCarousel"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                @else
                    <img src="{{ asset('storage/default-image.jpg') }}" alt="Default Image" class="img-fluid">
                @endif
            </div>
            <div class="col-md-6">
                <h1>{{ $produk->namaproduk }}</h1>
                <p class="text-muted">{{ $produk->deskripsi }}</p>
                <h4>Rp. {{ number_format($produk->harga, 0, ',', '.') }}</h4>
                <p class="text-muted">Stok yang tersedia :{{ $produk->stok }}</p>
                <!-- Form untuk jumlah stok -->
                <form action="{{ route('cart.add') }}" method="POST">
                    @csrf
                    <input type="hidden" name="produk_id" value="{{ $produk->id }}">

                    <div class="mb-3 d-flex align-items-center">
                        <input type="number" style="max-width: 100px; width: 80%;" class="form-control" name="quantity"
                            id="quantity" placeholder="0" max="{{ $produk->stok }}" step="1" value="1" required>
                        <button type="submit" class="btn btn-primary ms-2">Tambah ke Keranjang</button>
                    </div>
                </form>

            </div>

        </div>
    </div>
@endsection
