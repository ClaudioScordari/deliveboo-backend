@extends('layouts.guest')

@section('main-content')
    <section class="container-form-section">
        <div class="container-form w-50 m-auto card p-5 mt-5 bg-light">
            <h1 class="text-center text-success">CONFIRM PASSWORD</h1>
            
            <div class="bg-secondary-subtle text-center rounded p-3 m-2">
                {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
            </div>
        
            <form method="POST" action="{{ route('password.confirm') }}">
                @csrf
        
                <!-- Password -->
                <div class="form-group my-3">
                    <label for="password">
                        Password
                    </label>
                    <input class="form-control" type="password" id="password" name="password" required autocomplete="current-password">
                </div>
                {{-- Barra errore --}}
                @error('password')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror
        
                <div class="text-center">
                    <button class="btn text-white btn-secondary" type="submit">
                        Confirm <i class="fa-solid fa-check"></i>
                    </button>
                </div>
            </form>
        </div>
    </section>
@endsection