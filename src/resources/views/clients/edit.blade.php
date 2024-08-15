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
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $client->email) }}" required>
        </div>
        <div class="form-group">
            <label for="address">Adresse</label>
            <input type="text" class="form-control" id="address" name="address" value="{{ old('address', $client->address) }}" required>
        </div>

        <!-- Zone Dropdown -->
        <div class="form-group">
            <label for="zone_id">Zone</label>
            <select id="zone_id" name="zone_id" class="form-control" required>
                <option value="">Sélectionner une zone</option>
                @foreach($zones as $zone)
                    <option value="{{ $zone->id }}" {{ old('zone_id', $client->zone_id) == $zone->id ? 'selected' : '' }}>{{ $zone->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Immeuble Dropdown -->
        <div class="form-group">
            <label for="immeuble_id">Immeuble</label>
            <select id="immeuble_id" name="immeuble_id" class="form-control" required>
                <option value="">Sélectionner un immeuble</option>
            </select>
        </div>

        <!-- Appartement Dropdown -->
        <div class="form-group">
            <label for="appartement_id">Appartement</label>
            <select id="appartement_id" name="appartement_id" class="form-control" required>
                <option value="">Sélectionner un appartement</option>
            </select>
        </div>

        <div class="form-group">
            <label for="first_year">Année de première association</label>
            <input type="number" class="form-control" id="first_year" name="first_year" value="{{ old('first_year', $client->first_year) }}" required min="1900" max="{{ date('Y') + 1 }}">
        </div>

        <button type="submit" class="btn btn-primary">Mettre à jour</button>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const zoneId = document.getElementById('zone_id').value;
        const immeubleId = {!! json_encode(old('immeuble_id', $client->immeuble_id)) !!};

        function loadImmeubles(zoneId) {
            fetch(`/zones/${zoneId}/immeubles`)
                .then(response => response.json())
                .then(data => {
                    const immeubleSelect = document.getElementById('immeuble_id');
                    immeubleSelect.innerHTML = '<option value="">Sélectionner un immeuble</option>';
                    data.forEach(immeuble => {
                        const option = document.createElement('option');
                        option.value = immeuble.id;
                        option.textContent = immeuble.name;
                        immeubleSelect.appendChild(option);
                    });
                    if (immeubleId) {
                        immeubleSelect.value = immeubleId;
                        immeubleSelect.dispatchEvent(new Event('change'));
                    }
                });
        }

        function loadAppartements(immeubleId) {
            fetch(`/immeubles/${immeubleId}/appartements`)
                .then(response => response.json())
                .then(data => {
                    const appartementSelect = document.getElementById('appartement_id');
                    appartementSelect.innerHTML = '<option value="">Sélectionner un appartement</option>';
                    data.forEach(appartement => {
                        const option = document.createElement('option');
                        option.value = appartement.id;
                        option.textContent = appartement.name;
                        appartementSelect.appendChild(option);
                    });
                    const oldAppartementId = {!! json_encode(old('appartement_id', $client->appartement_id)) !!};
                    if (oldAppartementId) {
                        appartementSelect.value = oldAppartementId;
                    }
                });
        }

        document.getElementById('zone_id').addEventListener('change', function() {
            loadImmeubles(this.value);
        });

        document.getElementById('immeuble_id').addEventListener('change', function() {
            loadAppartements(this.value);
        });

        if (zoneId) {
            loadImmeubles(zoneId);
        }

        if (immeubleId) {
            loadAppartements(immeubleId);
        }
    });
</script>

@endsection
