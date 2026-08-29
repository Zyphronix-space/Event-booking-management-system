<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EventController extends Controller
{
    /**
     * Public event listing / search. Uses the same Event_Name pattern
     * search the report's idx_event_name index was built to optimize.
     */
    public function index(Request $request)
    {
        $search = $request->query('search');

        $events = Event::with('organizer')
            ->when($search, fn ($query) => $query->where('event_name', 'ILIKE', "%{$search}%"))
            ->orderBy('event_date')
            ->get();

        return view('events.index', compact('events', 'search'));
    }

    public function show(Event $event)
    {
        $event->load('organizer');
        $bookingCount = DB::selectOne('SELECT count_event_bookings(?) AS total', [$event->event_id])->total;

        return view('events.show', compact('event', 'bookingCount'));
    }
}
