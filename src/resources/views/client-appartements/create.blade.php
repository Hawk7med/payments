@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Ajouter un Appartement pour {{ $client->first_name }} {{ $client->last_name }}</h1>

    <form action="{{ route('client-appartements.store') }}" method="POST">
        @csrf

        <input type="hidden" name="client_id" value="{{ $client->id }}">

        <!-- Zone Dropdown -->
        <div class="form-group">
            <label for="zone_id">Zone</label>
            <select id="zone_id" name="zone_id" class="form-control" required>
                <option value="">Sélectionner une zone</option>
                @foreach($zones as $zone)
                    <option value="{{ $zone->id }}">{{ $zone->name }}</option>
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
            <label for="first_year">Première année</label>
            <input type="number" class="form-control" id="first_year" name="first_year" required>
        </div>

        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>
</div>

<script>
    document.getElementById('zone_id').addEventListener('change', function() {
        const zoneId = this.value;
        const immeubleSelect = document.getElementById('immeuble_id');
        const appartementSelect = document.getElementById('appartement_id');

        // Clear previous options
        immeubleSelect.innerHTML = '<option value="">Sélectionner un immeuble</option>';
        appartementSelect.innerHTML = '<option value="">Sélectionner un appartement</option>';

        if (zoneId) {
            fetch(`/zones/${zoneId}/immeubles`)
                .then(response => response.json())
                .then(data => {
                    data.forEach(immeuble => {
                        const option = document.createElement('option');
                        option.value = immeuble.id;
                        option.textContent = immeuble.name;
                        immeubleSelect.appendChild(option);
                    });
                });
        }
    });

    document.getElementById('immeuble_id').addEventListener('change', function() {
        const immeubleId = this.value;
        const appartementSelect = document.getElementById('appartement_id');

        // Clear previous options
        appartementSelect.innerHTML = '<option value="">Sélectionner un appartement</option>';

        if (immeubleId) {
            fetch(`/immeubles/${immeubleId}/appartements`)
                .then(response => response.json())
                .then(data => {
                    data.forEach(appartement => {
                        const option = document.createElement('option');
                        option.value = appartement.id;
                        option.textContent = appartement.name;
                        appartementSelect.appendChild(option);
                    });
                });
        }
    });
</script>
@endsection
