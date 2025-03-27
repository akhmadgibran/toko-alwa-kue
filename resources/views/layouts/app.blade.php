<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> --}}
  </head>
  <body>
    <div id="app">
        @if (Auth::check()==true)
            @if (Auth::user()->usertype=='superadmin')
                @include('layouts.navigation.navbar-superadmin')
            @elseif (Auth::user()->usertype=='admin')
                @include( 'layouts.navigation.navbar-admin') 
            @elseif (Auth::user()->usertype=='costumer')
                {{-- @include() --}}
            @endif
        @else
            @include('layouts.navigation.navbar-guest')
        @endif


        <main class="">
            @include('layouts.flash-message')
            @yield('content')
        </main>

        @if (Auth::check()==true)
            @if (Auth::user()->usertype=='superadmin' || Auth::user()->usertype=='admin')
                @include('layouts.footer.footer-admin-superadmin')
            @endif
        @else
        @include('layouts.footer.footer-guest-costumer')
        @endif
      
    </div>

      {{-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script> --}}

      <!-- Bootstrap CSS -->

      


  </body>
</html>