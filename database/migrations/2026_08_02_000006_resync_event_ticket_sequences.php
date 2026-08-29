<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * The report's demo rows were inserted with explicit IDs (e.g.
     * Organizer_ID 101-103), which doesn't advance PostgreSQL's identity
     * sequence. The next auto-generated INSERT then collides with an
     * existing row ("duplicate key value violates unique constraint").
     * Resyncs every sequence to the current max ID so is idempotent and
     * safe to run again after any future manual data load.
     */
    public function up(): void
    {
        foreach (['customer', 'organizer', 'event', 'booking', 'payment', 'ticket'] as $table) {
            $column = "{$table}_id";
            DB::statement("
                SELECT setval(
                    pg_get_serial_sequence('{$table}', '{$column}'),
                    GREATEST(
                        (SELECT COALESCE(MAX({$column}), 0) FROM {$table}),
                        (SELECT last_value FROM {$table}_{$column}_seq)
                    )
                )
            ");
        }
    }

    public function down(): void
    {
        // No-op: resyncing a sequence forward is not meaningfully reversible.
    }
};
