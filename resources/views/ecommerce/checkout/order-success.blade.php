@extends('ecommerce.layouts.app')

@section('content')
    <div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
        <div class="card" style="width: 100%; max-width: 500px;">
            <div class="card-body text-center">
                <h5 class="card-title">Pesanan Berhasil</h5>
                <p class="card-text">Terima kasih telah memesan! Pesanan Anda telah berhasil dibuat.</p>
                <a href="{{ url('/') }}" class="btn btn-primary">Kembali ke Beranda</a>
            </div>
        </div>
    </div>
@endsection
