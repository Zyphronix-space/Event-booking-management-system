<?php

namespace App\Http\Controllers\Organizer;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function create()
    {
        return view('organizer.events.create');
    }

    /**
     * Add Event use case.
     */
    public function store(Request $request)
    {
        $validated = $this->validateEvent($request);
        $validated['organizer_id'] = Auth::guard('organizer')->id();

        Event::create($validated);

        return redirect()->route('organizer.dashboard')->with('status', 'Event created.');
    }

    public function edit(Event $event)
    {
        $this->authorizeOwnership($event);

        return view('organizer.events.edit', compact('event'));
    }

    /**
     * Update Event Details use case.
     */
    public function update(Request $request, Event $event)
    {
        $this->authorizeOwnership($event);

        $validated = $this->validateEvent($request);
        $event->update($validated);

        return redirect()->route('organizer.dashboard')->with('status', 'Event updated.');
    }

    /**
     * View Bookings For Their Events use case.
     */
    public function bookings(Event $event)
    {
        $this->authorizeOwnership($event);

        $event->load(['bookings.customer', 'bookings.payment']);

        return view('organizer.events.bookings', compact('event'));
    }

    private function validateEvent(Request $request): array
    {
        return $request->validate([
            'event_name' => ['required', 'string', 'max:100'],
            'event_date' => ['required', 'date'],
            'venue' => ['required', 'string', 'max:100'],
            'category' => ['required', 'string', 'max:50'],
            'ticket_price' => ['required', 'numeric', 'min:0'],
        ]);
    }

    private function authorizeOwnership(Event $event): void
    {
        abort_unless($event->organizer_id === Auth::guard('organizer')->id(), 403);
    }
}
