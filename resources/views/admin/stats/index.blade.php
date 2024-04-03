@extends('layouts.app')

@section('main-content')

    <div class="container mt-5">
        <h1>Statistiche Ordini</h1>
        <div class="mt-4">
            <h2>Numero di ordini: {{ $ordersCount }}</h2>
            <h2>Totale piatti ordinati: {{ $totalPlates }}</h2>
            <canvas id="ordersChart"></canvas>
            <canvas id="platesChart"></canvas>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Il tuo codice JavaScript per generare i grafici va qui
            const ordersCount = @json($ordersCount);
            const totalPlates = @json($totalPlates);
            
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

    });
    </script>
@endsection