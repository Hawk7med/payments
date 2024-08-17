<?php

namespace App\Http\Controllers;

use App\Models\ClientAppartement;
use App\Models\Client;
use App\Models\Appartement;
use Illuminate\Http\Request;

class ClientAppartementController extends Controller
{
    public function index()
    {
        $clientAppartements = ClientAppartement::with('client', 'appartement')->get();
        return view('client_appartements.index', compact('clientAppartements'));
    }

    public function create()
    {
        $clients = Client::all();
        $appartements = Appartement::all();
        return view('client_appartements.create', compact('clients', 'appartements'));
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
    }

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