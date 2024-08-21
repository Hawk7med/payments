<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Client;
use App\Models\Appartement;
use App\Models\ClientAppartement;

class ClientSeeder extends Seeder
{
    public function run()
    {
        // Générer des clients
        Client::factory()->count(5)->create()->each(function ($client) {
            // Créer un appartement pour chaque client
            //$appartement = Appartement::factory()->create();
            
            // Associer le client à l'appartement dans client_appartements
           /*  $clientAppartement = ClientAppartement::create([
                'client_id' => $client->id,
                'appartement_id' => $appartement->id,
                'first_year' => rand(1900, date('Y')),
            ]);

            // Créer des paiements pour chaque client_appartement
           Payment::factory()->count(3)->create([
                'client_appartement_id' => $clientAppartement->id,
                'year' => rand(1900, date('Y')),
            ]);*/
        });
    }
}
