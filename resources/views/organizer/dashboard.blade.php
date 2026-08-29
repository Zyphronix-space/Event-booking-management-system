@extends('layouts.app')

@section('title', 'My Events')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>My Events</h1>
        <a href="{{ route('organizer.events.create') }}" class="btn btn-primary">+ Add Event</a>
    </div>

    @if ($events->isEmpty())
        <p class="text-muted">You haven't added any events yet.</p>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered bg-white align-middle">
            <thead class="table-light">
                <tr>
                    <th>Event Name</th>
                    <th>Date</th>
                    <th>Venue</th>
                    <th>Category</th>
                    <th>Ticket Price</th>
                    <th>Bookings</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($events as $event)
                    <tr>
                        <td>{{ $event->event_name }}</td>
                        <td>{{ \Illuminate\Support\Carbon::parse($event->event_date)->format('d M Y') }}</td>
                        <td>{{ $event->venue }}</td>
                        <td>{{ $event->category }}</td>
                        <td>Rs. {{ number_format($event->ticket_price, 2) }}</td>
                        <td>{{ $event->booking_count }}</td>
                        <td class="text-nowrap">
                            <a href="{{ route('organizer.events.edit', $event) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                            <a href="{{ route('organizer.events.bookings', $event) }}" class="btn btn-sm btn-outline-primary">Bookings</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
