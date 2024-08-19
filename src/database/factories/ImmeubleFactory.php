<?php

namespace Database\Factories;

use App\Models\Immeuble;
use App\Models\Zone;
use Illuminate\Database\Eloquent\Factories\Factory;

class ImmeubleFactory extends Factory
{
    protected $model = Immeuble::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'address' => $this->faker->address,
            'zone_id' => Zone::factory(),
        ];
    }
}
