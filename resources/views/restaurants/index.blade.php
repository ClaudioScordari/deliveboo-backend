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
                        Sono la parte pubblica!!!
                    </h2>

                    <br>

                    <ul>
                        @foreach ($restaurants as $restaurant)
                            <li class="mb-5">
                                <h2>
                                    Nome ristorante: {{ $restaurant['activity_name'] }}
                                </h2>

                                {{-- Show --}}
                                <div class="pb-2 border-bottom border-3 border-dark d-inline-block">
                                    <a class="btn btn-primary" 
                                        {{-- href="{{ route('restaurants.show', ['restaurant' => $restaurant->id]) }}" --}}
                                        >
                                        Vedi il ristorante
                                    </a> 
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