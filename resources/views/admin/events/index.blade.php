@extends('layouts.app')

@section('title', 'Manage Events')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Manage Events</h1>
        <a href="{{ route('admin.events.create') }}" class="btn btn-primary">+ Add Event</a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered bg-white align-middle">
            <thead class="table-light">
                <tr>
                    <th>Event Name</th>
                    <th>Date</th>
                    <th>Venue</th>
                    <th>Category</th>
                    <th>Ticket Price</th>
                    <th>Organizer</th>
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
                        <td>{{ $event->organizer->organizer_name ?? '-' }}</td>
                        <td class="text-nowrap">
                            <a href="{{ route('admin.events.edit', $event) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                            <form method="POST" action="{{ route('admin.events.destroy', $event) }}" class="d-inline" onsubmit="return confirm('Delete this event?');">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
