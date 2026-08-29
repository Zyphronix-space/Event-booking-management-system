<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Organizer;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Manage Events use case (Admin has full SELECT/INSERT/UPDATE/DELETE on Event).
     */
    public function index()
    {
        $events = Event::with('organizer')->orderBy('event_date')->get();

        return view('admin.events.index', compact('events'));
    }

    public function create()
    {
        $organizers = Organizer::orderBy('organizer_name')->get();

        return view('admin.events.create', compact('organizers'));
    }

    public function store(Request $request)
    {
        Event::create($this->validateEvent($request));

        return redirect()->route('admin.events.index')->with('status', 'Event created.');
    }

    public function edit(Event $event)
    {
        $organizers = Organizer::orderBy('organizer_name')->get();

        return view('admin.events.edit', compact('event', 'organizers'));
    }

    public function update(Request $request, Event $event)
    {
        $event->update($this->validateEvent($request));

        return redirect()->route('admin.events.index')->with('status', 'Event updated.');
    }

    public function destroy(Event $event)
    {
        if ($event->bookings()->exists() || $event->tickets()->exists()) {
            return back()->withErrors(['event' => 'Cannot delete "' . $event->event_name . '": it has existing bookings or tickets. Cancel those first.']);
        }

        $event->delete();

        return redirect()->route('admin.events.index')->with('status', 'Event deleted.');
    }

    private function validateEvent(Request $request): array
    {
        return $request->validate([
            'event_name' => ['required', 'string', 'max:100'],
            'event_date' => ['required', 'date'],
            'venue' => ['required', 'string', 'max:100'],
            'category' => ['required', 'string', 'max:50'],
            'ticket_price' => ['required', 'numeric', 'min:0'],
            'organizer_id' => ['required', 'integer', 'exists:organizer,organizer_id'],
        ]);
    }
}
