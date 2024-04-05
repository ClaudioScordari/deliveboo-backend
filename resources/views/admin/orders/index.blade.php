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
        <div class="table-responsive-md">
            <table class="table table-sm table-hover">
                <thead>
                    <tr>
                        <th class="text-success" scope="col">Nome</th>
                        <th class="text-success" scope="col">Telefono</th>
                        <th class="text-success" scope="col">Indirizzo</th>
                        <th class="text-success" scope="col">Totale</th>
                        <th class="text-success" scope="col">Pagamento</th>
                        <th class="text-success d-none d-lg-block" scope="col">Piatti (Quantità)</th>
                        <th class="text-success" scope="col">Data</th>
                        <th class="text-success" scope="col">Azioni</th>
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
                            <td class="small d-none d-lg-block">
                                @foreach ($order->plates as $plate)
                                    <div>{{ $plate->name }} (x{{ $plate->pivot->quantity }})</div>
                                @endforeach
                            </td>
                            <td class="small">{{ $order->created_at->format('d-m-Y') }}</td>
                            <td><a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-sm btn-secondary text-light">Info <i class="fa-solid fa-circle-info"></i></a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>    
    @endif
</div>
@endsection