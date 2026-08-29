@extends('layouts.app')

@section('title', 'Update Customer')

@section('content')
    <h1 class="mb-4">Update Customer</h1>

    <form method="POST" action="{{ route('admin.customers.update', $customer) }}" class="col-md-6">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">Full Name</label>
            <input type="text" name="full_name" value="{{ old('full_name', $customer->full_name) }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" value="{{ old('email', $customer->email) }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Phone Number</label>
            <input type="text" name="phone_number" value="{{ old('phone_number', $customer->phone_number) }}" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Username</label>
            <input type="text" name="username" value="{{ old('username', $customer->username) }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Password <span class="text-muted small">(leave blank to keep unchanged)</span></label>
            <input type="password" name="password" class="form-control">
        </div>
        <button class="btn btn-primary">Save Changes</button>
        <a href="{{ route('admin.customers.index') }}" class="btn btn-link">Cancel</a>
    </form>
@endsection
