<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\ClientAppartement;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::with('clientAppartement')->get();
        return view('payments.index', compact('payments'));
    }

    public function create()
    {
        $clientAppartements = ClientAppartement::with('client', 'appartement')->get();
        return view('payments.create', compact('clientAppartements'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'client_appartement_id' => 'required|exists:client_appartement,id',
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'is_paid' => 'required|boolean',
            'amount' => 'required|numeric|min:0',
            'payment_date' => 'required|date',
        ]);

        Payment::create($request->all());

        return redirect()->route('payments.index')->with('success', 'Payment recorded successfully.');
    }

    public function edit(Payment $payment)
    {
        $clientAppartements = ClientAppartement::with('client', 'appartement')->get();
        return view('payments.edit', compact('payment', 'clientAppartements'));
    }

    public function update(Request $request, Payment $payment)
    {
        $request->validate([
            'client_appartement_id' => 'required|exists:client_appartement,id',
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'is_paid' => 'required|boolean',
            'amount' => 'required|numeric|min:0',
            'payment_date' => 'required|date',
        ]);

        $payment->update($request->all());

        return redirect()->route('payments.index')->with('success', 'Payment updated successfully.');
    }

    public function destroy(Payment $payment)
    {
        $payment->delete();
        return redirect()->route('payments.index')->with('success', 'Payment deleted successfully.');
    }

    public function showHistory($clientAppartementId)
    {
        $clientAppartement = ClientAppartement::findOrFail($clientAppartementId);
        $currentYear = date('Y');
        $payments = $clientAppartement->payments()->whereYear('year', '<=', $currentYear)->get();

        return view('payments.history', compact('clientAppartement', 'payments', 'currentYear'));
    }
}