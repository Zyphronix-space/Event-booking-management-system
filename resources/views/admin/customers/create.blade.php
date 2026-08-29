@extends('layouts.app')

@section('title', 'Add Customer')

@section('content')
    <h1 class="mb-4">Add Customer</h1>

    <form method="POST" action="{{ route('admin.customers.store') }}" class="col-md-6">
        @csrf
        <div class="mb-3">
            <label class="form-label">Full Name</label>
            <input type="text" name="full_name" value="{{ old('full_name') }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Phone Number</label>
            <input type="text" name="phone_number" value="{{ old('phone_number') }}" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Username</label>
            <input type="text" name="username" value="{{ old('username') }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button class="btn btn-primary">Create Customer</button>
        <a href="{{ route('admin.customers.index') }}" class="btn btn-link">Cancel</a>
    </form>
@endsection
