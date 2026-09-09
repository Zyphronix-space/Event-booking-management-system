@extends('layouts.app')

@section('title', 'Add Customer')

@section('content')
    <h1 class="mb-4">Add Customer</h1>

    <form method="POST" action="{{ route('admin.customers.store') }}" class="col-md-6">
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
        <button class="btn btn-primary">Create Customer</button>
        <a href="{{ route('admin.customers.index') }}" class="btn btn-link">Cancel</a>
    </form>
@endsection
