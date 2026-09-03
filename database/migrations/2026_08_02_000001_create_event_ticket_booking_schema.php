<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Matches the ER diagram in the project report exactly.
     * Guarded with hasTable() so this is a no-op against the database
     * that was already hand-built while writing the report, but still
     * lets a fresh Postgres instance be bootstrapped from scratch.
     */
    public function up(): void
    {
        if (!Schema::hasTable('customer')) {
            Schema::create('customer', function (Blueprint $table) {
                $table->increments('customer_id');
                $table->string('full_name', 100)->nullable();
                $table->string('email', 100)->nullable();
                $table->string('phone_number', 15)->nullable();
                $table->string('username', 50)->nullable();
                $table->string('password', 100)->nullable();
            });
        }

        if (!Schema::hasTable('organizer')) {
            Schema::create('organizer', function (Blueprint $table) {
                $table->increments('organizer_id');
                $table->string('organizer_name', 100)->nullable();
                $table->string('contact_email', 100)->nullable();
                $table->string('contact_number', 15)->nullable();
            });
        }

        if (!Schema::hasTable('event')) {
            Schema::create('event', function (Blueprint $table) {
                $table->increments('event_id');
                $table->string('event_name', 100)->nullable();
                $table->date('event_date')->nullable();
                $table->string('venue', 100)->nullable();
                $table->string('category', 50)->nullable();
                $table->decimal('ticket_price', 10, 2)->nullable();
                $table->unsignedInteger('organizer_id')->nullable();

                $table->foreign('organizer_id')->references('organizer_id')->on('organizer');
            });
        }

        if (!Schema::hasTable('payment')) {
            Schema::create('payment', function (Blueprint $table) {
                $table->increments('payment_id');
                $table->string('payment_method', 50)->nullable();
                $table->date('payment_date')->nullable();
                $table->decimal('amount', 10, 2)->nullable();
                $table->string('payment_status', 20)->nullable();
            });
        }

        if (!Schema::hasTable('booking')) {
            Schema::create('booking', function (Blueprint $table) {
                $table->increments('booking_id');
                $table->date('booking_date')->nullable();
                $table->integer('quantity')->nullable();
                $table->decimal('total_amount', 10, 2)->nullable();
                $table->unsignedInteger('customer_id')->nullable();
                $table->unsignedInteger('event_id')->nullable();
                $table->unsignedInteger('payment_id')->nullable();

                $table->foreign('customer_id')->references('customer_id')->on('customer');
                $table->foreign('event_id')->references('event_id')->on('event');
                $table->foreign('payment_id')->references('payment_id')->on('payment');
            });
        }

        if (!Schema::hasTable('ticket')) {
            Schema::create('ticket', function (Blueprint $table) {
                $table->increments('ticket_id');
                $table->string('seat_number', 10)->nullable();
                $table->string('ticket_type', 50)->nullable();
                $table->unsignedInteger('event_id')->nullable();
                $table->unsignedInteger('booking_id')->nullable();

                $table->foreign('event_id')->references('event_id')->on('event');
                $table->foreign('booking_id')->references('booking_id')->on('booking');
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('ticket');
        Schema::dropIfExists('booking');
        Schema::dropIfExists('payment');
        Schema::dropIfExists('event');
        Schema::dropIfExists('organizer');
        Schema::dropIfExists('customer');
    }
};
