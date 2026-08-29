@extends('layouts.app')

@section('title', 'Reports')

@section('content')
    <h1 class="mb-4">Reports</h1>

    <h3>📊 Stats Report</h3>
    <div class="row row-cols-1 row-cols-md-5 g-3 mb-5">
        <div class="col">
            <div class="card text-center shadow-sm"><div class="card-body">
                <h4>{{ $stats['total_events'] }}</h4><p class="text-muted mb-0">Events</p>
            </div></div>
        </div>
        <div class="col">
            <div class="card text-center shadow-sm"><div class="card-body">
                <h4>{{ $stats['total_customers'] }}</h4><p class="text-muted mb-0">Customers</p>
            </div></div>
        </div>
        <div class="col">
            <div class="card text-center shadow-sm"><div class="card-body">
                <h4>{{ $stats['total_organizers'] }}</h4><p class="text-muted mb-0">Organizers</p>
            </div></div>
        </div>
        <div class="col">
            <div class="card text-center shadow-sm"><div class="card-body">
                <h4>{{ $stats['total_bookings'] }}</h4><p class="text-muted mb-0">Bookings</p>
            </div></div>
        </div>
        <div class="col">
            <div class="card text-center shadow-sm"><div class="card-body">
                <h4>Rs. {{ number_format($stats['total_revenue'], 2) }}</h4><p class="text-muted mb-0">Revenue</p>
            </div></div>
        </div>
    </div>

    <h3>💰 Sales Report</h3>
    <div class="table-responsive mb-5">
        <table class="table table-bordered bg-white">
            <thead class="table-light">
                <tr><th>Event</th><th>Bookings</th><th>Revenue</th></tr>
            </thead>
            <tbody>
                @foreach ($salesReport as $row)
                    <tr>
                        <td>{{ $row->event_name }}</td>
                        <td>{{ $row->bookings }}</td>
                        <td>Rs. {{ number_format($row->revenue, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <h3>🎪 Event Report</h3>
    <div class="table-responsive">
        <table class="table table-bordered bg-white">
            <thead class="table-light">
                <tr><th>Event</th><th>Date</th><th>Organizer</th><th>Ticket Price</th><th>Total Bookings</th></tr>
            </thead>
            <tbody>
                @foreach ($eventReport as $event)
                    <tr>
                        <td>{{ $event->event_name }}</td>
                        <td>{{ \Illuminate\Support\Carbon::parse($event->event_date)->format('d M Y') }}</td>
                        <td>{{ $event->organizer->organizer_name ?? '-' }}</td>
                        <td>Rs. {{ number_format($event->ticket_price, 2) }}</td>
                        <td>{{ $event->booking_count }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
