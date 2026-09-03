<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Functions and triggers exactly as designed in the project report
     * (Database Programming section). CREATE OR REPLACE keeps this
     * idempotent against the already-existing report database.
     */
    public function up(): void
    {
        DB::unprepared(<<<'SQL'
            CREATE OR REPLACE FUNCTION calculate_total_amount(p_event_id INT, p_quantity INT)
            RETURNS DECIMAL(10,2) AS $$
            DECLARE
                v_price DECIMAL(10,2);
                v_total DECIMAL(10,2);
            BEGIN
                SELECT Ticket_Price INTO v_price FROM Event WHERE Event_ID = p_event_id;
                v_total := v_price * p_quantity;
                RETURN v_total;
            END;
            $$ LANGUAGE plpgsql;
        SQL);

        DB::unprepared(<<<'SQL'
            CREATE OR REPLACE FUNCTION count_event_bookings(p_event_id INT)
            RETURNS INT AS $$
            DECLARE
                v_count INT;
            BEGIN
                SELECT COUNT(*) INTO v_count
                FROM Booking
                WHERE Event_ID = p_event_id;
                RETURN v_count;
            END;
            $$ LANGUAGE plpgsql;
        SQL);

        DB::unprepared(<<<'SQL'
            CREATE OR REPLACE FUNCTION update_total_amount()
            RETURNS TRIGGER AS $$
            BEGIN
                UPDATE Booking
                SET Total_Amount = calculate_total_amount(NEW.Event_ID, NEW.Quantity)
                WHERE Booking_ID = NEW.Booking_ID;
                RETURN NEW;
            END;
            $$ LANGUAGE plpgsql;
        SQL);

        DB::unprepared(<<<'SQL'
            CREATE OR REPLACE TRIGGER trg_update_total_amount
            AFTER INSERT ON Booking
            FOR EACH ROW
            EXECUTE FUNCTION update_total_amount();
        SQL);

        DB::unprepared(<<<'SQL'
            CREATE OR REPLACE FUNCTION set_payment_status()
            RETURNS TRIGGER AS $$
            BEGIN
                IF NEW.Payment_Status IS NULL THEN
                    NEW.Payment_Status := 'Paid';
                END IF;
                RETURN NEW;
            END;
            $$ LANGUAGE plpgsql;
        SQL);

        DB::unprepared(<<<'SQL'
            CREATE OR REPLACE TRIGGER trg_set_payment_status
            BEFORE INSERT ON Payment
            FOR EACH ROW
            EXECUTE FUNCTION set_payment_status();
        SQL);
    }

    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS trg_set_payment_status ON Payment');
        DB::unprepared('DROP TRIGGER IF EXISTS trg_update_total_amount ON Booking');
        DB::unprepared('DROP FUNCTION IF EXISTS set_payment_status()');
        DB::unprepared('DROP FUNCTION IF EXISTS update_total_amount()');
        DB::unprepared('DROP FUNCTION IF EXISTS count_event_bookings(INT)');
        DB::unprepared('DROP FUNCTION IF EXISTS calculate_total_amount(INT, INT)');
    }
};
