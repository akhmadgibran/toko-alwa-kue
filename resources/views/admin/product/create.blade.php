{{-- create page for product --}}
@extends('layouts.app')

@section('content')
<div class="row justify-content-center mt-5" style="height: 100vh;">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Create Product</div>
            <div class="card-body">
                <form action="{{ Auth::user()->usertype == 'admin' ? route('admin.product.store') : route('superadmin.product.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>    
                        <textarea class="form-control" id="description" name="description" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="number" step="0.01" class="form-control" id="price" name="price" required>
                    </div>
                    <div class="form-group mt-2">
                        <label for="image">Image</label>
                        <input type="file" class="form-control-file" id="image" name="image" required>
                        <p class="text-danger mb-0" style="font-size: 11px; mb-0">*ukuran file max 2MB</p>
                    </div>
                    <div class="form-group">
                        <label for="category_id">Category</label>
                        <select class="form-control" id="category_id" name="category_id" required>
                            <option value="" disabled selected>Select Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        
                    </div>
                    <button type="submit" class="btn btn-primary mt-2">Create</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
