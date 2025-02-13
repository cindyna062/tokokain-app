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

                    <div class="mb-3">
                        <label for="jenis_pengiriman" class="form-label">Jenis Pengiriman</label>
                        <select name="jenis_pengiriman" id="jenis_pengiriman" class="form-control" required>
                            <option value="">Pilih Pengiriman</option>
                            <option value="reguler">Reguler</option>
                            <option value="ekspress">Ekspress</option>
                            <option value="ambil_di_toko">Ambil di Toko</option>
                        </select>
                    </div>

                    <div class="mb-3" id="pilihan_kurir" style="display: none;">
                        <label for="kurir" class="form-label">Pilih Kurir</label>
                        <select name="kurir" id="kurir" class="form-control">
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="jenis_pembayaran" class="form-label">Jenis Pembayaran</label>
                        <select name="jenis_pembayaran" id="jenis_pembayaran" class="form-control" required>
                            <option value="transfer">Transfer</option>
                            <option value="cod">COD</option>
                        </select>
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
                            <strong>Total Produk</strong>
                            <strong>Rp {{ number_format($total, 0, ',', '.') }}</strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <strong>Biaya Pengiriman</strong>
                            <strong id="biaya_pengiriman">Rp 0</strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <strong>Total Bayar</strong>
                            <strong id="total_bayar">Rp {{ number_format($total, 0, ',', '.') }}</strong>
                        </li>
                    </ul>

                    <button type="submit" class="btn btn-primary w-100">Konfirmasi Pesanan</button>
                </form>

            </div>
        </div>
    </div>
@endsection

@push('custom-scripts')
    <script>
        const biayaPengiriman = {
            reguler: {
                JNE: 12000,
                JNT: 11000,
                SICEPAT: 10000
            },
            ekspress: {
                Gojek: 20000,
                Grab: 21000
            }
        };

        document.getElementById("jenis_pengiriman").addEventListener("change", function() {
            const jenis = this.value;
            const kurirSelect = document.getElementById("kurir");
            const pilihanKurirDiv = document.getElementById("pilihan_kurir");
            kurirSelect.innerHTML = "";

            if (biayaPengiriman[jenis]) {
                pilihanKurirDiv.style.display = "block";
                Object.keys(biayaPengiriman[jenis]).forEach(kurir => {
                    let option = new Option(
                        `${kurir} - Rp ${biayaPengiriman[jenis][kurir].toLocaleString()}`, kurir);
                    kurirSelect.add(option);
                });
            } else {
                pilihanKurirDiv.style.display = "none";
            }
            updateTotal();
        });

        document.getElementById("kurir").addEventListener("change", updateTotal);

        function updateTotal() {
            let totalProduk = {{ $total }};
            let jenis = document.getElementById("jenis_pengiriman").value;
            let kurir = document.getElementById("kurir").value;
            let biaya = biayaPengiriman[jenis]?.[kurir] || 0;

            document.getElementById("biaya_pengiriman").innerText = `Rp ${biaya.toLocaleString()}`;
            document.getElementById("total_bayar").innerText = `Rp ${(totalProduk + biaya).toLocaleString()}`;
        }
    </script>
@endpush
