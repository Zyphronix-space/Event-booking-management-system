@extends('layouts.app')

@section('title', $event->event_name)

@section('content')
    <a href="{{ route('events.index') }}" class="btn btn-link ps-0">&larr; Back to events</a>

    <div class="row">
        <div class="col-md-7">
            <h1>{{ $event->event_name }}</h1>
            <p class="text-muted">{{ $event->category }}</p>
            <ul class="list-group list-group-flush mb-4">
                <li class="list-group-item">Date: {{ \Illuminate\Support\Carbon::parse($event->event_date)->format('d M Y') }}</li>
                <li class="list-group-item">Venue: {{ $event->venue }}</li>
                <li class="list-group-item">Ticket Price: Rs. {{ number_format($event->ticket_price, 2) }}</li>
                <li class="list-group-item">Organizer: {{ $event->organizer->organizer_name ?? 'Unknown' }}</li>
                <li class="list-group-item">Bookings so far: {{ $bookingCount }}</li>
            </ul>
        </div>

        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Book Tickets</h5>

                    @auth('customer')
                        <form method="POST" action="{{ route('customer.bookings.store') }}">
                            @csrf
                            <input type="hidden" name="event_id" value="{{ $event->event_id }}">

                            <div class="mb-3">
                                <label for="quantity" class="form-label">Quantity</label>
                                <input id="quantity" type="number" name="quantity" value="1" min="1" max="20" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="payment_method" class="form-label">Payment Method</label>
                                <select id="payment_method" name="payment_method" class="form-select" required>
                                    <option value="Card">Card</option>
                                    <option value="Cash">Cash</option>
                                </select>
                            </div>

                            <button class="btn btn-success w-100">Book & Pay</button>
                        </form>
                    @else
                        <p class="text-muted">Please log in as a customer to book tickets.</p>
                        <a href="{{ route('customer.login') }}" class="btn btn-primary w-100 mb-2">Customer Login</a>
                        <a href="{{ route('customer.register') }}" class="btn btn-outline-primary w-100">Register</a>
                    @endauth
                </div>
            </div>
        </div>
    </div>
@endsection
