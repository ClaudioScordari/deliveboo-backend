@extends('layouts.app')

@section('page-title', 'Tutti i ristoranti')

@section('main-content')

    @foreach ($orders as $order)
        <div>{{ $order->id }} - {{ $order->name }}</div>
    @endforeach

@endsection