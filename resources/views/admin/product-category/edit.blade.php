{{-- Product Categories Edit Form for update --}}
@extends('layouts.app')

@section('content')
<div class="container mt-5">
<div class="row justify-content-center" style="height: 100vh;">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Edit Product Category</div>
            <div class="card-body">
                <form action="{{ Auth::user()->usertype == 'admin' ? route('admin.category.update', $productCategory->id) : route('superadmin.category.update', $productCategory->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $productCategory->name }}" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" name="description" required>{{ $productCategory->description }}</textarea>
                    </div>
                    <div class="form-group mt-2">
                        <label for="image">Image</label>
                        <input type="file" class="form-control-file" id="image" name="image">
                    </div>
                    <button type="submit" class="btn btn-primary mt-2">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
