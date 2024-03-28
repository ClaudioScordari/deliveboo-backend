@extends('layouts.app')

@section('page-title', 'Tutti i ristoranti')

@section('main-content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h1>
                        Ristoranti
                    </h1>

                    <h2>
                        Sono la parte privata!!!
                    </h2>

                    <br>

                    <ul>
                        @foreach ($restaurants as $restaurant)
                            <li class="mb-5">
                                <h2>
                                    Nome ristorante: {{ $restaurant->activity_name }}
                                </h2>

                                {{-- Show --}}
                                <div class="pb-2 border-bottom border-3 border-dark d-inline-block">
                                    <a class="btn btn-primary" 
                                        href="{{ route('admin.restaurants.index', ['restaurant' => $restaurant->id]) }}"
                                        >
                                        Vedi il ristorante
                                    </a> 
                                </div>

                                {{-- Piatti --}}
                                <div class="pb-2 border-bottom border-3 border-dark d-inline-block">
                                    <a class="btn btn-info" 
                                        href="{{ route('admin.plates.index', ['restaurant' => $restaurant->id]) }}"
                                        >
                                        Vedi il Menù
                                    </a> 
                                </div>

                                {{-- Edit --}}
                                <div class="pb-2 border-bottom border-3 border-dark d-inline-block">
                                    <a 
                                        class="btn btn-warning ms-2" 
                                        href="{{ route('admin.restaurants.edit', ['restaurant' => $restaurant->id]) }}"
                                        >
                                        Modifica questo ristorante
                                    </a>
                                </div>

                                {{-- Delete --}}
                                <div class="pb-2 border-bottom border-3 border-dark d-inline-block">
                                    <form 
                                        onsubmit="return confirm('Sicuro che vuoi eliminare il ristorante?')" 
                                        action="{{ route('admin.restaurants.destroy', ['restaurant' => $restaurant->id]) }}"
                                        method="POST"
                                        >
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-danger w-100">
                                            Elimina il ristorante
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