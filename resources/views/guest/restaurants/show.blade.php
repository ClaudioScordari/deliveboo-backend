@extends('layouts.app')

@section('page-title', $restaurant->activity_name)

@section('main-content')
    <div class="row">
        <div class="col-6 m-auto">
            <div class="card">
                <div class="card-body py-3 px-5">
                    <h1 class="my-2 text-center">
                        {{ $restaurant->activity_name }}
                    </h1>

                    <span>di:</span>
                    <span class="fs-4">{{ $restaurant->user->name }}</span>

                    {{-- Immagine associata --}}
                    <div class="my-3 text-center">
                        @if ($restaurant->image != null)
                            <div class="bg-success p-3 rounded-3">
                                <img src="/storage/{{ $restaurant->image }}" alt="image1">
                            </div>
                        @else
                            -
                        @endif
                    </div>

                    {{-- Tipi --}}
                    <div class="my-3">
                        <span class="fs-3 fw-bold">
                            Cucina
                        </span>

                        <span>
                            @forelse ( $restaurant->types as $type )
                                <span class="badge rounded-pill text-bg-success">
                                    {{ $type->name }}
                                </span>
                            @empty
                                -
                            @endforelse
                        </span>
                    </div>

                    <p>
                        {{ $restaurant->description }}
                    </p>

                    <p>
                        P.IVA: {{ $restaurant ->VAT_number }}
                    </p>

                    {{-- Ristoranti --}}
                    <div>
                        <a class="btn btn-primary" 
                            href="{{ route('guest.restaurants.index') }}"
                            >
                            <i class="fa-solid fa-left-long"></i> ai Ristoranti
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection