@extends('admin.layouts.app')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/datatables/datatables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/datatables/datatables.css') }}" rel="stylesheet">
@endpush

@push('style')
    <style>

    </style>
@endpush

@section('content')
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="mdi mdi-shopping-outline"></i>
            </span>
            Produk
        </h3>
        <nav aria-label="breadcrumb">
            <ul class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <span></span>Data Produk
                    <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                </li>
            </ul>
        </nav>
    </div>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Produk</h6>
                    <div class="table-responsive">
                        <table id="DTproduk" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Barang</th>
                                    <th>Harga</th>
                                    <th>Deskripsi</th>
                                    <th>Stok</th>
                                    <th>Gambar Produk</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($produks as $produk)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $produk->namaproduk }}</td>
                                        <td>{{ $produk->harga }}</td>
                                        <td>{{ $produk->deskripsi }}</td>
                                        <td>{{ $produk->stok }}</td>
                                        <td>
                                            <!-- Tombol untuk membuka modal -->
                                            <button class="btn btn-primary" data-toggle="modal" data-target="#produkModal"
                                                onclick="showImages({{ json_encode(json_decode($produk->gambarproduk)) }})">Lihat
                                                Gambar</button>
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-primary dropdown-toggle"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    Aksi
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <a class="dropdown-item" data-bs-toggle="modal"
                                                            data-bs-target="#modaledit{{ $produk->id }}">
                                                            Edit
                                                        </a>
                                                    </li>
                                                    {{-- <li>
                                                    <a class="dropdown-item" href="#"
                                                        onclick="confirmDelete({{ $penghuni->id }})">
                                                        </i> Hapus
                                                    </a>
                                                </li> --}}
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal untuk menampilkan gambar -->
    <div class="modal fade" id="produkModal" tabindex="-1" role="dialog" aria-labelledby="produkModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="produkModalLabel">Gambar Produk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex justify-content-center align-items-center" id="modalBody">
                    <!-- Gambar yang akan ditampilkan -->

                </div>
            </div>
        </div>
    </div>
@endsection

@push('plugin-scripts')
    <script src="{{ asset('assets/plugins/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/datatables.js') }}"></script>
@endpush

@push('custom-scripts')
    <script>
        var table = $('#DTproduk').DataTable({
            paging: true,
            searching: true,
            ordering: true,
            info: true,
            responsive: true,

            // Aktifkan responsif
        });

        // Function to show images in the carousel inside the modal
        function showImages(gambarproduk) {
            const modalBody = document.getElementById('modalBody');
            modalBody.innerHTML = ''; // Reset modal body

            // Create the carousel structure
            let carouselHTML = `
            <div id="produkCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner" id="carouselImages">
                    <!-- Images will be dynamically added here -->
                </div>
                <a class="carousel-control-prev" href="#produkCarousel" role="button" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#produkCarousel" role="button" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        `;

            modalBody.innerHTML = carouselHTML; // Add the carousel structure to the modal body

            const carouselInner = document.getElementById('carouselImages');

            gambarproduk.forEach((image, index) => {
                const activeClass = index === 0 ? 'active' : ''; // Set the first image as active

                const imageItem = `
                <div class="carousel-item ${activeClass}">
                    <img src="/storage/${image}" class="d-block w-100" alt="Gambar Produk">
                </div>
            `;
                carouselInner.innerHTML += imageItem; // Add each image to the carousel
            });

            // Show the modal manually
            const modal = new bootstrap.Modal(document.getElementById('produkModal'));
            modal.show();
        }

        // Ensure the backdrop is removed when the modal is closed
        const modalElement = document.getElementById('produkModal');
        modalElement.addEventListener('hidden.bs.modal', function() {
            // Manually remove the modal backdrop if it's still there
            const backdrop = document.querySelector('.modal-backdrop');
            if (backdrop) {
                backdrop.remove();
            }
        });
    </script>
@endpush
