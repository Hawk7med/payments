@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Liste des Clients</h1>

    <!-- Search Form -->
    <form method="GET" action="{{ route('clients.index') }}" class="mb-3">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Rechercher par nom ou CIN" value="{{ request()->input('search') }}">
            <button class="btn btn-primary" type="submit">Rechercher</button>
        </div>
    </form>

    <!-- Filter by Immeuble -->
    <form method="GET" action="{{ route('clients.index') }}" class="mb-3">
        <div class="input-group">
            <select name="immeuble_id" class="form-select" onchange="this.form.submit()">
                <option value="">Sélectionner un immeuble</option>
                @foreach($immeubles as $immeuble)
                    <option value="{{ $immeuble->id }}" {{ request()->input('immeuble_id') == $immeuble->id ? 'selected' : '' }}>
                        {{ $immeuble->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </form>

    <a href="{{ route('clients.create') }}" class="btn btn-primary mb-3">Créer un nouveau client</a>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Prénom</th>
                <th>Nom</th>
                <th>CIN</th>
                <th>Email</th>
                <th>Téléphone</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($clients as $client)
                <tr>
                    <td>{{ $client->id }}</td>
                    <td>{{ $client->first_name }}</td>
                    <td>{{ $client->last_name }}</td>
                    <td>{{ $client->cin }}</td>
                    <td>{{ $client->email }}</td>
                    <td>{{ $client->tel }}</td>
                    <td>
                        <a href="{{ route('clients.show', $client->id) }}" class="btn btn-info btn-sm">
                            <i class="mdi mdi-eye"></i>
                        </a>
                        <a href="{{ route('clients.edit', $client->id) }}" class="btn btn-primary btn-sm">
                            <i class="mdi mdi-pencil"></i>
                        </a>
                        <form action="{{ route('clients.destroy', $client->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce client ?')">
                                <i class="mdi mdi-delete"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $clients->links() }}
</div>
@endsection
