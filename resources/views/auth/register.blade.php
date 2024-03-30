@extends('layouts.guest')

@section('main-content')
    <section class="container-form-section">
        <div class="container-form w-50 m-auto card p-5 mt-5 bg-light">
            <h1 class="text-center text-success">REGISTER</h1>

            <form method="POST" action="{{ route('register') }}">
                @csrf
        
                <!-- Name -->
                <div class="form-group">
                    <label for="name">
                        Name
                    </label>
                    <input class="form-control" type="text" id="name" name="name">
                </div>
        
                <!-- Email Address -->
                <div class="mt-4 form-group">
                    <label for="email">
                        Email
                    </label>
                    <input class="form-control" type="email" id="email" name="email">
                </div>
        
                <!-- Password -->
                <div class="mt-4 form-group">
                    <label for="password">
                        Password
                    </label>
                    <input class="form-control" type="password" id="password" name="password">
                </div>
        
                <!-- Confirm Password -->
                <div class="mt-4 form-group">
                    <label for="password_confirmation">
                        Conferma Password
                    </label>
                    <input class="form-control" type="password" id="password_confirmation" name="password_confirmation">
                </div>
        
                <div class="mt-3 form-group">
                    <a class="text-success" href="{{ route('login') }}">
                        {{ __('Already registered?') }}
                    </a>
        
                    <button class="mt-3 btn btn-secondary text-light d-block" type="submit">
                        Register <i class="fa-solid fa-address-card"></i>
                    </button>
                </div>
            </form>
        </div>
    </section>
@endsection
