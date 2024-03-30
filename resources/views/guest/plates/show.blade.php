@extends('layouts.app')

@section('page-title', $plate->name)

@section('main-content')
<div class="container mt-2">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <!-- Header della Card con il nome del piatto -->
                <div class="card-header text-success text-center">
                    <h2 class="mb-0">{{ $plate->name }}</h2>
                </div>
                
                <!-- Corpo della Card -->
                <div class="card-body">
                    <!-- Sezione Immagine -->
                    <div class="text-center my-1">
                        @if ($plate->image)
                            <img src="{{ asset('storage/' . $plate->image) }}" class="img-fluid rounded" alt="Immagine di {{ $plate->name }}">
                        @else
                            <p class="text-muted">Nessuna immagine disponibile</p>
                        @endif
                    </div>
                    
                    <!-- Dettagli del piatto -->
                    <p>Prezzo: <strong>€{{ number_format($plate->price, 2) }}</strong></p>
                    <p>Disponibilità: 
                        @if($plate->visible)
                            <span class="text-success">Disponibile <i class="fa-solid fa-check"></i></span>
                        @else
                            <span class="text-danger"><del>Non Disponibile</del></span>
                        @endif
                    </p>
                    <p>Ingredienti: {{ $plate->ingredients }}</p>
                    <p>Descrizione: {{ $plate->description ?? 'Nessuna descrizione disponibile' }}</p>
                </div>

                <!-- Footer della Card -->
                <div class="card-footer text-center">
                    <a class="btn btn-secondary" href="{{ route('guest.restaurants.plates.index', ['restaurantId' => $restaurant->id]) }}">
                        <i class="fa-solid fa-left-long"></i> Menù
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection