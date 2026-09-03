<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Customer;
use App\Models\Event;
use App\Models\Organizer;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    /**
     * View Reports use case, covering its three <<Extend>> variants:
     * Sales Reports, Event Reports, Stats Reports.
     */
    public function index()
    {
        $salesReport = DB::table('booking')
            ->join('event', 'booking.event_id', '=', 'event.event_id')
            ->join('payment', 'booking.payment_id', '=', 'payment.payment_id')
            ->select('event.event_name', DB::raw('COUNT(booking.booking_id) as bookings'), DB::raw('SUM(payment.amount) as revenue'))
            ->groupBy('event.event_name')
            ->orderByDesc('revenue')
            ->get();

        $eventReport = Event::with('organizer')
            ->get()
            ->map(function ($event) {
                $event->booking_count = DB::selectOne('SELECT count_event_bookings(?) AS total', [$event->event_id])->total;
                return $event;
            });

        $stats = [
            'total_events' => Event::count(),
            'total_customers' => Customer::count(),
            'total_organizers' => Organizer::count(),
            'total_bookings' => Booking::count(),
            'total_revenue' => DB::table('payment')->sum('amount'),
        ];

        return view('admin.reports.index', compact('salesReport', 'eventReport', 'stats'));
    }
}
