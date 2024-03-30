@extends('layouts.app')

@section('page-title', auth()->user()->restaurant->activity_name)

@section('main-content')
    <section class="rounded-4 p-4 container-form-section">
        @foreach ($restaurants as $restaurant)
            <h1 class="text-center tex-dark mb-4">{{ $restaurant->activity_name }}</h1>

            <div class="mb-3 d-flex">
                <div class="container-img" style="width: 500px; height: 500px;">
                    <img class="w-100" src="{{ asset('storage/' . $restaurant->image) }}" alt="immagine ristorante">
                </div>

                <div class="info-restaurants p-2 w-50 ms-auto">
                    <div class="container-info">
                        <ul>
                            <li>
                                <h3>Descrizione</h3>

                                <p>{{ $restaurant->description }}</p>
                            </li>
                            <li>
                                <h3>Indirizzo</h3>

                                <p>{{ $restaurant->address }}</p>
                            </li>
                            <li>
                                <h3>Partita IVA</h3>

                                <p>{{ $restaurant->VAT_number }}</p>
                            </li>
                        </ul>

                        {{-- Buttons --}}
                        <div class="d-flex flex-column px-3">
                            {{-- Piatti --}}
                            <div class="d-inline-block">
                                <a class="text-decoration-none fw-bold text-success py-3 d-inline-block fs-5 text-center"
                                    href="{{ route('admin.plates.index', ['restaurant' => $restaurant->id]) }}">
                                    Vedi il Menù del ristorante
                                </a>
                            </div>

                            {{-- Edit --}}
                            <div class="d-inline-block">
                                <a class="text-decoration-none fw-bold text-secondary py-3 d-inline-block border-top border-bottom border-1 border-dark fs-5 text-center"
                                    href="{{ route('admin.restaurants.edit', ['restaurant' => $restaurant->id]) }}">
                                    Modifica il ristorante
                                </a>
                            </div>

                            {{-- Delete --}}
                            <div class="d-inline-block">
                                <form onsubmit="return confirm('Sicuro che vuoi eliminare il ristorante?')"
                                    action="{{ route('admin.restaurants.destroy', ['restaurant' => $restaurant->id]) }}"
                                    method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" style="background-color: #D1E7DD"
                                        class="px-0 border-0 text-decoration-none fw-bold text-danger py-3 d-inline-block fs-5 text-center">
                                        Elimina il ristorante
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Show --}}
            {{-- 
                <div class="d-inline-block">
                    <a class="btn btn-primary" href="{{ route('admin.restaurants.show', ['restaurant' => $restaurant->id]) }}">
                        Vedi il ristorante
                    </a>
                </div>
            --}}
        @endforeach
    </section>
@endsection
