{{-- payment page --}}

@extends('layouts.app')

@section('content')
<section id="payment-success-page" class="container" style="min-height: " >
  
        <div class="d-flex justify-content-center align-items-center" style="min-height: 70vh" >
            {{-- order summary --}}
            <div class="bg-card-primer p-3 rounded-0 responsive-card" style="width: 18rem;">
                <h3>Pembayaran Berhasil</h3>
                <p>Kode Order :</p>
                <p>{{ $order->custom_order_id }}</p>
                <p>Anda telah melakukan transaksi sebesar</p>
                <p>Rp. {{ number_format($order->total_price, 0, ',', '.') }}</p>
                <a href="{{ route('costumer.order.index') }}" class="btn bg-button-primer w-100">Lihat Halaman Orderan</a>
            </div>
        </div>

</section>