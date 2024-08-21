<?php

namespace App\Http\Controllers;

use App\Models\Appartement;
use App\Models\Immeuble;
use Illuminate\Http\Request;

class AppartementController extends Controller
{
    public function index()
    {
        $appartements = Appartement::with('immeuble')->get();
        return view('appartements.index', compact('appartements'));
    }

    public function create()
    {
        $immeubles = Immeuble::all();
        return view('appartements.create', compact('immeubles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'immeuble_id' => 'required|exists:immeubles,id',
        ]);

        Appartement::create($request->all());

        return redirect()->route('appartements.index')->with('success', 'Appartement created successfully.');
    }

    public function edit(Appartement $appartement)
    {
        $immeubles = Immeuble::all();
        return view('appartements.edit', compact('appartement', 'immeubles'));
    }

    public function update(Request $request, Appartement $appartement)
    {
        $request->validate([
            'name' => 'required|max:255',
            'immeuble_id' => 'required|exists:immeubles,id',
        ]);

        $appartement->update($request->all());

        return redirect()->route('appartements.index')->with('success', 'Appartement updated successfully.');
    }

    public function destroy(Appartement $appartement)
    {
        $appartement->delete();
        return redirect()->route('appartements.index')->with('success', 'Appartement deleted successfully.');
    }
    public function getAppartements($immeubleId)
    {
        $appartements = Appartement::where('immeuble_id', $immeubleId)->get();
        return response()->json($appartements);
    }
}