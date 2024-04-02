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

                    {{-- Modal button --}}
                    <button type="button" class="btn btn-secondary text-light" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Elimina
                        <i class="fa-solid fa-trash"></i>
                    </button>
                    
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">
                                        {{ $plate->name }}
                                    </h1>
                                    
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>

                                <div class="modal-body">
                                    Sicuro che vuoi eliminare il piatto?
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary text-light" data-bs-dismiss="modal"><i class="fa-solid fa-left-long"></i> Annulla</button>

                                    {{-- Form di eliminazione --}}
                                    <form action="{{ route('admin.plates.destroy', ['plate' => $plate->id]) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger text-light">Si, sono sicuro <i class="fa-solid fa-trash"></i></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
