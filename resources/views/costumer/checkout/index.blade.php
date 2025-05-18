{{-- index cart pagee --}}

@extends('layouts.app')

@section('content')
    {{-- <section id="cart" class="py-5" style="min-height: 70vh" >
    <div class="container" >
            <div class="row" >
                 
            <div class="col-md-7 col-sm-12 " >
                <h3>Item Belanja</h3>
                <table class="table">
                    <thead>
                        <tr>
                          
                            <th scope="col">Item</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Jumlah</th>
                            <th scope="col">Subtotal</th>
          
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cartItems as $cartItem)
                            <tr>
                   
                                <td>{{ $cartItem->product->name }}</td>
                                <td>Rp. {{ $cartItem->product->price }}</td>
                                <td>{{ $cartItem->quantity }}</td>
                                <td>Rp. {{ number_format($cartItem->sub_total, 0, ',', '.') }}</td>
                
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
           

         
            <div class="col-md-3 col-sm-12 border rounded" style="" >
                <div class="p-3">
                    <h3>Ringkasan Order</h3>
                    <table class="table">
                        <thead>
                            <tr>
                      
                                <th scope="col">Order Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                           
                                <td>Rp. {{ number_format($totalPrice, 0, ',', '.') }}</td>
                            </tr>

                        </tbody>
                    </table>
                    <div>
                        <h4>Penerima</h4>
                        <p>Nama : {{ $costumerName }}</p>
                        <p>Alamat : {{ $costumerAddress }}</p>
                        <p>Nomor Whatsapp : {{ $costumerPhone }}</p>
                        <p class="text-danger" style="font-size: 11px;">*Alamat tidak bisa diganti setelah order</p>
                        <p class="text-danger" style="font-size: 11px;">*Mohon ganti alamat anda di profile apabila salah</p>
                    </div>
                    
                    @if ($costumerName == null || $costumerAddress == null || $costumerPhone == null)
                        <a href="{{ route('profile.edit') }}" class="btn btn-primary">Lengkapi Data Diri</a>
                    @else
                    <form action="{{ route('costumer.checkout.store') }}" method="POST">
                        @csrf
                        <label for="buyer_note">Catatan untuk penjual :</label>
                        <textarea name="buyer_note" id="buyer_note" class="" cols="34" rows="5" required></textarea>
                        <button class="btn btn-primary w-100">Checkout</button>
                    </form>
                    @endif

                    
                </div>
            </div>

            </div>
    </div>
</section> --}}


<section id="cart" class="container p-4 d-flex align-items-center justify-content-center" style="min-height: 70vh">

        <div class="row justify-content-center w-100">
            {{-- cart table --}}
            <div class="col-lg-7 col-12 ">
                <h3 class="title-script">Item Order</h3>

                {{-- large screen --}}
                <table class="table normal-font table-transparent d-none d-lg-table">
                    <thead>
                        <tr>
                            <th scope="col">Items</th>
                            <th scope="col">Harga</th>
                            <th scope="col" class="text-center">Jumlah</th>
                            <th scope="col">Subtotal</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cartItems as $cartItem)
                            <tr>
                                <td style="vertical-align: middle;">{{ $cartItem->product->name }}</td>
                                <td style="vertical-align: middle;">Rp. {{ $cartItem->product->price }}</td>
                                <td style="vertical-align: middle;">{{ $cartItem->quantity }}</td>
                                <td style="vertical-align: middle;">Rp.
                                    {{ number_format($cartItem->sub_total, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{-- end large screen --}}

                {{-- mobile --}}
                <div class="d-block d-lg-none">
                    @foreach ($cartItems as $cartItem)
                        <div id="cart-list" class="d-flex flex-column mb-2">
                            <h3>{{ $cartItem->product->name }}</h3>
                            <div class="d-flex flex-row align-items-center">
                                <div class="d-flex justify-content-center align-items-center me-auto"
                                    style="height: 100%;">
                                    <p class="mb-0">Rp. {{ $cartItem->product->price }}</p>
                                </div>
                                <div class="d-flex justify-content-center align-items-center me-auto"
                                    style="height: 100%;">
                                    <p class="mb-0">X {{ $cartItem->quantity }}</p>
                                </div>
                                <div class="d-flex justify-content-center align-items-center ms-auto" style="height: 100%;">
                                    <p class="mb-0">Rp. {{ number_format($cartItem->sub_total, 0, ',', '.') }}</p>
                                </div>

                            </div>
                        </div>
                    @endforeach

                </div>
                {{-- end mobile --}}
            </div>

            {{-- cart summary --}}
            <div class="col-lg-4 col-12" style="min-width: 300px">
                <div class="p-3 bg-card-primer">
                    <h3>Ringkasan Belanja</h3>
                    <table class="table table-transparent normal-font">
                        <thead>
                            <tr>
                                <th scope="col">Order Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Rp. {{ number_format($totalPrice, 0, ',', '.') }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <div>
                        <h4>Penerima</h4>
                        <p>Nama : {{ $costumerName }}</p>
                        <p>Alamat : {{ $costumerAddress }}</p>
                        <p>Nomor Whatsapp : {{ $costumerPhone }}</p>
                        <p class="text-danger" style="font-size: 11px;">*Alamat tidak bisa diganti setelah order</p>
                        <p class="text-danger" style="font-size: 11px;">*Mohon ganti alamat anda di profile apabila salah
                        </p>
                    </div>
                    @if ($costumerName == null || $costumerAddress == null || $costumerPhone == null)
                        <a href="{{ route('profile.edit') }}" class="btn bg-button-primer w-100">Lengkapi Data Diri</a>
                    @else
                        <form action="{{ route('costumer.checkout.store') }}" method="POST">
                            @csrf
                            <label for="buyer_note">Catatan untuk penjual :</label>
                            <textarea name="buyer_note" id="buyer_note" class="w-100" rows="5" required></textarea>
                            <button class="btn bg-button-primer w-100">Checkout</button>
                        </form>
                    @endif
                </div>
            </div>
            {{-- end cart summary --}}
        </div>

    </section>
@endsection
