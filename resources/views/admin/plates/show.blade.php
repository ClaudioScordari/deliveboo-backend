@extends('layouts.app')

@section('page-title', $plate->name)

@section('main-content')
    <section class="rounded-4 p-4 container-form-section">
        <h1 class="text-center tex-dark mb-4">{{ $plate->name }}</h1>

        <div class="mb-3 d-flex">
            <div class="container-img" style="width: 500px; height: 500px;">
                <img class="w-100" src="{{ asset('storage/' . $plate->image) }}" alt="immagine ristorante">
            </div>

            <div class="info-plate p-2 w-50 ms-auto">
                <div class="container-info">
                    <ul>
                        <li>
                            <h3>Descrizione</h3>

                            <p>{{ $plate->description }}</p>
                        </li>
                        <li>
                            <h3>Prezzo</h3>

                            <p>€ {{ number_format($plate->price, 2) }}</p>
                        </li>
                        <li>
                            <h3>Ingredienti</h3>

                            <p>{{ $plate->ingredients }}</p>
                        </li>
                        <li>
                            <h3>Disponibilità nel Menù</h3>

                            <p>{{ $plate->visible ? 'Sì' : 'No' }}</p>
                        </li>
                    </ul>

                    {{-- Buttons --}}
                    <div class="d-flex flex-column px-3">
                        {{-- Ristorante --}}
                        <div class="d-inline-block">
                            <a class="text-decoration-none fw-bold text-success py-3 d-inline-block fs-5 text-center"
                                href="{{ route('admin.restaurants.index') }}">
                                Torna al ristorante
                            </a>
                        </div>

                        {{-- Piatti --}}
                        <div class="d-inline-block">
                            <a class="border-1 border-top border-dark text-decoration-none fw-bold text-primary py-3 d-inline-block fs-5 text-center"
                                href="{{ route('admin.plates.index') }}">
                                Torna ai piatti
                            </a>
                        </div>

                        {{-- Edit --}}
                        <div class="d-inline-block">
                            <a class="text-decoration-none fw-bold text-secondary py-3 d-inline-block border-top border-bottom border-1 border-dark fs-5 text-center"
                                href="{{ route('admin.plates.edit', ['plate' => $plate->id]) }}">
                                Modifica il piatto
                            </a>
                        </div>

                        {{-- Delete --}}
                        <div class="d-inline-block">
                            <form onsubmit="return confirm('Sicuro che vuoi eliminare il piatto?')"
                                action="{{ route('admin.plates.destroy', ['plate' => $plate->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')

                                <button type="submit" style="background-color: #D1E7DD"
                                    class="px-0 border-0 text-decoration-none fw-bold text-danger py-3 d-inline-block fs-5 text-center">
                                    Elimina il piatto
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        La dashboard è una pagina privata (protetta dal middleware)
    </section>
@endsection
