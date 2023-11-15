@extends('layouts.app')

@section('guest_content')
<div class="login-form">
    <h2>Admin Login</h2>
    <form method="POST" action="{{ route('login') }}">
        @csrf

        @if($errors->any())
            {{ implode('', $errors->all('<div>:message</div>')) }}
        @endif
        <div class="form-group">
            <label for="username">Email:</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Enter your Email" value="{{ old('email') }}" name="email">
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Enter your password" name="password">
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
</div>
@endsection