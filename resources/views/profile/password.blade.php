@extends('layouts.app')

@section('content')
{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Change Password') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('user-password.update') }}">
                        @csrf
                        @method('PUT')

                        @if (session('status') == 'password-updated')
                            <div class="alert alert-success" role="alert">
                                {{ __('Password updated successfully!') }}
                            </div>
                        @endif


                 

                        <div class="row mb-3">
                            <label for="current_password" class="col-md-4 col-form-label text-md-end">{{ __('Current Password') }}</label>

                            <div class="col-md-6">
                                <input id="current_password" type="password" class="form-control @error('current_password', 'updatePassword') is-invalid @enderror" name="current_password"  required autofocus>

                                @error('current_password', 'updatePassword')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password', 'updatePassword') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password', 'updatePassword')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Change Password') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}

<section id="change-password-page" class="container" style="min-height: 100vh;">
    <div class="d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="bg-card-primer shadow-sm rounded rounded-4 p-5 responsive-card mx-auto">
            <h2 class="text-center title-script mb-4">{{ __('Change Password') }}</h2>

            <form method="POST" action="{{ route('user-password.update') }}">
                @csrf
                @method('PUT') {{-- Important for updating resources --}}

                @if (session('status') == 'password-updated')
                    <div class="alert alert-success mb-4" role="alert">
                        {{ __('Password updated successfully!') }}
                    </div>
                @endif

                {{-- Current Password Field --}}
                <div class="mb-3">
                    <label for="current_password" class="form-label">{{ __('Current Password') }}</label>
                    <input id="current_password" type="password" class="form-control @error('current_password', 'updatePassword') is-invalid @enderror" name="current_password" required autofocus>
                    @error('current_password', 'updatePassword')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                {{-- New Password Field --}}
                <div class="mb-3">
                    <label for="password" class="form-label">{{ __('New Password') }}</label>
                    <input id="password" type="password" class="form-control @error('password', 'updatePassword') is-invalid @enderror" name="password" required autocomplete="new-password">
                    @error('password', 'updatePassword')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                {{-- Confirm New Password Field --}}
                <div class="mb-3">
                    <label for="password-confirm" class="form-label">{{ __('Confirm New Password') }}</label>
                    <input id="password-confirm" type="password" class="form-control @error('password_confirmation', 'updatePassword') is-invalid @enderror" name="password_confirmation" required autocomplete="new-password">
                     {{-- Displaying confirmation error if any, using the same error bag --}}
                    @error('password_confirmation', 'updatePassword')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <button type="submit" class="btn bg-button-primer w-100">
                    {{ __('Change Password') }}
                </button>
            </form>
        </div>
    </div>
</section>
@endsection