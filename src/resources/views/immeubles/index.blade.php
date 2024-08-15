@extends('layouts.app')

@section('title', 'Liste des Immeubles')

@section('content')
<div class="container">
    <h1>Liste des Immeubles</h1>
    <a href="{{ route('immeubles.create') }}" class="btn btn-primary mb-3">Créer un nouvel immeuble</a>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Adresse</th>
                <th>Zone</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($immeubles as $immeuble)
                <tr>
                    <td>{{ $immeuble->id }}</td>
                    <td>{{ $immeuble->name }}</td>
                    <td>{{ $immeuble->address }}</td>
                    <td>{{ $immeuble->zone->name }}</td>
                    <td>
                        <a href="{{ route('immeubles.edit', $immeuble->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                        <form action="{{ route('immeubles.destroy', $immeuble->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet immeuble ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
