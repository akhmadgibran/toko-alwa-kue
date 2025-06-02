{{-- best seller managemeent page --}}

@extends('layouts.app')

@section('content')
    <div class="container" style="height: 100vh;">
        <h1 class="mt-4">Product Promotion Management</h1>
        <div class="d-flex flex-column algin-items-center">
            @if ($products->isEmpty())
                <div class="alert alert-warning" role="alert">
                    {{ __('Tolong Tambah Product terlebih dahulu.') }}
                </div>
            @endif
            @foreach ($productPromotionItems as $Item)
                @php
                    $actionRoute =
                        Auth::user()->usertype == 'admin'
                            ? route('admin.productpromotion.update', $Item->id)
                            : route('superadmin.productpromotion.update', $Item->id);
                @endphp
                <div class="d-flex flex-column">
                    <form action="{{ $actionRoute }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="d-flex flex-row">
                            <select name="product_id" class="form-select mb-3">
                                {{-- Option for selecting "no product" (represents null) --}}
                                <option value="" {{ is_null($Item->product_id) ? 'selected' : '' }}>
                                    -- Select Product (or None) --
                                </option>

                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}"
                                        {{ $Item->product_id == $product->id ? 'selected' : '' }}>
                                        {{ $product->name }}
                                    </option>
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
