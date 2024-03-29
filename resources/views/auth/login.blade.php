@extends('layouts.guest')

@section('main-content')
    <section class="container-form-section">
        <div class="container-form">
            <h1 class="text-center text-light">LOGIN</h1>
            
            <form method="POST" action="{{ route('login') }}">
                @csrf
        
                <!-- Email Address -->
                <div class="form-group">
                    <label for="email">
                        Email
                    </label>
                    <input placeholder="Email" class="form-control" type="email" id="email" name="email">
                </div>
        
                <!-- Password -->
                <div class="my-4 form-group">
                    <label for="password">
                        Password
                    </label>
                    <input placeholder="Password" class="form-control" type="password" id="password" name="password">
                </div>
        
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
                        <a class="text-light" href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif
        
                    <button class="btn btn-success d-block mt-3" type="submit">
                        Log in
                    </button>
                </div>
            </form>
        </div>
    </section>
@endsection
