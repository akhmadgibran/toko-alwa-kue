{{-- index cart pagee --}}

@extends('layouts.app')

@section('content')
    <section id="cart" class="p-5" style="min-height: 70vh">
        {{-- class="container p-4 d-flex align-items-center justify-content-center" style="min-height: 70vh" --}}

        <div class="row justify-content-center">
            {{--  justify-content-center --}}
            {{-- cart table --}}
            <div class="col-lg-7 col-12 ">
                <h3 class="title-script">Keranjang Belanja</h3>

                {{-- large screen --}}
                <table class="table normal-font table-transparent d-none d-lg-table">
                    <thead>
                        <tr>
                            <th scope="col">Items</th>
                            <th scope="col">Harga</th>
                            <th scope="col" class="text-center">Jumlah</th>
                            <th scope="col">Subtotal</th>
                            <th scope="col" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cartItems as $cartItem)
                            <tr>
                                <td style="vertical-align: middle;">{{ $cartItem->product->name }}</td>
                                <td style="vertical-align: middle;">Rp. {{ $cartItem->product->price }}</td>

                                <td style="vertical-align: middle;">
                                    <div class="d-flex align-items-center gap-2 justify-content-center">
                                        {{-- Decrement Form --}}
                                        <form action="{{ route('costumer.cart.update', $cartItem->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="quantity" value="{{ $cartItem->quantity - 1 }}">
                                            <button type="submit" class="btn btn-outline-secondary btn-sm"
                                                {{ $cartItem->quantity <= 1 ? 'disabled' : '' }}>−</button>
                                        </form>

                                        {{-- Quantity Display --}}
                                        <span class="px-2">{{ $cartItem->quantity }}</span>

                                        {{-- Increment Form --}}
                                        <form action="{{ route('costumer.cart.update', $cartItem->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="quantity" value="{{ $cartItem->quantity + 1 }}">
                                            <button type="submit" class="btn btn-outline-secondary btn-sm">+</button>
                                        </form>
                                    </div>
                                </td>



                                <td style="vertical-align: middle;">Rp.
                                    {{ number_format($cartItem->sub_total, 0, ',', '.') }}</td>


                                <td class="text-center" style="vertical-align: middle;">
                                    <form action="{{ route('costumer.cart.destroy', $cartItem->id) }}" method="POST"
                                        style="display: inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn">
                                            <img style="width: 55%" class="img-fluid"
                                                src="{{ asset('icons/iconoir_trash-solid.png') }}" alt="delete"
                                                style="width: 20px">
                                        </button>
                                    </form>
                                </td>
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
                            <p>Rp. {{ number_format($cartItem->product->price, 0, ',', '.') }}</p>
                            <div class="d-flex flex-row align-items-center">
                                <div class="d-flex align-items-center gap-2 justify-content-center">
                                    {{-- Decrement Form --}}
                                    <form action="{{ route('costumer.cart.update', $cartItem->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="quantity" value="{{ $cartItem->quantity - 1 }}">
                                        <button type="submit" class="btn btn-outline-secondary btn-sm"
                                            {{ $cartItem->quantity <= 1 ? 'disabled' : '' }}>−</button>
                                    </form>

                                    {{-- Quantity Display --}}
                                    <span class="px-2">{{ $cartItem->quantity }}</span>

                                    {{-- Increment Form --}}
                                    <form action="{{ route('costumer.cart.update', $cartItem->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="quantity" value="{{ $cartItem->quantity + 1 }}">
                                        <button type="submit" class="btn btn-outline-secondary btn-sm">+</button>
                                    </form>
                                </div>
                                <div class="d-flex justify-content-center align-items-center">
                                    <form action="{{ route('costumer.cart.destroy', $cartItem->id) }}" method="POST"
                                        style="display: inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn">
                                            <img style="width: 45%" class="img-fluid"
                                                src="{{ asset('icons/iconoir_trash-solid.png') }}" alt="delete"
                                                style="width: 20px">
                                        </button>
                                    </form>

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
            <div class="col-lg-3 col-12" style="min-width: 300px">
                <div class="p-3 bg-card-primer">
                    <h3>Ringkasan Belanja</h3>
                    <table class="table table-transparent normal-font">
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
                                <td>Rp. {{ number_format($totalPrice, 0, ',', '.') }}</td>
                            </tr>
                        </tbody>
                    </table>
                    @if ($statusToko->name == 'open')
                        <a href="{{ route('costumer.checkout.index') }}" class="btn bg-button-primer w-100">Order</a>
                    @else
                        <a href="#" class="btn bg-button-primer w-100 disabled">Order</a>
                    @endif
                </div>
            </div>
            {{-- end cart summary --}}
        </div>

    </section>
@endsection
