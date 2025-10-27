<?php

namespace Database\Factories;

use App\Models\TravelPartner;
use Illuminate\Database\Eloquent\Factories\Factory;

class TravelPartnerFactory extends Factory
{
    protected $model = TravelPartner::class;

    public function definition(): array
    {
        return [
            'company_name' => $this->faker->company,
            'contact_person' => $this->faker->name,
            'contact_email' => $this->faker->unique()->safeEmail,
            'contact_phone' => $this->faker->phoneNumber,
            'status' => 'active',
        ];
    }
}
