<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <title>@yield('page-title') | {{ config('app.name', 'Laravel') }}</title>

        <!-- Scripts -->
        @vite('resources/js/app.js')
    </head>
    <body class="bg-success-subtle">
        <header>
            <nav class="navbar navbar-expand-lg bg-body-tertiary">
                <div class="container">
                    <a class="navbar-brand text-success" href="/">Deliveboo</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarText">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.dashboard') }}">Dashboard</a>
                            </li>

                            @auth
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('admin.restaurants.create') }}">Crea un ristorante</a>
                                </li>
                            @endauth
                            
                            @guest
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('guest.restaurants.index') }}">Vedi le attività</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">Login</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">Register</a>
                                </li>
                            @endguest

                            @auth
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('admin.restaurants.index') }}">Vedi la mia attività</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('admin.plates.index') }}">Vedi i miei piatti</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('admin.orders.index') }}">Vedi i miei ordini</a>
                                </li>
                            @endauth

                        </ul>
                        
                        @auth
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <button type="submit" class="btn btn-outline-danger">
                                    Log Out
                                </button>
                            </form>
                        @endauth
                    </div>
                </div>
            </nav>
        </header>

        <main class="py-4">
            <div class="container">
                @yield('main-content')
            </div>
        </main>
    </body>
</html>
