<?php
// database/seeders/TravelPartnerSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TravelPartner;
use App\Models\User;

class TravelPartnerSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('user_type', 'admin')->first();
        
        $partners = [
            [
                'company_name' => 'Amadeus Travel',
                'profile_image' => 'profile_image',
                'api_type' => 'Flight Search API',
                'partner_tier' => 'enterprise',
                'status' => 'active',
                'commission_rate' => 12.00,
                'monthly_revenue' => 45680.00,
                'integration_date' => now()->subMonths(8),
                'contract_end_date' => now()->addMonths(16), // Dec 2025
                'api_credential_1' => 'amadeus_api_key_123456',
                'api_credential_2' => encrypt('amadeus_secret_key_789'),
                'api_credential_3' => 'access_token_789',
                'api_credential_4' => 'https://api.amadeus.com/v1',
                'api_credential_5' => encrypt('webhook_secret_abc123'),
                'api_credential_6' => 'additional_param_xyz',
                'development_mode' => false,
                'currency_support' => true,
                'payment_integration' => true,
                'custom_pnr_format' => true,
                'api_uptime' => 98.5,
                'total_bookings' => 1250,
                'total_revenue' => 365000.00,
                'revenue_growth' => 18.0,
                'admin_notes' => 'Amadeus configured for production. Test mode enabled for development environment.',
                'contact_email' => 'api@amadeus.com',
                'contact_person' => 'John Smith',
                'supported_currencies' => ['USD', 'EUR', 'GBP', 'JPY'],
                'supported_countries' => ['US', 'UK', 'FR', 'DE', 'JP'],
                'created_by' => $admin->id
            ],
            [
                'company_name' => 'Kiwi.com',
                'api_type' => 'Multi-city Flight API',
                'partner_tier' => 'premium',
                'status' => 'active',
                'commission_rate' => 8.00,
                'monthly_revenue' => 32140.00,
                'integration_date' => now()->subMonths(5),
                'contract_end_date' => now()->addMonths(22), // Jun 2026
                'api_credential_1' => 'kiwi_api_key_456789',
                'api_credential_2' => encrypt('kiwi_secret_key_123'),
                'api_credential_3' => 'kiwi_access_token_456',
                'api_credential_4' => 'https://api.kiwi.com/v2',
                'development_mode' => false,
                'currency_support' => true,
                'payment_integration' => true,
                'custom_pnr_format' => false,
                'api_uptime' => 96.2,
                'total_bookings' => 890,
                'total_revenue' => 245000.00,
                'revenue_growth' => 8.0,
                'admin_notes' => 'Kiwi integration working well. Good for multi-city routes.',
                'contact_email' => 'partners@kiwi.com',
                'contact_person' => 'Sarah Johnson',
                'supported_currencies' => ['USD', 'EUR', 'CZK'],
                'supported_countries' => ['US', 'EU', 'CZ'],
                'created_by' => $admin->id
            ],
            [
                'company_name' => 'Duffel',
                'api_type' => 'NDC Flight API',
                'partner_tier' => 'standard',
                'status' => 'active',
                'commission_rate' => 6.00,
                'monthly_revenue' => 18960.00,
                'integration_date' => now()->subMonths(3),
                'contract_end_date' => now()->addMonths(9), // Mar 2025
                'api_credential_1' => 'duffel_api_key_789012',
                'api_credential_2' => encrypt('duffel_secret_key_456'),
                'api_credential_3' => 'duffel_access_token_789',
                'api_credential_4' => 'https://api.duffel.com/air',
                'development_mode' => true,
                'currency_support' => false,
                'payment_integration' => false,
                'custom_pnr_format' => false,
                'api_uptime' => 92.8,
                'total_bookings' => 420,
                'total_revenue' => 89000.00,
                'revenue_growth' => -5.0,
                'admin_notes' => 'Duffel in test mode. Performance needs improvement.',
                'contact_email' => 'support@duffel.com',
                'contact_person' => 'Mike Wilson',
                'supported_currencies' => ['USD'],
                'supported_countries' => ['US', 'UK'],
                'created_by' => $admin->id
            ],
            [
                'company_name' => 'TravelGate',
                'api_type' => 'Hotel Booking API',
                'partner_tier' => 'premium',
                'status' => 'pending',
                'commission_rate' => 15.00,
                'monthly_revenue' => 28540.00,
                'integration_date' => now()->subMonths(6),
                'contract_end_date' => now()->subDays(15), // Contract pending renewal
                'api_credential_1' => 'travelgate_api_key_345678',
                'api_credential_2' => encrypt('travelgate_secret_key_789'),
                'api_credential_3' => 'travelgate_access_token_123',
                'api_credential_4' => 'https://api.travelgate.com/hotel',
                'development_mode' => false,
                'currency_support' => true,
                'payment_integration' => true,
                'custom_pnr_format' => true,
                'api_uptime' => 94.5,
                'total_bookings' => 680,
                'total_revenue' => 195000.00,
                'revenue_growth' => 22.0,
                'admin_notes' => 'TravelGate contract renewal pending. Good performance.',
                'contact_email' => 'partnerships@travelgate.com',
                'contact_person' => 'Lisa Chen',
                'supported_currencies' => ['USD', 'EUR', 'GBP'],
                'supported_countries' => ['US', 'EU', 'UK'],
                'created_by' => $admin->id
            ]
        ];

        foreach ($partners as $partner) {
            TravelPartner::create($partner);
        }
    }
}