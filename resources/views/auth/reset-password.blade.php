@extends('layouts.guest')

@section('main-content')
    <section class="container-form-section">
        <div class="container-form">
            <h1 class="text-center text-light">RESET PASSWORD</h1>

            <form method="POST" action="{{ route('password.store') }}">
                @csrf
        
                <!-- Password Reset Token -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">
        
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
        
                <div>
                    <button class="mt-3 btn btn-success d-block" type="submit">
                        Reset Password
                    </button>
                </div>
            </form>
        </div>
    </section>
@endsection
