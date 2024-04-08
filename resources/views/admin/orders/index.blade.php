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
        <div class="table-responsive">
            <table class="table table-sm table-light table-striped-columns table-hover table-bordered border-success">
                <thead>
                    <tr>
                        <th class="text-success text-center align-middle" scope="col">Nome</th>
                        <th class="text-success text-center align-middle d-none d-md-table-cell" scope="col">Telefono</th>
                        <th class="text-success text-center align-middle" scope="col">Indirizzo</th>
                        <th class="text-success text-center align-middle" scope="col">Totale</th>
                        <th class="text-success text-center align-middle d-none d-sm-table-cell" scope="col">Pagamento</th>
                        <th class="text-success text-center align-middle d-none d-lg-table-cell" scope="col">Piatti (Quantità)</th>
                        <th class="text-success text-center align-middle" scope="col">Data</th>
                        <th class="text-success text-center align-middle" scope="col">Azioni</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    @foreach ($orders as $order)
                        <tr>
                            <td class="small text-center align-middle">{{ $order->name }}</td>
                            <td class="small text-center align-middle d-none d-md-table-cell">{{ $order->phone }}</td>
                            <td class="small text-center align-middle">{{ $order->address }}</td>
                            <td class="small text-center align-middle">{{ $order->total_price }}€</td>
                            <td class="small text-center align-middle d-none d-sm-table-cell">{{ $order->payment_status }}</td>
                            <td class="small text-center align-middle d-none d-lg-table-cell">
                                @foreach ($order->plates as $plate)
                                    <div>{{ $plate->name }} (x{{ $plate->pivot->quantity }})</div>
                                @endforeach
                            </td>
                            <td class="small text-center align-middle">{{ $order->created_at->format('d-m-Y') }}</td>
                            <td class="small text-center align-middle"><a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-sm btn-secondary text-white">Info <i class="fa-solid fa-circle-info"></i></a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>    
    @endif
</div>
@endsection