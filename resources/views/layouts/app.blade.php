<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alegreya+Sans+SC:ital,wght@0,100;0,300;0,400;0,500;0,700;0,800;0,900;1,100;1,300;1,400;1,500;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <link rel="icon" href="{{ Vite::asset('resources/img/favicon.ico') }}" type="image/png">

    <title>@yield('page-title') | {{ config('app.name', 'Deliveboo') }}</title>

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
            <div class="list-group list-group-flush text-center">
                @auth
                    <a href="{{ route('admin.dashboard') }}" class="text-success fw-bolder border-bottom border-success py-3 text-decoration-none"><span class="d-none d-md-inline">Dashboard</span> <i class="fa-solid fa-house"></i></a>
                    
                    {{-- Esiste un'istanza di restaurant con quell'ID? - Se no fammi creare il ristorante --}}
                    @if(auth()->user()->restaurant?->id)
                        <a href="{{ route('admin.restaurants.index') }}" class="text-success fw-bolder border-bottom border-success py-3 text-decoration-none"><span class="d-none d-md-inline">Il mio Ristorante</span> <i class="fa-solid fa-utensils"></i></a>
                        <a href="{{ route('admin.plates.index') }}" class="text-success fw-bolder border-bottom border-success py-3 text-decoration-none"><span class="d-none d-md-inline">Piatti</span> <i class="fa-solid fa-bowl-food"></i></a>
                        <a href="{{ route('admin.orders.index') }}" class="text-success fw-bolder border-bottom border-success py-3 text-decoration-none"><span class="d-none d-md-inline">Ordini</span> <i class="fa-solid fa-receipt"></i></a>
                        <a href="{{ route('admin.stats.index') }}" class="text-success fw-bolder border-bottom border-success py-3 text-decoration-none"><span class="d-none d-md-inline">Statistiche</span> <i class="fa-solid fa-chart-simple"></i></a>
                    @else
                        <a href="{{ route('admin.restaurants.create') }}" class="text-success fw-bolder border-bottom border-success py-3 text-decoration-none"><span class="d-none d-md-inline">Nuovo Ristorante</span> <i class="fa-solid fa-plus"></i></a>
                    @endif
                @endauth
                @auth
                <div id="logout-wrapper">
                    <form method="POST" action="{{ route('logout') }}" class="my-3">
                        @csrf
                        <button type="submit" class="btn btn-secondary text-white fw-bolder w-100 d-none d-md-inline">
                           Log Out <i class="fa-solid fa-right-from-bracket"></i> 
                        </button>
                        <a type="submit" class="text-secondary fw-bolder w-100 d-block d-md-none">
                            <i class="fa-solid fa-right-from-bracket"></i> 
                         </a>
                    </form>
                </div>
                @endauth

                @guest
                    <a href="/" class="bg-light text-success fw-bolder border-bottom py-3 text-decoration-none"><span class="d-none d-md-inline">Home</span> <i class="fa-solid fa-house"></i></a>
                    <a href="{{ route('login') }}" class="bg-light text-success fw-bolder border-bottom py-3 text-decoration-none"><span class="d-none d-md-inline">Login</span> <i class="fa-solid fa-right-to-bracket"></i></a>
                    <a href="{{ route('register') }}" class="bg-light text-success fw-bolder border-bottom py-3 text-decoration-none"><span class="d-none d-md-inline">Register</span> <i class="fa-solid fa-address-card"></i></a>
                @endguest

            </div>
        </div>

    </div>

    <!-- Page Content -->
    <div id="page-content-wrapper" class="w-100">
        <main class="container py-4">
            @yield('main-content')
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</body>
</html>
