<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Appartement;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ClientFactory extends Factory
{
    protected $model = Client::class;

    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'cin' => strtoupper(Str::random(8)), // Génère un CIN aléatoire
            'email' => $this->faker->unique()->safeEmail,
            'tel' => $this->faker->unique()->phoneNumber,
            'address' => $this->faker->address,
            'appartement_id' => Appartement::factory(), // Crée un appartement associé
            'first_year' => $this->faker->numberBetween(1900, date('Y')),
        ];
    }
}
