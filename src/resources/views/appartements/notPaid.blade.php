@extends('layouts.app')

@section('title', 'Appartements Non Payés')

@section('content')
<div class="container">
    <h1 class="mb-4">Appartements Non Payés pour l'Année {{ $year }}</h1>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Immeuble</th>
                <th>Zone</th>
            </tr>
        </thead>
        <tbody>
            @foreach($appartements as $appartement)
                <tr>
                    <td>{{ $appartement->id }}</td>
                    <td>{{ $appartement->name }}</td>
                    <td>{{ $appartement->immeuble->name }}</td>
                    <td>{{ $appartement->immeuble->zone->name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('appartements.index') }}" class="btn btn-primary">Retour à la liste</a>
</div>
@endsection
