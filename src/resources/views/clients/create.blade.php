@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Créer un nouveau client</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('clients.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="first_name">Prénom</label>
            <input type="text" class="form-control" id="first_name" name="first_name" value="{{ old('first_name') }}" required>
        </div>
        <div class="form-group">
            <label for="last_name">Nom</label>
            <input type="text" class="form-control" id="last_name" name="last_name" value="{{ old('last_name') }}" required>
        </div>
        <div class="form-group">
            <label for="cin">CIN</label>
            <input type="text" class="form-control" id="cin" name="cin" value="{{ old('cin') }}" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
        </div>
        <div class="form-group">
            <label for="address">Adresse</label>
            <input type="text" class="form-control" id="address" name="address" value="{{ old('address') }}" required>
        </div>

        <!-- Zone Dropdown -->
        <div class="form-group">
            <label for="zone_id">Zone</label>
            <select id="zone_id" name="zone_id" class="form-control" required>
                <option value="">Sélectionner une zone</option>
                @foreach($zones as $zone)
                    <option value="{{ $zone->id }}" {{ old('zone_id') == $zone->id ? 'selected' : '' }}>{{ $zone->name }}</option>
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
            <input type="number" class="form-control" id="first_year" name="first_year" value="{{ old('first_year') }}" required min="1900" max="{{ date('Y') + 1 }}">
        </div>

        <button type="submit" class="btn btn-primary">Créer</button>
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
