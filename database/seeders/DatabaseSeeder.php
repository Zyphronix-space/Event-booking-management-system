<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Organizer;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seeds login credentials on top of the report's hand-built demo data:
     * an admin account, organizer usernames/passwords (the ER diagram
     * never gave organizers login fields), and rehashes the customer
     * passwords that were inserted as plain text while writing the report.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@eventbooking.test'],
            ['name' => 'Admin', 'password' => Hash::make('admin123')]
        );

        Organizer::whereNull('username')->orWhere('username', '')->get()->each(function (Organizer $organizer) {
            $organizer->update([
                'username' => Str::slug($organizer->organizer_name) ?: 'organizer' . $organizer->organizer_id,
                'password' => Hash::make('organizer123'),
            ]);
        });

        Customer::all()->each(function (Customer $customer) {
            if ($customer->password && !str_starts_with($customer->password, '$2y$')) {
                $customer->forceFill(['password' => Hash::make($customer->password)])->save();
            }
        });
    }
}
