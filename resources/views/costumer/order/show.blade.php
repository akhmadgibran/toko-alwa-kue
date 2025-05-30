{{-- show order pagee --}}

@extends('layouts.app')

@section('content')

<section id="cart" class="py-5" style="min-height: 70vh" >
    <div class="container" >
            <div class="row" >
            
                {{-- Items --}}
            <div class="col-md-7 col-sm-12 " >
                <h3 class="title-script">Item Order</h3>

                {{-- large screen --}}
                <table class="table normal-font table-transparent d-none d-lg-table">
                    <thead>
                        <tr>
                            <th scope="col">Item</th>
                            <th scope="col">Harga</th>
                            <th scope="col" class="text-center" >Jumlah</th>
                            <th scope="col">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($costumerOrderDetail as $Item)
                            <tr>
                                <td style="vertical-align: middle;">{{ $Item->product_name }}</td>
                                <td style="vertical-align: middle;">Rp. {{ number_format($Item->product_price, 0, ',', '.') }}</td>
                                <td class="text-center" style="vertical-align: middle;">{{ $Item->quantity }}</td>
                                <td style="vertical-align: middle;">Rp. {{ number_format($Item->subtotal, 0, ',', '.') }}</td>
                        @endforeach
                    </tbody>
                </table>
                {{-- end large screen --}}


                {{-- mobile --}}
                <div class="d-block d-lg-none">
                    @foreach ($costumerOrderDetail as $Item)
                        <div id="cart-list" class="d-flex flex-column mb-2">
                            <h3>{{ $Item->product_name }}</h3>
                            <div class="d-flex flex-row align-items-center">
                                <div class="d-flex justify-content-center align-items-center me-auto"
                                    style="height: 100%;">
                                    <p class="mb-0">Rp. {{ $Item->product_price }}</p>
                                </div>
                                <div class="d-flex justify-content-center align-items-center me-auto"
                                    style="height: 100%;">
                                    <p class="mb-0">X {{ $Item->quantity }}</p>
                                </div>
                                <div class="d-flex justify-content-center align-items-center ms-auto" style="height: 100%;">
                                    <p class="mb-0">Rp. {{ number_format($Item->subtotal, 0, ',', '.') }}</p>
                                </div>

                            </div>
                        </div>
                    @endforeach
                </div>
                {{-- end mobile --}}
            </div>
            {{-- end Item--}}



            {{-- order summary --}}
            <div class="col-lg-4 col-12" style="min-width: 300px" >
                <div class="p-3 bg-card-primer">
                    <h3>Ringkasan Order</h3>

                    <table class="table normal-font table-transparent ">
                        <thead>
                            <tr>
                                <th scope="col">Order Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Rp. {{ number_format($costumerOrderItem->total_price, 0, ',', '.') }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <p>Kode Order :</p>
                    <p> {{ $costumerOrderItem->custom_order_id }}</p>
                    
                    <p>Status : {{ $costumerOrderItem->status }}</p>
                    <p>Alamat :</p>
                    <p class="faded-border">{{ $costumerOrderItem->address }}</p>
                    <p>Catatan dari penjual : </p>
                    <p class="faded-border">{{ $costumerOrderItem->seller_note ? $costumerOrderItem->seller_note : 'Belum ada catatan' }}</p>
                    <p>Catatan untuk penjual :</p>
                    <p class="faded-border" >
                        {{ $costumerOrderItem->buyer_note ? $costumerOrderItem->buyer_note : 'Belum ada catatan'  }}
                    </p>
                    @if ($costumerOrderItem->status == 'Menunggu Pembayaran')
                        <a href="{{ route('checkout.pending.payment', $custom_order_id = $costumerOrderItem->custom_order_id) }}" class="btn bg-button-primer w-100">Bayar Sekarang</a>
                        
                    @endif



                    {{-- <a href="{{ route('costumer.checkout.index') }}" class="btn btn-primary w-100">Order</a> --}}
                </div>
            </div>
            {{-- end order summary --}}
            </div>
    </div>
</section>

@endsection
