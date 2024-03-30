@extends('layouts.app')

@section('page-title', 'Tutti i miei piatti')

@section('main-content')
<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <h1 class="text-center mb-3 text-success">Menù</h1>
            <div class="row">
                @foreach ($plates as $plate)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        @if($plate->image)
                        <img src="{{ asset('storage/' . $plate->image) }}" class="card-img-top" alt="{{ $plate->name }}">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title text-success">{{ $plate->name }}</h5>
                            <p>Prezzo: <span class="fw-bold">{{ number_format($plate->price, 2) }}€</span></p>
                            @if($plate->visible)
                                <span class="text-success">Disponibile <i class="fa-solid fa-check"></i></span>
                            @else
                                <span class="text-danger"><del>Non Disponibile</del></span>
                            @endif
                        </div>
                        <div class="card-footer text-center">
                            <a href="{{ route('guest.restaurants.plates.show', ['plate' => $plate->id]) }}" class="btn text-light btn-secondary btn-sm">Ingredienti <i class="fa-solid fa-utensils"></i></a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <a class="btn text-light btn-secondary mb-3" href="{{ route('guest.restaurants.index') }}">
                <i class="fa-solid fa-left-long"></i> Ristoranti
            </a>
        </div>
    </div>
</div>
@endsection