@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Modifier un client</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('clients.update', $client->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Form fields as before -->
        <div class="form-group">
            <label for="first_name">Prénom</label>
            <input type="text" class="form-control" id="first_name" name="first_name" value="{{ old('first_name', $client->first_name) }}" required>
        </div>
        <div class="form-group">
            <label for="last_name">Nom</label>
            <input type="text" class="form-control" id="last_name" name="last_name" value="{{ old('last_name', $client->last_name) }}" required>
        </div>
        <div class="form-group">
            <label for="cin">CIN</label>
            <input type="text" class="form-control" id="cin" name="cin" value="{{ old('cin', $client->cin) }}" required>
        </div>
        <div class="form-group">
            <label for="tel">Téléphone</label>
            <input type="text" class="form-control" id="tel" name="tel" value="{{ old('tel', $client->tel) }}" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $client->email) }}" required>
        </div>
        <div class="form-group">
            <label for="address">Adresse</label>
            <input type="text" class="form-control" id="address" name="address" value="{{ old('address', $client->address) }}" required>
        </div>



        <button type="submit" class="btn btn-primary">Mettre à jour</button>
    </form>
</div>

@endsection
