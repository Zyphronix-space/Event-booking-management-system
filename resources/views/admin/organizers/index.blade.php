@extends('layouts.app')

@section('title', 'Manage Organizers')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Manage Organizers</h1>
        <a href="{{ route('admin.organizers.create') }}" class="btn btn-primary">+ Add Organizer</a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered bg-white align-middle">
            <thead class="table-light">
                <tr>
                    <th>Organizer Name</th>
                    <th>Contact Email</th>
                    <th>Contact Number</th>
                    <th>Username</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($organizers as $organizer)
                    <tr>
                        <td>{{ $organizer->organizer_name }}</td>
                        <td>{{ $organizer->contact_email }}</td>
                        <td>{{ $organizer->contact_number }}</td>
                        <td>{{ $organizer->username ?? '-' }}</td>
                        <td class="text-nowrap">
                            <a href="{{ route('admin.organizers.edit', $organizer) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                            <form method="POST" action="{{ route('admin.organizers.destroy', $organizer) }}" class="d-inline" onsubmit="return confirm('Delete this organizer?');">
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
