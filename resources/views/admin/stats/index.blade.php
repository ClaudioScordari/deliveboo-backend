@extends('layouts.app')

@section('page-title', 'Statistiche')

@section('main-content')
    
    <div class="container mt-4">
        <h1 class="text-center text-success mb-4">Statistiche</h1>
        
        <div class="row g-4">
            <div class="col-lg-6">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title text-success">Totale Ordini <span class="card-text text-secondary"><strong>{{ $totalOrders }}</strong></span></h5>
                        <canvas id="ordersChart"></canvas>
                    </div>
                </div>
            </div>
    
            <div class="col-lg-6">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title text-success">Ordini Ultimi 30 Giorni <span class="card-text text-secondary"><strong>{{ $totalOrdersLast30Days }}</strong></span></h5>
                        <canvas id="dailyOrdersChart"></canvas>
                    </div>
                </div>
            </div>
    
            <div class="col-lg-6">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title text-success">Totale Entrare <span class="card-text text-secondary"><strong>{{ number_format($totalRevenue, 2) }}€</strong></span></h5>
                        <canvas id="dailyRevenueChart"></canvas>
                    </div>
                </div>
            </div>
    
            <div class="col-lg-6">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title text-success">Entrate Ultimi 30 Giorni <span class="card-text text-secondary"><strong>{{ number_format($totalRevenueLast30Days, 2) }}€</strong></span></h5>
                        <canvas id="revenueChart"></canvas>
                    </div>
                </div>
            </div>
    
            <div class="col-lg-6">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title text-success">Piatto Più Ordinato</h5>
                        <p class="card-text text-success">{{ $mostOrderedPlateOverall->name }} - x<span class="text-secondary fw-bold">{{ $mostOrderedPlateOverall->orders_count }}</span></p>
                        <canvas id="mostOrderedPlatesChart"></canvas>
                    </div>
                </div>
            </div>
    
            <div class="col-lg-6">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title text-success">Piatto Più Ordinato Ultimi 30 Giorni</h5>
                        <p class="card-text text-success">{{ $mostOrderedPlateThisMonth->name }} - x <span class="text-secondary fw-bold">{{ $mostOrderedPlateThisMonth->orders_count }}</span></p>
                        <canvas id="mostOrderedPlatesLast30DaysChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Grafico degli ordini
    
    const ordersCtx = document.getElementById('ordersChart').getContext('2d');
    const ordersChart = new Chart(ordersCtx, {
        type: 'bar',
        data: {
            labels: @json($statistics['months']),
            datasets: [{
                label: 'Ordini',
                data: @json($statistics['ordersCount']),
                backgroundColor: 'rgba(255, 135, 50, 0.8)',
                borderColor: 'rgba(255, 135, 50, 1)',
                borderWidth: 3
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
                label: 'Ordini',
                data: @json($ordersCountPerDay),
                backgroundColor: 'rgba(255, 135, 50, 0.8)',
                borderColor: 'rgba(255, 135, 50, 1)',
                borderWidth: 3,
                fill: true
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
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
                label: 'Entrate',
                data: @json($statistics['revenuePerMonth']),
                backgroundColor: 'rgba(255, 135, 50, 0.8)',
                borderColor: 'rgba(255, 135, 50, 1)',
                borderWidth: 3
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
                label: 'Entrate',
                data: @json($revenuePerDay),
                backgroundColor: 'rgba(255, 135, 50, 0.8)',
                borderColor: 'rgba(255, 135, 50, 1)',
                borderWidth: 3,
                fill: true
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
        type: 'doughnut',
        data: {
            labels: @json($plateNames),
            datasets: [{
                data: @json($plateQuantities),
                backgroundColor: [
                    'rgba(255, 135, 50, 0.8)',
                    'rgba(80, 35, 20, 0.8)',
                    'rgba(210, 188, 157, 0.8)',
                    'rgba(170, 85, 35, 0.8)',
                    'rgba(229, 161, 101, 0.8)',
                ],
                borderColor: [
                    'rgba(255, 135, 50, 1)',
                    'rgba (80, 35, 20, 1)',
                    'rgba(210, 188, 157, 1)',
                    'rgba(170, 85, 35, 1)',
                    'rgba(229, 161, 101, 1)',
                ],
                borderWidth: 3
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

    // Piatti più ordinati ultimo mese
    var platesMonthCtx = document.getElementById('mostOrderedPlatesLast30DaysChart').getContext('2d');
    var mostOrderedPlatesLast30DaysChart = new Chart(platesMonthCtx, {
        type: 'doughnut',
        data: {
            labels: @json($mostOrderedPlatesLast30Days->pluck('name')),
            datasets: [{
                data: @json($mostOrderedPlatesLast30Days->pluck('total_ordered')),
                backgroundColor: [
                    // Colori per ogni segmento del grafico
                    'rgba(255, 135, 50, 0.8)',
                    'rgba(80, 35, 20, 0.8)',
                    'rgba(210, 188, 157, 0.8)',
                    'rgba(170, 85, 35, 0.8)',
                    'rgba(229, 161, 101, 0.8)',
                ],
                borderColor: [
                    // Colori del bordo per ogni segmento
                    'rgba(255, 135, 50, 1)',
                    'rgba(80, 35, 20, 1)',
                    'rgba(210, 188, 157, 1)',
                    'rgba(170, 85, 35, 1)',
                    'rgba(229, 161, 101, 1)',
                ],
                borderWidth: 3
            }]
        },
        options: {
            responsive: true,
            legend: {
                position: 'top',
            },
            title: {
                display: true,
                text: 'Piatti più ordinati negli ultimi 30 giorni'
            }
        }
    });
});

</script>
@endsection