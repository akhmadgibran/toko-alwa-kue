{{-- payment page --}}

@extends('layouts.app')

@section('content')
<section id="payment-success-page" class="container" style="min-height: 70vh" >
        <div class="d-flex justify-content-center align-items-center" style="min-height: 70vh" >
            <div class="bg-card-primer p-3 rounded-0 responsive-card" style="width: 18rem;">
                <h3>Pembayaran Gagal</h3>
                <p>Kode Order :</p>
                <p>{{ $order->custom_order_id }}</p>
                <p>Pembayaran anda gagal, Pesanan anda dibatalkan</p>
                <a href="{{ route('home') }}" class="btn bg-button-primer w-100">Kembali ke Home</a>
            </div>
    </div>
</section>
@endsection