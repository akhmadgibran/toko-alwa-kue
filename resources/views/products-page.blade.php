{{-- page to display product by the selected category --}}

@extends('layouts.app')

@section('content')

    <section class="page-title py-5 d-flex align-items-center" style="min-height: 30vh">
        <div class="container">
            <div class="col-md-12 text-center">
                <h2 class="quote-script">We Proudly Serve You</h2>
                <p>Which type of product will you choose today ?</p>
            </div>
        </div>
    </section>

    <section id="products" >
        <div class="container" >
            <div class="row" >
                @foreach ($products as $product )
                    <div class="col-md-4 col-sm-12 "  >
                        {{-- <a class="text-decoration-none text-black"  href="{{ route('product.show', ['id' => $product->id]) }}">
                            <div>
                                <img src="{{ asset('storage/' . $product->image_path) }}" alt="Product Image" class="img-fluid rounded rounded-4">
                            </div>
                            <div>
                                <h3>{{ $product->name }}</h3>
                            </div>
                            <div>
                                <p>{{ $product->description }}</p>
                            </div>
                        </a> --}}
                        <div class="d-flex justify-content-center p-3">
                            <div class="bg-card-primer p-3 rounded-0 responsive-card" style="width: 18rem;">
                                <img src="{{ asset('storage/' . $product->image_path) }}" alt="" class="img-fluid shadow-md mb-2">
                                <h4>{{ $product->name }}</h4>
                                <p>{{ $product->description }}</p>
                                <a href="{{ route('product.show', ['id' => $product->id]) }}" class="btn bg-button-primer w-100 rounded rounded-5">Lihat Product</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection