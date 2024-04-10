@extends('layouts.guest')

@section('main-content')
    <section class="container-form-section">
        <div class="container-form w-50 m-auto card border-success p-5 mt-5 bg-light">
            <h1 class="text-center text-success">FORGOT PASSWORD</h1>
            
            <div class="bg-secondary-subtle text-center rounded p-3 m-2">
                {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
            </div>
        
            <form method="POST" action="{{ route('password.email') }}">
                @csrf
        
                <!-- Email Address -->
                <div class="form-group my-3">
                    <label for="email">
                        Email
                    </label>
                    <input class="form-control" type="email" id="email" name="email" autocomplete="on">
                </div>
                {{-- Barra errore --}}
                @error('email')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror
        
                <div>
                    <button class="btn text-white btn-secondary d-block" type="submit">
                        <i class="fa-solid fa-power-off"></i> Email Password Reset Link
                    </button>
                </div>
            </form>
        </div>
    </section>
@endsection
