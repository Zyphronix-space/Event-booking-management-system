<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Index 1 & 2 from the report — Event_Name search optimization and
     * Booking.Customer_ID lookup optimization. Both already exist on the
     * hand-built report database; IF NOT EXISTS keeps this idempotent for
     * a fresh install too.
     */
    public function up(): void
    {
        DB::statement('CREATE INDEX IF NOT EXISTS idx_event_name ON event (event_name)');
        DB::statement('CREATE INDEX IF NOT EXISTS idx_booking_customer ON booking (customer_id)');
    }

    public function down(): void
    {
        DB::statement('DROP INDEX IF EXISTS idx_event_name');
        DB::statement('DROP INDEX IF EXISTS idx_booking_customer');
    }
};
