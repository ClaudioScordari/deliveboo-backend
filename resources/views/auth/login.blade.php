@extends('layouts.guest')

@section('main-content')
    <section class="container-form-section">
        <div class="container-form w-50 m-auto card border-success p-5 mt-5 bg-light">
            <h1 class="text-center text-success">LOGIN</h1>
            
            <form method="POST" action="{{ route('login') }}">
                @csrf
        
                <!-- Email Address -->
                <div class="form-group">
                    <label for="email">
                        Email
                    </label>
                    <input placeholder="Email" class="form-control" type="email" id="email" name="email" autocomplete="on" >
                </div>
                {{-- Barra errore --}}
                @error('email')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror
        
                <!-- Password -->
                <div class="my-4 form-group">
                    <label for="password">
                        Password
                    </label>
                    <input placeholder="Password" class="form-control" type="password" id="password" name="password" autocomplete="on" >
                </div>
                {{-- Barra errore --}}
                @error('password')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror
        
                <!-- Remember Me -->
                <div class="mb-3 form-group">
                    <label class="form-check-label" for="remember_me">
                        <input id="remember_me" type="checkbox" name="remember">
                        <span>Remember me</span>
                    </label>
                </div>
                
                {{-- Forgot password --}}
                <div class="form-group">
                    @if (Route::has('password.request'))
                        <a class="text-success" href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif
        
                    <button class="btn text-white btn-secondary d-block mt-3" type="submit">
                        <i class="fa-solid fa-right-to-bracket"></i> Login
                    </button>
                </div>
            </form>
        </div>
    </section>
@endsection
