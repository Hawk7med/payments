@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Liste des Clients</h1>

  <!-- Search Form -->
  <form method="GET" action="{{ route('clients.notPaid') }}" class="mb-3">
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="year">Année</label>
                <input type="number" name="year" id="year" class="form-control" placeholder="Entrez une année" value="{{ request('year') }}">
            </div>
        </div>
        <div class="col-md-4">
            <button type="submit" class="btn btn-primary mt-4">Filtrer</button>
        </div>
    </div>
</form>


    <!-- Formulaire de recherche existant -->
    <form method="GET" action="{{ route('clients.index') }}" class="mb-3">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Rechercher par nom ou CIN" value="{{ request()->input('search') }}">
            <button class="btn btn-primary" type="submit">Rechercher</button>
        </div>
    </form>

    <a href="{{ route('clients.create') }}" class="btn btn-primary mb-3">Créer un nouveau client</a>

    <!-- Messages de succès et d'erreurs -->
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

    <!-- Table responsive wrapper -->
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Prénom</th>
                    <th>Nom</th>
                    <th class="d-none d-sm-table-cell">CIN</th> <!-- Hidden on extra small screens -->
                    <th class="d-none d-md-table-cell">Email</th> <!-- Hidden on small screens -->
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
                        <td class="d-none d-sm-table-cell">{{ $client->cin }}</td> <!-- Hidden on extra small screens -->
                        <td class="d-none d-md-table-cell">{{ $client->email }}</td> <!-- Hidden on small screens -->
                        <td>{{ $client->tel }}</td>
                     <!--   <td>
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
                        </td> -->
                        <td>
                        <a href="{{ route('clients.show', $client->id) }}" class="btn btn-info btn-sm">
                            <img src="{{ asset('assets/icons/eye.svg') }}" alt="Voir" width="16" height="16">
                        </a>
                        <a href="{{ route('clients.edit', $client->id) }}" class="btn btn-primary btn-sm">
                            <img src="{{ asset('assets/icons/pencil.svg') }}" alt="Éditer" width="16" height="16">
                        </a>
                        <form action="{{ route('clients.destroy', $client->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce client ?')">
                                <img src="{{ asset('assets/icons/trash.svg') }}" alt="Supprimer" width="16" height="16">
                            </button>
                        </form>
                    </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-center mt-4">
    {{ $clients->links() }}
</div>
</div>
@endsection
