<!-- Stored in resources/views/layouts/app.blade.php -->

<html>
    <head>
        <title>Todo - @yield('title')</title>
        <link rel="stylesheet" href="{{ mix('css/style.css') }}">
        <style> 
            .is-invalid {border: 1px solid red;}
            .alert {color:red;}

        </style>
    </head>
    <body>
        @section('sidebar')
            {{-- This is the master sidebar. --}}
        @show

        <div class="container">
            @yield('content')
        </div>
    </body>
</html>