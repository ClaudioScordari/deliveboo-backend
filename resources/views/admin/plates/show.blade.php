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

                <!-- Footer della Card con azioni amministrative -->
                <div class="card-footer text-center">
                    <a href="{{ route('admin.plates.index') }}" class="btn btn-secondary text-light"><i class="fa-solid fa-left-long"></i> Menù</a>
                    <a href="{{ route('admin.plates.edit', ['plate' => $plate->id]) }}" class="btn btn-secondary text-light">Modifica <i class="fa-solid fa-pencil"></i></a>
                    <form class="d-inline" action="{{ route('admin.plates.destroy', ['plate' => $plate->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-secondary text-light" onclick="return confirm('Sicuro di voler eliminare questo piatto?')">Elimina <i class="fa-solid fa-trash"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
