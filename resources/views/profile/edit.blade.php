@extends('layouts.app')

@section('content')
{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Profile') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('user-profile-information.update') }}">
                        @csrf
                        @method('PUT')
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') ?? Auth::user()->name }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') ?? Auth::user()->email }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="phone" class="col-md-4 col-form-label text-md-end">{{ __('Whatsapp Number') }}</label>

                            <div class="col-md-6">
                                <input id="phone" type="phone" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') ?? Auth::user()->phone }}" required autofocus>

                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="address" class="col-md-4 col-form-label text-md-end">{{ __('Address') }}</label>
                        
                            <div class="col-md-6">
                                <textarea id="address" class="form-control @error('address') is-invalid @enderror" name="address" required autofocus>{{ old('address') ?? Auth::user()->address }}</textarea>
                        
                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>




                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update Profile') }}
                                </button>


                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}

{{-- <section id="profile-edit" class="container" style="min-height: 100vh;">
    <div class="d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="bg-card-primer shadow-sm rounded rounded-4 p-5 responsive-card mx-auto">
            <h2 class="text-center title-script">Edit Profile</h2>
            <form method="POST" action="{{ route('user-profile-information.update') }}">
                @csrf
                @method('PUT')
                <div class="row mb-3">
                    <label for="name" class="col-md-4 col-form-label text-md-end">Name</label>

                    <div class="col-md-6">
                        <input id="name" type="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') ?? Auth::user()->name }}" required autocomplete="name" autofocus>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') ?? Auth::user()->email }}" required autocomplete="email" autofocus>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="phone" class="col-md-4 col-form-label text-md-end">{{ __('Whatsapp Number') }}</label>

                    <div class="col-md-6">
                        <input id="phone" type="phone" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') ?? Auth::user()->phone }}" required autofocus>

                        @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="address" class="col-md-4 col-form-label text-md-end">{{ __('Address') }}</label>
                
                    <div class="col-md-6">
                        <textarea id="address" class="form-control @error('address') is-invalid @enderror" name="address" required autofocus>{{ old('address') ?? Auth::user()->address }}</textarea>
                
                        @error('address')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-0">
                    <div class="col-md-8 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Update Profile') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section> --}}

{{-- <section id="profile-edit" class="container" style="min-height: 100vh;">
    <div class="row justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="col-lg-8">
            <div class="bg-card-primer shadow-sm rounded rounded-4 p-5 mx-auto" style="max-width: 100%; width: 100%;">
                <h2 class="text-center title-script">Edit Profile</h2>
                <form method="POST" action="{{ route('user-profile-information.update') }}">
                    @csrf
                    @method('PUT')
                    <div class="row mb-3">
                        <label for="name" class="col-md-4 col-form-label text-md-end">Name</label>
                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                name="name" value="{{ old('name') ?? Auth::user()->name }}" required autocomplete="name" autofocus>
                            @error('name')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="email" class="col-md-4 col-form-label text-md-end">Email Address</label>
                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') ?? Auth::user()->email }}" required autocomplete="email">
                            @error('email')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="phone" class="col-md-4 col-form-label text-md-end">Whatsapp Number</label>
                        <div class="col-md-6">
                            <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror"
                                name="phone" value="{{ old('phone') ?? Auth::user()->phone }}" required>
                            @error('phone')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="address" class="col-md-4 col-form-label text-md-end">Address</label>
                        <div class="col-md-6">
                            <textarea id="address" class="form-control @error('address') is-invalid @enderror"
                                name="address" required>{{ old('address') ?? Auth::user()->address }}</textarea>
                            @error('address')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-0">
                        <div class="col-md-8 offset-md-4">
                            <button type="submit" class="btn bg-button-primer">Update Profile</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section> --}}

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