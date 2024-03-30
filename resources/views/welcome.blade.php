@extends('layouts.guest')

@section('main-content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-center">
                        <h1 class="text-center text-success ps-5">
                            Benvenuto su
                        </h1>
                        <img src="{{ Vite::asset('resources/img/deliveboo.png') }}" alt="Jumbotron" class="h-25">
                    </div>
                    <div>
                        <p class="text-center px-5 pb-1 mx-5">
                            "Semplifica la gestione del tuo business di delivery oggi stesso! Iscriviti a <span class="text-success fw-bolder">Deliveboo</span> e ottieni accesso a strumenti potenti per migliorare l'efficienza, monitorare gli ordini e massimizzare i profitti. Unisciti a centinaia di ristoratori soddisfatti che hanno scelto la comodità e la precisione del nostro servizio. Registrati ora e trasforma la tua attività di delivery!"
                        </p>
                    </div>
                    <div class="text-center mb-3">
                        <a href="{{ route('register') }}" class="btn text-light btn-secondary btn-lg">Unisciti alla Famiglia! <i class="fa-solid fa-user-group"></i></a>
                    </div>
                    <div class="text-center mb-3">
                        <img src="{{ Vite::asset('resources/img/jumbotron.webp') }}" alt="Jumbotron" class="w-50">
                    </div>
                    <div>
                        <p class="text-center px-5 pb-2 mx-5">
                            "Oppure lasciati convinciere dagli altri nostri affezionati clienti!"
                        </p>
                    </div>
                    <div class="text-center">
                        <a href="{{ route('guest.restaurants.index') }}" class="btn text-light btn-secondary btn-lg">Esplora i Ristoranti <i class="fa-solid fa-utensils"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
