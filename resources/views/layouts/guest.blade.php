<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <link rel="icon" href="{{ Vite::asset('resources/img/favicon.ico') }}" type="image/png">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Alegreya+Sans+SC:ital,wght@0,100;0,300;0,400;0,500;0,700;0,800;0,900;1,100;1,300;1,400;1,500;1,700;1,800;1,900&display=swap" rel="stylesheet">

        <title>{{ config('app.name', 'Deliveboo') }}</title>

        <!-- Scripts -->
        @vite('resources/js/app.js')
    </head>
    <body class="d-flex">
        <!-- Sidebar -->
        <div class="bg-light text-success border-end border-success text-center p-3" id="sidebar-wrapper">
            <div class="sidebar-heading d-none d-md-block">
                <img src="{{ Vite::asset('resources/img/deliveboo.png') }}" alt="deliveboo" class="w-100">
            </div>
            <div class="sidebar-heading d-block d-md-none">
                <img src="{{ Vite::asset('resources/img/deliveboo-icon.png') }}" alt="deliveboo" class="w-100">
            </div>
            <div class="list-group list-group-flush">
                <a href="/" class="text-success fw-bolder border-bottom border-success py-3 text-decoration-none"><span class="d-none d-md-inline">Home</span> <i class="fa-solid fa-house"></i></a>
                    <a href="{{ route('login') }}" class="text-success fw-bolder border-bottom border-success py-3 text-decoration-none"><span class="d-none d-md-inline">Login</span> <i class="fa-solid fa-right-to-bracket"></i></a>
                    <a href="{{ route('register') }}" class="text-success fw-bolder border-bottom border-success py-3 text-decoration-none"><span class="d-none d-md-inline">Register</span> <i class="fa-solid fa-address-card"></i></a>
                {{-- <a href="{{ route(guest.restaurants.index) }}" class="list-group-item list-group-item-action bg-light text-success fw-bolder">Ristoranti <i class="fa-solid fa-utensils"></i></a> --}}
            </div>
        </div>
    
        <!-- Page Content -->
        <div id="page-content-wrapper">
            <main class="container py-4">
                @yield('main-content')
            </main>
        </div>
    
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    </body>
</html>
