<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <link rel="icon" type="image/png" href="/favicon.ico">

    <title>@yield('page-title') | {{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    @vite('resources/js/app.js')
</head>
<body class="d-flex">
    <!-- Sidebar -->
    <div class="bg-light text-success text-center p-3" id="sidebar-wrapper">
        <div class="sidebar-heading">
            <img src="{{ Vite::asset('resources/img/deliveboo.png') }}" alt="deliveboo" class="w-100">
        </div>
        <div>
            <div class="list-group list-group-flush text-center">
                @auth
                    <a href="{{ route('admin.dashboard') }}" class="list-group-item list-group-item-action bg-light text-success fw-bolder">Dashboard <i class="fa-solid fa-house"></i></a>
                    <a href="{{ route('admin.restaurants.create') }}" class="list-group-item list-group-item-action bg-light text-success fw-bolder">Nuovo Ristorante <i class="fa-solid fa-plus"></i></a>
                    <a href="{{ route('admin.restaurants.index') }}" class="list-group-item list-group-item-action bg-light text-success fw-bolder">Il mio Ristorante <i class="fa-solid fa-utensils"></i></a>
                    <a href="{{ route('admin.plates.index') }}" class="list-group-item list-group-item-action bg-light text-success fw-bolder">Piatti <i class="fa-solid fa-bowl-food"></i></a>
                    <a href="{{ route('admin.orders.index') }}" class="list-group-item list-group-item-action bg-light text-success fw-bolder">Ordini <i class="fa-solid fa-receipt"></i></a>
                @endauth
                @auth
                <div id="logout-wrapper">
                    <form method="POST" action="{{ route('logout') }}" class="bg-light">
                        @csrf
                        <button type="submit" class="btn btn-outline-warning fw-bolder w-100">
                            Log Out <i class="fa-solid fa-right-from-bracket"></i>
                        </button>
                    </form>
                </div>
                @endauth
                @guest
                <a href="/" class="list-group-item list-group-item-action bg-light text-success fw-bolder">Home <i class="fa-solid fa-house"></i></a>
                    <a href="{{ route('guest.restaurants.index') }}" class="list-group-item list-group-item-action bg-light text-success fw-bolder">Ristoranti <i class="fa-solid fa-utensils"></i></a>
                    <a href="{{ route('login') }}" class="list-group-item list-group-item-action bg-light text-success fw-bolder">Login <i class="fa-solid fa-right-to-bracket"></i></a>
                    <a href="{{ route('register') }}" class="list-group-item list-group-item-action bg-light text-success fw-bolder">Register <i class="fa-solid fa-address-card"></i></a>
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
</body>
</html>
