<?php
// database/seeders/BookingSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Booking;
use App\Models\User;
use App\Models\TravelPartner;

class BookingSeeder extends Seeder
{
    public function run(): void
    {
        $customers = User::customers()->take(5)->get();
        $partners = TravelPartner::active()->get();
        
        $bookings = [
            [
                'booking_reference' => 'BK-2025-001',
                'user_id' => $customers[0]->id,
                'partner_id' => $partners[0]->id ?? null,
                'origin_code' => 'NYC',
                'destination_code' => 'LAX',
                'origin_city' => 'New York',
                'destination_city' => 'Los Angeles',
                'route_type' => 'non-stop',
                'flight_number' => 'AA 1234',
                'airline_name' => 'American Airlines',
                'airline_code' => 'AA',
                'departure_date' => now()->addDays(7),
                'departure_time' => '08:30:00',
                'arrival_date' => now()->addDays(7),
                'arrival_time' => '11:45:00',
                'flight_duration' => 375, // 6 hours 15 minutes
                'adults_count' => 2,
                'children_count' => 0,
                'infants_count' => 0,
                'total_passengers' => 2,
                'cabin_class' => 'economy',
                'base_amount' => 700.00,
                'taxes_amount' => 120.00,
                'fees_amount' => 30.00,
                'total_amount' => 850.00,
                'currency' => 'USD',
                'commission_rate' => 12.00,
                'commission_amount' => 102.00,
                'payment_status' => 'paid',
                'payment_method' => 'credit_card',
                'status' => 'confirmed',
                'confirmation_status' => 'confirmed',
                'pnr_number' => 'ABCD123',
                'booking_source' => 'website',
                'booked_at' => now(),
                'confirmed_at' => now(),
                'passengers_details' => [
                    [
                        'type' => 'adult',
                        'title' => 'Mr',
                        'first_name' => 'John',
                        'last_name' => 'Doe',
                        'date_of_birth' => '1985-06-15',
                        'passport_number' => 'P123456789'
                    ],
                    [
                        'type' => 'adult',
                        'title' => 'Mrs',
                        'first_name' => 'Jane',
                        'last_name' => 'Doe',
                        'date_of_birth' => '1987-08-22',
                        'passport_number' => 'P987654321'
                    ]
                ]
            ],
            [
                'booking_reference' => 'BK-2025-002',
                'user_id' => $customers[1]->id,
                'partner_id' => $partners[1]->id ?? null,
                'origin_code' => 'LON',
                'destination_code' => 'DXB',
                'origin_city' => 'London',
                'destination_city' => 'Dubai',
                'route_type' => '1-stop',
                'flight_number' => 'EK 001',
                'airline_name' => 'Emirates',
                'airline_code' => 'EK',
                'departure_date' => now()->addDays(10),
                'departure_time' => '14:20:00',
                'arrival_date' => now()->addDays(10),
                'arrival_time' => '22:45:00',
                'flight_duration' => 505, // 8 hours 25 minutes
                'adults_count' => 1,
                'children_count' => 0,
                'infants_count' => 0,
                'total_passengers' => 1,
                'cabin_class' => 'business',
                'base_amount' => 1100.00,
                'taxes_amount' => 110.00,
                'fees_amount' => 30.00,
                'total_amount' => 1240.00,
                'currency' => 'USD',
                'commission_rate' => 8.00,
                'commission_amount' => 99.20,
                'payment_status' => 'pending',
                'status' => 'pending',
                'confirmation_status' => 'pending',
                'booking_source' => 'website',
                'booked_at' => now(),
                'passengers_details' => [
                    [
                        'type' => 'adult',
                        'title' => 'Ms',
                        'first_name' => 'Sarah',
                        'last_name' => 'Miller',
                        'date_of_birth' => '1990-03-12',
                        'passport_number' => 'P456789123'
                    ]
                ]
            ],
            [
                'booking_reference' => 'BK-2025-003',
                'user_id' => $customers[2]->id,
                'partner_id' => $partners[2]->id ?? null,
                'origin_code' => 'PAR',
                'destination_code' => 'TOK',
                'origin_city' => 'Paris',
                'destination_city' => 'Tokyo',
                'route_type' => '2-stops',
                'flight_number' => 'AF 292',
                'airline_name' => 'Air France',
                'airline_code' => 'AF',
                'departure_date' => now()->addDays(12),
                'departure_time' => '11:15:00',
                'arrival_date' => now()->addDays(13),
                'arrival_time' => '15:30:00',
                'flight_duration' => 1575, // 26 hours 15 minutes
                'adults_count' => 1,
                'children_count' => 1,
                'infants_count' => 0,
                'total_passengers' => 2,
                'cabin_class' => 'economy',
                'base_amount' => 1600.00,
                'taxes_amount' => 200.00,
                'fees_amount' => 40.00,
                'total_amount' => 1840.00,
                'currency' => 'USD',
                'commission_rate' => 6.00,
                'commission_amount' => 110.40,
                'payment_status' => 'paid',
                'payment_method' => 'paypal',
                'status' => 'confirmed',
                'confirmation_status' => 'confirmed',
                'pnr_number' => 'EFGH456',
                'booking_source' => 'website',
                'booked_at' => now()->subDay(),
                'confirmed_at' => now()->subDay(),
                'passengers_details' => [
                    [
                        'type' => 'adult',
                        'title' => 'Mr',
                        'first_name' => 'Mike',
                        'last_name' => 'Johnson',
                        'date_of_birth' => '1982-11-05',
                        'passport_number' => 'P789123456'
                    ],
                    [
                        'type' => 'child',
                        'title' => 'Master',
                        'first_name' => 'Tommy',
                        'last_name' => 'Johnson',
                        'date_of_birth' => '2015-07-18',
                        'passport_number' => 'P321654987'
                    ]
                ]
            ],
            [
                'booking_reference' => 'BK-2025-004',
                'user_id' => $customers[3]->id,
                'partner_id' => null, // Custom Partner
                'origin_code' => 'SYD',
                'destination_code' => 'SIN',
                'origin_city' => 'Sydney',
                'destination_city' => 'Singapore',
                'route_type' => 'non-stop',
                'flight_number' => 'SQ 221',
                'airline_name' => 'Singapore Airlines',
                'airline_code' => 'SQ',
                'departure_date' => now()->addDays(4),
                'departure_time' => '09:20:00',
                'arrival_date' => now()->addDays(4),
                'arrival_time' => '14:30:00',
                'flight_duration' => 490, // 8 hours 10 minutes
                'adults_count' => 3,
                'children_count' => 0,
                'infants_count' => 0,
                'total_passengers' => 3,
                'cabin_class' => 'premium-economy',
                'base_amount' => 1400.00,
                'taxes_amount' => 180.00,
                'fees_amount' => 40.00,
                'total_amount' => 1620.00,
                'currency' => 'USD',
                'payment_status' => 'refunded',
                'payment_method' => 'credit_card',
                'status' => 'cancelled',
                'confirmation_status' => 'confirmed',
                'pnr_number' => 'IJKL789',
                'booking_source' => 'website',
                'booked_at' => now()->subDays(2),
                'confirmed_at' => now()->subDays(2),
                'cancelled_at' => now()->subDay(),
                'cancellation_reason' => 'Customer requested cancellation due to emergency',
                'passengers_details' => [
                    [
                        'type' => 'adult',
                        'title' => 'Ms',
                        'first_name' => 'Emma',
                        'last_name' => 'Anderson',
                        'date_of_birth' => '1988-04-20',
                        'passport_number' => 'P147258369'
                    ],
                    [
                        'type' => 'adult',
                        'title' => 'Mr',
                        'first_name' => 'David',
                        'last_name' => 'Anderson',
                        'date_of_birth' => '1986-09-15',
                        'passport_number' => 'P963852741'
                    ],
                    [
                        'type' => 'adult',
                        'title' => 'Mrs',
                        'first_name' => 'Lisa',
                        'last_name' => 'Wilson',
                        'date_of_birth' => '1992-12-08',
                        'passport_number' => 'P753951486'
                    ]
                ]
            ],
            [
                'booking_reference' => 'BK-2025-005',
                'user_id' => $customers[4]->id,
                'partner_id' => $partners[0]->id ?? null,
                'origin_code' => 'BOM',
                'destination_code' => 'FRA',
                'origin_city' => 'Mumbai',
                'destination_city' => 'Frankfurt',
                'route_type' => '1-stop',
                'flight_number' => 'LH 756',
                'airline_name' => 'Lufthansa',
                'airline_code' => 'LH',
                'departure_date' => now()->addDays(17),
                'departure_time' => '02:15:00',
                'arrival_date' => now()->addDays(17),
                'arrival_time' => '08:45:00',
                'flight_duration' => 570, // 9 hours 30 minutes
                'adults_count' => 2,
                'children_count' => 0,
                'infants_count' => 0,
                'total_passengers' => 2,
                'cabin_class' => 'economy',
                'base_amount' => 1250.00,
                'taxes_amount' => 200.00,
                'fees_amount' => 50.00,
                'total_amount' => 1500.00,
                'currency' => 'USD',
                'commission_rate' => 12.00,
                'commission_amount' => 180.00,
                'payment_status' => 'refunded',
                'payment_method' => 'credit_card',
                'status' => 'refunded',
                'confirmation_status' => 'confirmed',
                'pnr_number' => 'MNOP012',
                'booking_source' => 'website',
                'booked_at' => now()->subDays(3),
                'confirmed_at' => now()->subDays(3),
                'cancelled_at' => now()->subDays(2),
                'refunded_at' => now()->subDay(),
                'cancellation_reason' => 'Flight cancelled by airline',
                'refund_reason' => 'Full refund due to airline cancellation',
                'passengers_details' => [
                    [
                        'type' => 'adult',
                        'title' => 'Mr',
                        'first_name' => 'Robert',
                        'last_name' => 'Wilson',
                        'date_of_birth' => '1980-01-25',
                        'passport_number' => 'P159357486'
                    ],
                    [
                        'type' => 'adult',
                        'title' => 'Mrs',
                        'first_name' => 'Maria',
                        'last_name' => 'Wilson',
                        'date_of_birth' => '1983-08-30',
                        'passport_number' => 'P486139572'
                    ]
                ]
            ]
        ];

        foreach ($bookings as $booking) {
            Booking::create($booking);
        }
    }
}