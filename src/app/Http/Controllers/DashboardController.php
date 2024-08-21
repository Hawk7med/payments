<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Immeuble;
use App\Models\Zone;
use App\Models\Client;
use App\Models\Payment;
use App\Models\ClientAppartement; // Make sure to import this if it's used

class DashboardController extends Controller
{
    public function index()
    {
        // Fetch statistics
        $immeublesCount = Immeuble::count();
        $zonesCount = Zone::count();
        $clientsCount = Client::count();
        
        // Fetch statistics for payments
        $currentYear = date('Y');
        $years = range($currentYear - 2, $currentYear);

        // Fetch the number of paid and unpaid apartments
        $payments = Payment::selectRaw('year, COUNT(*) as count, SUM(CASE WHEN is_paid = 1 THEN 1 ELSE 0 END) as paid_count, SUM(CASE WHEN is_paid = 0 THEN 1 ELSE 0 END) as unpaid_count')
                           ->groupBy('year')
                           ->pluck('count', 'year')
                           ->toArray();
        
        $paidCount = Payment::selectRaw('year, COUNT(*) as count')
                            ->where('is_paid', 1)
                            ->groupBy('year')
                            ->pluck('count', 'year')
                            ->toArray();
        
        $unpaidCount = Payment::selectRaw('year, COUNT(*) as count')
                              ->where('is_paid', 0)
                              ->groupBy('year')
                              ->pluck('count', 'year')
                              ->toArray();
        
        // Collect other relevant statistics if needed

        return view('dashboard', compact('immeublesCount', 'zonesCount', 'clientsCount', 'payments', 'paidCount', 'unpaidCount', 'years'));
    }
}
