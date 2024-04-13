@extends('layouts.app')

@section('page-title', auth()->user()->restaurant->activity_name)

@section('main-content')
<div class="container mt-2">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-success text-center">
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
                    <p>di: <span class="fs-4 text-success">{{ $restaurant->user->name }}</span></p>
                    <div class="my-1">
                        <p class="d-inline fw-bolder">Cucina tipica:</p>
                        @forelse ($restaurant->types as $type)
                            <span class="badge rounded-pill bg-secondary">{{ $type->name }}</span>
                        @empty
                            <span class="text-muted">Nessuna tipologia specificata</span>
                        @endforelse
                    </div>
                    <p>{{ $restaurant->description }}</p>
                    <p class="card-text"><span class="fw-bolder"> Indirizzo: </span>{{ $restaurant->address }}</p>
                    <p><span class="fw-bolder">P.IVA:</span> {{ $restaurant->VAT_number }}</p>
                </div>
                <div class="card-footer text-center">
                    <a class="btn btn-secondary text-light" href="{{ route('admin.restaurants.index') }}">
                        <i class="fa-solid fa-left-long"></i> Ristoranti
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection