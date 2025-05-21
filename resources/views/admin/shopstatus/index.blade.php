{{-- index for admin and superadmin, in this view, admin and superadmin can select what status, is it open or closed, and after selecting, it will fill the description form with the old value, this view will include update button, so if superadmin or admin select example : open, it will fill the description form with the old value so superadmin or admin can update the description, and click update button to update current shop --}}
@extends('layouts.app')

@section('content')
<div class="row justify-content-center mt-5" style="height: 100vh;">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Shop Status</div>
            <div class="card-body">
                <form action="{{ Auth::user()->usertype == 'admin' ? route('admin.shopstatus.update') : route('superadmin.shopstatus.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">Status</label>
                        <select class="form-control" id="name" name="name">
                            <option value="" disabled selected>Select Status</option>
                            <option value="open" {{ $shopstatus->name == 'open' ? 'selected' : '' }}>Buka</option>
                            <option value="closed" {{ $shopstatus->name == 'closed' ? 'selected' : '' }}>Tutup</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>    
                        <textarea class="form-control" id="description" name="description" required>{{ $shopstatus->description }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary mt-2">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection