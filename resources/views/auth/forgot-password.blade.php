@extends('layouts.app')

@section('content')
{{-- <div class="container" style="min-height: 70vh">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}

<section id="forgot-password-page" class="container" style="min-height: 100vh;">
    <div class="d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="bg-card-primer shadow-sm rounded rounded-4 p-5 responsive-card mx-auto">
            <h2 class="text-center title-script mb-4">{{ __('Forgot Your Password?') }}</h2>

            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <p class="text-center mb-4">{{ __('No problem. Just let us know your email address and we will email you a password reset link.') }}</p>

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label">{{ __('Email Address') }}</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <button type="submit" class="btn bg-button-primer w-100">
                    {{ __('Send Password Reset Link') }}
                </button>
            </form>

            <div class="text-center mt-4">
                <p>Remember your password? <a href="{{ route('login') }}" class="text-decoration-none">Login here</a></p>
            </div>
        </div>
    </div>
</section>
@endsection