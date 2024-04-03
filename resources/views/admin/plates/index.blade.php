@extends('layouts.app')

@section('page-title', 'Tutti i miei piatti')

@section('main-content')
<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <h1 class="text-center mb-3 text-success">I miei Piatti</h1>
            <div class="d-flex justify-content-end mb-4">
                <a href="{{ route('admin.plates.create') }}" class="btn btn-secondary text-light">Nuovo piatto <i class="fa-solid fa-plus"></i><i class="fa-solid fa-bowl-food"></i></a>
            </div>
            <div class="row">

                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                @if($plates->isEmpty())
                    <div class="d-flex justify-content-center">
                        <div class="alert alert-secondary w-50 text-center" role="alert">
                            Nessun Piatto Presente.
                        </div>
                    </div>
                @else

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
                            <p>Ingredienti: {{ $plate->ingredients }}</p>
                            <p class="card-text mt-3">{{ $plate->description ?? 'Nessuna descrizione disponibile' }}</p>
                        </div>
                        
                        <div class="card-footer text-center">
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
                                            <h1 class="modal-title fs-5 text-success" id="exampleModalLabel">
                                                {{ $plate->name }}
                                            </h1>
                                            
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>

                                        <div class="modal-body">
                                            Vuoi davvero eliminare il Piatto?
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-success" data-bs-dismiss="modal"><i class="fa-solid fa-left-long"></i> Annulla</button>

                                            {{-- Form di eliminazione --}}
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
                @endforeach
                @endif
            </div>
        </div>
    </div>
</div>
@endsection