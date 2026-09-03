<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Event Ticket Booking System')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="{{ route('events.index') }}">🎫 Event Ticket Booking</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navMenu">
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a class="nav-link" href="{{ route('events.index') }}">Browse Events</a></li>

                @auth('customer')
                    <li class="nav-item"><a class="nav-link" href="{{ route('customer.bookings.index') }}">My Bookings</a></li>
                @endauth

                @auth('organizer')
                    <li class="nav-item"><a class="nav-link" href="{{ route('organizer.dashboard') }}">My Events</a></li>
                @endauth

                @auth('web')
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.dashboard') }}">Admin Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.events.index') }}">Events</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.customers.index') }}">Customers</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.organizers.index') }}">Organizers</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.reports.index') }}">Reports</a></li>
                @endauth
            </ul>

            <ul class="navbar-nav">
                @auth('customer')
                    <li class="nav-item"><span class="navbar-text text-white-50 me-3">Customer: {{ auth('customer')->user()->full_name }}</span></li>
                    <li class="nav-item">
                        <form method="POST" action="{{ route('customer.logout') }}">@csrf
                            <button class="btn btn-outline-light btn-sm">Logout</button>
                        </form>
                    </li>
                @else
                    @auth('organizer')
                        <li class="nav-item"><span class="navbar-text text-white-50 me-3">Organizer: {{ auth('organizer')->user()->organizer_name }}</span></li>
                        <li class="nav-item">
                            <form method="POST" action="{{ route('organizer.logout') }}">@csrf
                                <button class="btn btn-outline-light btn-sm">Logout</button>
                            </form>
                        </li>
                    @else
                        @auth('web')
                            <li class="nav-item"><span class="navbar-text text-white-50 me-3">Admin: {{ auth('web')->user()->name }}</span></li>
                            <li class="nav-item">
                                <form method="POST" action="{{ route('admin.logout') }}">@csrf
                                    <button class="btn btn-outline-light btn-sm">Logout</button>
                                </form>
                            </li>
                        @else
                            <li class="nav-item"><a class="nav-link" href="{{ route('customer.login') }}">Customer Login</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('customer.register') }}">Register</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('organizer.login') }}">Organizer Login</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('admin.login') }}">Admin Login</a></li>
                        @endauth
                    @endauth
                @endauth
            </ul>
        </div>
    </div>
</nav>

<div class="container py-4">
    @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
