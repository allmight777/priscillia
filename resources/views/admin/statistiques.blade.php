@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Statistiques</h1>

    <!-- KPI Cards -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <h5>🔢 Clients Totaux</h5>
                    <h3>{{ $totalClients }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h5>🆕 Nouveaux Clients</h5>
                    <h3>{{ $nouveauxClients }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <h5>🛒 Commandes (Mois)</h5>
                    <h3>{{ $commandesCeMois }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-warning text-dark">
                <div class="card-body">
                    <h5>💰 CA (Mois)</h5>
                    <h3>{{ number_format($chiffreAffaires, 2) }} FCFA</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Graphiques -->
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">📈 Commandes (30 jours)</div>
                <div class="card-body">
                    <canvas id="commandesChart" height="200"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">🐟 Top 5 Produits</div>
                <div class="card-body">
                    <canvas id="produitsChart" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Scripts Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Graphique des commandes (30 jours)
    const commandesCtx = document.getElementById('commandesChart').getContext('2d');
    new Chart(commandesCtx, {
        type: 'line',
        data: {
            labels: @json($last30DaysLabels), // À générer dans le contrôleur
            datasets: [{
                label: 'Commandes',
                data: @json($last30DaysData), // À générer dans le contrôleur
                borderColor: 'rgb(75, 192, 192)',
                tension: 0.1
            }]
        }
    });

    // Graphique des produits (top 5)
    const produitsCtx = document.getElementById('produitsChart').getContext('2d');
    new Chart(produitsCtx, {
        type: 'bar',
        data: {
            labels: @json($topProduits->keys()),
            datasets: [{
                label: 'Ventes',
                data: @json($topProduits->values()),
                backgroundColor: 'rgba(54, 162, 235, 0.5)'
            }]
        }
    });
</script>
@endsection