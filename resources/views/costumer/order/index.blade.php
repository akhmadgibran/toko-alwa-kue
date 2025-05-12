{{-- index order for costumer, in here, costumer can see their order filtered based on their status --}}

@extends('layouts.app')

@section('content')
<section id="page-title" class="d-flex justify-content-center align-items-center py-5" style="min-height: 20vh" >
    <div id="container">
        <h2>Halaman Orderanmu</h2>
    </div>
</section>

<section id="order-filter" class="py-5" style="min-height: 10vh"  >
    <div id="container" >
        <div class="d-flex flex-row justify-content-center align-items-center" >
            {{-- filter -- All --}}
            {{-- filter -- Menunggu Pembayaran --}}
            <div>
                <form action="{{ route('costumer.order.filtered') }}" method="POST">
                    @csrf
                    <input type="hidden" name="status" value="Menunggu Pembayaran">
                    <button type="submit" class="btn btn-primary">Menunggu Pembayaran</button>
                </form>
                
            </div>
            {{-- filter -- Menunggu Verifikasi --}}
            <div>
                <form action="{{ route('costumer.order.filtered') }}" method="POST">
                    @csrf
                    <input type="hidden" name="status" value="Menunggu Verifikasi">
                    <button type="submit" class="btn btn-primary">Menunggu Verifikasi</button>
                </form>
            </div>
            {{-- filter -- Dalam Proses --}}
            <div>
                <form action="{{ route('costumer.order.filtered') }}" method="POST">
                    @csrf
                    <input type="hidden" name="status" value="Dalam Proses">
                    <button type="submit" class="btn btn-primary">Dalam Proses</button>
                </form>
            </div>
            {{-- filter -- Delivery --}}
            <div>
                <form action="{{ route('costumer.order.filtered') }}" method="POST">
                    @csrf
                    <input type="hidden" name="status" value="Delivery">
                    <button type="submit" class="btn btn-primary">Delivery</button>
                </form>
            </div>
            {{-- filter -- Selesai --}}
            <div>
                <form action="{{ route('costumer.order.filtered') }}" method="POST">
                    @csrf
                    <input type="hidden" name="status" value="Selesai">
                    <button type="submit" class="btn btn-primary">Selesai</button>
                </form>
            </div>
            {{-- filter -- Ditolak --}}
            <div>
                <form action="{{ route('costumer.order.filtered') }}" method="POST">
                    @csrf
                    <input type="hidden" name="status" value="Ditolak">
                    <button type="submit" class="btn btn-primary">Ditolak</button>
                </form>
            </div>
            {{-- filter -- Dibatalkan --}}
            <div>
                <form action="{{ route('costumer.order.filtered') }}" method="POST">
                    @csrf
                    <input type="hidden" name="status" value="Dibatalkan">
                    <button type="submit" class="btn btn-primary">Dibatalkan</button>
                </form>
            </div>
        </div>
    </div>
</section>

<section id="order-list" class="d-flex justify-content-center " style="min-height: 70vh" >
    <div id="container" >
        {{-- <div class="d-flex flex-row" > --}}
            @if ($costumerOrderItems->isEmpty())
                <div class="alert alert-warning" role="alert">
                    Tidak ada orderan dengan status tersebut.
                </div>
            @else
                @foreach ($costumerOrderItems as $order )
                   
                <div class="d-flex flex-row shadow-lg rounded" >
                    <div class="d-flex flex-column  justify-content-center" >
                        <p class="">{{ $order->custom_order_id }}</p>
                        <p>Rp. {{ number_format($order->total_price, 0, ',', '.') }}</p>
                    </div>
         

                    <div class="d-flex flex-row">
                        <div class="d-flex align-items-center" >
                            <p>{{ $order->status }}</p>
                        </div>
                    </div>

                    <div class="d-flex text-center justify-center align-items-center" >
                        <a href="{{ route('costumer.order.show', $order->custom_order_id) }}">
                            <p>Lihat Detail</p>
                        </a>
                    </div>
                </div>
                @endforeach
            @endif
        {{-- </div> --}}
    </div>
</section>
@endsection

