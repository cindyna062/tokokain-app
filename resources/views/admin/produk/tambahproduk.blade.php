@extends('admin.layouts.app')

@push('plugin-styles')
    <link href="https://cdn.jsdelivr.net/npm/dropify@0.2.2/dist/css/dropify.min.css" rel="stylesheet">
@endpush

@push('style')
    <style>
        #preview-container {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 10px;
            background-color: #f0f0f0;
            /* Light gray background */
            border-radius: 10px;
            /* Rounded corners */
            padding: 10px;
            /* Some padding inside the container */
        }

        .img-container {
            position: relative;
            margin-bottom: 15px;
            width: calc(33.33% - 10px);
            /* Default: 3 images per row */
        }

        .img-container img {
            width: 100%;
            height: 200px;
            border-radius: 5px;
        }

        @media (max-width: 768px) {
            .img-container {
                width: calc(50% - 10px);
                /* 2 images per row on tablets */
            }
        }

        @media (max-width: 480px) {
            .img-container {
                width: 100%;
                /* 1 image per row on small screens */
            }
        }
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
                    <span></span>Tambah Produk
                    <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                </li>
            </ul>
        </nav>
    </div>
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Tambah Produk</h4>
                <p class="card-description">Masukkan data secara lengkap</p>
                <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="namaproduk">Nama Produk</label>
                        <input type="text" class="form-control" name="namaproduk" id="namaproduk"
                            placeholder="Nama Produk" value="{{ old('namaproduk') }}">
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <input type="text" class="form-control" name="deskripsi" id="deskripsi" placeholder="Deskripsi"
                            value="{{ old('deskripsi') }}">
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label for="stok">Kategori</label>
                            <!-- Select2 Dropdown for Categories -->
                            <select id="category_select" name="kategori_id" style="width: 100%">
                                <option value="">Pilih Kategori</option>
                                @foreach ($kategori as $k)
                                    <option value="{{ $k->id }}">{{ $k->kategori_produk }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="stok">Stok</label>
                            <input type="number" class="form-control" name="stok" id="stok" placeholder="0">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="harga">Harga</label>
                        <input type="number" class="form-control" name="harga" id="harga" placeholder="Harga"
                            value="{{ old('harga') }}">
                    </div>
                    <div class="form-group">
                        <input type="file" id="gambarproduk" name="gambarproduk[]" multiple accept="image/*"
                            onchange="previewImages()" class="file-upload-default">
                        <label for="gambarproduk" class="form-label">Upload Gambar Produk</label>
                        <div class="input-group col-xs-12">
                            <span class="input-group-append">
                                <button class="file-upload-browse btn btn-gradient-primary py-3"
                                    type="button">Upload</button>
                            </span>
                        </div>

                        <!-- Carousel Container -->
                        <div id="preview-container" style="display: flex; gap: 10px; margin-top: 10px;">
                            <!-- File preview akan ditambahkan di sini -->

                        </div>
                    </div>
                    <button type="submit" class="btn btn-gradient-primary me-2">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('plugin-scripts')
    <script src="https://cdn.jsdelivr.net/npm/dropify@0.2.2/dist/js/dropify.min.js"></script>
@endpush

@push('custom-scripts')
    <script>
        $(document).ready(function() {
            $('#category_select').select2({
                tags: true, // Allow users to create new categories as tags
                placeholder: 'Pilih atau Buat Kategori Baru'
            });
        });

        function previewImages() {
            const input = document.getElementById('gambarproduk');
            const files = input.files;
            const previewContainer = document.getElementById('preview-container');

            // Untuk memastikan gambar yang sudah ada tidak terhapus
            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        // Membuat elemen gambar untuk preview
                        const imgContainer = document.createElement('div');
                        imgContainer.style.position = 'relative';
                        imgContainer.style.marginBottom = '15px';

                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.classList.add('img-fluid');
                        img.style.height = '200px';
                        img.style.objectFit = 'cover';

                        // Tombol hapus gambar
                        const deleteButton = document.createElement('button');
                        deleteButton.textContent = 'Hapus';
                        deleteButton.className = 'btn btn-danger btn-sm';
                        deleteButton.style.position = 'absolute';
                        deleteButton.style.top = '10px';
                        deleteButton.style.right = '10px';
                        deleteButton.onclick = function() {
                            imgContainer.remove();
                        };

                        imgContainer.appendChild(img);
                        imgContainer.appendChild(deleteButton);
                        previewContainer.appendChild(imgContainer);
                    };

                    // Membaca gambar sebagai DataURL
                    reader.readAsDataURL(file);
                }
            }
        }
    </script>
@endpush
