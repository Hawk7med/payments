@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Gestion des Appartements</h1>

    <form method="GET" action="{{ route('appartements.index') }}" class="mb-4">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="zone_id">Filtrer par Zone</label>
                    <select name="zone_id" id="zone_id" class="form-control">
                        <option value="">Toutes les Zones</option>
                        @foreach ($zones as $zone)
                            <option value="{{ $zone->id }}" {{ request('zone_id') == $zone->id ? 'selected' : '' }}>
                                {{ $zone->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="immeuble_id">Filtrer par Immeuble</label>
                    <select name="immeuble_id" id="immeuble_id" class="form-control">
                        <option value="">Tous les Immeubles</option>
                        @foreach ($immeubles as $immeuble)
                            <option value="{{ $immeuble->id }}" {{ request('immeuble_id') == $immeuble->id ? 'selected' : '' }}>
                                {{ $immeuble->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary mt-4">Filtrer</button>
            </div>
        </div>
    </form>

    <table class="table">
        <thead>
            <tr>
                <th>Nom de l'Appartement</th>
                <th>Immeuble</th>
                <th>Zone</th>
                <th>Propriétaire</th>
                <th>Historique de Paiement</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($appartements as $appartement)
                <tr>
                    <td>{{ $appartement->name }}</td>
                    <td>{{ $appartement->immeuble->name }}</td>
                    <td>{{ $appartement->immeuble->zone->name }}</td>
                    <td>
                        @foreach ($appartement->clientAppartements as $clientAppartement)
                            {{ $clientAppartement->client->first_name }} {{ $clientAppartement->client->last_name }}
                        @endforeach
                    </td>
                    <td>
                        @foreach ($appartement->clientAppartements as $clientAppartement)
                            <ul>
                                @foreach ($clientAppartement->payments as $payment)
                                    <li>
                                        Année: {{ $payment->year }} - 
                                        Montant: {{ $payment->amount }} - 
                                        Payé: {{ $payment->is_paid ? 'Oui' : 'Non' }}
                                    </li>
                                @endforeach
                            </ul>
                        @endforeach
                    </td>
                    <td>
                        <a href="{{ route('appartements.show', $appartement->id) }}" class="btn btn-info btn-sm">Détails</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center mt-4">
    {{ $appartements->links() }}
</div>

</div>
@endsection
