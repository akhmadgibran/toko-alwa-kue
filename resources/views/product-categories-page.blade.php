{{-- category page for costumer and guest --}}

@extends('layouts.app')

@section('content')
<section class="page-title py-5 d-flex align-items-center" style="min-height: 30vh">
    <div class="container">
            <div class="col-md-12 text-center ">
                <h2 class="">Created with Love and Passion</h2>
            </div>
    </div>
</section>

<section id="category" style="min-height: 70vh" >
    <div class="container" >
        <div class="row" >
            @foreach ($categories as $category )
                {{-- each categories, anchor to page with products in that category --}}
                <div class="col-md-4 col-sm-12 "  >
                    <a class="text-decoration-none text-black"  href="{{ route('product.index', ['id' => $category->id]) }}">
                    
                        {{-- category image --}}
                        <div>
                            <img src="{{ asset('storage/' . $category->image_path) }}" alt="Category Image" class="img-fluid">
                        </div>
                        {{-- end category image --}}
        
                        {{-- category name --}}
                        <div>
                            <h3>{{ $category->name }}</h3>
                        </div>
                        {{-- end category name --}}
        
                        {{-- category description --}}
                        <div>
                            <p>{{ $category->description }}</p>
                        </div>
                        {{-- end category description --}}
            
                    </a>
            </div>
            @endforeach
        </div>
    </div>
</section>

@endsection
