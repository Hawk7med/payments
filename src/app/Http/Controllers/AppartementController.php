<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appartement;
use App\Models\Payment;
use App\Models\Immeuble;
use App\Models\Zone;
class AppartementController extends Controller
{
    public function index(Request $request)
    {
        $query = Appartement::query();
    
        if ($request->filled('zone_id')) {
            $query->whereHas('immeuble', function ($query) use ($request) {
                $query->where('zone_id', $request->input('zone_id'));
            });
        }
    
        if ($request->filled('immeuble_id')) {
            $query->where('immeuble_id', $request->input('immeuble_id'));
        }
    
        $appartements = $query->with(['clientAppartements' => function ($query) {
            $query->with('payments');
        }])->paginate(10);
    
        $immeubles = Immeuble::all();
        $zones = Zone::all(); // Fetch zones for filtering
    
        return view('appartements.index', compact('appartements', 'immeubles', 'zones'));
    }
    
    public function show($id)
    {
        $appartement = Appartement::with(['clientAppartements' => function ($query) {
            $query->with('client', 'payments');
        }])->findOrFail($id);
    
        return view('appartements.show', compact('appartement'));
    }
    
    
    public function notPaid($year)
    {
        $appartements = Appartement::whereDoesntHave('payments', function ($query) use ($year) {
            $query->where('year', $year)->where('is_paid', true);
        })->get();

        return view('appartements.notPaid', compact('appartements', 'year'));
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