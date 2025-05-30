@extends('layouts.app')

@section('content')
<section id="register-page" class="container" style="min-height: 100vh;">
    <div class="d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="bg-card-primer shadow-sm rounded rounded-4 p-5 responsive-card mx-auto">
            <h2 class="text-center title-script">Register</h2>
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                </div>
                <button type="submit" class="btn bg-button-primer w-100">Register</button>
            </form>
        </div>
    </div>
</section>
@endsection