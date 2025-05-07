{{-- payment page --}}

@extends('layouts.app')

@section('content')
<section id="payment-success-page" >
    <div class="container" >
        <div class="row" >
            {{-- order summary --}}
            <div>
                <h3>Pembayaran Berhasil</h3>
                <p>Anda telah melakukan transaksi sebesar Rp. {{ $order->total_price }}</p>
                <a href="{{ route('costumer.order.index') }}" class="btn btn-primary">Lihat Halaman Orderan</a>
            </div>
        </div>
    </div>
</section>