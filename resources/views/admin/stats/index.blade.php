@extends('layouts.app')

@section('page-title', 'Statistiche')

@section('main-content')

    <div class="container mt-5">
        <h1>Statistiche Ordini</h1>
        <p>Totale Ordini: <strong>{{ $totalOrders }}</strong></p>
        <canvas id="ordersChart"></canvas>
        <p>Totale Soldi Guadagnati: <strong>€{{ number_format($totalRevenue, 2) }}</strong></p>
        <canvas id="revenueChart"></canvas>
    </div>
        
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Grafico degli ordini
    const ordersCtx = document.getElementById('ordersChart').getContext('2d');
    const ordersChart = new Chart(ordersCtx, {
        type: 'line',
        data: {
            labels: @json($statistics['months']),
            datasets: [{
                label: 'Numero di Ordini',
                data: @json($statistics['ordersCount']),
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Grafico dei guadagni
    const revenueCtx = document.getElementById('revenueChart').getContext('2d');
    const revenueChart = new Chart(revenueCtx, {
        type: 'bar',
        data: {
            labels: @json($statistics['months']),
            datasets: [{
                label: 'Guadagni Mensili',
                data: @json($statistics['revenuePerMonth']),
                backgroundColor: 'rgba(255, 206, 86, 0.2)',
                borderColor: 'rgba(255, 206, 86, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
});

</script>
@endsection