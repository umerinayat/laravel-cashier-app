<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel Cashier') }}</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Oswald&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <script src="https://www.google.com/recaptcha/api.js" async defer></script>


</head>
<body>

    <div id="app">

        <div id="siteHeader">
            @include('partials.header')
        </div>

        <main>
            @yield('content')
        </main>

        <div id="siteFooter" class="mt-4">
            @include('partials.footer')
        </div>

    </div>

    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
    <script> 
        Stripe.setPublishableKey('pk_test_51H9eVxKgW18lL4fGiORVneWHwrpqHfqkvXX5SjK87xc7pfDFT1unfuuehGRQVbzk3lTE9TOGcndBQXU7GmaLIc1P00XMCRBtxw');
    </script>

  
    <script src="{{asset('js/app.js')}}"> </script>

    @stack('scripts')


</body>
</html>
