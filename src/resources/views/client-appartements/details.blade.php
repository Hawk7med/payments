@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Détails de l'appartement</h1>

    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">{{ $clientAppartement->appartement->name }}</h5>
            <p class="card-text">Première année: {{ $clientAppartement->first_year }}</p>
            <p class="card-text">Zone: {{ $clientAppartement->appartement->immeuble->zone->name }}</p>
            <p class="card-text">Immeuble: {{ $clientAppartement->appartement->immeuble->name }}</p>
            <p class="card-text">Propriétaire: {{ $clientAppartement->client->first_name }} {{ $clientAppartement->client->last_name }}</p>
        </div>
    </div>

    <!-- Card that changes color based on checkbox -->
    <div class="card mb-3 {{ $clientAppartement->appartement->paper === 'yes' ? 'border-success' : 'border-danger' }}">
        <div class="card-body">
            <h5 class="card-title">{{ $clientAppartement->appartement->paper === 'yes' ? 'Feuille de levée prise' : 'Prendre la feuille de levée de main' }}</h5>
            <p class="card-text">
                Statut: {{ $clientAppartement->appartement->paper === 'yes' ? 'Oui' : 'Non' }}
            </p>
            <form action="{{ route('client-appartements.update-paper', $clientAppartement->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="paper" id="paperCheckbox" 
                        {{ $clientAppartement->appartement->paper === 'yes' ? 'checked' : '' }}>
                    <label class="form-check-label" for="paperCheckbox">Marquer comme pris</label>
                </div>
                <button type="submit" class="btn btn-primary mt-2">Enregistrer</button>
            </form>
        </div>
    </div>

    <h2>Historique de paiement</h2>
    <form action="{{ route('client-appartements.update-payments') }}" method="POST">
        @csrf
        <table class="table">
            <thead>
                <tr>
                    <th>Année</th>
                    <th>Payé</th>
                    <th>Montant</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $currentYear = date('Y');
                    $endYear = $currentYear + 2;
                @endphp

                @for ($year = $clientAppartement->first_year; $year <= $endYear; $year++)
                    @php
                        $payment = $clientAppartement->payments->firstWhere('year', $year);
                    @endphp
                    <tr class="{{ $payment && $payment->is_paid ? 'table-success' : 'table-danger' }}">
                        <td>{{ $year }}</td>
                        <td>
                            @if ($payment)
                                {{ $payment->is_paid ? 'Oui' : 'Non' }}
                            @else
                                Non
                            @endif
                        </td>
                        <td>
                            <input type="number" class="form-control" name="amounts[{{ $year }}]" 
                                value="{{ $payment ? $payment->amount : '900' }}" min="0" step="100">
                        </td>
                        <td>
                            <input type="hidden" name="years[]" value="{{ $year }}">
                            <input type="checkbox" name="is_paid[{{ $year }}]" {{ $payment && $payment->is_paid ? 'checked' : '' }}>
                        </td>
                    </tr>
                @endfor
            </tbody>
        </table>

        <input type="hidden" name="client_appartement_id" value="{{ $clientAppartement->id }}">
        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </form>
</div>
@endsection
