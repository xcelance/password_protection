<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

    <head>
        @include('partials.head')
    </head>
    
    <body>
        <div id="app">

            @include('partials.header')

            @yield('content')

        </div>

        @include('partials.footer')
    </body>
</html>
