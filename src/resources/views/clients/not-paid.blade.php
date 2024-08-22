<!-- resources/views/clients/not-paid.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Clients n'ayant pas payé en {{ $year }}</h1>

    @if($clients->isEmpty())
        <p>Aucun client n'a d'appartement impayé pour cette année.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Nom du Client</th>
                    <th>Appartement</th>
                    <th>Immeuble</th>
                    <th>Zone</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($clients as $client)
                    @foreach ($client->clientAppartements as $clientAppartement)
                        <tr>
                            <td>{{ $client->first_name }} {{ $client->last_name }}</td>
                            <td>{{ $clientAppartement->appartement->name }}</td>
                            <td>{{ $clientAppartement->appartement->immeuble->name }}</td>
                            <td>{{ $clientAppartement->appartement->immeuble->zone->name }}</td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
