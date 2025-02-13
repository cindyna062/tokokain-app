@extends('ecommerce.layouts.app')

@section('content')
<div class="container">
    <h2>Daftar Orderan</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Alamat</th>
                <th>Pengiriman</th>
                <th>Pembayaran</th>
                <th>Total</th>
                <th>Detail</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $index => $order)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $order->alamat }}</td>
                <td>{{ ucfirst($order->jenis_pengiriman) }} ({{ $order->kurir ?? 'N/A' }})</td>
                <td>{{ strtoupper($order->jenis_pembayaran) }}</td>
                <td>Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                <td>
                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#orderModal{{ $order->id }}">
                        Lihat Detail
                    </button>
                </td>
            </tr>

            <!-- Modal Detail Order -->
            <div class="modal fade" id="orderModal{{ $order->id }}" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Detail Order #{{ $order->id }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p><strong>Alamat:</strong> {{ $order->alamat }}</p>
                            <p><strong>Jenis Pengiriman:</strong> {{ ucfirst($order->jenis_pengiriman) }} ({{ $order->kurir ?? 'N/A' }})</p>
                            <p><strong>Jenis Pembayaran:</strong> {{ strtoupper($order->jenis_pembayaran) }}</p>
                            <p><strong>Total:</strong> Rp {{ number_format($order->total, 0, ',', '.') }}</p>
                            <hr>
                            <h5>Produk yang Dipesan:</h5>
                            <ul class="list-group">
                                @foreach ($order->items as $item)
                                <li class="list-group-item d-flex justify-content-between">
                                    {{ $item->produk->namaproduk }} x{{ $item->quantity }}
                                    <span>Rp {{ number_format($item->harga * $item->quantity, 0, ',', '.') }}</span>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Modal -->

            @endforeach
        </tbody>
    </table>
</div>
@endsection
