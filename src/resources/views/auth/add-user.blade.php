@extends('layouts.app')

@section('content')
<h2>Ajouter un utilisateur</h2>
<form method="POST" action="{{ route('users.add') }}">
    @csrf
    <div>
        <label for="name">Nom :</label>
        <input type="text" name="name" required autofocus>
    </div>
    <div>
        <label for="email">Email :</label>
        <input type="email" name="email" required>
    </div>
    <div>
        <label for="password">Mot de passe :</label>
        <input type="password" name="password" required>
    </div>
    <div>
        <label for="password_confirmation">Confirmer le mot de passe :</label>
        <input type="password" name="password_confirmation" required>
    </div>
    <div>
        <button type="submit">Ajouter l'utilisateur</button>
    </div>
</form>
@endsection