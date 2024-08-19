<?php


namespace Database\Factories;


use App\Models\Client;
use App\Models\Appartement;
use App\Models\ClientAppartement;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClientAppartementFactory extends Factory
{
    protected $model = ClientAppartement::class;

    public function definition()
    {
        return [
            'client_id' => Client::factory(),
            'appartement_id' => Appartement::factory(),
            'first_year' => $this->faker->year($min = 1900, $max = 'now'),
        ];
    }
}
