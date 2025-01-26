@extends('ecommerce.layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h3 class="mb-4">Detail Checkout</h3>
                <form action="{{ route('checkout.submit') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat Pengiriman</label>
                        <textarea name="alamat" id="alamat" class="form-control" rows="3" required></textarea>
                    </div>


                    <h5>Ringkasan Pesanan</h5>
                    <ul class="list-group mb-3">
                        @php
                            $total = 0;
                        @endphp
                        @foreach ($cart->items as $item)
                            @php
                                $subtotal = $item->produk->harga * $item->quantity;
                                $total += $subtotal;
                            @endphp
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $item->produk->namaproduk }} x{{ $item->quantity }}
                                <span>Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                            </li>
                        @endforeach
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <strong>Total</strong>
                            <strong>Rp {{ number_format($total, 0, ',', '.') }}</strong>
                        </li>
                    </ul>

                    <button type="submit" class="btn btn-primary w-100">Konfirmasi Pesanan</button>
                </form>
            </div>
        </div>
    </div>
@endsection
