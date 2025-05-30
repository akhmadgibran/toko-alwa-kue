{{-- index order for costumer, in here, costumer can see their order filtered based on their status --}}

@extends('layouts.app')

@section('content')
    <section id="page-title" class="d-flex justify-content-center align-items-center py-3" style="min-height: 20vh">
        <div id="container">
            <h2 class="title-script">Halaman Orderanmu</h2>
        </div>
    </section>

    <section id="order-filter" class="py-5" style="min-height: 10vh">
        <div id="container">
            <div class="d-none d-lg-flex flex-row justify-content-center align-items-center gap-2">
                {{-- filter -- All --}}
                {{-- filter -- Menunggu Pembayaran --}}
                <div>
                    <form action="{{ route('costumer.order.filtered') }}" method="POST">
                        @csrf
                        <input type="hidden" name="status" value="Menunggu Pembayaran">
                        <button type="submit" class="btn bg-button-primer d-flex align-items-center gap-1">
                            <img src="{{ asset('icons/material-symbols-light_payments-outline-sharp.png') }}" style="width: 35px;" alt="">
                            Menunggu Pembayaran
                        </button>
                    </form>

                </div>
                {{-- filter -- Menunggu Verifikasi --}}
                <div>
                    <form action="{{ route('costumer.order.filtered') }}" method="POST">
                        @csrf
                        <input type="hidden" name="status" value="Menunggu Verifikasi">
                        <button type="submit" class="btn bg-button-primer d-flex align-items-center gap-1">
                            <img src="{{ asset('icons/weui_time-outlined.png') }}" style="width: 35px;" alt="">
                            Menunggu Verifikasi</button>
                    </form>
                </div>
                {{-- filter -- Dalam Proses --}}
                <div>
                    <form action="{{ route('costumer.order.filtered') }}" method="POST">
                        @csrf
                        <input type="hidden" name="status" value="Dalam Proses">
                        <button type="submit" class="btn bg-button-primer d-flex align-items-center gap-1">
                            <img src="{{ asset('icons/iconoir_box-iso.png') }}" style="width: 35px;" alt="">
                            Dalam Proses</button>
                    </form>
                </div>
                {{-- filter -- Delivery --}}
                <div>
                    <form action="{{ route('costumer.order.filtered') }}" method="POST">
                        @csrf
                        <input type="hidden" name="status" value="Delivery">
                        <button type="submit" class="btn bg-button-primer d-flex align-items-center gap-1">
                            <img src="{{ asset('icons/iconoir_delivery-truck.png') }}" style="width: 35px;" alt="">
                            Delivery</button>
                    </form>
                </div>
                {{-- filter -- Selesai --}}
                <div>
                    <form action="{{ route('costumer.order.filtered') }}" method="POST">
                        @csrf
                        <input type="hidden" name="status" value="Selesai">
                        <button type="submit" class="btn bg-button-primer d-flex align-items-center gap-1">
                            <img src="{{ asset('icons/ic_baseline-download-done.png') }}" style="width: 35px;" alt="">
                            Selesai</button>
                    </form>
                </div>
                {{-- filter -- Ditolak --}}
                <div>
                    <form action="{{ route('costumer.order.filtered') }}" method="POST">
                        @csrf
                        <input type="hidden" name="status" value="Ditolak">
                        <button type="submit" class="btn bg-button-primer d-flex align-items-center gap-1">
                            <img src="{{ asset('icons/fluent_text-change-reject-20-regular.png') }}" style="width: 35px;" alt="">
                            Ditolak</button>
                    </form>
                </div>
                {{-- filter -- Dibatalkan --}}
                <div>
                    <form action="{{ route('costumer.order.filtered') }}" method="POST">
                        @csrf
                        <input type="hidden" name="status" value="Dibatalkan">
                        <button type="submit" class="btn bg-button-primer d-flex align-items-center gap-1">
                            <img src="{{ asset('icons/material-symbols-light_cancel-outline.png') }}" style="width: 35px;" alt="">
                            Dibatalkan</button>
                    </form>
                </div>
            </div>
            {{-- Mobile --}}
            <div class="d-flex flex-row justify-content-center align-items-center gap-1 d-lg-none">
                {{-- filter -- All --}}
                {{-- filter -- Menunggu Pembayaran --}}
                <div>
                    <form action="{{ route('costumer.order.filtered') }}" method="POST">
                        @csrf
                        <input type="hidden" name="status" value="Menunggu Pembayaran">
                        <button type="submit" class="btn bg-button-primer d-flex align-items-center gap-1">
                            <img src="{{ asset('icons/material-symbols-light_payments-outline-sharp.png') }}" style="width: 25px;" alt="">
                     
                        </button>
                    </form>

                </div>
                {{-- filter -- Menunggu Verifikasi --}}
                <div>
                    <form action="{{ route('costumer.order.filtered') }}" method="POST">
                        @csrf
                        <input type="hidden" name="status" value="Menunggu Verifikasi">
                        <button type="submit" class="btn bg-button-primer d-flex align-items-center gap-1">
                            <img src="{{ asset('icons/weui_time-outlined.png') }}" style="width: 25px;" alt="">
                         </button>
                    </form>
                </div>
                {{-- filter -- Dalam Proses --}}
                <div>
                    <form action="{{ route('costumer.order.filtered') }}" method="POST">
                        @csrf
                        <input type="hidden" name="status" value="Dalam Proses">
                        <button type="submit" class="btn bg-button-primer d-flex align-items-center gap-1">
                            <img src="{{ asset('icons/iconoir_box-iso.png') }}" style="width: 25px;" alt="">
                            </button>
                    </form>
                </div>
                {{-- filter -- Delivery --}}
                <div>
                    <form action="{{ route('costumer.order.filtered') }}" method="POST">
                        @csrf
                        <input type="hidden" name="status" value="Delivery">
                        <button type="submit" class="btn bg-button-primer d-flex align-items-center gap-1">
                            <img src="{{ asset('icons/iconoir_delivery-truck.png') }}" style="width: 25px;" alt="">
                            </button>
                    </form>
                </div>
                {{-- filter -- Selesai --}}
                <div>
                    <form action="{{ route('costumer.order.filtered') }}" method="POST">
                        @csrf
                        <input type="hidden" name="status" value="Selesai">
                        <button type="submit" class="btn bg-button-primer d-flex align-items-center gap-1">
                            <img src="{{ asset('icons/ic_baseline-download-done.png') }}" style="width: 25px;" alt="">
                            </button>
                    </form>
                </div>
                {{-- filter -- Ditolak --}}
                <div>
                    <form action="{{ route('costumer.order.filtered') }}" method="POST">
                        @csrf
                        <input type="hidden" name="status" value="Ditolak">
                        <button type="submit" class="btn bg-button-primer d-flex align-items-center gap-1">
                            <img src="{{ asset('icons/fluent_text-change-reject-20-regular.png') }}" style="width: 25px;" alt="">
                            </button>
                    </form>
                </div>
                {{-- filter -- Dibatalkan --}}
                <div>
                    <form action="{{ route('costumer.order.filtered') }}" method="POST">
                        @csrf
                        <input type="hidden" name="status" value="Dibatalkan">
                        <button type="submit" class="btn bg-button-primer d-flex align-items-center gap-1">
                            <img src="{{ asset('icons/material-symbols-light_cancel-outline.png') }}" style="width: 25px;" alt="">
                            </button>
                    </form>
                </div>
            </div>
            {{-- end mobile --}}
        </div>
    </section>

    <section id="order-list" class="d-flex justify-content-center " style="min-height: 50vh">
        <div id="container">
            {{-- <div class="d-flex flex-row" > --}}
            @if ($costumerOrderItems->isEmpty())
                <div class="p-3 bg-card-primer" role="alert">
                    <p class="mb-0">Tidak ada orderan dengan status tersebut.</p>
                </div>
            @else
                @foreach ($costumerOrderItems as $order)
                    <div class="d-flex flex-row  bg-card-primer p-3 mb-3 gap-3 align-items-center">
                        <div class="d-flex flex-column  justify-content-center">
                            <p  class="mb-0">{{ $order->custom_order_id }}</p>
                            <p class="mb-0">Rp. {{ number_format($order->total_price, 0, ',', '.') }}</p>
                        </div>


                        <div class="d-flex flex-row">
                            <div class="d-flex align-items-center">
                                <p class="mb-0">{{ $order->status }}</p>
                            </div>
                        </div>

                        <div class="d-flex text-center justify-center align-items-center ms-auto">
                            <a href="{{ route('costumer.order.show', $order->custom_order_id) }}">
                                <img src="{{ asset('icons/lets-icons_arrow-right-light.png') }}" alt="Details" width="35px">
                            </a>
                        </div>
                    </div>
                @endforeach

                <div class="d-flex justify-content-center" >
                    {{ $costumerOrderItems->links() }}
                </div>
            @endif
            {{-- </div> --}}
        </div>
    </section>
@endsection
