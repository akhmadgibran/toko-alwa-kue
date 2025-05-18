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
        <div class="row" >
            @foreach ($categories as $category )
                {{-- each categories, anchor to page with products in that category --}}
                {{-- <div class="col-md-3  "  >
                    <a class="text-decoration-none text-black"  href="{{ route('product.index', ['id' => $category->id]) }}">
                    
                     
                        <div>
                            <img src="{{ asset('storage/' . $category->image_path) }}" alt="Category Image" class="img-fluid rounded rounded-4" >
                        </div>
                    
        
                       
                        <div>
                            <h3>{{ $category->name }}</h3>
                        </div>
                        
        
                   
                        <div>
                            <p>{{ $category->description }}</p>
                        </div>
                      
            
                    </a>
            </div> --}}
                {{-- <div class="col-12 col-sm-3 p-3 rounded-0 bg-card-primer responsive-card" style="width: 18rem; flex: 0 0 auto;">
                    <div>
                        <img src="{{ asset('storage/' . $category->image_path) }}" alt="" class="img-fluid shadow-md mb-2">
                        <h4>{{ $category->name }}</h4>
                        <p>{{ $category->description }}</p>
                        <a href="{{ route('product.index', ['id' => $category->id]) }}" class="btn bg-button-primer w-100 rounded rounded-5">Lihat Category</a>
                    </div>
                </div> --}}
                <div class="col-12 col-sm-3 d-flex justify-content-center p-3">
                    <div class="bg-card-primer p-3 rounded-0 responsive-card" style="width: 18rem;">
                        <img src="{{ asset('storage/' . $category->image_path) }}" alt="" class="img-fluid shadow-md mb-2">
                        <h4>{{ $category->name }}</h4>
                        <p>{{ $category->description }}</p>
                        <a href="{{ route('product.index', ['id' => $category->id]) }}" class="btn bg-button-primer w-100 rounded rounded-5">Lihat Category</a>
                    </div>
                </div>

            @endforeach
        </div>
    </div>
</section>

@endsection
