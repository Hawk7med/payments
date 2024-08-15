@extends('layouts.app')

@section('title', 'Créer un nouvel immeuble')

@section('content')
<div class="container">
    <h1>Créer un nouvel immeuble</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('immeubles.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Nom de l'immeuble</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
        </div>
        <div class="form-group">
            <label for="address">Adresse</label>
            <input type="text" class="form-control" id="address" name="address" value="{{ old('address') }}" >
        </div>
        <div class="form-group">
            <label for="zone_id">Zone</label>
            <select class="form-control" id="zone_id" name="zone_id" required>
                @foreach($zones as $zone)
                    <option value="{{ $zone->id }}" {{ old('zone_id') == $zone->id ? 'selected' : '' }}>
                        {{ $zone->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Créer</button>
    </form>
</div>
@endsection
