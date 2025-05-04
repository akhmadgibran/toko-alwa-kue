{{-- the detail of the product --}}

@extends('layouts.app')

@section('content')

{{-- product detail --}}
<section id="product-detail" class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <img src="{{ asset('storage/' . $product->image_path) }}" alt="Product Image" class="img-fluid">
            </div>
            <div class="col-md-4">
                <h2>{{ $product->name }}</h2>
                <p>{{ $product->description }}</p>
                <h3>Rp. {{ number_format($product->price, 0, ',', '.') }}</h3>
            </div>
            <div class="col-md-4">

               

                <div class="input-group mb-3" style="width: 50%" >
                    <div class="input-group-prepend" >
                        <button class="btn btn-outline-secondary" type="button" id="button-addon1" onclick="updateQuantity(-1)" >-</button>
                    </div>
                    <input type="text" class="form-control" id="quantity" placeholder="" aria-label="" aria-describedby="button-addon1" value="1" readonly>
                    <div class="input-group-append" >
                        <button class="btn btn-outline-secondary" type="button" id="button-addon2" onclick="updateQuantity(1)" >+</button>
                    </div>

                </div>

                <div>
                    {{-- calculate quantity * price --}}
                    <p id="total-price" class="">Rp. {{ number_format($product->price * 1, 0, ',', '.') }}</p>
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
                        document.getElementById('hidden-quantity').value = quantity;
                        updateTotalPrice();
                    }
                
                    function updateTotalPrice() {
                        var quantity = parseInt(document.getElementById('quantity').value);
                        var totalPrice = quantity * price;
                        document.getElementById('total-price').innerHTML = 'Rp. ' + totalPrice.toLocaleString('id-ID', { minimumFractionDigits: 0 });
                    }
                </script>
                            
            {{-- if not logged in, then add to cart button will route to login --}}
            @if (!Auth::check())
                <input type="hidden" name="quantity" id="hidden-quantity" value="1">
                <a href="{{ route('login') }}" class="btn btn-primary">Add to Cart</a>
            @else
                <form action="{{ route('costumer.cart.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="quantity" id="hidden-quantity" value="1">
                    <button type="submit" class="btn btn-primary">Add to Cart</button>
                </form>
            @endif

            </div>

        </div>
    </div>
</section>
{{-- end product detail --}}



@endsection
