<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * The report's ER diagram gives Organizer no login credentials
     * (only Customer has username/password). The working app needs
     * organizers to log in too, so this adds the same fields Customer
     * already has.
     */
    public function up(): void
    {
        Schema::table('organizer', function (Blueprint $table) {
            if (!Schema::hasColumn('organizer', 'username')) {
                $table->string('username', 50)->nullable()->after('organizer_name');
            }
            if (!Schema::hasColumn('organizer', 'password')) {
                $table->string('password', 100)->nullable()->after('username');
            }
        });
    }

    public function down(): void
    {
        Schema::table('organizer', function (Blueprint $table) {
            $table->dropColumn(['username', 'password']);
        });
    }
};
