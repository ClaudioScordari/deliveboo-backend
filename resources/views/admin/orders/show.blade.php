@extends('layouts.app')

@section('page-title', 'Dettaglio Ordine')

@section('main-content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-success text-center">
                <!-- Header della Card -->
                <div class="card-header border-success bg-light text-success">
                    <h3>Dettagli dell'Ordine #{{ $order->id }}</h3>
                </div>

                <!-- Corpo della Card -->
                <div class="card-body p-4">
                    <p class="card-text"><strong>Nome Cliente:</strong> {{ $order->name }}</p>
                    <p class="card-text"><strong>Telefono:</strong> {{ $order->phone }}</p>
                    <p class="card-text"><strong>Indirizzo:</strong> {{ $order->address }}</p>
                    <p class="card-text"><strong>Data:</strong> {{ $order->created_at->format('d-m-Y') }}</p>
                    <p class="card-text">
                        <strong>Stato Pagamento:</strong> 
                        @if($order->payment_status == 'Completato')
                            <span class="text-info">Completato <i class="fa fa-check"></i></span>
                        @else
                            {{ ucfirst($order->payment_status) }}
                        @endif
                    </p>
                    <h6 class="card-subtitle fw-bolder">Piatti Ordinati:</h6>
                    <ul class="list-group list-group-flush w-50 m-auto">
                        @foreach ($order->plates as $plate)
                            <li class="list-group-item">{{ $plate->name }} - Quantità: {{ $plate->pivot->quantity }}x</li>
                        @endforeach
                    </ul>
                    <p class="card-text"><strong>Prezzo Totale:</strong> {{ $order->total_price }} €</p>
                    <p class="card-text"><strong>Note:</strong>
                        @if ($order->notes != null)
                        {{ $order->notes }}
                        @else
                            -
                        @endif
                    </p>
                </div>

                <!-- Footer della Card -->
                <div class="card-footer border-success bg-light text-muted text-center">
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary text-white"><i class="fa-solid fa-left-long"></i> Torna agli ordini</a>
                    <a href="{{ route('admin.orders.edit', $order->id) }}" class="btn btn-secondary text-white"><i class="fa-solid fa-pencil"></i> Modifica Stato</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection