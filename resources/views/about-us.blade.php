@extends('layouts.app')

@section('content')
{{-- about section --}}
<section id="about" class="py-5">
    <div class="container">
        <div class="text-center py-4" >
            <h2 class="title-script">About us</h2>
        </div>
        <div class="w-100 d-flex justify-content-center align-items-center mb-4" >
            <img class="w-100  shadow-md" src="{{ asset('sample/carousel-1.jpeg') }}" style="" alt="">
        </div>
        <div class="row" >
            <div class="col-12 col-md-6 d-flex justify-content-center align-items-center" >
            <img class="w-75" src="{{ asset('storage/' . $siteSettings->logo_path) }}" alt="logo {{ $siteSettings->shop_name }}" width="">

            </div>
            <div class="col-12 col-md-6 d-flex justify-content-center align-items-center" >
                <div class="d-flex flex-column justify-content-center">
                    <h2 class="quote-script">Tentang {{ $siteSettings->shop_name }}</h2>
                    <p class="">
                        {{ $siteSettings->about_us }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
{{-- end about section --}}
@endsection