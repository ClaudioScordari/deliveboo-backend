@extends('layouts.app')

@section('page-title', 'Statistiche')

@section('main-content')

    <div class="container mt-5">
        <h1>Statistiche Ordini</h1>
        <p>Totale Ordini: <strong>{{ $totalOrders }}</strong></p>
        <canvas id="ordersChart"></canvas>

        <p>Ordini ultimi 30 giorni: <strong>{{ $orderCount }}</strong></p>
        <canvas id="dailyOrdersChart"></canvas>

        <p>Totale Soldi Guadagnati: <strong>{{ number_format($totalRevenue, 2) }}€</strong></p>
        <canvas id="revenueChart"></canvas>

        <canvas id="dailyRevenueChart"></canvas>

        <canvas id="mostOrderedPlatesChart"></canvas>

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

    // Grafico per ordini ultimo mese
    const ctx = document.getElementById('dailyOrdersChart').getContext('2d');
    const dailyOrdersChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: @json($labels),
            datasets: [{
                label: 'Numero di Ordini',
                data: @json($ordersCountPerDay),
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1,
                fill: false
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }],
                xAxes: [{
                    display: true,
                    scaleLabel: {
                        display: true,
                        labelString: 'Giorno'
                    }
                }]
            },
            legend: {
                display: true,
                position: 'top',
                labels: {
                    fontColor: '#333',
                    usePointStyle: true
                }
            },
            responsive: true,
            maintainAspectRatio: true,
        }
    });

    // Grafico dei guadagni nell'ultimo mese
    const dailyRevenueCtx = document.getElementById('dailyRevenueChart').getContext('2d');
    const dailyRevenueChart = new Chart(dailyRevenueCtx, {
        type: 'bar',
        data: {
            labels: @json($statistics['months']),
            datasets: [{
                label: 'Guadagni Mensili',
                data: @json($statistics['revenuePerMonth']),
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
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
        type: 'line',
        data: {
            labels: @json($labels),
            datasets: [{
                label: 'Guadagni giornalieri',
                data: @json($revenuePerDay),
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1,
                fill: false
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            maintainAspectRatio: true,
        }
    });

    // piatti più ordinati
    const platesCtx = document.getElementById('mostOrderedPlatesChart').getContext('2d');
    const mostOrderedPlatesChart = new Chart(platesCtx, {
        type: 'pie',
        data: {
            labels: @json($plateNames),
            datasets: [{
                data: @json($plateQuantities),
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    // Altri colori per i piatti
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    // Altri bordi per i piatti
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            legend: {
                position: 'top',
            },
            title: {
                display: true,
                text: 'Piatti più ordinati nell\'ultimo anno'
            }
        }
    });
});

</script>
@endsection