{{-- edit page for superadmin, to change admin information --}}
@extends('layouts.app')

@section('content')
<div class="row justify-content-center mt-5" style="height: 100vh;">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Edit Admin</div>
            <div class="card-body">
                <form action="{{ route('superadmin.admin.update', $admin->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $admin->name }}" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ $admin->email }}" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone Number</label>
                        <input type="tel" class="form-control" id="phone" name="phone" value="{{ $admin->phone }}">
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <textarea type="text" class="form-control" id="address" name="address" value="{{ $admin->address }}">
                        </textarea>
                    </div>
                    <button type="submit" class="btn btn-primary mt-2">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection