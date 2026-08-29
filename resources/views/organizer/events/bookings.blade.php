@extends('layouts.app')

@section('title', 'Bookings for ' . $event->event_name)

@section('content')
    <a href="{{ route('organizer.dashboard') }}" class="btn btn-link ps-0">&larr; Back to my events</a>

    <h1 class="mb-4">Bookings for {{ $event->event_name }}</h1>

    @if ($event->bookings->isEmpty())
        <p class="text-muted">No bookings yet for this event.</p>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered bg-white align-middle">
            <thead class="table-light">
                <tr>
                    <th>Customer</th>
                    <th>Booking Date</th>
                    <th>Quantity</th>
                    <th>Total Amount</th>
                    <th>Payment Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($event->bookings as $booking)
                    <tr>
                        <td>{{ $booking->customer->full_name ?? 'Unknown' }}</td>
                        <td>{{ \Illuminate\Support\Carbon::parse($booking->booking_date)->format('d M Y') }}</td>
                        <td>{{ $booking->quantity }}</td>
                        <td>Rs. {{ number_format($booking->total_amount, 2) }}</td>
                        <td>{{ $booking->payment->payment_status ?? '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
