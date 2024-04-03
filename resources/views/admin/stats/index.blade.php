@extends('layouts.app')

@section('main-content')

    <div class="container mt-5">
        <h1>Statistiche Ordini</h1>
        <div class="mt-4">
            <h2>Numero di ordini: {{ $ordersCount }}</h2>
            <h2>Totale piatti ordinati: {{ $totalPlates }}</h2>
            <h2>Totale soldi guadagnati: €{{ number_format($totalRevenue, 2) }}</h2>
            <canvas id="ordersChart"></canvas>
            <canvas id="platesChart"></canvas>
            <canvas id="revenueChart"></canvas>
            <canvas id="monthlyStatsChart"></canvas>
            <canvas id="popularPlatesChart"></canvas>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Il tuo codice JavaScript per generare i grafici va qui
            const ordersCount = @json($ordersCount);
            const totalPlates = @json($totalPlates);
            const totalRevenue = @json($totalRevenue);
            const labels = @json($labels);
            const data = @json($data);
            
        // Grafico per il numero di ordini
        const ctxOrders = document.getElementById('ordersChart').getContext('2d');
        const ordersChart = new Chart(ctxOrders, {
            type: 'bar',
            data: {
                labels: ['Ordini'],
                datasets: [{
                    label: 'Numero di Ordini',
                    data: [ordersCount],
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
        
        // Grafico per il totale piatti ordinati
        const ctxPlates = document.getElementById('platesChart').getContext('2d');
        const platesChart = new Chart(ctxPlates, {
            type: 'bar',
            data: {
                labels: ['Piatti'],
                datasets: [{
                    label: 'Totale Piatti Ordinati',
                    data: [totalPlates],
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
        
        // Grafico per il totale soldi guadagnati
        const ctxRevenue = document.getElementById('revenueChart').getContext('2d');
        const revenueChart = new Chart(ctxRevenue, {
            type: 'bar',
            data: {
                labels: ['Soldi'],
                datasets: [{
                    label: 'Totale Soldi Guadagnati',
                    data: [totalRevenue],
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

        // Grafico per i piatti più ordinati
        const ctx = document.getElementById('popularPlatesChart').getContext('2d');
                const popularPlatesChart = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Piatti più ordinati',
                            data: data,
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)',
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(39, 174, 96, 0.2)',
                                'rgba(41, 128, 185, 0.2)',
                                'rgba(142, 68, 173, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255,99,132,1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)',
                                'rgba(255,99,132,1)',
                                'rgba(39, 174, 96, 1)',
                                'rgba(41, 128, 185, 1)',
                                'rgba(142, 68, 173, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'right',
                            },
                            title: {
                                display: true,
                                text: 'Piatti più ordinati'
                            }
                        },
                        animation: {
                            animateScale: true,
                            animateRotate: true
                        }
                    }
                });
    });
    </script>
@endsection