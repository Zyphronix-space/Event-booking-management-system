@extends('layouts.app')

@section('title', 'My Bookings')

@section('content')
    <h1 class="mb-4">My Bookings</h1>

    @if ($bookings->isEmpty())
        <p class="text-muted">You haven't booked any tickets yet. <a href="{{ route('events.index') }}">Browse events</a>.</p>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered bg-white align-middle">
            <thead class="table-light">
                <tr>
                    <th>Event</th>
                    <th>Booking Date</th>
                    <th>Quantity</th>
                    <th>Total Amount</th>
                    <th>Payment</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bookings as $booking)
                    <tr>
                        <td>{{ $booking->event->event_name ?? 'Deleted event' }}</td>
                        <td>{{ \Illuminate\Support\Carbon::parse($booking->booking_date)->format('d M Y') }}</td>
                        <td>{{ $booking->quantity }}</td>
                        <td>Rs. {{ number_format($booking->total_amount, 2) }}</td>
                        <td>{{ $booking->payment->payment_method ?? '-' }} (Rs. {{ number_format($booking->payment->amount ?? 0, 2) }})</td>
                        <td>
                            <span class="badge bg-{{ $booking->payment->payment_status === 'Paid' ? 'success' : 'secondary' }}">
                                {{ $booking->payment->payment_status ?? 'Pending' }}
                            </span>
                        </td>
                        <td>
                            <form method="POST" action="{{ route('customer.bookings.cancel', $booking) }}" onsubmit="return confirm('Cancel this booking?');">
                                @csrf
                                <button class="btn btn-sm btn-outline-danger">Cancel</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
