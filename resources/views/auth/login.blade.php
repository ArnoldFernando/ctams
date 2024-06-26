{{-- resources/views/auth/custom_login.blade.php --}}
@extends('adminlte::master')

@section('title', 'CSU-APARRI LIBRARY')

@section('adminlte_css')
    <link rel="stylesheet" href="{{ url('Css/all.min.css') }}">
    <link rel="stylesheet" href="{{ url('Css/fontawesome.min.css') }}">
    {{-- Favicon --}}
    <link rel="shortcut icon" href="{{ url('Image/logo.png') }}" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link
        href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: 'Nunito';
        }

        .font {
            font-family: 'Poppins';
            font-size: 3rem;
            font-weight: 900;
            color: #FFC219;
        }

        .font-text {
            font-family: 'Poppins';
        }

        .text-shadow {
            text-shadow: 3px 3px 2px rgba(121, 24, 0, 0.6);
        }

        .background {
            background-image: url('{{ asset('assets/img/bg.png') }}');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center center;
            min-height: 100vh;
            min-width: 100vw;
            position: relative;
        }

        .background::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            /* Adjust the opacity as needed */
            z-index: 1;
        }

        .background>* {
            position: relative;
            z-index: 2;
        }
    </style>
@stop

@section('classes_body', 'login-page')

@section('body')
    <div class="background">
        <div class="d-flex align-items-center justify-content-center" style="min-height: 95vh;">
            <div class="card rounded-4 shadow-lg p-5" style="width: 850px;">
                <div class="row py-3">
                    <div class="col-md-6 pt-0">
                        <div class="d-flex align-items-center justify-content-center">
                            <img src="{{ url('assets/img/csulogo.png') }}" class="mt-3" alt="CSU Logo" height="200rem">
                        </div>
                        <h3 class="d-flex justify-content-center font text-shadow mt-3">CSU-APARRI</h3>
                    </div>
                    <div class="col-md-6 mt-2">
                        <div class="">
                            <div class="">
                                <div class="rounded-1 py-0">
                                    <p class="text-center font-text fs-5" style="font-weight: 500;">Welcome to <b
                                            style="color: #FFC219;  text-shadow: 1px 1px 1px rgba(121, 24, 0, 0.6);">LIBRARY</b>
                                    </p>
                                </div>
                                <hr class="mt-0">
                                <form action ="{{ route('login') }}" method="post">
                                    @csrf

                                    <div class="input-group mb-3">
                                        <input type="email" name="email"
                                            class="form-control border border-1 border-secondary @error('email') is-invalid @enderror"
                                            placeholder="Email" value="{{ old('email') }}" required autofocus>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="input-group mb-3">
                                        <input type="password" name="password"
                                            class="form-control border border-1 border-secondary @error('password') is-invalid @enderror"
                                            placeholder="Password" required>
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="row mb-2">
                                        <div class="col-6">
                                            <div class="icheck-primary">
                                                <input type="checkbox" name="remember" id="remember"
                                                    {{ old('remember') ? 'checked' : '' }}>
                                                <label for="remember" style="font-weight: 500;">
                                                    Remember Me
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <p class="mb-1">
                                                <a href="{{ route('password.request') }}"
                                                    class="text-danger text-decoration-none fs-6 "
                                                    style="font-weight: 500;">
                                                    I forgot my password
                                                </a>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-block btn-primary text-light fw-bold"
                                                style="font-weight: 700;">Login</button>
                                        </div>
                                    </div>
                                </form>
                                <div class="row">
                                    <div class="col-12 text-center">
                                        <p class="mb-0">
                                            <a href="{{ route('register') }}" class="text-center text-decoration-none"
                                                style="font-weight: 500;">Create a
                                                New Account</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="d-flex justify-content-center" style="color:#030101;">
            &copy; Copyright <strong> <span class="text-danger ms-1">NORTHERN HEALTHCARE CHILDREN CLINIC</span></strong>.
            All
            Rights
            Reserved
        </div> --}}
    </div>
@stop

@section('adminlte_js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
@stop
