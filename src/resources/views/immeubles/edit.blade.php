@extends('layouts.app')

@section('title', 'Modifier l\'immeuble')

@section('content')
<div class="container">
    <h1>Modifier l'immeuble</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('immeubles.update', $immeuble->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Nom de l'immeuble</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $immeuble->name) }}" required>
        </div>
        <div class="form-group">
            <label for="address">Adresse</label>
            <input type="text" class="form-control" id="address" name="address" value="{{ old('address', $immeuble->address) }}" >
        </div>
        <div class="form-group">
            <label for="zone_id">Zone</label>
            <select class="form-control" id="zone_id" name="zone_id" required>
                @foreach($zones as $zone)
                    <option value="{{ $zone->id }}" {{ old('zone_id', $immeuble->zone_id) == $zone->id ? 'selected' : '' }}>
                        {{ $zone->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Mettre à jour</button>
    </form>
</div>
@endsection
