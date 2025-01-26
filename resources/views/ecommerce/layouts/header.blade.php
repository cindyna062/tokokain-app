@push('style')
    <style>
        #suggestions-box {
            max-height: 200px;
            overflow-y: auto;
            border: 1px solid #ddd;
            border-top: none;
            background-color: #fff;
        }

        #suggestions-box .list-group-item {
            cursor: pointer;
        }

        #suggestions-box .list-group-item:hover {
            background-color: #f8f9fa;
        }
    </style>
@endpush

<nav class="navbar navbar-expand-lg navbar-light fixed-top bg-light">
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
                <form class="d-flex mx-lg-3 flex-grow-1" action="{{ route('search') }}" method="GET">
                    <div class="position-relative w-100">
                        <!-- Ikon pencarian di dalam input -->
                        <span class="mdi mdi-store-search position-absolute top-50 start-0 translate-middle-y ps-3"
                            style="font-size: 1.25rem;"></span>
                        <input id="search-input" class="form-control ps-5" name="search" type="search"
                            placeholder="Cari produk, merek, atau kategori" aria-label="Search" autocomplete="off">
                        <div id="suggestions-box" class="list-group position-absolute w-100"
                            style="z-index: 100; display: none;">
                            <!-- Saran akan muncul di sini -->
                        </div>
                    </div>
                </form>

                <!-- Akun dan Keranjang -->
                <ul class="navbar-nav d-flex align-items-center">
                    <!-- Wishlist -->
                    <li class="nav-item">
                        <a href="/user/produk" class="nav-link text-dark">
                            <i class="mdi mdi-store-outline"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link text-dark">
                            <i class="mdi mdi-heart"></i>
                        </a>
                    </li>

                    @auth
                        <!-- Keranjang -->
                        <li class="nav-item me-3">
                            <a href="#" class="nav-link text-dark" data-bs-toggle="offcanvas"
                                data-bs-target="#offcanvasCart" aria-controls="offcanvasCart">
                                <i class="mdi mdi-cart"></i>
                            </a>
                        </li>

                        <!-- Akun -->
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
                            <a href="/register" class="btn btn-primary">Sign Up</a>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </div>
</nav>

@auth
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
@endauth

@push('custom-scripts')
    <script>
        $(document).ready(function() {
            $('#search-input').on('keyup', function() {
                const query = $(this).val();
                if (query.length > 1) { // Hanya mulai mencari jika lebih dari 2 karakter
                    $.ajax({
                        url: "{{ route('search.suggestions') }}",
                        type: "GET",
                        data: {
                            search: query
                        },
                        success: function(data) {
                            let suggestions = '';
                            if (data.length > 0) {
                                data.forEach(item => {
                                    suggestions +=
                                        `<a href="/produk/${item.id}" class="list-group-item list-group-item-action">${item.namaproduk}</a>`;
                                });
                            } else {
                                suggestions =
                                    '<div class="list-group-item">Tidak ada hasil ditemukan</div>';
                            }
                            $('#suggestions-box').html(suggestions).show();
                        }
                    });
                } else {
                    $('#suggestions-box').hide(); // Sembunyikan box jika input kosong
                }
            });

            // Sembunyikan saran jika klik di luar
            $(document).on('click', function(e) {
                if (!$(e.target).closest('#search-input, #suggestions-box').length) {
                    $('#suggestions-box').hide();
                }
            });
        });
    </script>
@endpush
