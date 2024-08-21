@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Détails du client</h1>

    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">{{ $client->first_name }} {{ $client->last_name }}</h5>
            <p class="card-text">CIN: {{ $client->cin }}</p>
            <p class="card-text">Email: {{ $client->email }}</p>
            <p class="card-text">Adresse: {{ $client->address }}</p>
            <p class="card-text">Téléphone: {{ $client->tel }}</p>
        </div>
    </div>

    <h2>Appartements associés</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Appartement</th>
                <th>Première année</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($clientAppartements as $clientAppartement)
            <tr>
                <td>{{ $clientAppartement->appartement->name }}</td>
                <td>{{ $clientAppartement->first_year }}</td>
                <td>
                    <a href="{{ route('client-appartements.details', $clientAppartement->id) }}" class="btn btn-info btn-sm">Détails</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('client-appartements.create', $client->id) }}" class="btn btn-secondary">Ajouter un Appartement</a>

 


@endsection
