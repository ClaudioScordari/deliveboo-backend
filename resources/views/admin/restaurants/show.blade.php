@extends('layouts.app')

@section('page-title', /* $restaurant->activity_name */)

@section('main-content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h1 class="my-2">
                        {{ $restaurant->activity_name }}
                    </h1>

                    {{-- Proprietario --}}
                    <h2>
                        Ecco il ristorante di {{ $restaurant->user->name }}
                    </h2>

                    <h3>
                        Sono la parte privata!!!
                    </h3>

                    {{-- Tipi --}}
                    <div class="my-3">
                        <h2>
                            Tipi:
                        </h2>

                        <ul>
                            @forelse ( $restaurant->types as $type )
                                <li>
                                    {{ $type->name }}
                                </li>
                            @empty
                                -
                            @endforelse
                        </ul>
                    </div>

                    {{-- Immagine associata --}}
                    <div class="my-3">
                        <h2>
                            Immagine:
                        </h2>

                        @if ($restaurant->image != null)
                            <div>
                                <img src="/storage/{{ $restaurant->image }}" alt="image1">
                            </div>
                        @else
                            -
                        @endif
                    </div>

                    <p>
                        {{ $restaurant->description }}
                    </p>

                    {{-- Ristoranti --}}
                    <div>
                        <a class="btn btn-primary" 
                            href="{{ route('admin.restaurants.index') }}"
                            >
                            Torna ai Ristoranti
                        </a>
                    </div>

                    <br>

                    La dashboard è una pagina privata (protetta dal middleware)
                </div>
            </div>
        </div>
    </div>
@endsection