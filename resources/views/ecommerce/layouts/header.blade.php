<nav class="navbar navbar-expand-lg navbar-light border-bottom">
    <div class="container-fluid">
        <!-- Logo -->
        <a class="navbar-brand" href="/">
            <img src="{{ asset('assets/logo/logo-panjang.svg') }}" alt="Logo" style="height: 50px;">
        </a>

        <!-- Button Toggler untuk responsive menu -->
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
            aria-controls="offcanvasNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Offcanvas Navbar -->
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <!-- Kategori Dropdown -->


                <!-- Form Pencarian -->
                <form class="d-flex mx-lg-3 flex-grow-1">
                    <input class="form-control" type="search" placeholder="Cari produk, merek, atau kategori"
                        aria-label="Search">
                    <button class="btn btn-primary" type="submit">
                        <i class="bi bi-search"></i>
                    </button>
                </form>

                <!-- Akun dan Keranjang -->

                <ul class="navbar-nav d-flex align-items-center">
                    <!-- Wishlist -->

                    <li class="nav-item me-3">
                        <a href="/user/produk" class="nav-link text-dark">
                            <i class="bi bi-heart"></i> <span class="">Produk</span>
                        </a>
                    </li>
                    <li class="nav-item me-3">
                        <a href="#" class="nav-link text-dark">
                            <i class="bi bi-heart"></i> <span class="">Wishlist</span>
                        </a>
                    </li>
                    <!-- Keranjang -->
                    <li class="nav-item me-3">
                        <a href="#" class="nav-link text-dark" data-bs-toggle="offcanvas"
                            data-bs-target="#offcanvasCart" aria-controls="offcanvasCart">
                            <i class="bi bi-cart"></i> <span class="">Cart</span>
                        </a>
                    </li>
                    <!-- Akun -->

                    @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="me-2 icon-md" data-feather="user"></i>{{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="mdi mdi-cached me-2 text-success"></i> Edit Password
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="/logout">
                                    <i class="mdi mdi-logout me-2 text-primary"></i> SignOut
                                </a>
                            </div>
                        </li>
                    @endauth
                    <!-- Login/Signup (Tampilkan jika belum login) -->
                    @guest
                        <li class="nav-item me-2">
                            <a href="{{ route('login') }}" class="btn btn-outline-primary">Login</a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="btn btn-primary">Sign Up</a>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </div>
</nav>

<!-- Offcanvas Cart -->
<div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="offcanvasCart"
    aria-labelledby="offcanvasCartLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasCartLabel">Keranjang</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">

        @if ($cart && $cart->items->count())
            <ul class="list-group mb-3">
                @foreach ($cart->items as $item)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ $item->produk->namaproduk }} x {{ $item->quantity }}
                        <span>Rp {{ number_format($item->produk->harga * $item->quantity, 0, ',', '.') }}</span>
                    </li>
                @endforeach
            </ul>
            <a href="{{ route('checkout.detail') }}" class="btn btn-primary">Checkout</a>
        @else
            <p>Keranjang Anda kosong.</p>
        @endif
    </div>
</div>
