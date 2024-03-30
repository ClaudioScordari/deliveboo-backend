@extends('layouts.app')

@section('page-title', 'Dashboard')

@section('main-content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h1 class="text-center text-success mt-3">
                        Benvenuto, {{ Auth::user()->name }}! 
                    </h1>
                    <div>
                        <div class="row py-5">
                            <div class="col-md-6 text-center p-3">
                                <div class="card bg-light p-3">
                                    <p class="fw-bolder fs-3 text-success">
                                        Gestisci il tuo Ristorante
                                    </p>
                                    <a href="{{ route('admin.restaurants.index') }}" class="btn text-light btn-secondary btn-lg w-50 m-auto">Il mio Ristorante <i class="fa-solid fa-utensils"></i></a>
                                </div>
                            </div>
                            <div class="col-md-6 text-center p-3">
                                <div class="card bg-light p-3">
                                    <p class="fw-bolder fs-3 text-success">
                                        Verifica gli Ordini
                                    </p>
                                    <a href="{{ route('admin.orders.index') }}" class="btn text-light btn-secondary btn-lg w-50 m-auto">Ordini <i class="fa-solid fa-receipt"></i></a>
                                </div>
                            </div>
                            <div class="col-md-6 text-center p-3">
                                <div class="card bg-light p-3">
                                <p class="fw-bolder fs-3 text-success">
                                    Controlla i tuoi Piatti
                                </p>
                                <a href="{{ route('admin.plates.index') }}" class="btn text-light btn-secondary btn-lg w-50 m-auto">Piatti <i class="fa-solid fa-bowl-food"></i></a>
                                </div>
                            </div>
                            <div class="col-md-6 text-center p-3">
                                <div class="card bg-light p-3">
                                    <p class="fw-bolder fs-3 text-success">
                                        Aggiungi la tua nuova Pietanza
                                    </p>
                                    <a href="{{ route('admin.plates.create') }}" class="btn text-light btn-secondary btn-lg w-50 m-auto">Nuovo Piatto <i class="fa-solid fa-plus"></i><i class="fa-solid fa-bowl-food"></i></a>
                                </div>
                            </div>
                            <div class="col-12 text-center p-5 mt-5">
                                <p>
                                    Oppure, se è il tuo primo accesso Crea il tuo Nuovo Ristorante!
                                </p>
                                <a href="{{ route('admin.restaurants.create') }}" class="btn text-light btn-secondary">Nuovo Ristorante <i class="fa-solid fa-plus"></i><i class="fa-solid fa-utensils"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
