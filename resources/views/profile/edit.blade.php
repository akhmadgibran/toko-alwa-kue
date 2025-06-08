@extends('layouts.app')

@section('content')
<section id="profile-edit" class="container" style="min-height: 100vh;">
    <div class="d-flex justify-content-center align-items-center" style="min-height: 100vh;"> {{-- Added d-flex for vertical centering --}}
        <div class="bg-card-primer shadow-sm rounded rounded-4 p-5 responsive-card mx-auto" style="max-width: 700px; width: 100%;"> {{-- Used responsive-card and set a max-width --}}
            <h2 class="text-center title-script mb-4">{{ __('Edit Profile') }}</h2>

            @if (session('status') == 'profile-information-updated')
                <div class="alert alert-success mb-4" role="alert">
                    {{ __('Profile updated successfully!') }}
                </div>
            @endif

            <form method="POST" action="{{ route('user-profile-information.update') }}">
                @csrf
                @method('PUT')

                {{-- Name Field --}}
                <div class="mb-3">
                    <label for="name" class="form-label">{{ __('Name') }}</label>
                    <input id="name" type="text" class="form-control @error('name', 'updateProfileInformation') is-invalid @enderror"
                           name="name" value="{{ old('name', Auth::user()->name) }}" required autocomplete="name" autofocus>
                    @error('name', 'updateProfileInformation')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                {{-- Email Field --}}
                <div class="mb-3">
                    <label for="email" class="form-label">{{ __('Email Address') }}</label>
                    <input id="email" type="email" class="form-control @error('email', 'updateProfileInformation') is-invalid @enderror"
                           name="email" value="{{ old('email', Auth::user()->email) }}" required autocomplete="email">
                    @error('email', 'updateProfileInformation')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                {{-- Phone Field --}}
                <div class="mb-3">
                    <label for="phone" class="form-label">{{ __('Whatsapp Number') }}</label>
                    <input id="phone" type="text" class="form-control @error('phone', 'updateProfileInformation') is-invalid @enderror"
                           name="phone" value="{{ old('phone', Auth::user()->phone) }}" required>
                    @error('phone', 'updateProfileInformation')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                {{-- Address Field --}}
                <div class="mb-3">
                    <label for="address" class="form-label">{{ __('Address') }}</label>
                    <textarea id="address" class="form-control @error('address', 'updateProfileInformation') is-invalid @enderror"
                              name="address" required>{{ old('address', Auth::user()->address) }}</textarea>
                    @error('address', 'updateProfileInformation')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                {{-- Link to Change Password Page --}}
                <div class="mb-3 text-center"> {{-- Centering the link --}}
                    <a href="{{ route('profile.password') }}" class="text-decoration-none">{{ __('Change Password?') }}</a>
                </div>

                <button type="submit" class="btn bg-button-primer w-100">{{ __('Update Profile') }}</button>

            </form>
        </div>
    </div>
</section>
@endsection