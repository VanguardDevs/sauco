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
                <div id="login"></div>
            </div>
        </div>
    </div>
</div>

@endsection
