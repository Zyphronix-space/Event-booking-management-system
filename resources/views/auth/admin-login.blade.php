@extends('layouts.app')

@section('title', 'Admin Login')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-5">
            <h1 class="mb-4">Admin Login</h1>
            <form method="POST" action="{{ route('admin.login') }}">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" class="form-control" required autofocus>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input id="password" type="password" name="password" class="form-control" required>
                </div>
                <button class="btn btn-dark w-100">Login</button>
            </form>
        </div>
    </div>
@endsection
