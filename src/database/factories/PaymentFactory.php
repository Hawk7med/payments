<?php

namespace Database\Factories;

use App\Models\Payment;
use App\Models\ClientAppartement;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentFactory extends Factory
{
    protected $model = Payment::class;

    public function definition()
    {
        return [
            'client_appartement_id' => ClientAppartement::factory(),
            'year' => $this->faker->year($min = 1900, $max = 'now'),
            'is_paid' => $this->faker->boolean,
            'amount' => $this->faker->randomFloat(2, 100, 10000),
            'payment_date' => $this->faker->optional()->date(),
        ];
    }
}
