@extends('layouts.guest')

@section('main-content')
    <section class="container-form-section">
        <div class="container-form">
            <h1 class="text-center text-light">VERIFY EMAIL</h1>

            <div class="bg-light rounded p-2">
                {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
            </div>
        
            @if (session('status') == 'verification-link-sent')
                <div>
                    {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                </div>
            @endif
        
            <div class="mt-4 flex items-center justify-between">
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
        
                    <div>
                        <button class="btn btn-success" type="submit">
                            Resend Verification Email
                        </button>
                    </div>
                </form>
        
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
        
                    <button class="btn btn-success d-block" type="submit">
                        Log Out
                    </button>
                </form>
            </div>
        </div>
    </section>

@endsection
