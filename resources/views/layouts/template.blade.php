<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') - SIRIM </title>
    @include('layouts.styles')
</head>
<body  class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--fixed kt-subheader--enabled kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading">

  <!-- begin:: Header Mobile -->
<div id="kt_header_mobile" class="kt-header-mobile  kt-header-mobile--fixed " >
    <div class="kt-header-mobile__logo">
      <a href="{{ url('dashboard') }}">
        <img alt="Logo" class="logo" src="{{ asset('assets/images/logo1.png') }}"/>
      </a>
    </div>
    <div class="kt-header-mobile__toolbar">
      <button class="kt-header-mobile__toggler kt-header-mobile__toggler--left" id="kt_aside_mobile_toggler"><span></span></button>
      <button class="kt-header-mobile__topbar-toggler" id="kt_header_mobile_topbar_toggler"><i class="flaticon-more"></i></button>
    </div>
</div>

  <input type="hidden" id="base_url" value="{{ url('/') }}">

  <div class="kt-grid kt-grid--hor kt-grid--root">
    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">
      @include('layouts.nav.aside')
      <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">
        {{-- Top Bar --}}
        @include('layouts.nav.top')
        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">
          <!-- begin:: Breadcrumbs -->
          {{--@include('partials.breadcrumbs')--}}
          @yield('breadcrumbs')
          <!-- end:: Breadcrumbs -->
          <!-- begin:: Content -->
          <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
                <input type="hidden" id="base_url" value="{{ url('/') }}">
            @yield('content')
          </div>
          <!-- end:: Content -->
        </div>
        @include('layouts.nav.footer')
      </div>
    </div>
  </div>
  <!-- begin::Scrolltop -->
  <div id="kt_scrolltop" class="kt-scrolltop">
      <i class="fa fa-arrow-up"></i>
  </div>
  <!-- end::Scrolltop -->

  @include('layouts.scripts')

</body>
</html>
