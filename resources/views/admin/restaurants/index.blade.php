@extends('layouts.app')

@section('page-title', 'Il mio ristorante')

@section('main-content')
<div class="container-fluid d-flex justify-content-center align-items-center min-vh-100">
    <div class="row justify-content-center w-100">
        <div class="col-md-12">

            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            @foreach ($restaurants as $restaurant)
                <div class="card border-success mb-3 bg-light">
                    <div class="row g-0">
                        <!-- Immagine a sinistra -->
                        <div class="col-md-4">
                            @if ($restaurant->image)
                                <img src="{{ asset('storage/' . $restaurant->image) }}" class="img-fluid rounded-start h-100" alt="Immagine di {{ $restaurant->activity_name }}">
                            @else
                                <img src="{{ Vite::asset('resources/img/not-found.png') }}" alt="not-found" class="img-fluid rounded-start h-100">
                            @endif
                        </div>

                        <!-- Testo a destra -->
                        <div class="col-md-8 d-flex flex-column py-3">
                            <div class="card-body">
                                <h1 class="card-title text-success fw-bold">{{ $restaurant->activity_name }}</h1>
                                <p class="card-text fw-bolder">Proprietario: <span class="text-success">{{ $restaurant->user->name }}</span></p>
                                <p class="card-text">
                                    @if ($restaurant->description)
                                    {{ $restaurant->description }}
                                    @else
                                       <span> - </span>
                                    @endif
                                </p>
                                <div class="mb-2">
                                    <span class="fw-bolder">Cucina tipica:</span>
                                    @forelse ($restaurant->types as $type)
                                        <span class="badge bg-secondary">{{ $type->name }}</span>
                                    @empty
                                        <span class="text-muted">Nessuna tipologia specificata</span>
                                    @endforelse
                                </div>
                                <p class="card-text"><span class="fw-bolder"> Indirizzo: </span>{{ $restaurant->address }}</p>
                                <p class="card-text"><small class="text-muted">P.IVA: {{ $restaurant->VAT_number }}</small></p>
                            </div>
                            <!-- Bottoni in basso -->
                            <div class="mt-auto p-3">
                                <a href="{{ route('admin.plates.index', ['restaurant' => $restaurant->id]) }}" class="btn btn-secondary text-white me-2"><i class="fa-solid fa-book"></i> Menù</a>
                                <a href="{{ route('admin.restaurants.edit', ['restaurant' => $restaurant->id]) }}" class="btn btn-secondary text-white me-2"><i class="fa-solid fa-pencil"></i> Modifica</a>
                                <button type="button" class="btn btn-secondary text-white" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $restaurant->id }}"><i class="fa-solid fa-trash"></i> Elimina</button>
                            </div>
                        </div>
                    </div>

                    <!-- Modal per la conferma di eliminazione -->
                    <div class="modal fade" id="deleteModal{{ $restaurant->id }}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header bg-light">
                                    <h5 class="modal-title text-success" id="deleteModalLabel">Conferma Eliminazione</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Vuoi davvero eliminare il ristorante <strong>{{ $restaurant->activity_name }}</strong>?
                                    <br>
                                    Questo comporterà la perdita di tutti i piatti associati.
                                </div>
                                <div class="modal-footer border-success bg-light">
                                    <button type="button" class="btn btn-success text-white" data-bs-dismiss="modal"><i class="fa-solid fa-left-long"></i> Annulla</button>
                                    <form action="{{ route('admin.restaurants.destroy', ['restaurant' => $restaurant->id]) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-secondary text-white"><i class="fa-solid fa-trash"></i> Sì, sono sicuro</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection