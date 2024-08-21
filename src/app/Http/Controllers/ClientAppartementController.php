<?php

namespace App\Http\Controllers;

use App\Models\ClientAppartement;
use App\Models\Client;
use App\Models\Appartement;

use App\Models\Zone;
use Illuminate\Http\Request;

class ClientAppartementController extends Controller
{
  
public function updatePayments(Request $request)
{
    $clientAppartementId = $request->input('client_appartement_id');
    $years = $request->input('years', []);
    $amounts = $request->input('amounts', []);
    $isPaid = $request->input('is_paid', []);

    $clientAppartement = ClientAppartement::findOrFail($clientAppartementId);

    foreach ($years as $year) {
        $amount = $amounts[$year] ?? 0;
        $paid = isset($isPaid[$year]);

        $payment = $clientAppartement->payments()->updateOrCreate(
            ['year' => $year],
            ['is_paid' => $paid, 'amount' => $amount]
        );
    }

    return redirect()->back()->with('success', 'Paiements mis à jour avec succès.');
}

    public function storePayment(Request $request, $clientAppartementId)
    {
        try {
            $validated = $request->validate([
                'year' => 'required|integer',
                'is_paid' => 'required|boolean',
                'amount' => 'nullable|numeric|min:0',
            ]);
    
            $clientAppartement = ClientAppartement::findOrFail($clientAppartementId);
    
            $payment = $clientAppartement->payments()->updateOrCreate(
                ['year' => $validated['year']],
                ['is_paid' => $validated['is_paid'], 'amount' => $validated['amount']]
            );
    
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    

    
    public function index()
    {
        $clientAppartements = ClientAppartement::with('client', 'appartement')->get();
        return view('client-appartements.index', compact('clientAppartements'));
    }
    public function create(Client $client)
    {
        $zones = Zone::all(); // Récupérer toutes les zones
        return view('client-appartements.create', compact('client', 'zones'));
    }

    public function details($id)
    {
        $clientAppartement = ClientAppartement::with('payments')->findOrFail($id);
        return view('client-appartements.details', compact('clientAppartement'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'appartement_id' => 'required|exists:appartements,id',
            'first_year' => 'required|integer|min:2000|max:2099',
        ]);

        ClientAppartement::create($validated);

        return redirect()->route('clients.show', $validated['client_id'])
                         ->with('success', 'Appartement ajouté avec succès.');
    }


    /*
        public function create(Client $client, $appartement_id)
    {
        $appartement = Appartement::findOrFail($appartement_id);
        return view('client-appartements.create', compact('client', 'appartement'));
    }
    public function create()
    {
        $clients = Client::all();
        $appartements = Appartement::all();
        return view('client-appartements.create', compact('clients', 'appartements'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'appartement_id' => 'required|exists:appartements,id',
            'first_year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
        ]);

         // Vérifiez si l'association existe déjà
            $exists = ClientAppartement::where('client_id', $request->client_id)
            ->where('appartement_id', $request->appartement_id)
            ->exists();

        if ($exists) {
        return redirect()->back()->withErrors(['msg' => 'Cet appartement est déjà associé à ce client.']);
        }

        ClientAppartement::create($request->all());

        return redirect()->route('client_appartements.index')->with('success', 'Client-Appartement association created successfully.');
    }*/

    public function edit(ClientAppartement $clientAppartement)
    {
        $clients = Client::all();
        $appartements = Appartement::all();
        return view('client_appartements.edit', compact('clientAppartement', 'clients', 'appartements'));
    }

    public function update(Request $request, ClientAppartement $clientAppartement)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'appartement_id' => 'required|exists:appartements,id',
            'first_year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
        ]);

        $clientAppartement->update($request->all());

        return redirect()->route('client_appartements.index')->with('success', 'Client-Appartement association updated successfully.');
    }

    public function destroy(ClientAppartement $clientAppartement)
    {
        $clientAppartement->delete();
        return redirect()->route('client_appartements.index')->with('success', 'Client-Appartement association deleted successfully.');
    }
}