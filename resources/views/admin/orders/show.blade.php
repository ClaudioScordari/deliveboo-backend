@extends('layouts.app')

@section('page-title', 'Tutti gli ordini')

@section('main-content')

    <div class="container mt-4">
        <div class="row">
            <div class="col-12">
                <h2 class="text-primary py-3">Ordine</h2> 
    
                <div class="container">
                    <h1>Dettagli dell'Ordine #{{ $order->id }}</h1>
                    <p>Nome Cliente: {{ $order->name }}</p>
                    <p>Telefono: {{ $order->phone }}</p>
                    <p>Indirizzo: {{ $order->address }}</p>
                    <p>Stato Pagamento: {{ $order->payment_status }}</p>
                    <p>Note: {{ $order->notes }}</p>
                    
                    <h3>Piatti nell'ordine:</h3>
                    <ul>
                        @foreach ($order->plates as $plate)
                            <li>{{ $plate->name }} - Quantità: {{ $plate->pivot->quantity }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>

@endsection