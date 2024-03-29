@extends('layouts.guest')

@section('main-content')
    <section class="container-form-section">
        <div class="container-form">
            <h1 class="text-center">REGISTER</h1>

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
                    <a class="text-light" href="{{ route('login') }}">
                        {{ __('Already registered?') }}
                    </a>
        
                    <button class="btn btn-primary mt-3 btn btn-success d-block" type="submit">
                        Register
                    </button>
                </div>
            </form>
        </div>
    </section>
@endsection
