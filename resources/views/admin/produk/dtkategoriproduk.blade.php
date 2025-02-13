@extends('admin.layouts.app')

@push('plugin-styles')
    <link href="{{ asset('assets/plugins/datatables/datatables.min.css') }}" rel="stylesheet">
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
                    <span></span>Kategori
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
                    <div class="mb-4">
                        <button type="button" class="btn btn-primary btn-xs" data-bs-toggle="modal"
                            data-bs-target="#tambahdata">
                            <i class="mdi mdi-plus icon-sm align-middle"></i> Kategori Baru
                        </button>
                    </div>
                    <div class="table-responsive">
                        <table id="DTkategoriproduk" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Kategori</th>
                                    <th>Deskripsi</th>
                                    <th>Gambar</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kategori as $k)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $k->kategori_produk }}</td>

                                        <td>{{ $k->deskripsi }}</td>
                                        <td>
                                            <!-- Tombol untuk membuka modal -->
                                            <button class="btn btn-primary" data-toggle="modal"
                                                data-target="#kategoriimgModal"
                                                onclick="showImages({{ json_encode(json_decode($k->gambar_kategori)) }})">Lihat
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
                                                            data-bs-target="#modaledit{{ $k->id }}">
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
    <!-- Modal untuk Tambah Data -->
    <div class="modal fade" id="tambahdata" aria-labelledby="tambahdataLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content bg-white rounded shadow-sm"> <!-- Container putih dan ada shadow -->
                <div class="modal-header border-bottom">
                    <h5 class="modal-title" id="modaleditLabel">Buat Kategori</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('kategori.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label for="kategori_produk">Nama Kategori</label>
                            <input type="text" class="form-control w-100" name="kategori_produk" id="kategori_produk"
                                placeholder="Nama Kategori" value="{{ old('kategori_produk') }}">
                            @error('kategori_produk')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="deskripsi">Deskripsi</label>
                            <input type="text" class="form-control w-100" name="deskripsi" id="deskripsi"
                                placeholder="Deskripsi" value="{{ old('deskripsi') }}">
                            @error('deskripsi')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="gambar_kategori">Gambar Kategori</label>
                            <input type="file" name="gambar_kategori" id="gambar_kategori" class="form-control w-100">
                            @error('gambar_kategori')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal untuk menampilkan gambar -->
    <!-- Modal untuk menampilkan gambar -->
    <div class="modal fade" id="kategoriimgModal" tabindex="-1" role="dialog" aria-labelledby="kategoriimgModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="kategoriimgModalLabel">Gambar Produk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modalBody">
                    <!-- Gambar yang akan ditampilkan -->
                </div>
            </div>
        </div>
    </div>
@endsection

@push('plugin-scripts')
    <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/datatables.js') }}"></script>
@endpush

@push('custom-scripts')
    <script>
        $(document).ready(function() {

            var table = $('#DTkategoriproduk').DataTable({
                paging: true,
                searching: true,
                ordering: true,
                info: true,
                responsive: true,

                // Aktifkan responsif
            });

            window.showImages = function(gambar_kategori) {
                const modalBody = document.getElementById('modalBody');

                // Check if modalBody exists
                if (!modalBody) {
                    console.error("Modal body element not found!");
                    return;
                }

                // Ensure gambar_kategori is an array
                if (!Array.isArray(gambar_kategori)) {
                    gambar_kategori = [
                    gambar_kategori]; // If it's not an array, make it one (assuming it's a single image)
                }

                modalBody.innerHTML = ''; // Reset modal body

                // Loop through each image and create an image element
                gambar_kategori.forEach(image => {
                    const imgElement = document.createElement('img');
                    imgElement.src = `/storage/${image}`; // Set the image source
                    imgElement.classList.add('img-fluid'); // Make sure the image fits within the modal
                    imgElement.alt = "Gambar Produk";

                    // Append the image element to the modal body
                    modalBody.appendChild(imgElement);
                });

                // Show the modal manually
                const modal = new bootstrap.Modal(document.getElementById('kategoriimgModal'));
                modal.show();
            };


            // Ensure the backdrop is removed when the modal is closed
            const modalElement = document.getElementById('kategoriimgModal');
            modalElement.addEventListener('hidden.bs.modal', function() {
                const backdrop = document.querySelector('.modal-backdrop');
                if (backdrop) {
                    backdrop.remove();
                }
            });
        });
    </script>
@endpush
