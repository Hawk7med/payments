<?php

namespace App\Http\Controllers;

use App\Models\Immeuble;
use App\Models\Zone;
use App\Models\Appartement;
use Illuminate\Http\Request;

class ImmeubleController extends Controller
{
    public function index()
    {
        $immeubles = Immeuble::with('zone')->get();
        return view('immeubles.index', compact('immeubles'));
    }

    public function create()
    {
        $zones = Zone::all();
        return view('immeubles.create', compact('zones'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
         
            'zone_id' => 'required|exists:zones,id',
        ]);

        $immeuble = Immeuble::create($request->all());

        // Create 27 default apartments
        for ($i = 1; $i <= 27; $i++) {
            $immeuble->appartements()->create(['name' => "Appartement $i"]);
        }

        return redirect()->route('immeubles.index')->with('success', 'Immeuble created successfully.');
    }

    public function edit(Immeuble $immeuble)
    {
        $zones = Zone::all();
        return view('immeubles.edit', compact('immeuble', 'zones'));
    }

    public function update(Request $request, Immeuble $immeuble)
    {
        $request->validate([
            'name' => 'required|max:255',
      
            'zone_id' => 'required|exists:zones,id',
        ]);

        $immeuble->update($request->all());

        return redirect()->route('immeubles.index')->with('success', 'Immeuble updated successfully.');
    }

    public function destroy(Immeuble $immeuble)
    {
        $immeuble->delete();
        return redirect()->route('immeubles.index')->with('success', 'Immeuble deleted successfully.');
    }
    public function getAppartements($immeubleId)
{
    $appartements = Appartement::where('immeuble_id', $immeubleId)->get();
    return response()->json($appartements);
}
public function getImmeubles($zoneId)
{
    $immeubles = Immeuble::where('zone_id', $zoneId)->get();
    return response()->json($immeubles);
}

}