@extends('layouts.app')

@section('page-title', 'I miei Ordini')

@section('main-content')
<div class="container mt-4">
    <h1 class="text-center text-success mb-3">Ordini</h1>

    @if($orders->isEmpty())
        <div class="d-flex justify-content-center">
            <div class="alert alert-secondary w-50 text-center" role="alert">
                Nessun Ordine Presente.
            </div>
        </div>
    @else
        <table class="table table-sm table-hover">
            <thead>
                <tr>
                    <th class="text-success" scope="col" style="width: 13%;">Nome</th>
                    <th class="text-success" scope="col" style="width: 10%;">Telefono</th>
                    <th class="text-success" scope="col" style="width: 20%;">Indirizzo</th>
                    <th class="text-success" scope="col" style="width: 5%;">Totale</th>
                    <th class="text-success" scope="col" style="width: 10%;">Pagamento</th>
                    <th class="text-success" scope="col" style="width: 20%;">Piatti (Quantità)</th>
                    <th class="text-success" scope="col" style="width: 15%;">Note</th>
                    <th class="text-success" scope="col" style="width: 22%;">Azioni</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                @foreach ($orders as $order)
                    <tr>
                        <td class="small">{{ $order->name }}</td>
                        <td class="small">{{ $order->phone }}</td>
                        <td class="small">{{ $order->address }}</td>
                        <td class="small">{{ $order->total_price }}€</td>
                        <td class="small">{{ $order->payment_status }}</td>
                        <td class="small">
                            @foreach ($order->plates as $plate)
                                <div>{{ $plate->name }} (x{{ $plate->pivot->quantity }})</div>
                            @endforeach
                        </td>
                        <td class="small">{{ $order->notes }}</td>
                        <td><a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-sm btn-secondary text-light">Info <i class="fa-solid fa-circle-info"></i></a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection