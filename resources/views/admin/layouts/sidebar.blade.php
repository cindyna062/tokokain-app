<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/') }}">
                <span class="menu-title">Dashboard</span>
                <i class="mdi mdi-home menu-icon"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#icons" aria-expanded="false" aria-controls="icons">
                <span class="menu-title">Product</span>
                <i class="mdi mdi-shopping-outline menu-icon"></i>
            </a>
            <div class="collapse" id="icons">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/produk') }}">Data Produk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/produk/tambahproduk') }}">Tambah Produk</a>
                    </li>
                    {{-- <li class="nav-item">
                        <a class="nav-link" href="{{ url('/kategoriproduk') }}">Kategori Produk</a>
                    </li> --}}
                </ul>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#forms" aria-expanded="false" aria-controls="forms">
                <span class="menu-title">Order</span>
                <i class="mdi mdi-cart-plus menu-icon"></i>
            </a>
            {{-- <div class="collapse" id="forms">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="../pages/forms/basic_elements.html">Form Elements</a>
                    </li>
                </ul>
            </div> --}}
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#charts" aria-expanded="false" aria-controls="charts">
                <span class="menu-title">Laporan</span>
                <i class="mdi mdi-file-chart menu-icon"></i>
            </a>
            {{-- <div class="collapse" id="charts">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="../pages/charts/chartjs.html">ChartJs</a>
                    </li>
                </ul>
            </div> --}}
        </li>
        {{-- <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#tables" aria-expanded="false" aria-controls="tables">
                <span class="menu-title">Tables</span>
                <i class="mdi mdi-table-large menu-icon"></i>
            </a>
            <div class="collapse" id="tables">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="../pages/tables/basic-table.html">Basic table</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
                <span class="menu-title">User Pages</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-lock menu-icon"></i>
            </a>
            <div class="collapse" id="auth">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="../pages/samples/blank-page.html"> Blank Page </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../pages/samples/login.html"> Login </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../pages/samples/register.html"> Register </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../pages/samples/error-404.html"> 404 </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../pages/samples/error-500.html"> 500 </a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="../docs/documentation.html" target="_blank">
                <span class="menu-title">Documentation</span>
                <i class="mdi mdi-file-document-box menu-icon"></i>
            </a>
        </li> --}}
    </ul>
</nav>
