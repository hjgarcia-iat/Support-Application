<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Support - @yield('pageTitle')</title>
    <link rel="shortcut icon" href="{{  asset('favicon.png') }}">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>
<body class="bg-gray-100">
    <div class="h-full app-grid w-full md:w-3/5 xl:w-2/5 mx-auto">
        <header class="flex justify-center mb-5" role="banner">
            <section class="logo m-6">
                <img src="{{ asset('img/logo.png') }}" width="400" alt="{{ config('app.name') }}">
            </section>
        </header>
        <main role="main">
            <section  class="mb-5 border bg-white">
                @yield('content')
            </section>
        </main>

        <footer role="contentinfo" class="flex justify-center border-t p-5 text-center text-gray-600 text-sm">
            <section class="text-center">
                <p>&copy; {{ date('Y') }} Activate Learning. All Rights Reserved.</p>
                <p>44 Amogerone Crossway #7862, Greenwich, CT 06836 Phone: 646-502-5231</p>
            </section>
        </footer>
    </div>
@yield('scripts')
</body>
</html>