<?php 
$siteSettings = \App\Models\SiteSetting::first();
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link rel="icon" href="{{ asset('storage/' . $siteSettings->logo_path) }}" type="image/x-icon">
    
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> --}}
  </head>
  <body class="bg-primer-light d-flex flex-column min-vh-100">
    <div id="app">
        @if (Auth::check()==true)
            @if (Auth::user()->usertype=='superadmin')
                @include('layouts.navigation.navbar-superadmin')
            @elseif (Auth::user()->usertype=='admin')
                @include( 'layouts.navigation.navbar-admin') 
            @elseif (Auth::user()->usertype=='costumer')
                @include('layouts.navigation.navbar-costumer')
            @endif
        @else
            @include('layouts.navigation.navbar-guest')
        @endif


        <main class="">
            @include('layouts.flash-message')
            @if (Auth::check() && Auth::user()->usertype=='costumer')
                @include('layouts.shop-status-flash-message')
            @elseif (!Auth::check())
                @include('layouts.shop-status-flash-message')
            @endif
            @yield('content')
            
        </main>

        @if (Auth::check()==true)
            @if (Auth::user()->usertype=='superadmin' || Auth::user()->usertype=='admin')
                @include('layouts.footer.footer-admin-superadmin')
            @else
            @include('layouts.footer.footer-guest-costumer')
            @endif
        @else
        @include('layouts.footer.footer-guest-costumer')
        @endif
      
    </div>




      


  </body>
</html>