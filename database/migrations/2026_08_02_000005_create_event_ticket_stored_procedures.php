<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Stored Procedure 1 & 2 from the report, with transaction/rollback
     * handling exactly as designed. CREATE OR REPLACE keeps this
     * idempotent against the already-existing report database.
     */
    public function up(): void
    {
        // NOTE: the report's original design put COMMIT/ROLLBACK inside a
        // nested BEGIN...EXCEPTION...END block. PostgreSQL rejects that:
        // "cannot commit while a subtransaction is active", because an
        // EXCEPTION clause implicitly opens a subtransaction, and explicit
        // transaction control is only legal in the procedure's outermost
        // block. Fixed here by keeping the risky DML (and its exception
        // handler) in the inner block, and only COMMITting in the outer
        // block once the inner block has completed without error.
        DB::unprepared(<<<'SQL'
            CREATE OR REPLACE PROCEDURE create_booking_transaction(
                p_booking_date DATE,
                p_quantity INT,
                p_customer_id INT,
                p_event_id INT,
                p_payment_method VARCHAR,
                p_payment_amount DECIMAL
            )
            LANGUAGE plpgsql
            AS $$
            DECLARE
                v_payment_id INT;
                v_booking_id INT;
                v_total DECIMAL(10,2);
            BEGIN
                BEGIN
                    INSERT INTO Payment (Payment_Method, Payment_Date, Amount)
                    VALUES (p_payment_method, CURRENT_DATE, p_payment_amount)
                    RETURNING Payment_ID INTO v_payment_id;

                    INSERT INTO Booking (Booking_Date, Quantity, Customer_ID, Event_ID, Payment_ID)
                    VALUES (p_booking_date, p_quantity, p_customer_id, p_event_id, v_payment_id)
                    RETURNING Booking_ID INTO v_booking_id;

                    v_total := calculate_total_amount(p_event_id, p_quantity);

                    UPDATE Booking
                    SET Total_Amount = v_total
                    WHERE Booking_ID = v_booking_id;
                EXCEPTION
                    WHEN OTHERS THEN
                        RAISE NOTICE 'Transaction failed. Rolled back: %', SQLERRM;
                        RETURN;
                END;

                COMMIT;
            END;
            $$;
        SQL);

        DB::unprepared(<<<'SQL'
            CREATE OR REPLACE PROCEDURE cancel_booking_transaction(p_booking_id INT)
            LANGUAGE plpgsql
            AS $$
            DECLARE
                v_payment_id INT;
            BEGIN
                BEGIN
                    SELECT Payment_ID INTO v_payment_id
                    FROM Booking
                    WHERE Booking_ID = p_booking_id;

                    DELETE FROM Ticket
                    WHERE Booking_ID = p_booking_id;

                    DELETE FROM Booking
                    WHERE Booking_ID = p_booking_id;

                    DELETE FROM Payment
                    WHERE Payment_ID = v_payment_id;
                EXCEPTION
                    WHEN OTHERS THEN
                        RAISE NOTICE 'Booking cancellation failed. Transaction rolled back: %', SQLERRM;
                        RETURN;
                END;

                COMMIT;
            END;
            $$;
        SQL);
    }

    public function down(): void
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS cancel_booking_transaction(INT)');
        DB::unprepared('DROP PROCEDURE IF EXISTS create_booking_transaction(DATE, INT, INT, INT, VARCHAR, DECIMAL)');
    }
};
