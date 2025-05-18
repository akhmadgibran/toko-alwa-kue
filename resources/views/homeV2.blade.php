@extends('layouts.app')

@section('content')


{{-- hero section --}}
<section id="guest-hero" class="d-flex justify-content-center align-items-center shadow-lg w-100"
    style="height: 100vh;
           background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), 
                     url('{{ asset('backgrounds/hero-background.jpg') }}') center/cover no-repeat;">
    <div class="text-center text-white">
        <h1 class="quote-script">Selamat Datang di {{ $siteSettings->shop_name }}</h1>
        <p>Pilih product apa hari ini ?</p>
        <a href="{{ route('product.category') }}" class="btn bg-button-primer">Product Kami</a>
    </div>
</section>
{{-- end hero section --}}


{{-- best selling new version --}}
<section id="" class="container" >
    <div class="row p-5" >
        <div class="col-12 col-sm-3">
            <h2 class="title-script">Best Selling</h2>
            <p>Discover our new premium Specialty Cakes. The perfect fusion of innovative design and timeless flavors. Enjoy intricate layers, delicate textures, and balanced flavours in every bite.</p>
        </div>
        <div class="col-12 col-sm-9">
            <div class="d-flex flex-row overflow-auto gap-4 pb-5 slider">
                @if ($bestSellerItems->isEmpty())
                    <div class="alert alert-warning" role="alert">
                        {{ __('Belum ada produk best seller.') }}
                    </div>
                @else
                    @foreach($bestSellerItems as $Item)
                        {{-- products --}}
                        <div class="p-3 rounded-0 bg-card-primer responsive-card" style="width: 18rem; flex: 0 0 auto;">
                            <div>
                                <img src="{{ asset('storage/' . $Item->product->image_path) }}" alt="" class="img-fluid shadow-md mb-2">
                                <h4>{{ $Item->product->name }}</h4>
                                <p>Rp. {{ number_format($Item->product->price, 0, ',', '.') }}</p>
                                <a href="{{ route('product.show', $Item->product_id) }}" class="btn bg-button-primer w-100 rounded rounded-5">Pilih produk</a>
                            </div>
                        </div>
                        {{-- end products --}}
                    @endforeach
                @endif

            </div>
        </div>

    </div>
</section>
{{-- end best selling new version --}}





{{-- slogan section --}}
<section id="slogan" class="d-flex justify-content-center align-items-center bg-card-primer shadow-sm" style="min-height: 30vh" >
    <div class="container">
        <div class="text-center py-4" >
            <h2 class="quote-script">{{ $siteSettings->slogan }}</h2>
        </div>
    </div>
</section>
{{-- end slogan section --}}








@endsection
