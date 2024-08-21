@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Tableau de Bord</h1>

    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body">
                    <h5 class="card-title">Immeubles</h5>
                    <p class="card-text">{{ $immeublesCount }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title">Zones</h5>
                    <p class="card-text">{{ $zonesCount }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-danger mb-3">
                <div class="card-body">
                    <h5 class="card-title">Clients</h5>
                    <p class="card-text">{{ $clientsCount }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-warning mb-3">
                <div class="card-body">
                    <h5 class="card-title">Clients Payés</h5>
                    <canvas id="paymentsChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Statistiques des Paiements</h5>
                    <canvas id="paymentStatsChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Paiements Payés vs Non Payés</h5>
                    <canvas id="paidVsUnpaidChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const paymentsChartCtx = document.getElementById('paymentsChart').getContext('2d');
    const paymentStatsChartCtx = document.getElementById('paymentStatsChart').getContext('2d');
    const paidVsUnpaidChartCtx = document.getElementById('paidVsUnpaidChart').getContext('2d');

    const paymentsChart = new Chart(paymentsChartCtx, {
        type: 'bar',
        data: {
            labels: @json($years),
            datasets: [{
                label: 'Nombre Total de Paiements',
                data: @json($payments),
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                x: {
                    beginAtZero: true
                },
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    const paymentStatsChart = new Chart(paymentStatsChartCtx, {
        type: 'line',
        data: {
            labels: @json($years),
            datasets: [{
                label: 'Statistiques des Paiements',
                data: @json($payments),
                backgroundColor: 'rgba(153, 102, 255, 0.2)',
                borderColor: 'rgba(153, 102, 255, 1)',
                borderWidth: 1,
                fill: true
            }]
        },
        options: {
            responsive: true,
            scales: {
                x: {
                    beginAtZero: true
                },
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    const paidVsUnpaidChart = new Chart(paidVsUnpaidChartCtx, {
        type: 'bar',
        data: {
            labels: @json($years),
            datasets: [{
                label: 'Paiements Payés',
                data: @json($paidCount),
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }, {
                label: 'Paiements Non Payés',
                data: @json($unpaidCount),
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                x: {
                    beginAtZero: true
                },
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
@endsection
