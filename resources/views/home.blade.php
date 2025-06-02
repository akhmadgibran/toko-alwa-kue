@extends('layouts.app')

@section('content')


{{-- hero section --}}
<section id="guest-hero" class="d-flex justify-content-center align-items-center shadow-lg w-100"
    style="height: 100vh;
           background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), 
                     url('{{ $siteSettings->home_background_path ? asset('storage/' . $siteSettings->home_background_path) : asset('default-images/home-background-default.jpg') }}') center/cover no-repeat;">
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
            <h2 class="title-script">Promotions</h2>
            <p>{{ $siteSettings->promotion_paragraph }}</p>
        </div>
        <div class="col-12 col-sm-9">
            <div class="d-flex flex-row overflow-auto gap-4 pb-5 slider" style="min-height: 100%">
                @if ($productPromotionItems->isEmpty())
                    <div class="d-flex align-items-center justify-content-center">
                        <div class="alert alert-warning " role="alert">
                            {{ __('Belum ada produk best seller.') }}
                        </div>
                    </div>
                @else
                        {{-- best selling 1 --}}
                        @if ($productPromotionId1->product != null)
                        <div class="p-3 rounded-0 bg-card-primer responsive-card" style="width: 18rem; flex: 0 0 auto;">
                            <div>
                                <img src="{{ asset('storage/' . $productPromotionId1->product->image_path) }}" alt="" class="img-fluid shadow-md mb-2">
                                <h4>{{ $productPromotionId1->product->name }}</h4>
                                <p>Rp. {{ number_format($productPromotionId1->product->price, 0, ',', '.') }}</p>
                                <a href="{{ route('product.show', $productPromotionId1->product_id) }}" class="btn bg-button-primer w-100 rounded rounded-5">Pilih produk</a>
                            </div>
                        </div>
                        @endif
                        {{-- end best selling 1 --}}
                        {{-- best selling 2 --}}
                        @if ($productPromotionId2->product != null)
                            <div class="p-3 rounded-0 bg-card-primer responsive-card" style="width: 18rem; flex: 0 0 auto;">
                                <div>
                                    <img src="{{ asset('storage/' . $productPromotionId2->product->image_path) }}" alt="" class="img-fluid shadow-md mb-2">
                                    <h4>{{ $productPromotionId2->product->name }}</h4>
                                    <p>Rp. {{ number_format($productPromotionId2->product->price, 0, ',', '.') }}</p>
                                    <a href="{{ route('product.show', $productPromotionId2->product_id) }}" class="btn bg-button-primer w-100 rounded rounded-5">Pilih produk</a>
                                </div>
                            </div>
                        @endif
                        {{-- end best selling 2 --}}
                        {{-- best selling 3 --}}
                        @if ($productPromotionId3->product != null)
                            <div class="p-3 rounded-0 bg-card-primer responsive-card" style="width: 18rem; flex: 0 0 auto;">
                                <div>
                                    <img src="{{ asset('storage/' . $productPromotionId3->product->image_path) }}" alt="" class="img-fluid shadow-md mb-2">
                                    <h4>{{ $productPromotionId3->product->name }}</h4>
                                    <p>Rp. {{ number_format($productPromotionId3->product->price, 0, ',', '.') }}</p>
                                    <a href="{{ route('product.show', $productPromotionId3->product_id) }}" class="btn bg-button-primer w-100 rounded rounded-5">Pilih produk</a>
                                </div>
                            </div>
                        @endif
                        {{-- end best selling 3 --}}
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
