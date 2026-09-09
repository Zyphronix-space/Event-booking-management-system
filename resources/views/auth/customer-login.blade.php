@extends('layouts.app')

@section('title', 'Customer Login')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-5">
            <h1 class="mb-4">Customer Login</h1>
            <form method="POST" action="{{ route('customer.login') }}">
                @csrf
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input id="username" type="text" name="username" value="{{ old('username') }}" class="form-control" required autofocus>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input id="password" type="password" name="password" class="form-control" required>
                </div>
                <div class="form-check mb-3">
                    <input type="checkbox" name="remember" class="form-check-input" id="remember">
                    <label class="form-check-label" for="remember">Remember me</label>
                </div>
                <button class="btn btn-primary w-100">Login</button>
            </form>
            <p class="mt-3">New here? <a href="{{ route('customer.register') }}">Create an account</a>.</p>
        </div>
    </div>
@endsection
