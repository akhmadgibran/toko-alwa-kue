@extends('layouts.app')

@section('content')
{{-- hero section --}}
<section id="guest-hero" class="d-flex justify-content-center align-items-center shadow-lg" style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('{{ asset('backgrounds/hero-background.jpg') }}') center/cover ;" >
    <div class="text-center text-white" >
        <h1>Selamat Datang di {{ $siteSettings->shop_name }}</h1>
        <p>Pilih product apa hari ini ?</p>
        <a href="{{ route('product.category') }}" class="btn btn-primary">Product Kami</a>
    </div>
</section>
{{-- end hero section --}}

{{-- best selling section --}}
<section id="best-selling" class="d-flex flex-column justify-content-center" style="min-height: 70vh" >
    <div class="container ">
        <div class="text-center py-4" >
            <h2>Best Selling Product !</h2>
        </div>
        <div class="row p-4" >
            @if ($bestSellerItems->isEmpty())
                <div class="alert alert-warning" role="alert">
                    {{ __('Belum ada produk best seller.') }}
                </div>
            @else
                @foreach ($bestSellerItems as $Item )
                    <div class="col-md-4 col-sm-6 mb-4 " >
                        <a href="{{ route('product.show', $Item->product_id) }}" class="text-decoration-none text-dark" >
                            <img src="{{ asset('storage/' . $Item->product->image_path) }}" class="img-fluid shadow-lg rounded rounded-4"  alt="">
                        </a>
                    </div>
               @endforeach
            @endif
        </div>
    </div>
</section>
{{-- end best selling section --}}


{{-- slogan section --}}
<section id="slogan" class="d-flex justify-content-center align-items-center bg-body-secondary shadow-sm" style="min-height: 30vh" >
    <div class="container">
        <div class="text-center py-4" >
            <h2>{{ $siteSettings->slogan }}</h2>
        </div>
    </div>
</section>
{{-- end slogan section --}}


{{-- about section --}}
<section id="about" class="py-5">
    <div class="container">
        <div class="text-center py-4" >
            <h2>Tentang Kami</h2>
        </div>
        <div class="w-100 d-flex justify-content-center align-items-center mb-4" >
            <img class="w-100 rounded rounded-4 shadow-md" src="{{ asset('sample/carousel-1.jpeg') }}" style="" alt="">
        </div>
        <div class="row" >
            <div class="col-12 col-md-6 d-flex justify-content-center align-items-center" >
            <img class="w-75" src="{{ asset('storage/' . $siteSettings->logo_path) }}" alt="logo {{ $siteSettings->shop_name }}" width="">

            </div>
            <div class="col-12 col-md-6 d-flex justify-content-center align-items-center" >
                <div class="d-flex flex-column justify-content-center">
                    <h2 class="">Tentang {{ $siteSettings->shop_name }}</h2>
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
