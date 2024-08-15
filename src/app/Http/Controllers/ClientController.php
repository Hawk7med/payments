<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Zone;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::paginate(15); // Adjust the number as needed
        return view('clients.index', compact('clients'));
    }
    

    public function create()
    {
        $zones = Zone::all();
        return view('clients.create', compact('zones'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'cin' => 'required|unique:clients|max:255',
            'email' => 'required|email|unique:clients|max:255',
            'address' => 'required',
            'appartement_id' => 'required|exists:appartements,id',
            'first_year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
        ]);

        $client = Client::create($request->except('appartement_id', 'first_year'));
        $client->appartements()->attach($request->appartement_id, ['first_year' => $request->first_year]);

        return redirect()->route('clients.index')->with('success', 'Client created successfully.');
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