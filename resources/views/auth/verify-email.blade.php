@extends('layouts.guest')

@section('main-content')
    <section class="container-form-section">
        <div class="container-form w-50 m-auto card p-5 mt-5 bg-light">
            <h1 class="text-center text-success">VERIFY EMAIL</h1>

            {{-- Errors --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>
                                {{ $error }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-secondary-subtle rounded p-3 m-2 text-center">
                {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
            </div>

            @if (session('status') == 'verification-link-sent')
                <div class="alert alert-success" role="alert">
                    {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                </div>
            @endif

            <div class="d-flex justify-content-between mt-4">
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf

                    <button class="btn btn-secondary text-white" type="submit">
                        Resend Verification Email <i class="fa-solid fa-envelope"></i>
                    </button>
                </form>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button class="btn btn-secondary text-white" type="submit">
                        Log Out <i class="fa-solid fa-right-from-bracket"></i>
                    </button>
                </form>
            </div>
        </div>
    </section>
@endsection
