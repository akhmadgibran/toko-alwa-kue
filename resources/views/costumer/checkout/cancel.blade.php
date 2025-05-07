{{--canceled payment page --}}

@extends('layouts.app')

@section('content')
<section id="payment-success-page" >
    <div class="container" >
        <div class="row" >
            {{-- order summary --}}
            <div>
                <h3>Pembayaran Dibatalkan</h3>
                <p>Kode Order :</p>
                <p>{{ $order->costom_order_id }}</p>
                <p>Pembayaran dibatalkan</p>
                <a href="{{ route('home') }}" class="btn btn-primary">Kembali ke Home</a>
            </div>
        </div>
    </div>
</section>