{{-- index cart pagee --}}

@extends('layouts.app')

@section('content')

<section id="cart" class="py-5" style="min-height: 70vh" >
    <div class="container" >
            <div class="row" >
                        {{-- cart table --}}
            <div class="col-md-7 col-sm-12 " >
                <h3>Keranjang Belanja</h3>
                <table class="table">
                    <thead>
                        <tr>
                            {{-- <th scope="col">No</th> --}}
                            <th scope="col">Item</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Jumlah</th>
                            <th scope="col">Subtotal</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cartItems as $cartItem)
                            <tr>
                                {{-- <th scope="row">{{ $loop->iteration }}</th> --}}
                                <td>{{ $cartItem->product->name }}</td>
                                <td>Rp. {{ $cartItem->product->price }}</td>
                                <td>{{ $cartItem->quantity }}</td>
                                <td>Rp. {{ number_format($cartItem->sub_total, 0, ',', '.') }}</td>
                                <td>
                                    <form action="{{ route('costumer.cart.destroy', $cartItem->id) }}" method="POST" style="display: inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{-- end cart table --}}

            {{-- cart summary --}}
            <div class="col-md-3 col-sm-12 border rounded" style="" >
                <div class="p-3">
                    <h3>Ringkasan Belanja</h3>
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
                                <td>Rp. {{ $totalPrice }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            {{-- end cart summary --}}
            </div>
    </div>
</section>

@endsection