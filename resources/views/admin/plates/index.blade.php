@extends('layouts.app')

@section('page-title', 'Tutti i miei piatti')

@section('main-content')
<div class="container mt-4">
    <div class="row">
        <div class="col-12">
            <h1 class="text-center mb-3 text-success">I miei Piatti</h1>
            <div class="d-flex justify-content-end mb-4">
                <a href="{{ route('admin.plates.create') }}" class="btn btn-success">Nuovo piatto <i class="fa-solid fa-plus"></i><i class="fa-solid fa-bowl-food"></i></a>
            </div>
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
                            <p class="card-text mt-3">{{ $plate->description ?? 'Nessuna descrizione disponibile' }}</p>
                        </div>
                        
                        <div class="card-footer text-center">
                            <a href="{{ route('admin.plates.show', ['plate' => $plate->id]) }}" class="btn btn-secondary text-light btn-sm">Info <i class="fa-solid fa-circle-info"></i></a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection