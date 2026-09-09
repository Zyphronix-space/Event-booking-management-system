@extends('layouts.app')

@section('title', 'Update Organizer')

@section('content')
    <h1 class="mb-4">Update Organizer</h1>

    <form method="POST" action="{{ route('admin.organizers.update', $organizer) }}" class="col-md-6">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="organizer_name" class="form-label">Organizer Name</label>
            <input id="organizer_name" type="text" name="organizer_name" value="{{ old('organizer_name', $organizer->organizer_name) }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="contact_email" class="form-label">Contact Email</label>
            <input id="contact_email" type="email" name="contact_email" value="{{ old('contact_email', $organizer->contact_email) }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="contact_number" class="form-label">Contact Number</label>
            <input id="contact_number" type="text" name="contact_number" value="{{ old('contact_number', $organizer->contact_number) }}" class="form-control">
        </div>
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input id="username" type="text" name="username" value="{{ old('username', $organizer->username) }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Password <span class="text-muted small">(leave blank to keep unchanged)</span></label>
            <input type="password" name="password" class="form-control">
        </div>
        <button class="btn btn-primary">Save Changes</button>
        <a href="{{ route('admin.organizers.index') }}" class="btn btn-link">Cancel</a>
    </form>
@endsection
