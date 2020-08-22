<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SIRIM</title>
    @include('layouts.styles')
    <script src="{{ asset('css/app.css') }}"></script>
</head>
<body>
    <div id="root"></div>
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
