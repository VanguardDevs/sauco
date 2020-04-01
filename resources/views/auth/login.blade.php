@extends('auth.app')

@section('title', 'Login')

@section('content')

<div class="kt-grid kt-grid--hor kt-grid--root  kt-login kt-login--v1" id="kt_login">
    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--desktop kt-grid--ver-desktop kt-grid--hor-tablet-and-mobile">
        <div class="kt-grid__item kt-grid__item--fluid kt-grid__item--order--table-and-mobile-1 kt-login__wrapper">
            <div class="kt-login__body" style="justify-content:space-evenly">
                <div class="kt-login__logo">
                    <a href="">
                        <img class="img-responsive" src="{{ asset('assets/images/logo1.png') }}">
                    </a>
                </div>
                <div class="kt-login__form">
                    <div class="kt-login__title">
                       <h3>Inicio de Sesión</h3>
                    </div>
                    <form class="kt-form" method="POST" action="{{ route('login') }}" autocomplete="off">
                        @csrf
                        <div class="form-group">
                            <input type="text" class="form-control @error('login') is-invalid @enderror" name="login" value="{{ old('login') }}" required autocomplete="login" autofocus placeholder="Usuario">

                            @error('login')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Clave">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="kt-login__actions">
                            <button type="submit" id="kt_login_signin_submit" class="btn btn-primary btn-elevate kt-login__btn-primary">
                                {{ ('Login') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
