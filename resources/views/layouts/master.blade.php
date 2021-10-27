<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
        <link rel="stylesheet" href=" {{ asset('css/styles.css') }}">
    <title>@yield('title')</title>
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
</body>
</html>
