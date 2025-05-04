@extends('layouts.app')

@section('content')
{{-- hero section --}}
<section id="guest-hero" class="d-flex justify-content-center align-items-center shadow-lg" style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('{{ asset('backgrounds/hero-background.jpg') }}') center/cover ;" >
    <div class="text-center text-white" >
        <h1>Selamat Datang di Alwa Kue</h1>
        <p>Pilih product apa hari ini ?</p>
        <a href="{{ route('product.category') }}" class="btn btn-primary">Product Kita</a>
    </div>
</section>
{{-- end hero section --}}

{{-- about section --}}
<section id="about" class="py-5">
    <div class="container">
        <div class="text-center py-4" >
            <h2>Tentang Kami</h2>
        </div>
        <div class="row" >
            <div class="col-12 col-md-6 d-flex justify-content-center align-items-center" >
                    <img src="{{ asset('logo/logo.png') }}" alt="" width="250">
            </div>
            <div class="col-12 col-md-6 d-flex justify-content-center align-items-center" >
                <div class="d-flex flex-column justify-content-center">
                    <h2 class="text-center">Tentang Alwa Kue</h2>
                    <p class="text-center">ALWA KUE merupakan toko kue di Tulungagung yang menyediakan berbagai macam aneka Snack, Cookies, Tart, Kue Tradisional, Paket Snack, dan masih banyak lagi produk yang kami tawarkan. Kini, ALWA KUE hadir di Sebalor, Kec. Bandung, Kabupaten Tulungagung, Jawa Timur 66274. Kami juga melayani pemesanan secara online melalui WhatsApp dan Instagram. 
                    </p>
                    <p class="text-center" >
                        Dengan tema “APAPUN ACARANYA, ALWA KUE SOLUSINYA”, kami siap melayani segala kebutuhan Sahabat ALWA.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
{{-- end about section --}}

{{-- slogan section --}}
<section id="slogan" class="d-flex justify-content-center align-items-center bg-body-secondary shadow-sm" style="min-height: 30vh" >
    <div class="container">
        <div class="text-center py-4" >
            <h2>Apapun acaranya, Alwa Kue solusinya.</h2>
        </div>
    </div>
</section>
{{-- end slogan section --}}

{{-- best selling section --}}
<section id="best-selling" class="d-flex flex-column justify-content-center" style="min-height: 70vh" >
    <div class="container ">
        <div class="text-center py-4" >
            <h2>Best Selling Product !</h2>
        </div>
        <div class="row p-4" >
            <div class="col-md-4 col-sm-6 mb-4 " >
                {{-- style="max-width: 350px; min-width: 10%;" --}}
                <a href="">
                    <img src="{{ asset('sample/square-product.png') }}" class="img-fluid shadow"  alt="">
                </a>
            </div>
            <div class="col-md-4 col-sm-6 mb-4 " >
                {{-- style="max-width: 350px; min-width: 10%;" --}}
                <a href="">
                    <img src="{{ asset('sample/square-product.png') }}" class="img-fluid shadow"  alt="">
                </a>
            </div>
            <div class="col-md-4 col-sm-6 mb-4 " >
                {{-- style="max-width: 350px; min-width: 10%;" --}}
                <a href="">
                    <img src="{{ asset('sample/square-product.png') }}" class="img-fluid shadow"  alt="">
                </a>
            </div>
        </div>
    </div>
</section>
{{-- end best selling section --}}

@endsection
