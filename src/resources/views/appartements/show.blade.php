@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Détails de l'Appartement</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Appartement: {{ $appartement->name }}</h5>
            <p><strong>Immeuble:</strong> {{ $appartement->immeuble->name }}</p>
            <p><strong>Zone:</strong> {{ $appartement->immeuble->zone->name }}</p>

            <h5 class="mt-4">Propriétaires:</h5>
            <ul>
                @foreach ($appartement->clientAppartements as $clientAppartement)
                    <li>{{ $clientAppartement->client->first_name }} {{ $clientAppartement->client->last_name }}</li>
                @endforeach
            </ul>

            <h5 class="mt-4">Historique des Paiements:</h5>
            <ul>
                @foreach ($appartement->clientAppartements as $clientAppartement)
                    @foreach ($clientAppartement->payments as $payment)
                        <li>
                            Année: {{ $payment->year }} - 
                            Montant: {{ $payment->amount }} - 
                            Payé: {{ $payment->is_paid ? 'Oui' : 'Non' }}
                        </li>
                    @endforeach
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection
