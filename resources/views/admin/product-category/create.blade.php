{{-- create form for product-category --}}
@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class=" row justify-content-center" style="height: 100vh;">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Create Product Category</div>
            <div class="card-body">
                <form action="{{ Auth::user()->usertype == 'admin' ? route('admin.category.store') : route('superadmin.category.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" name="description" required></textarea>
                    </div>
                    <div class="form-group mt-2">
                        <label for="image">Image</label>
                        <input type="file" class="form-control-file" id="image" name="image" required>
                        <p class="text-danger mb-0" style="font-size: 11px; mb-0">*ukuran file max 2MB</p>
                    </div>
                    <button type="submit" class="btn btn-primary mt-2">Create</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>

@endsection