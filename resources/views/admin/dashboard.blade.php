{{-- admin dashboard --}}
@extends('layouts.app')

@section('content')
<section id="superadmin-dashboard" class="container mt-5" style="min-height: 100vh;" >
    <div>
        <h2>Admin Dashboard</h2>
    </div>
    <div class="d-flex flex-column bg-card-primer p-3" >
        <div class="d-flex flex-row gap-2 justify-content-between">
            <div class="d-flex flex-row gap-5">
                <div>
                    <h3 class="title-script">Orderan Butuh Penanganan</h3>
                    <p>Orderan berstatus Menunggu Verifikasi, dan Dalam Proses</p>
                </div>
                <div class="d-flex align-items-center">
                    <h3>{{ $ordersNeedAttention }}</h3>
                </div>
            </div>
            <div class="d-flex flex-row gap-5">
                <div>
                    <h3 class="title-script">Orderan Delivery</h3>
                    <p>Orderan berstatus Delivery</p>
                </div>
                <div class="d-flex align-items-center">
                    <h3>{{ $ordersInDelivery }}</h3>
                </div>
            </div>
            <div class="d-flex flex-row gap-5">
                <div>
                    <h3 class="title-script">Orderan Selesai</h3>
                    <p>Orderan berstatus Selesai</p>
                </div>
                <div class="d-flex align-items-center">
                    <h3>{{ $ordersAlreadyDone }}</h3>
                </div>
            </div>
        </div>

        {{-- fast track feature --}}
        <div class="d-flex flex-column">
            <h3 class="title-script">Fast Track Order</h3>
        
            {{-- Fast track logic that move the value inputed into the php route --}}
            @php
                $baseRoute = Auth::user()->usertype == 'admin'
                    ? route('admin.order.show', ['custom_order_id' => '__id__'])
                    : route('superadmin.order.show', ['custom_order_id' => '__id__']);
            @endphp

            <div class="d-flex flex-column gap-2">
                <input class="form-control" type="text" name="custom_order_id" id="custom_order_id" placeholder="Masukan Order ID">
                <a href="#" id="goToOrder" class="btn bg-button-primer">Go to Order</a>
                <a href="{{ route('admin.order.index') }}" class="btn bg-button-primer"> Ke Halaman Kelola Orderan</a>
            </div>


            <script>
                document.getElementById('goToOrder').addEventListener('click', function (e) {
                    e.preventDefault();
                    const orderId = document.getElementById('custom_order_id').value.trim();

                    if (orderId) {
                        const url = "{{ $baseRoute }}".replace('__id__', encodeURIComponent(orderId));
                        window.location.href = url;
                    } else {
                        alert('Please enter an order ID.');
                    }
                });
            </script>

            {{--end Fast track logic that move the value inputed into the php route --}}

        </div>
        {{-- end fast track feature --}}
    </div>
</section>
@endsection