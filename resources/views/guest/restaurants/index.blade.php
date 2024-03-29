@extends('layouts.app')

@section('page-title', 'Tutti i ristoranti')

@section('main-content')
<div class="container mt-3">
    <div class="row">
        <div class="col-12">
            <h1 class="text-center text-success mb-4">Ristoranti</h1>
            <div class="row">
                @foreach ($restaurants as $restaurant)
                <div class="col-md-3 mb-4">
                    <div class="card bg-secondary-subtle h-100 border-0">
                        @if($restaurant->image)
                        <img src="{{ asset('storage/' . $restaurant->image) }}" class="card-img-top" alt="{{ $restaurant->activity_name }}">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $restaurant->activity_name }}</h5>
                            <p class="card-text">{{ $restaurant->address }}</p>
                            <div class="mb-3">
                                @forelse ( $restaurant->types as $type )
                                    <span class="badge rounded-pill text-bg-success">
                                        {{ $type->name }}
                                    </span>
                                @empty
                                    -
                                @endforelse
                            </div>
                            <p class="card-text">{{ $restaurant->description }}</p>
                        </div>
                        <div class="card-footer text-center">
                            <a href="{{ route('guest.restaurants.show', ['restaurant' => $restaurant->id]) }}" class="btn btn-secondary btn-sm">Info <i class="fa-solid fa-circle-info"></i></a>
                            <a href="{{ route('guest.restaurants.plates.index', ['restaurantId' => $restaurant->id]) }}" class="btn btn-secondary btn-sm">Menù <i class="fa-solid fa-book"></i></a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection