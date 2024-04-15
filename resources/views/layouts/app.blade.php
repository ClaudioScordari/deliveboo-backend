<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alegreya+Sans+SC:ital,wght@0,100;0,300;0,400;0,500;0,700;0,800;0,900;1,100;1,300;1,400;1,500;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <link rel="icon" href="{{ Vite::asset('resources/img/favicon.ico') }}" type="image/png">

    <title>@yield('page-title') | {{ config('app.name', 'Eatoon') }}</title>

    @vite(['resources/js/app.js'])
    <!-- Scripts -->
    @vite('resources/js/app.js')
</head>
<body class="d-flex">
    <!-- Sidebar -->
    <div class="bg-light border-end border-success text-success text-center p-3" id="sidebar-wrapper">
        <div class="sidebar-heading d-none d-md-block">
            <img src="{{ Vite::asset('resources/img/deliveboo.png') }}" alt="deliveboo" class="w-100">
        </div>
        <div class="sidebar-heading d-block d-md-none">
            <img src="{{ Vite::asset('resources/img/deliveboo-icon.png') }}" alt="deliveboo" class="w-100">
        </div>
        <div>
            <div class="list-group list-group-flush">
                @auth
                        <div class="border-bottom border-success py-3 ps-3 text-start d-none d-md-inline">
                            <a href="{{ route('admin.dashboard') }}" class="text-success fw-bolder text-decoration-none text-start">
                                <i class="fa-solid fa-house"></i> <span class="ps-3">Dashboard</span>
                            </a>
    
                        </div>
                        <a href="{{ route('admin.dashboard') }}" class="text-success fw-bolder text-decoration-none text-start d-block d-md-none border-bottom border-success py-3">
                            <i class="fa-solid fa-house"></i>
                        </a>
                    
                    {{-- Esiste un'istanza di restaurant con quell'ID? - Se no fammi creare il ristorante --}}
                    @if(auth()->user()->restaurant?->id)

                        <div class="border-bottom border-success py-3 ps-3 text-start d-none d-md-inline">
                            <a href="{{ route('admin.restaurants.index') }}" class="text-success fw-bolder text-decoration-none text-start">
                                <i class="fa-solid fa-utensils"></i> <span class="ps-3">Ristorante</span>
                            </a>
                        </div>
                        <a href="{{ route('admin.restaurants.index') }}" class="text-success fw-bolder text-decoration-none text-start d-block d-md-none border-bottom border-success py-3">
                            <i class="fa-solid fa-utensils"></i>
                        </a>

                        <div class="border-bottom border-success py-3 ps-3 text-start d-none d-md-inline">
                            <a href="{{ route('admin.plates.index') }}" class="text-success fw-bolder text-decoration-none text-start">
                                <i class="fa-solid fa-bowl-food"></i> <span class="ps-3">Piatti</span>
                            </a>
                        </div>
                        <a href="{{ route('admin.plates.index') }}" class="text-success fw-bolder text-decoration-none text-start d-block d-md-none border-bottom border-success py-3">
                            <i class="fa-solid fa-bowl-food"></i>
                        </a>

                        <div class="border-bottom border-success py-3 ps-3 text-start d-none d-md-inline">
                            <a href="{{ route('admin.orders.index') }}" class="text-success fw-bolder text-decoration-none text-start">
                                <i class="fa-solid fa-receipt"></i> <span class="ps-3">Ordini</span>
                            </a>
                        </div>
                        <a href="{{ route('admin.orders.index') }}" class="text-success fw-bolder text-decoration-none text-start d-block d-md-none border-bottom border-success py-3">
                            <i class="fa-solid fa-receipt"></i>
                        </a>

                        <div class="border-bottom border-success py-3 ps-3 text-start d-none d-md-inline">
                            <a href="{{ route('admin.stats.index') }}" class="text-success fw-bolder text-decoration-none text-start">
                                <i class="fa-solid fa-chart-simple"></i> <span class="ps-3">Statistiche</span>
                            </a>
                        </div>
                        <a href="{{ route('admin.stats.index') }}" class="text-success fw-bolder text-decoration-none text-start d-block d-md-none border-bottom border-success py-3">
                            <i class="fa-solid fa-chart-simple"></i>
                        </a>

                        <div class="border-bottom border-success py-3 ps-3 text-start d-none d-md-inline">
                            <a href="http://localhost:5174" class="text-success fw-bolder text-decoration-none text-start">
                                <i class="fa-solid fa-shop"></i> <span class="ps-3">Front-Office</span>
                            </a>
                        </div>
                        <a href="http://localhost:5174" class="text-success fw-bolder text-decoration-none text-start d-block d-md-none border-bottom border-success py-3">
                            <i class="fa-solid fa-shop"></i>
                        </a>
                    @else
                        <div class="border-bottom border-success py-3 ps-3 text-start d-none d-md-inline">
                            <a href="{{ route('admin.restaurants.create') }}" class="text-success fw-bolder text-decoration-none text-start">
                                <i class="fa-solid fa-plus"></i> <span class="ps-3">Nuovo Ristorante</span>
                            </a>
                        </div>
                        <a href="{{ route('admin.restaurants.create') }}" class="text-success fw-bolder text-decoration-none text-start d-block d-md-none border-bottom border-success py-3">
                            <i class="fa-solid fa-plus"></i>
                        </a>

                        <div class="border-bottom border-success py-3 ps-3 text-start d-none d-md-inline">
                            <a href="http://localhost:5174" class="text-success fw-bolder text-decoration-none text-start">
                                <i class="fa-solid fa-shop"></i> <span class="ps-3">Front-Office</span>
                            </a>
                        </div>
                        <a href="http://localhost:5174" class="text-success fw-bolder text-decoration-none text-start d-block d-md-none border-bottom border-success py-3">
                            <i class="fa-solid fa-shop"></i>
                        </a>
                    @endif
                @endauth
                @auth
                <div id="logout-wrapper">
                    <form method="POST" action="{{ route('logout') }}" class="my-3">
                        @csrf
                        <button type="submit" class="btn btn-secondary text-white fw-bolder w-100 d-none d-md-inline">
                            <i class="fa-solid fa-right-from-bracket"></i> Log Out
                        </button>
                        <a type="submit" class="text-secondary fw-bolder w-100 d-block d-md-none">
                            <i class="fa-solid fa-right-from-bracket"></i> 
                         </a>
                    </form>
                </div>
                @endauth

                @guest
                    <div class="border-bottom border-success py-3 ps-3 text-start d-none d-md-inline">
                        <a href="/" class="text-success fw-bolder text-decoration-none text-start">
                            <i class="fa-solid fa-house"></i> <span class="ps-3">Home</span>
                        </a>
                    </div>
                    <a href="/" class="text-success fw-bolder text-decoration-none text-start d-block d-md-none border-bottom border-success py-3">
                        <i class="fa-solid fa-house"></i>
                    </a>

                    <div class="border-bottom border-success py-3 ps-3 text-start d-none d-md-inline">
                        <a href="{{ route('login') }}" class="text-success fw-bolder text-decoration-none text-start">
                            <i class="fa-solid fa-right-to-bracket"></i> <span class="ps-3">Login</span>
                        </a>
                    </div>
                    <a href="{{ route('login') }}" class="text-success fw-bolder text-decoration-none text-start d-block d-md-none border-bottom border-success py-3">
                        <i class="fa-solid fa-right-to-bracket"></i>
                    </a>

                    <div class="border-bottom border-success py-3 ps-3 text-start d-none d-md-inline">
                        <a href="{{ route('register') }}" class="text-success fw-bolder text-decoration-none text-start">
                            <i class="fa-solid fa-address-card"></i> <span class="ps-3">Register</span>
                        </a>
                    </div>
                    <a href="{{ route('register') }}" class="text-success fw-bolder text-decoration-none text-start d-block d-md-none border-bottom border-success py-3">
                        <i class="fa-solid fa-address-card"></i>
                    </a>

                    <div class="border-bottom border-success py-3 ps-3 text-start d-none d-md-inline">
                        <a href="http://localhost:5174" class="text-success fw-bolder text-decoration-none text-start">
                            <i class="fa-solid fa-shop"></i> <span class="ps-3">Front-Office</span>
                        </a>
                    </div>
                    <a href="http://localhost:5174" class="text-success fw-bolder text-decoration-none text-start d-block d-md-none border-bottom border-success py-3">
                        <i class="fa-solid fa-shop"></i>
                    </a>
                @endguest

            </div>
        </div>

    </div>

    <!-- Page Content -->
    <div id="page-content-wrapper" class="w-100">
        <main class="container">
            @yield('main-content')
        </main>
    </div>

        <!-- Inclusione di jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

    <!-- JavaScript Bundle con Popper.js per Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</body>
</html>
