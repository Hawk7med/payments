<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Zone;
use App\Models\ClientAppartement;
use Illuminate\Http\Request;
use App\Models\Immeuble;

class ClientController extends Controller
{

    public function index(Request $request)
    {
        $search = $request->input('search');
       

        $query = Client::query();

        if ($search) {
            $query->where(function ($query) use ($search) {
                $query->where('first_name', 'like', "%{$search}%")
                      ->orWhere('last_name', 'like', "%{$search}%")
                      ->orWhere('cin', 'like', "%{$search}%");
            });
        }
        $clients = $query->paginate(10);
        return view('clients.index', compact('clients'));
    }

    
    public function create()
    {
        $zones = Zone::all();
        return view('clients.create', compact('zones'));
    }
    public function clientsNotPaid(Request $request)
    {
        \Log::info('clientsNotPaid method called');
        \Log::info('Year received: ' . $request->input('year'));
    
        $year = $request->input('year');
        if (!$year) {
            return redirect()->route('clients.index')->withErrors('Veuillez entrer une année.');
        }
    
        $clients = Client::whereHas('clientAppartements', function ($query) use ($year) {
            $query->whereHas('payments', function ($query) use ($year) {
                $query->where('year', $year)->where('is_paid', false);
            });
        })->with(['clientAppartements' => function ($query) use ($year) {
            $query->whereHas('payments', function ($query) use ($year) {
                $query->where('year', $year)->where('is_paid', false);
            });
        }])->get();
    
        return view('clients.not-paid', compact('clients', 'year'));
    }
    



    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'cin' => 'required|unique:clients|max:255',
            'email' => 'required|email|unique:clients|max:255',
            'address' => 'required',
            'tel' => 'nullable|string|max:20', // Ajoutez cette ligne
            'appartement_id' => 'required|exists:appartements,id',
            'first_year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
        ]);

        // Check if the apartment is already associated with a client
        $exists = ClientAppartement::where('appartement_id', $request->appartement_id)->exists();
        if ($exists) {
            return redirect()->back()->withErrors(['appartement_id' => 'Cet appartement est déjà associé à un client.'])->withInput();
        }

        // Create the client
        $client = Client::create($request->except('appartement_id', 'first_year'));

        // Create the ClientAppartement association
        ClientAppartement::create([
            'client_id' => $client->id,
            'appartement_id' => $request->appartement_id,
            'first_year' => $request->first_year
        ]);

        return redirect()->route('clients.index')->with('success', 'Client créé avec succès.');
    }

   /* public function show(Client $client)
    {
        $clientAppartements = $client->appartements()->with('payments')->get();
        $currentYear = date('Y');

        return view('clients.show', compact('client', 'clientAppartements', 'currentYear'));
    }*/
    public function show(Client $client)
    {
        // Récupérer tous les appartements associés au client et leur historique de paiement
        $clientAppartements = $client->clientAppartements()->with('appartement', 'payments')->get();
        $currentYear = date('Y');

        return view('clients.show', compact('client', 'clientAppartements', 'currentYear'));
    }
    public function addAppartement(Request $request, $clientId)
    {
        $client = Client::findOrFail($clientId);
        $client->appartements()->attach($request->appartement_id, ['first_year' => $request->first_year]);

        return redirect()->route('clients.show', $clientId);
    }

    public function edit(Client $client)
    {
        $zones = Zone::all();
        return view('clients.edit', compact('client', 'zones'));
    }

    public function update(Request $request, Client $client)
    {
        $request->validate([
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'cin' => 'required|unique:clients,cin,' . $client->id . '|max:255',
            'email' => 'required|email|unique:clients,email,' . $client->id . '|max:255',
            'address' => 'required',
            'tel' => 'required',
        ]);

        $client->update($request->all());

        return redirect()->route('clients.index')->with('success', 'Client updated successfully.');
    }

    public function destroy(Client $client)
    {
        $client->delete();
        return redirect()->route('clients.index')->with('success', 'Client deleted successfully.');
    }

    public function search(Request $request)
    {
        $query = Client::query();

        if ($request->has('search')) {
            $search = $request->get('search');
            $query->where('first_name', 'like', "%$search%")
                  ->orWhere('last_name', 'like', "%$search%")
                  ->orWhere('cin', 'like', "%$search%");
        }

        $clients = $query->paginate(15);

        return view('clients.index', compact('clients'));
    }
    
}