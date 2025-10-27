<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create 5 customers
        \App\Models\User::factory()->count(5)->create([
            'user_type' => 'user',
            'status' => 'active',
        ]);

        // Create 2 travel partners (if needed)
        \App\Models\TravelPartner::factory()->count(3)->create([
            'status' => 'active',
        ]);

        // Create 1 admin
        \App\Models\User::factory()->create([
            'first_name' => 'Admin',
            'last_name' => 'User',
            'email' => 'admin@skybooking.com',
            'user_type' => 'admin',
            'status' => 'active',
            'email_verified_at' => now(),
        ]);

        $this->call([
            MenuItemSeeder::class,
            TravelPartnerSeeder::class,
            SettingsSeeder::class,
            BlogSeeder::class,
            NewsletterSubscriberSeeder::class,
            BookingSeeder::class,
        ]);

    }

    
}
