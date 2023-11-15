@extends('layouts.app')

@section('content')
<h5>Admin Profile</h5>


@if (Session::has('success'))
            <div class="alert alert-success  text-color">{{ Session::get('success') }}</div>
        @endif
<div class="custom-form">
    <form method="POST" action="{{ route('update-profile') }}">
        @csrf
        
        <div class="form-group">
            <label>Name:</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Enter your Name" name="name" value="{{ old('name', $user->name) }}">
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <label>Phone:</label>
            <input type="text" class="form-control @error('phone') is-invalid @enderror" placeholder="Enter your Contact Number" name="phone" value="{{ old('phone', $user->phone) }}">
            @error('phone')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <label>Identity Number (Aadhar Number):</label>
            <input type="text" class="form-control @error('identity_number') is-invalid @enderror" id="identity_number" placeholder="Enter your Identity Number (Aadhar Number)" name="identity_number" value="{{ old('identity_number', $user->identity_number) }}">
            @error('identity_number')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        
        <button type="submit" class="btn btn-primary">Update Profile</button>
    </form>
</div>
@endsection