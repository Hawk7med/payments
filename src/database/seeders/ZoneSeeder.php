<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Zone;

class ZoneSeeder extends Seeder
{
    public function run()
    {
        Zone::factory()->count(3)->create(); // Crée 10 zones
    }
}
