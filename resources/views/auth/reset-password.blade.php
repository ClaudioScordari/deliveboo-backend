@extends('layouts.guest')

@section('main-content')
    <section class="container-form-section">
        <div class="container-form w-50 m-auto card p-5 mt-5 bg-light">
            <h1 class="text-center text-success">RESET PASSWORD</h1>
            
            <form method="POST" action="{{ route('password.update') }}">
                @csrf
        
                <!-- Password Reset Token -->
                <input type="hidden" name="token" value="{{ $request->token }}">
        
                <!-- Email Address -->
                <div class="form-group my-3">
                    <label for="email">
                        Email
                    </label>
                    <input class="form-control" type="email" id="email" name="email" required autofocus>
                </div>
                {{-- Barra errore --}}
                @error('email')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror
        
                <!-- Password -->
                <div class="form-group my-3">
                    <label for="password">
                        Password
                    </label>
                    <input class="form-control" type="password" id="password" name="password" required autocomplete="new-password">
                </div>
                {{-- Barra errore --}}
                @error('password')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror
        
                <!-- Confirm Password -->
                <div class="form-group my-3">
                    <label for="password_confirmation">
                        Conferma Password
                    </label>
                    <input class="form-control" type="password" id="password_confirmation" name="password_confirmation" required autocomplete="new-password">
                </div>
                {{-- Barra errore --}}
                @error('password_confirmation')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror
        
                <div class="text-center">
                    <button class="btn btn-secondary text-white d-block w-100" type="submit">
                        Reset Password <i class="fa-solid fa-rotate-right"></i>
                    </button>
                </div>
            </form>
        </div>
    </section>
@endsection
