<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Immeuble;

class ImmeubleSeeder extends Seeder
{
    public function run()
    {
        // Créer manuellement 10 immeubles avec zone_id = 1
        $immeubles = [
            ['name' => 168, 'address' => 'gh/5', 'zone_id' => 1],
            ['name' => 169, 'address' => 'gh/5', 'zone_id' => 1],
            ['name' => 170, 'address' => 'gh/5', 'zone_id' => 1],
            ['name' => 171, 'address' => 'gh/5', 'zone_id' => 1],
            ['name' => 172, 'address' => 'gh/5', 'zone_id' => 1],
            ['name' => 173, 'address' => 'gh/5', 'zone_id' => 1],
            ['name' => 174, 'address' => 'gh/5', 'zone_id' => 1],
            ['name' => 175, 'address' => 'gh/5', 'zone_id' => 1],
            ['name' => 176, 'address' => 'gh/5', 'zone_id' => 1],
            ['name' => 177, 'address' => 'gh/5', 'zone_id' => 1],
        ];

        foreach ($immeubles as $immeuble) {
            Immeuble::create($immeuble);
        }
    }
}
