@extends('layouts.app')

@section('title', 'Register')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h1 class="mb-4">Create Your Account</h1>
            <form method="POST" action="{{ route('customer.register') }}">
                @csrf
                <div class="mb-3">
                    <label for="full_name" class="form-label">Full Name</label>
                    <input id="full_name" type="text" name="full_name" value="{{ old('full_name') }}" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="phone_number" class="form-label">Phone Number</label>
                    <input id="phone_number" type="text" name="phone_number" value="{{ old('phone_number') }}" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input id="username" type="text" name="username" value="{{ old('username') }}" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input id="password" type="password" name="password" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" class="form-control" required>
                </div>
                <p class="form-text">By creating an account you agree to the <a href="{{ route('terms') }}">Terms and Conditions</a> and confirm you've read the <a href="{{ route('privacy') }}">Privacy Policy</a>.</p>
                <button class="btn btn-primary w-100">Register</button>
            </form>
            <p class="mt-3">Already have an account? <a href="{{ route('customer.login') }}">Login here</a>.</p>
        </div>
    </div>
@endsection
