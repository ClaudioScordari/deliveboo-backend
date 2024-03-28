@extends('layouts.app')

@section('page-title', 'Tutti gli ordini')

@section('main-content')

    <div class="container mt-4">
        <div class="row">
            <div class="col-12">
                <h2 class="text-primary py-3">Ordini</h2> 
    
                <table class="table table-bordered table-striped table-primary table-hover">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>name</th>
                            <th>phone</th>
                            <th>address</th>
                            <th>price</th>
                            <th>status</th>
                            <th>plates (quantity)</th>
                            <th>note</th>
                            <th>info</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{ $order -> id }}</td>
                                <td>{{ $order -> name }}</td>
                                <td>{{ $order -> phone }}</td>
                                <td>{{ $order -> address }}</td>
                                <td>{{ $order -> total_price }}€</td>
                                <td>{{ $order -> payment_status }}</td>
                                <td>
                                    @foreach ($order->plates as $plate)
                                        <div>{{ $plate->name }} (x{{ $plate->pivot->quantity }})</div>
                                    @endforeach
                                </td>
                                <td>{{ $order -> notes }}</td>
                                <td><a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-sm btn-primary me-2">Info <i class="fa-solid fa-circle-info"></i></a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection