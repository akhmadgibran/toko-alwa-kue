@extends('layouts.app')

@section('content')
{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verify Your Email Address') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}

    <div class="d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="bg-card-primer shadow-sm rounded rounded-4 p-5 responsive-card mx-auto text-center">
            {{-- Themed title for the verification page --}}
            <h2 class="text-center title-script mb-4">{{ __('Verify Your Email Address') }}</h2>

            {{-- Success message if a new link was just sent --}}
            @if (session('resent'))
                <div class="alert alert-success mb-4" role="alert">
                    {{ __('A fresh verification link has been sent to your email address.') }}
                </div>
            @endif

            {{-- Informational text about checking email --}}
            <p class="mb-3">{{ __('Before proceeding, please check your email for a verification link.') }}</p>
            <p class="mb-0">{{ __('If you did not receive the email') }},</p>

            {{-- Form to request another verification link --}}
            {{-- Using d-inline-block for better layout control with text-center on parent --}}
            <form class="d-inline-block mt-2" method="POST" action="{{ route('verification.send') }}">
                @csrf
                {{-- Styling the button to look like a link but with your theme's button class if desired --}}
                {{-- Or keep it as a simple link-styled button if that fits better --}}
                <button type="submit" class="btn btn-link p-0 m-0 align-baseline text-decoration-none">{{ __('click here to request another') }}</button>.
            </form>

            {{-- Optional: Add a link to logout or go back to home if appropriate --}}
            <div class="mt-4">
                <p>
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                       class="btn btn-danger w-100">
                        {{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </p>
            </div>
        </div>
    </div>
@endsection