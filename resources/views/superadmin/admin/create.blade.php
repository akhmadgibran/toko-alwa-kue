{{-- create page for superadmin to add new admin --}}
@extends('layouts.app')

@section('content')
<div class="row justify-content-center mt-5" style="height: 100vh;">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Create Admin</div>
            <div class="card-body">
                {{-- if error --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('superadmin.admin.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="form-group" >
                        <label for="phone">Phone Number</label>
                        <input type="tel" class="form-control" id="phone" name="phone" >
                    </div>
                    <div class="form-group" >
                        <label for="address">Address</label>
                        <textarea type="text" class="form-control" id="address" name="address">
                        </textarea>
                    </div>
                    <button type="submit" class="btn btn-primary mt-2">Create</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection