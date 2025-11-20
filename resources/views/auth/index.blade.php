@extends('layouts.app')

@section('inline-css')
    <!--=============== REMIXICONS ===============-->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('main')
    <section class="login">

        <img src="{{ asset('img/fondo.jpg') }}" alt="Login-image" class="login--image" />

        <form action="{{ route('login.auth') }}" class="login--form" method="POST">
            @csrf

            <h1 class="login--title">Bienvenido</h1>

            <div class="login--content">
                <div class="login-box">
                    <i class="ri-user-3-line login-icon"></i>

                    <div class="login--input-box">
                        <input type="text" required class="login-input" name="study_id" id="login-input-text"
                            placeholder=" " />
                        <label for="" class="login--input-label">ID Estudiante o Email</label>
                    </div>
                </div>

                {{--
                <div class="login-box">
                    <i class="ri-lock-2-line login-icon"></i>

                    <div class="login--input-box">
                        <input type="password" class="login-input" id="login-input-pass" placeholder=" " />
                        <label for="" class="login--input-label">Password</label>
                        <i class="ri-eye-off-line login--eye" id="login--eye"></i>
                    </div>
                </div>
                --}}
            </div>


            {{--
            <div class="login--check">
                <div class="login-check-group">
                    <input type="checkbox" class="login--check-input" name="check" />
                    <label for="" class="chek--label">Remember Me</label>
                </div>

                 <a href="#" class="forgot-password">Forgot Password?</a> 
            </div>
            --}}

            <button class="login--button">Ingresar</button>

            @if (session()->has('error'))
                <p class="login--title">{{ session('error') }}</p>
            @endif

            {{-- <p class="login-register">
                Don't have an account? <a href="#">Register</a>
            </p>
        --}}
        </form>
    </section>
@endsection
