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
    <script type="text/javascript">
       /* window.addEventListener("beforeunload", function(e){
            debugger;
        }, false);*/
    </script>
</html>
