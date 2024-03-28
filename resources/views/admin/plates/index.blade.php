@extends('layouts.app')

@section('page-title', 'Tutti i miei piatti')

@section('main-content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h1>
                        I miei piatti
                    </h1>

                    {{-- Aggungi piatto --}}
                    <div class="pb-2 border-bottom border-3 border-dark d-inline-block w-100">
                        <a class="btn btn-success w-100 fw-bold fs-4" 
                            href="{{ route('admin.plates.create') }}"
                            >
                            Aggiungi un piatto al tuo Menù
                        </a> 
                    </div>

                    <ul>
                        @foreach ($plates as $plate)
                            <li class="mb-5">
                                <h2>Nome piatto: {{ $plate->name }}</h2>
                                <img src="{{ asset('storage/' . $plate->image) }}" alt="immagine piatto">
                                <p>Descrizione: {{ $plate->description ?? 'Nessuna descrizione disponibile' }}</p>
                                <p>Prezzo: €{{ number_format($plate->price, 2) }}</p>
                                <p>Disponibile: {{ $plate->visible ? 'Sì' : 'No' }}</p>

                                {{-- Show --}}
                                <div class="pb-2 border-bottom border-3 border-dark d-inline-block">
                                    <a class="btn btn-primary" 
                                        href="{{ route('admin.plates.show', ['plate' => $plate->id]) }}"
                                        >
                                        Vedi il piatto
                                    </a> 
                                </div>

                                {{-- Edit --}}
                                <div class="pb-2 border-bottom border-3 border-dark d-inline-block">
                                    <a 
                                        class="btn btn-warning ms-2" 
                                        href="{{ route('admin.plates.edit', ['plate' => $plate->id]) }}"
                                        >
                                        Modifica questo piatto
                                    </a>
                                </div>

                                {{-- Delete --}}
                                <div class="pb-2 border-bottom border-3 border-dark d-inline-block">
                                    <form 
                                        onsubmit="return confirm('Sicuro che vuoi eliminare il piatto?')" 
                                        action="{{ route('admin.plates.destroy', ['plate' => $plate->id]) }}"
                                        method="POST"
                                        >
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-danger w-100">
                                            Elimina il piatto
                                        </button>
                                    </form>
                                </div>
                            </li>
                        @endforeach
                    </ul>

                    <br>

                    La dashboard è una pagina privata (protetta dal middleware)
                </div>
            </div>
        </div>
    </div>
@endsection