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

                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    {{-- Fammi vedere le mie info solo se ho un ristorante associato --}}
                    @if (auth()->user()->restaurant?->id)  
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
                                        <a href="{{ route('admin.orders.index', ['sort' => 'desc']) }}" class="btn text-light btn-secondary btn-lg w-50 m-auto">Ordini <i class="fa-solid fa-receipt"></i></a>
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
                                            Guarda le tue Statistiche
                                        </p>
                                        <a href="{{ route('admin.stats.index') }}" class="btn text-light btn-secondary btn-lg w-50 m-auto">Statistiche <i class="fa-solid fa-chart-simple"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="col-12 text-center p-5 mt-5">
                            <p class="fs-3 fw-bold text-success">
                                Crea il tuo Nuovo Ristorante!
                            </p>
                            <a href="{{ route('admin.restaurants.create') }}" class="btn text-light btn-secondary btn-lg">Nuovo Ristorante <i class="fa-solid fa-plus"></i><i class="fa-solid fa-utensils"></i></a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
