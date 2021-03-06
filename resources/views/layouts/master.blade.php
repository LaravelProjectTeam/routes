<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Маршрути') }} | @yield('title')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
          integrity="sha256-eZrrJcwDc/3uDhsdt61sL2oOBY362qM3lon1gyExkL0=" crossorigin="anonymous" />
{{--    CDN    --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
{{--    Local    --}}
{{--    <link rel="stylesheet" href=" {{ asset('css/bulma.css') }}">--}}
{{--    <link rel="stylesheet" href=" {{ secure_asset('css/styles.css') }}">--}}
{{--    <script src="{{ secure_asset('js/app.js') }}" defer></script>--}}
    <link rel="stylesheet" href=" {{ asset('css/styles.css') }}">
</head>
<body class="body">
    <nav>
        @include('includes.navbar')
    </nav>

    <main class="content">
        @yield('content')
    </main>

    <footer>
        @include('includes.footer')
    </footer>

    <script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
</body>
</html>
