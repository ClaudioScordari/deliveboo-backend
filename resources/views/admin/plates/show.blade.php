@extends('layouts.app')

@section('page-title', $plate->name)

@section('main-content')
<div class="container-fluid d-flex justify-content-center align-items-center min-vh-100">
    <div class="row justify-content-center w-100">
        <div class="col-md-12">
            <div class="card border-success mb-3">
                <div class="row g-0">
                    <!-- Immagine a sinistra -->
                    <div class="col-md-4">
                        @if ($plate->image)
                            <img src="{{ asset('storage/' . $plate->image) }}" class="img-fluid rounded-start h-100" alt="Immagine di {{ $plate->name }}">
                        @else
                            <img src="{{ Vite::asset('resources/img/not-found.png') }}" alt="not-found" class="img-fluid rounded-start h-100">
                        @endif
                    </div>

                    <!-- Dettagli a destra -->
                    <div class="col-md-8 d-flex flex-column py-3">
                        <div class="card-body">
                            <h1 class="card-title text-success fw-bold">{{ $plate->name }}</h1>
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
                        <!-- Bottoni in basso -->
                        <div class="mt-auto p-3 text-center">
                            <a href="{{ route('admin.plates.index') }}" class="btn btn-secondary text-light me-2"><i class="fa-solid fa-left-long"></i> Menù</a>
                            <a href="{{ route('admin.plates.edit', ['plate' => $plate->id]) }}" class="btn btn-secondary text-light me-2">Modifica <i class="fa-solid fa-pencil"></i></a>
                            <button type="button" class="btn btn-secondary text-light" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                Elimina <i class="fa-solid fa-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title text-success" id="exampleModalLabel">Conferma Eliminazione</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Vuoi davvero eliminare il Piatto?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-success" data-bs-dismiss="modal"><i class="fa-solid fa-left-long"></i> Annulla</button>
                                <form action="{{ route('admin.plates.destroy', ['plate' => $plate->id]) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-secondary text-light">Sì, sono sicuro <i class="fa-solid fa-trash"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection