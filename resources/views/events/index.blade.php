@extends('layouts.app')

@section('title', 'Browse Events')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Upcoming Events</h1>
    </div>

    <form method="GET" action="{{ route('events.index') }}" class="row g-2 mb-4">
        <div class="col-auto flex-grow-1">
            <label for="search" class="visually-hidden">Search events by name</label>
            <input id="search" type="text" name="search" value="{{ $search }}" class="form-control" placeholder="Search events by name...">
        </div>
        <div class="col-auto">
            <button class="btn btn-primary">Search</button>
        </div>
        @if ($search)
            <div class="col-auto">
                <a href="{{ route('events.index') }}" class="btn btn-outline-secondary">Clear</a>
            </div>
        @endif
    </form>

    @if ($events->isEmpty())
        <p class="text-muted">No events found.</p>
    @endif

    <div class="row row-cols-1 row-cols-md-3 g-4">
        @foreach ($events as $event)
            <div class="col">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">{{ $event->event_name }}</h5>
                        <h6 class="card-subtitle mb-2 text-muted">{{ $event->category }}</h6>
                        <p class="card-text mb-1"><strong>Date:</strong> {{ \Illuminate\Support\Carbon::parse($event->event_date)->format('d M Y') }}</p>
                        <p class="card-text mb-1"><strong>Venue:</strong> {{ $event->venue }}</p>
                        <p class="card-text mb-1"><strong>Price:</strong> Rs. {{ number_format($event->ticket_price, 2) }}</p>
                        <p class="card-text text-muted small">by {{ $event->organizer->organizer_name ?? 'Unknown Organizer' }}</p>
                    </div>
                    <div class="card-footer bg-white border-0">
                        <a href="{{ route('events.show', $event) }}" class="btn btn-primary w-100">View & Book</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
