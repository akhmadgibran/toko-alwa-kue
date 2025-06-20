

{{-- the detail of the product --}}

@extends('layouts.app')

@section('content')

{{-- product detail --}}
<section id="product-detail" class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <img src="{{ asset('storage/' . $product->image_path) }}" alt="Product Image" class="img-fluid product-image-square">
            </div>
            <div class="col-md-6">
                <h2 class="quote-script" >{{ $product->name }}</h2>
                <h3 style="font-weight: bold">Rp. {{ number_format($product->price, 0, ',', '.') }}</h3>
                <p>{{ $product->description }}</p>

            <div class="d-flex flex-row mb-2">
                <div class="quantity-selector">
                    <button type="button" onclick="updateQuantity(-1)">−</button>
                    <input type="text" id="quantity" value="1" readonly>
                    <button type="button" onclick="updateQuantity(1)">+</button>
                </div>

                <div class="d-flex align-items-center ms-3">
                    <p id="total-price" class="mb-0">
                        Rp. {{ number_format($product->price * 1, 0, ',', '.') }}
                    </p>
                </div>
            </div>


                <script>
                    let price = {{ $product->price }};
                
                    function updateQuantity(value) {
                        var quantity = parseInt(document.getElementById('quantity').value);
                        quantity += value;
                        if (quantity < 1) {
                            quantity = 1;
                        }
                        document.getElementById('quantity').value = quantity;
                        const hiddenQuantityInput = document.getElementById('hidden-quantity');
                        if (hiddenQuantityInput) {
                            hiddenQuantityInput.value = quantity;
                        }
                        updateTotalPrice();
                    }
                
                    function updateTotalPrice() {
                        var quantity = parseInt(document.getElementById('quantity').value);
                        var totalPrice = quantity * price;
                        document.getElementById('total-price').innerHTML = 'Rp. ' + totalPrice.toLocaleString('id-ID', { minimumFractionDigits: 0 });
                    }
                </script>
                            
                    {{-- Cek kondisi toko dulu --}}
                    @if ($statusToko->name == 'close' || $statusToko->name == 'closed')
                        {{-- KASUS 1: TOKO TUTUP --}}
                        <a href="#" class="btn bg-button-primer w-100 rounded-5 disabled">Toko Sedang Tutup</a>
                    @else
                        {{-- KASUS 2: TOKO BUKA, sekarang cek status login user --}}
                        @auth
                            {{-- User sudah login --}}
                            <form action="{{ route('costumer.cart.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="hidden" name="quantity" id="hidden-quantity" value="1">
                                <button type="submit" class="btn bg-button-primer w-100 rounded-5">Add to Cart</button>
                            </form>
                        @else
                            {{-- User belum login (guest) --}}
                            <a href="{{ route('login') }}" class="btn bg-button-primer w-100 rounded-5">Login untuk Menambah ke
                                Keranjang</a>
                        @endauth
                    @endif
            </div>

        </div>
    </div>
</section>
{{-- end product detail --}}



@endsection
