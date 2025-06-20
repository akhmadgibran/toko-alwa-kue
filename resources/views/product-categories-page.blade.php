{{-- category page for costumer and guest --}}

@extends('layouts.app')

@section('content')
<section class="page-title py-5 d-flex align-items-center" style="min-height: 30vh">
    <div class="container">
            <div class="col-md-12 text-center ">
                <h2 class="quote-script">Created with Love and Passion</h2>
                <p>Find the perfect product for any occasion</p>
            </div>
    </div>
</section>

<section id="category" style="min-height: 70vh" >
    <div class="container" >
        <div class="row " >
            @if (count($categories) == 0)
                <div class="col-12">
                    <div class="d-flex justify-content-center">
                        <div class="d-flex flex-column justify-content-center align-items-center">
                            <h2 class="quote-script">No Categories Yet</h2>
                        </div>
                    </div>
                </div>
                
            @endif
            @foreach ($categories as $category )
                {{-- each categories, anchor to page with products in that category --}}
                 <div class="col-12  col-lg-6 col-xxl-6"  >
                    <div class="d-flex justify-content-center p-3" >
                        <div class="p-3 rounded-0 bg-card-primer responsive-card" style="width: 18rem; flex: 0 0 auto;">
                            <div >
                                <img src="{{ asset('storage/' . $category->image_path) }}" alt="" class="img-fluid shadow-md mb-2 product-image-square">
                                <h4>{{ $category->name }}</h4>
                                <p>{{ $category->description }}</p>
                                <a href="{{ route('product.index', ['id' => $category->id]) }}" class="btn bg-button-primer w-100 rounded rounded-5">Lihat Category</a>
                            </div>
                        </div>
                        {{-- <div class="col-12 col-sm-3 d-flex justify-content-center p-3">
                            <div class="bg-card-primer p-3 rounded-0 responsive-card" style="width: 18rem;">
                                <img src="{{ asset('storage/' . $category->image_path) }}" alt="" class="img-fluid shadow-md mb-2 product-image-square">
                                <h4>{{ $category->name }}</h4>
                                <p>{{ $category->description }}</p>
                                <a href="{{ route('product.index', ['id' => $category->id]) }}" class="btn bg-button-primer w-100 rounded rounded-5">Lihat Category</a>
                            </div>
                        </div> --}}
                 </div>
            </div>

            @endforeach

            <div class="d-flex justify-content-center">
                {!! $categories->links() !!}
            </div>
        </div>
    </div>
</section>

@endsection
