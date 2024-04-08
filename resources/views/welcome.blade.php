@extends('layouts.guest')

@section('main-content')
    <div class="row">
        <div class="col">
            <div class="card border-0">
                <div class="card-body">
                    <div class="container d-flex align-items-center justify-content-center">
                        <h1 class="text-center text-success ps-5 d-none d-md-block">
                            Benvenuto su
                        </h1>
                        <img src="{{ Vite::asset('resources/img/deliveboo.png') }}" alt="Jumbotron" class="h-25">
                    </div>
                    <div class="row">
                        <div class="col-md-6 p-3">
                            <div class="card bg-light border-success p-3">
                                <p class="text-center px-5 mx-5 mb-3 my-auto">
                                    "Esegui la Registrazione su <span class="text-success fw-bolder">Deliveboo</span>!"
                                </p>
                                <div class="text-center mb-3">
                                    <a href="{{ route('register') }}" class="btn text-white btn-secondary btn-lg">Registrati! <i class="fa-solid fa-address-card"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 p-3">
                            <div class="card bg-light p-3">
                                <p class="text-center px-5 mx-5 mb-3 my-auto">
                                    "Sei già nostro cliente? effettua il Login"
                                </p>
                                <div class="text-center mb-3">
                                    <a href="{{ route('login') }}" class="btn text-white btn-secondary btn-lg">Accedi <i class="fa-solid fa-right-to-bracket"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center mb-3">
                        <img src="{{ Vite::asset('resources/img/jumbotron.png') }}" alt="Jumbotron" class="w-50 rounded">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
