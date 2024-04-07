@extends('layouts.guest')

@section('main-content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="container d-flex align-items-center justify-content-center">
                        <h1 class="text-center text-success ps-5 d-none d-md-block">
                            Benvenuto su
                        </h1>
                        <img src="{{ Vite::asset('resources/img/deliveboo.png') }}" alt="Jumbotron" class="h-25">
                    </div>
                    <div class="row">
                        <div class="col-md-6 p-3">
                            <div class="card bg-light p-3" style="height:200px">
                                <p class="text-center px-5 mx-5 my-auto">
                                    "Esegui la Registrazione su <span class="text-success fw-bolder">Deliveboo</span> e ottieni accesso a strumenti potenti per migliorare l'efficienza, monitorare gli ordini e massimizzare i profitti!"
                                </p>
                                <div class="text-center mb-3">
                                    <a href="{{ route('register') }}" class="btn text-light btn-secondary btn-lg">Registrati! <i class="fa-solid fa-address-card"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 p-3">
                            <div class="card bg-light p-3" style="height:200px">
                                <p class="text-center px-5 mx-5 my-auto">
                                    "Oppure, se sei già nostro cliente effettua il login"
                                </p>
                                <div class="text-center mb-3">
                                    <a href="{{ route('login') }}" class="btn text-light btn-secondary btn-lg">Accedi <i class="fa-solid fa-right-to-bracket"></i></a>
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
