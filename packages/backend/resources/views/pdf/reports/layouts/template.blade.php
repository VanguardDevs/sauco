<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('pdf.reports.layouts.head')
    <body>
        @include('pdf.reports.layouts.header')
        <div class="tables">
            @yield('content')
            <br>
        </div>
    </body>
</html>
