{{-- show order pagee --}}

@extends('layouts.app')

@section('content')

<section id="cart" class="py-5" style="min-height: 70vh" >
    <div class="container" >
            <div class="row" >
                        {{-- order table --}}
            <div class="col-md-7 col-sm-12 " >
                <h3>Item Order</h3>
                <table class="table">
                    <thead>
                        <tr>
                            {{-- <th scope="col">No</th> --}}
                            <th scope="col">Item</th>
                            {{-- <th scope="col">Harga</th> --}}
                            <th scope="col">Jumlah</th>
                            {{-- <th scope="col">Subtotal</th> --}}
                            {{-- <th scope="col">Aksi</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($costumerOrderDetail as $Item)
                            <tr>
                                {{-- <th scope="row">{{ $loop->iteration }}</th> --}}
                                <td>{{ $Item->product ? $Item->product->name : 'Product Not Found' }}</td>
                                {{-- <td>Rp. {{ $Item->product->price }}</td> --}}
                                <td>{{ $Item->quantity }}</td>
                                {{-- <td>Rp. {{ number_format($Item->sub_total, 0, ',', '.') }}</td> --}}
                                {{-- <td>
                                    <form action="{{ route('costumer.cart.destroy', $cartItem->id) }}" method="POST" style="display: inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                    </form>
                                </td> --}}
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{-- end cart table --}}

            {{-- cart summary --}}
            <div class="col-md-3 col-sm-12 border rounded" style="" >
                <div class="p-3">
                    <h3>Ringkasan Order</h3>

                    <table class="table">
                        <thead>
                            <tr>
                                {{-- <th scope="col">Subtotal</th> --}}
                                {{-- <th scope="col">Ongkir</th> --}}
                                <th scope="col">Order Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                {{-- <td>Rp. {{ $subTotal }}</td> --}}
                                {{-- <td>Rp. {{ $ongkir }}</td> --}}
                                <td>Rp. {{ $costumerOrderItem->total_price }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <p>Kode Order :</p>
                    <p> {{ $costumerOrderItem->custom_order_id }}</p>
                    <p>Status : {{ $costumerOrderItem->status }}</p>
                    <p>Alamat : {{ $costumerOrderItem->address }}</p>
                    <p>Catatan dari penjual :</p>
                    <p>{{ $costumerOrderItem->seller_note }}</p>
                    <p>Catatan untuk penjual :</p>
                    <p> {{ $costumerOrderItem->buyer_note }}</p>
                    @if ($costumerOrderItem->status == 'Menunggu Pembayaran')
                        <a href="{{ route('checkout.pending.payment', $custom_order_id = $costumerOrderItem->custom_order_id) }}" class="btn btn-primary w-100">Bayar Sekarang</a>
                        
                    @endif



                    {{-- <a href="{{ route('costumer.checkout.index') }}" class="btn btn-primary w-100">Order</a> --}}
                </div>
            </div>
            {{-- end cart summary --}}
            </div>
    </div>
</section>

@endsection
