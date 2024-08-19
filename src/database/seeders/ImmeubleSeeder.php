<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use App\Models\Immeuble;

class ImmeubleSeeder extends Seeder
{
    public function run()
    {
        Immeuble::factory()->count(4)->create(); // Crée 20 immeubles
    }
}
