<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('pdf.reports.layouts.head')
    <body>
        @include('pdf.reports.layouts.header')
        <div class="tables">
           <table style="text-align: center">
                @yield('content')
            </table>
            <br>
        </div>
    </body>
</html>
