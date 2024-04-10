@extends('layouts.app')

@section('page-title', 'il mio ristorante')

@section('main-content')
<div class="container mt-2">
    <div class="row justify-content-center">
        <div class="col-md-8">

            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <div class="card border-success">
                @foreach ($restaurants as $restaurant)
                    <div class="card-header border-success bg-light text-success text-center">
                        <h1 class="mb-0">{{ $restaurant->activity_name }}</h1>
                    </div>

                    <div class="card-body">
                        <div class="text-center my-1">
                            @if ($restaurant->image)
                                <img src="{{ asset('storage/' . $restaurant->image) }}" class="img-fluid rounded" alt="Immagine di {{ $restaurant->activity_name }}">
                            @else
                                <p class="text-muted">Nessuna immagine disponibile</p>
                            @endif
                        </div>
                        <p><span class="fw-bolder">Proprietario:</span> <span class="fs-4 text-success">{{ $restaurant->user->name }}</span></p>
                        <div class="my-1">
                            <p class="d-inline fw-bolder">Cucina tipica:</p>
                            @forelse ($restaurant->types as $type)
                                <span class="badge rounded-pill bg-secondary">{{ $type->name }}</span>
                            @empty
                                <span class="text-muted">Nessuna tipologia specificata</span>
                            @endforelse
                        </div>
                        <p>{{ $restaurant->description }}</p>
                        <p><span class="fw-bolder">P.IVA:</span> {{ $restaurant->VAT_number }}</p>
                    </div>

                    <div class="card-footer border-success bg-light text-center">
                        {{-- <a href="{{ route('admin.restaurants.show', ['restaurant' => $restaurant->id]) }}" class="btn btn-secondary text-light">Info <i class="fa-solid fa-circle-info"></i></a> --}}
                        <a href="{{ route('admin.plates.index', ['restaurant' => $restaurant->id]) }}" class="btn btn-secondary text-white"><i class="fa-solid fa-book"></i> Menù</a>
                        <a href="{{ route('admin.restaurants.edit', ['restaurant' => $restaurant->id]) }}" class="btn btn-secondary text-white"><i class="fa-solid fa-pencil"></i> Modifica</a>
                        
                        {{-- Modal button --}}
                        <button type="button" class="btn btn-secondary text-white" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <i class="fa-solid fa-trash"></i> Elimina
                        </button>
                        
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header bg-light border-success">
                                        <h1 class="modal-title fs-5 text-success" id="exampleModalLabel">
                                            {{ $restaurant->activity_name }}
                                        </h1>
                                        
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>

                                    <div class="modal-body">
                                        Vuoi davvero eliminare il Ristorante? <br> 
                                        Così perderai anche tutti i tuoi piatti!
                                    </div>

                                    <div class="modal-footer bg-light border-success">
                                        <button type="button" class="btn btn-success text-white" data-bs-dismiss="modal"><i class="fa-solid fa-left-long"></i> Annulla</button>

                                        {{-- Form di eliminazione --}}
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
</div>
@endsection
