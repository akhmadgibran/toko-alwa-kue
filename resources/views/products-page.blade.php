{{-- page to display product by the selected category --}}

@extends('layouts.app')

@section('content')

    <section class="page-title py-5 d-flex align-items-center" style="min-height: 30vh">
        <div class="container">
            <div class="col-md-12 text-center">
                <h2 class="">Created with Love and Passion</h2>
            </div>
        </div>
    </section>

    <section id="products" >
        <div class="container" >
            <div class="row" >
                @foreach ($products as $product )
                    <div class="col-md-4 col-sm-12 "  >
                        <a class="text-decoration-none text-black"  href="{{ route('product.show', ['id' => $product->id]) }}">
                            <div>
                                <img src="{{ asset('storage/' . $product->image_path) }}" alt="Product Image" class="img-fluid">
                            </div>
                            <div>
                                <h3>{{ $product->name }}</h3>
                            </div>
                            <div>
                                <p>{{ $product->description }}</p>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection