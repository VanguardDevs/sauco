<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('pdf.reports.layouts.head')
    <body>
        @include('pdf.reports.layouts.header')
        <span class="current-date">
            FECHA DE IMPRESIÓN: {{ date('d-m-Y') }}
        </span>
        <div class="tables">
            @yield('content')
            <br>
        </div>
    </body>
</html>
