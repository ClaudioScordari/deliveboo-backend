@extends('layouts.app')

@section('page-title', 'Tutti i miei piatti')

@section('main-content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <ul>
                        <li class="mb-5">
                            <h2>Nome piatto: {{ $plate->name }}</h2>
                            <p>Descrizione: {{ $plate->description ?? 'Nessuna descrizione disponibile' }}</p>
                            <p>Prezzo: €{{ number_format($plate->price, 2) }}</p>
                            <p>Disponibile: {{ $plate->visible ? 'Sì' : 'No' }}</p>

                            {{-- Immagine associata --}}
                            <div class="my-3">
                                <h2>
                                    Immagine:
                                </h2>

                                @if ($plate->image != null)
                                    <div>
                                        <img src="/storage/{{ $plate->image }}" alt="{{ $plate->name }}">
                                    </div>
                                @else
                                    -
                                @endif
                            </div>
                        </li>
                    </ul>

                    <hr>

                    {{-- Piatti --}}
                    <div>
                        <a class="btn btn-primary" 
                            href="{{ route('admin.plates.index') }}"
                            >
                            Torna ai piatti
                        </a>
                    </div>

                    <br>

                    La dashboard è una pagina privata (protetta dal middleware)
                </div>
            </div>
        </div>
    </div>
@endsection