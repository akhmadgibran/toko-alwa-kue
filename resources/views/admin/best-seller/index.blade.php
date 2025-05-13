{{-- best seller managemeent page --}}

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mt-4">Best Seller Management</h1>
        <div class="d-flex flex-column algin-items-center" >
            @if ($products->isEmpty())
                <div class="alert alert-warning" role="alert">
                    {{ __('Tolong Tambah Product terlebih dahulu.') }}
                </div>
                
            @endif
            @foreach ($bestSellerItems as $Item)
                @php
                    $actionRoute = Auth::user()->usertype == 'admin' ? route('admin.bestseller.update', $Item->id) : route('superadmin.bestseller.update', $Item->id);
                @endphp
                <div class="d-flex flex-column" >
                    <form action="{{ $actionRoute }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="d-flex flex-row" >
                        <select name="product_id" class="form-select mb-3">
                            @foreach ($products as $product )
                            <option value="{{ $product->id }}" {{ $Item->product_id == $product->id ? 'selected' : '' }}>{{ $product->name }}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn btn-primary mb-3 mx-2">Update</button>
                    </div>  
                    
                </form>
                </div>
            @endforeach
        </div>
    </div>
@endsection