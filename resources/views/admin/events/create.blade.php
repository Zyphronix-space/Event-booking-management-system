@extends('layouts.app')

@section('title', 'Add Event')

@section('content')
    <h1 class="mb-4">Add Event</h1>

    <form method="POST" action="{{ route('admin.events.store') }}" class="col-md-6">
        @csrf
        <div class="mb-3">
            <label class="form-label">Event Name</label>
            <input type="text" name="event_name" value="{{ old('event_name') }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Event Date</label>
            <input type="date" name="event_date" value="{{ old('event_date') }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Venue</label>
            <input type="text" name="venue" value="{{ old('venue') }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Category</label>
            <input type="text" name="category" value="{{ old('category') }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Ticket Price (Rs.)</label>
            <input type="number" step="0.01" name="ticket_price" value="{{ old('ticket_price') }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Organizer</label>
            <select name="organizer_id" class="form-select" required>
                <option value="">-- Select Organizer --</option>
                @foreach ($organizers as $organizer)
                    <option value="{{ $organizer->organizer_id }}" @selected(old('organizer_id') == $organizer->organizer_id)>{{ $organizer->organizer_name }}</option>
                @endforeach
            </select>
        </div>
        <button class="btn btn-primary">Create Event</button>
        <a href="{{ route('admin.events.index') }}" class="btn btn-link">Cancel</a>
    </form>
@endsection
