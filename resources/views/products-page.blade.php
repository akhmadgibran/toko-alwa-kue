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

    <section id="products" style="min-height: 70vh">
        <div class="container">
            <div class="row">
                @if (count($products) == 0)
                    <div class="col-12">
                        <div class="d-flex justify-content-center">
                            <div class="d-flex flex-column justify-content-center align-items-center">
                                <h2 class="quote-script">No Product Yet</h2>
                            </div>
                        </div>
                    </div>
                @endif
                @foreach ($products as $product)
                    <div class="col-12  col-lg-6 col-xxl-4">
                        <div class="d-flex justify-content-center p-3">
                            <div class="bg-card-primer p-3 rounded-0 responsive-card" style="width: 18rem;">
                                <img src="{{ asset('storage/' . $product->image_path) }}" alt=""
                                    class="img-fluid shadow-md mb-2 product-image-square">
                                <h4>{{ $product->name }}</h4>
                                <p>{{ Str::words($product->description, 4, '...') }}</p>
                                <a href="{{ route('product.show', ['id' => $product->id]) }}"
                                    class="btn bg-button-primer w-100 rounded rounded-5">Lihat Product</a>
                            </div>
                        </div>
                    </div>
                @endforeach

                <div class="d-flex justify-content-center">
                    {!! $products->links() !!}
            </div>
            </div>
        </div>
    </section>
@endsection
