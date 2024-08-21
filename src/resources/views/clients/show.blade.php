@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Détails du client</h1>

    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">{{ $client->first_name }} {{ $client->last_name }}</h5>
            <p class="card-text">CIN: {{ $client->cin }}</p>
            <p class="card-text">Email: {{ $client->email }}</p>
            <p class="card-text">Adresse: {{ $client->address }}</p>
            <p class="card-text">Téléphone: {{ $client->tel }}</p>
        </div>
    </div>

    <h2>Appartements associés</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Appartement</th>
                <th>Première année</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($clientAppartements as $clientAppartement)
            <tr>
                <td>{{ $clientAppartement->appartement->name }}</td>
                <td>{{ $clientAppartement->first_year }}</td>
                <td>
                    <a href="{{ route('client-appartements.details', $clientAppartement->id) }}" class="btn btn-info btn-sm">Détails</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('client-appartements.create', $client->id) }}" class="btn btn-secondary">Ajouter un Appartement</a>

    <h2>Années à venir</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Année</th>
                <th>Payé</th>
                <th>Montant</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @for ($year = $currentYear + 1; $year <= $currentYear + 5; $year++)
            <tr>
                <td>{{ $year }}</td>
                <td>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="paid-{{ $year }}">
                        <label class="form-check-label" for="paid-{{ $year }}">
                            Payé
                        </label>
                    </div>
                </td>
                <td>
                    <input type="number" class="form-control" id="amount-{{ $year }}" min="0" step="0.01">
                </td>
                <td>
                    <button class="btn btn-primary btn-sm" onclick="savePayment({{ $client->id }}, {{ $year }})">Enregistrer</button>
                </td>
            </tr>
            @endfor
        </tbody>
    </table>

    <a href="{{ route('clients.edit', $client->id) }}" class="btn btn-primary">Modifier</a>
</div>

<script>
    function savePayment(clientAppartementId, year) {
        const amount = $(`#amount-${year}`).val();
        const isPaid = $(`#paid-${year}`).is(':checked');

        $.ajax({
            url: `/client-appartements/${clientAppartementId}/payments`,
            method: 'POST',
            data: {
                year: year,
                is_paid: isPaid,
                amount: amount,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.success) {
                    alert(`Paiement pour l'année ${year} a été enregistré`);
                    location.reload(); // Recharger la page pour afficher les modifications
                }
            },
            error: function(xhr) {
                console.error(xhr.responseText); // Log des erreurs pour débogage
                alert('Erreur lors de l\'enregistrement du paiement');
            }
        });
    }
</script>


@endsection
