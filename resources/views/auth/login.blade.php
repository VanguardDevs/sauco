@extends('auth.app')

@section('title', 'Inicio de Sesión')

@section('content')

<div class="kt-grid kt-grid--hor kt-grid--root  kt-login kt-login--v4 kt-login--signin" id="kt_login">
    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">
        <div class="kt-grid__item kt-grid__item--fluid kt-login__wrapper">
            <div class="kt-login__container">
                <div class="kt-login__logo">
                    <a href="#">
                        <img class="img-responsive" src="{{ asset('assets/images/sascom-1.png') }}">
                    </a>
                </div>
                <div class="kt-login__signin row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <div class="kt-login__head">
                            <h3 class="kt-login__title">Inicio de Sesión</h3>
                        </div>

                        <form class="kt-form" method="POST" action="{{ route('login') }}" autocomplete="off">
                        @csrf
                        <div class="input-group">
                            <input id="login" type="text" class="form-control @error('login') is-invalid @enderror" name="login" value="{{ old('login') }}" required autocomplete="login" autofocus placeholder="Usuario">

                            @error('login')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="input-group">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Clave">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="kt-login__actions">
                            <button type="submit" class="btn buttons-add-up btn-pill kt-login__btn-primary">
                                {{ __('Login') }}
                            </button>
                        </div>
                    </form>    
                    </div>
                    <div class="col-md-2"></div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
