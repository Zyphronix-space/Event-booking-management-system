@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
    <h1 class="mb-4">Admin Dashboard</h1>

    <div class="row row-cols-1 row-cols-md-4 g-4">
        <div class="col">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h2>{{ $stats['events'] }}</h2>
                    <p class="text-muted mb-0">Events</p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h2>{{ $stats['customers'] }}</h2>
                    <p class="text-muted mb-0">Customers</p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h2>{{ $stats['organizers'] }}</h2>
                    <p class="text-muted mb-0">Organizers</p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h2>{{ $stats['bookings'] }}</h2>
                    <p class="text-muted mb-0">Bookings</p>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-4">
        <a href="{{ route('admin.events.index') }}" class="btn btn-outline-primary me-2">Manage Events</a>
        <a href="{{ route('admin.customers.index') }}" class="btn btn-outline-primary me-2">Manage Customers</a>
        <a href="{{ route('admin.organizers.index') }}" class="btn btn-outline-primary me-2">Manage Organizers</a>
        <a href="{{ route('admin.reports.index') }}" class="btn btn-outline-primary">View Reports</a>
    </div>
@endsection
