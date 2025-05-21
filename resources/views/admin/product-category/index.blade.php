{{-- product categories index --}}
@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center" style="height: 100vh;">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Product Categories</div>

                

                <div class="card-body">
                    {{-- to create page small button --}}
                    <a href="{{ Auth::user()->usertype == 'admin' ? route('admin.category.create') : route('superadmin.category.create') }}" class="btn btn-primary">Create</a>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Description</th>
                                <th scope="col">Image</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                                <tr>
                                    <th scope="row">{{ $category->id }}</th>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->description }}</td>
                                    <td><img style="width: 50%" src="{{ asset('storage/' . $category->image_path) }}" alt="{{ $category->name }}"></td>
                                    <td>
                                        <a href="{{ Auth::user()->usertype == 'admin' ? route('admin.category.edit', $category->id) : route('superadmin.category.edit', $category->id) }}" class="btn btn-primary">Edit</a>
                                        <form action="{{ Auth::user()->usertype == 'admin' ? route('admin.category.destroy', $category->id) : route('superadmin.category.destroy', $category->id) }}" method="POST" style="display: inline-block">
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
</div>
@endsection