@extends('layouts.app')

@section('title', 'Liste des Zones')

@section('content')
    <h1 class="mb-4">Liste des Zones</h1>
    <a href="{{ route('zones.create') }}" class="btn btn-primary mb-3">Créer une nouvelle zone</a>

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
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($zones as $zone)
                <tr>
                    <td>{{ $zone->id }}</td>
                    <td>{{ $zone->name }}</td>
                    <td>
                        <a href="{{ route('zones.edit', $zone->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                        <form action="{{ route('zones.destroy', $zone->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette zone ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
