@extends('layouts.app')

@section('content')
<section id="forgot-password-page" class="container" style="min-height: 100vh;">
    <div class="d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="bg-card-primer shadow-sm rounded rounded-4 p-5 responsive-card mx-auto">
            <h2 class="text-center title-script mb-4">{{ __('Selamat Datang!') }}</h2>

            {{-- @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif --}}

            <p class="text-center mb-4">{{ __('Selamat datang di Alwa Kue, kami menyediakan berbagai macam kue untuk keperluan mu!') }}</p>

            <div>
                <a href="{{ route('home') }}" class="btn bg-button-primer w-100">
                    {{ __('Mulai Belanja') }}
                </a>
            </div>
        </div>
    </div>
</section>

@endsection