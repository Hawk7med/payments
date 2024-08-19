<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Client;
use App\Models\Appartement;
use App\Models\ClientAppartement;
use App\Models\Payment;

class ClientAppartementSeeder extends Seeder
{
    public function run()
    {
        // Générer des clients avec des appartements et des paiements
        ClientAppartement::factory()->count(50)->create()->each(function ($clientAppartement) {
            // Créer des paiements pour chaque client_appartement
            Payment::factory()->count(3)->create([
                'client_appartement_id' => $clientAppartement->id,
                'year' => $clientAppartement->first_year + rand(0, 5), // Paiements pour les premières années
            ]);
        });
    }
}
