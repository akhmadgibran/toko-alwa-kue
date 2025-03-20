{{-- index for product with button to create view --}}
@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Products</div>
            <div class="card-body">
                <a href="{{ Auth::user()->usertype == 'admin' ? route('admin.product.create') : route('superadmin.product.create') }}" class="btn btn-primary">Create</a>

                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Description</th>
                            <th scope="col">Category</th>
                            <th scope="col">Price</th>
                            <th scope="col">Image</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <th scope="row">{{ $product->id }}</th>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->description }}</td>
                                <td>{{ $product->category->name }}</td>
                                <td>Rp. {{ $product->price }}</td>
                                <td><img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}"></td>
                                <td>
                                    <a href="{{ Auth::user()->usertype == 'admin' ? route('admin.product.edit', $product->id) : route('superadmin.product.edit', $product->id) }}" class="btn btn-primary">Edit</a>
                                    <form action="{{ Auth::user()->usertype == 'admin' ? route('admin.product.destroy', $product->id) : route('superadmin.product.destroy', $product->id) }}" method="POST" style="display: inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection