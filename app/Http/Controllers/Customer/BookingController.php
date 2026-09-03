<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    /**
     * Customer's own booking history. Uses idx_booking_customer under the hood.
     */
    public function index()
    {
        $customerId = Auth::guard('customer')->id();

        $bookings = Booking::with(['event', 'payment', 'tickets'])
            ->where('customer_id', $customerId)
            ->orderByDesc('booking_id')
            ->get();

        return view('customer.bookings.index', compact('bookings'));
    }

    /**
     * Book Tickets + Make Payment, via Stored Procedure 1
     * (create_booking_transaction) from the report.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'event_id' => ['required', 'integer', 'exists:event,event_id'],
            'quantity' => ['required', 'integer', 'min:1', 'max:20'],
            'payment_method' => ['required', 'string', 'in:Card,Cash'],
        ]);

        $event = Event::findOrFail($validated['event_id']);
        $customerId = Auth::guard('customer')->id();
        $amount = $event->ticket_price * $validated['quantity'];

        DB::statement(
            'CALL create_booking_transaction(?, ?, ?, ?, ?, ?)',
            [now()->toDateString(), $validated['quantity'], $customerId, $event->event_id, $validated['payment_method'], $amount]
        );

        return redirect()->route('customer.bookings.index')
            ->with('status', 'Booking confirmed for ' . $event->event_name . '.');
    }

    /**
     * Cancel Booking, via Stored Procedure 2 (cancel_booking_transaction).
     */
    public function cancel(Booking $booking)
    {
        abort_unless($booking->customer_id === Auth::guard('customer')->id(), 403);

        DB::statement('CALL cancel_booking_transaction(?)', [$booking->booking_id]);

        return redirect()->route('customer.bookings.index')->with('status', 'Booking cancelled.');
    }
}
