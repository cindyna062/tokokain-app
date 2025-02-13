@extends('ecommerce.layouts.app')

@section('content')
    <section id="billboard" class="py-5" style="background-color: #fac3ff">
        <div class="container" style="background-color: #fac3ff">
            <div class="row justify-content-center">
                <h1 class="section-title text-center mt-4" data-aos="fade-up">
                    Stoffa
                </h1>
                <div class="col-md-6 text-center" data-aos="fade-up" data-aos-delay="300">
                    <p>
                        Temukan berbagai kategori kain khas Indonesia yang terbuat dari serat alami dan nyaman digunakan.
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="swiper main-swiper py-4" data-aos="fade-up" data-aos-delay="600">
                    <div class="swiper-wrapper border-animation-left">
                        @foreach ($kategoriproduks as $kategori)
                            <div class="swiper-slide">
                                <div class="banner-item image-zoom-effect">
                                    <div class="image-holder">
                                        @php
                                            $gambar = json_decode($kategori->gambar_kategori, true);
                                            $gambarPath = is_array($gambar) ? $gambar[0] : $kategori->gambar_kategori;
                                        @endphp
                                        <a href="#">
                                            <img src="{{ asset('storage/' . str_replace('gambar_kategori/', 'gambar_kategori/', $gambarPath)) }}"
                                                alt="{{ $kategori->kategori_produk }}" class="img-fluid" />
                                        </a>
                                    </div>
                                    <div class="banner-content py-4">
                                        <h5 class="element-title text-uppercase">
                                            <a href="#" class="item-anchor">{{ $kategori->kategori_produk }}</a>
                                        </h5>
                                        <p>
                                            {{ $kategori->deskripsi }}
                                        </p>
                                        <div class="btn-left">
                                            <a href="#"
                                                class="btn-link fs-6 text-uppercase item-anchor text-decoration-none">Lihat
                                                Produk</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
                <div class="icon-arrow icon-arrow-left">
                    <svg width="50" height="50" viewBox="0 0 24 24">
                        <use xlink:href="#arrow-left"></use>
                    </svg>
                </div>
                <div class="icon-arrow icon-arrow-right">
                    <svg width="50" height="50" viewBox="0 0 24 24">
                        <use xlink:href="#arrow-right"></use>
                    </svg>
                </div>
            </div>
        </div>
    </section>

    <section class="features py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-3 text-center" data-aos="fade-in" data-aos-delay="0">
                    <div class="py-5">
                        <svg width="38" height="38" viewBox="0 0 24 24">
                            <use xlink:href="#calendar"></use>
                        </svg>
                        <h4 class="element-title text-capitalize my-3">
                            Pre-Order
                        </h4>
                        <p>
                            Anda bisa melakukan pre-order untuk produk yang belum tersedia.
                        </p>
                    </div>
                </div>
                <div class="col-md-3 text-center" data-aos="fade-in" data-aos-delay="300">
                    <div class="py-5">
                        <svg width="38" height="38" viewBox="0 0 24 24">
                            <use xlink:href="#shopping-bag"></use>
                        </svg>
                        <h4 class="element-title text-capitalize my-3">
                            Bawa di Toko
                        </h4>
                        <p>
                            Anda bisa memesan produk dan mengambilnya di toko kami.
                        </p>
                    </div>
                </div>
                <div class="col-md-3 text-center" data-aos="fade-in" data-aos-delay="600">
                    <div class="py-5">
                        <svg width="38" height="38" viewBox="0 0 24 24">
                            <use xlink:href="#gift"></use>
                        </svg>
                        <h4 class="element-title text-capitalize my-3">
                            Kemasan Spesial
                        </h4>
                        <p>
                            Kami menyediakan kemasan spesial untuk produk yang Anda beli.
                        </p>
                    </div>
                </div>
                <div class="col-md-3 text-center" data-aos="fade-in" data-aos-delay="900">
                    <div class="py-5">
                        <svg width="38" height="38" viewBox="0 0 24 24">
                            <use xlink:href="#arrow-cycle"></use>
                        </svg>
                        <h4 class="element-title text-capitalize my-3">
                            Pengembalian Mudah
                        </h4>
                        <p>
                            Anda bisa mengembalikan produk yang tidak sesuai dengan keinginan Anda.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- <section class="categories overflow-hidden">
        <div class="container">
            <div class="open-up" data-aos="zoom-out">
                <div class="row">
                    <div class="col-md-4">
                        <div class="cat-item image-zoom-effect">
                            <div class="image-holder">
                                <a href="index.html">
                                    <img src="images/cat-item1.jpg" alt="categories" class="product-image img-fluid" />
                                </a>
                            </div>
                            <div class="category-content">
                                <div class="product-button">
                                    <a href="index.html" class="btn btn-common text-uppercase">Shop for men</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="cat-item image-zoom-effect">
                            <div class="image-holder">
                                <a href="index.html">
                                    <img src="images/cat-item2.jpg" alt="categories" class="product-image img-fluid" />
                                </a>
                            </div>
                            <div class="category-content">
                                <div class="product-button">
                                    <a href="index.html" class="btn btn-common text-uppercase">Shop for women</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="cat-item image-zoom-effect">
                            <div class="image-holder">
                                <a href="index.html">
                                    <img src="images/cat-item3.jpg" alt="categories" class="product-image img-fluid" />
                                </a>
                            </div>
                            <div class="category-content">
                                <div class="product-button">
                                    <a href="index.html" class="btn btn-common text-uppercase">Shop accessories</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
    <section id="new-arrival" class="new-arrival product-carousel py-5 position-relative overflow-hidden">
        <div class="container">
            <div class="d-flex flex-wrap justify-content-between align-items-center mt-5 mb-3">
                <h4 class="text-uppercase">Produk Baru</h4>
                <a href="/produkterbaru" class="btn-link">Lihat Semua Produk</a>
            </div>
            <div class="swiper product-swiper open-up" data-aos="zoom-out">
                <div class="swiper-wrapper d-flex">
                    @foreach ($produkbaru as $p)
                        @php
                            // Decode JSON images and get the first image
                            $images = json_decode($p->gambarproduk, true);
                            $firstImage = $images[0] ?? 'default-image.jpg'; // Fallback to default image
                        @endphp
                        <div class="swiper-slide">
                            <div class="product-item image-zoom-effect link-effect">
                                <div class="image-holder position-relative">
                                    <a href="{{ route('produk.show', $p->id) }}">
                                        <img src="{{ asset('storage/' . $firstImage) }}" alt="{{ $p->namaproduk }}"
                                            class="product-image img-fluid" />
                                    </a>
                                    <a href="#" class="btn-icon btn-wishlist">
                                        <svg width="24" height="24" viewBox="0 0 24 24">
                                            <use xlink:href="#heart"></use>
                                        </svg>
                                    </a>
                                    <div class="product-content">
                                        <h5 class="text-uppercase fs-5 mt-3">
                                            <a href="">{{ $p->namaproduk }}</a>
                                        </h5>
                                        <a href="#" class="text-decoration-none" data-after="Add to cart">
                                            <span>Rp. {{ number_format($p->harga) }}</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="swiper-pagination"></div>
            </div>
            <div class="icon-arrow icon-arrow-left">
                <svg width="50" height="50" viewBox="0 0 24 24">
                    <use xlink:href="#arrow-left"></use>
                </svg>
            </div>
            <div class="icon-arrow icon-arrow-right">
                <svg width="50" height="50" viewBox="0 0 24 24">
                    <use xlink:href="#arrow-right"></use>
                </svg>
            </div>
        </div>
    </section>

    {{-- <section class="collection position-relative py-5" style="background-color: #fac3ff">
        <div class="container">
            <div class="row">
                <div class="title-xlarge text-uppercase txt-fx domino">
                    Collection
                </div>
                <div class="collection-item d-flex flex-wrap my-5">
                    <div class="col-md-6 column-container">
                        <div class="image-holder">
                            <img src="images/single-image-2.jpg" alt="collection" class="product-image img-fluid" />
                        </div>
                    </div>
                    <div class="col-md-6 column-container bg-white">
                        <div class="collection-content p-5 m-0 m-md-5">
                            <h3 class="element-title text-uppercase">
                                Classic winter collection
                            </h3>
                            <p>
                                Dignissim lacus, turpis ut suspendisse vel tellus. Turpis
                                purus, gravida orci, fringilla a. Ac sed eu fringilla odio mi.
                                Consequat pharetra at magna imperdiet cursus ac faucibus sit
                                libero. Ultricies quam nunc, lorem sit lorem urna, pretium
                                aliquam ut. In vel, quis donec dolor id in. Pulvinar commodo
                                mollis diam sed facilisis at cursus imperdiet cursus ac
                                faucibus sit faucibus sit libero.
                            </p>
                            <a href="#" class="btn btn-dark text-uppercase mt-3">Shop Collection</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
@endsection

@push('custom-scripts')
    <script></script>
@endpush
