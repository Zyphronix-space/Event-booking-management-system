@extends('layouts.app')

@section('title', 'Organizer Login')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-5">
            <h1 class="mb-4">Organizer Login</h1>
            <form method="POST" action="{{ route('organizer.login') }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" name="username" value="{{ old('username') }}" class="form-control" required autofocus>
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <button class="btn btn-primary w-100">Login</button>
            </form>
            <p class="mt-3 text-muted">Organizer accounts are created by an administrator.</p>
        </div>
    </div>
@endsection
