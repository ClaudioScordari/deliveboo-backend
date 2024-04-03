@extends('layouts.app')

@section('page-title', 'Statistiche')

@section('main-content')

    <div class="container mt-5">
        <h1>Statistiche Ordini Mensili</h1>
        <p>Numero totale di ordini: {{ $totalOrdersCount }}</p>
        <canvas id="ordersChart"></canvas>
    </div>
        
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const months = @json($statistics['months']);
            const ordersCount = @json($statistics['ordersCount']).map(Number); // Assicura che i dati siano numeri
        
            const ctx = document.getElementById('ordersChart').getContext('2d');
            
            const ordersChart = new Chart(ctx, {
                type: 'line', // o 'bar' se preferisci un grafico a colonne
                data: {
                    labels: months,
                    datasets: [{
                        label: 'Numero di Ordini',
                        data: ordersCount,
                        fill: true,
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 5
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1
                            }
                        }
                    },
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        title: {
                            display: true,
                            text: 'Statistiche Ordini Mensili'
                        }
                    }
                }
            });
        });
    </script>
@endsection