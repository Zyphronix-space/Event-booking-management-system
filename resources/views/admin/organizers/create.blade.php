@extends('layouts.app')

@section('title', 'Add Organizer')

@section('content')
    <h1 class="mb-4">Add Organizer</h1>

    <form method="POST" action="{{ route('admin.organizers.store') }}" class="col-md-6">
        @csrf
        <div class="mb-3">
            <label for="organizer_name" class="form-label">Organizer Name</label>
            <input id="organizer_name" type="text" name="organizer_name" value="{{ old('organizer_name') }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="contact_email" class="form-label">Contact Email</label>
            <input id="contact_email" type="email" name="contact_email" value="{{ old('contact_email') }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="contact_number" class="form-label">Contact Number</label>
            <input id="contact_number" type="text" name="contact_number" value="{{ old('contact_number') }}" class="form-control">
        </div>
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input id="username" type="text" name="username" value="{{ old('username') }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input id="password" type="password" name="password" class="form-control" required>
        </div>
        <button class="btn btn-primary">Create Organizer</button>
        <a href="{{ route('admin.organizers.index') }}" class="btn btn-link">Cancel</a>
    </form>
@endsection
