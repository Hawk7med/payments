<?php

namespace App\Http\Controllers;

use App\Models\Zone;
use App\Models\Immeuble;
use Illuminate\Http\Request;

class ZoneController extends Controller
{
    public function index()
    {
        $zones = Zone::all();
        return view('zones.index', compact('zones'));
    }

    public function create()
    {
        return view('zones.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:zones|max:255',
        ]);

        Zone::create($request->all());

        return redirect()->route('zones.index')->with('success', 'Zone created successfully.');
    }

    public function edit(Zone $zone)
    {
        return view('zones.edit', compact('zone'));
    }

    public function update(Request $request, Zone $zone)
    {
        $request->validate([
            'name' => 'required|unique:zones,name,' . $zone->id . '|max:255',
        ]);

        $zone->update($request->all());

        return redirect()->route('zones.index')->with('success', 'Zone updated successfully.');
    }

    public function destroy(Zone $zone)
    {
        $zone->delete();
        return redirect()->route('zones.index')->with('success', 'Zone deleted successfully.');
    }
    public function getImmeubles($zoneId)
{
    $immeubles = Immeuble::where('zone_id', $zoneId)->get();
    return response()->json($immeubles);
}

}