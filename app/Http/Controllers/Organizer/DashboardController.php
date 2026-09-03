<?php

namespace App\Http\Controllers\Organizer;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $organizerId = Auth::guard('organizer')->id();

        $events = Event::where('organizer_id', $organizerId)
            ->orderBy('event_date')
            ->get()
            ->map(function ($event) {
                $event->booking_count = DB::selectOne('SELECT count_event_bookings(?) AS total', [$event->event_id])->total;
                return $event;
            });

        return view('organizer.dashboard', compact('events'));
    }
}
