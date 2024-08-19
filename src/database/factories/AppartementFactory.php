<?php


namespace Database\Factories;

use App\Models\Appartement;
use App\Models\Immeuble;
use Illuminate\Database\Eloquent\Factories\Factory;

class AppartementFactory extends Factory
{
    protected $model = Appartement::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'immeuble_id' => Immeuble::factory(),  // Associe l'appartement à un immeuble
        ];
    }
}
