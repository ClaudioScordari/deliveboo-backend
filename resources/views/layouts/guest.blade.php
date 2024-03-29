<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Scripts -->
        @vite('resources/js/app.js')
    </head>
    <body class="d-flex">
        <!-- Sidebar -->
        <div class="bg-light text-success text-center p-3" id="sidebar-wrapper">
            <div class="sidebar-heading">Deliveboo</div>
            <div class="list-group list-group-flush">
                <a href="/" class="list-group-item list-group-item-action bg-light">Home</a>
                @auth
                    <a href="{{ route('dashboard') }}" class="list-group-item list-group-item-action bg-light">Dashboard</a>
                    <!-- Aggiungi ulteriori link per autenticati qui -->
                @else
                    <a href="{{ route('guest.restaurants.index') }}" class="list-group-item list-group-item-action bg-light">Ristoranti</a>
                    <a href="{{ route('login') }}" class="list-group-item list-group-item-action bg-light">Login</a>
                    <a href="{{ route('register') }}" class="list-group-item list-group-item-action bg-light">Register</a>
                @endauth
            </div>
        </div>
    
        <!-- Page Content -->
        <div id="page-content-wrapper">
            <main class="container py-4">
                @yield('main-content')
            </main>
        </div>
    
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>>
</html>
