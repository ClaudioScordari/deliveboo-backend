@extends('layouts.guest')

@section('main-content')
    <section class="container-form-section">
        <div class="container-form">
            <h1 class="text-center text-light">FORGOT PASSWORD</h1>
            
            <div class="bg-light rounded p-2">
                {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
            </div>
        
            <form method="POST" action="{{ route('password.email') }}">
                @csrf
        
                <!-- Email Address -->
                <div class="form-group my-3">
                    <label for="email">
                        Email
                    </label>
                    <input class="form-control" type="email" id="email" name="email">
                </div>
        
                <div>
                    <button class="btn btn-success d-block" type="submit">
                        Email Password Reset Link
                    </button>
                </div>
            </form>
        </div>
    </section>
@endsection
