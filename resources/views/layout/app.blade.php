<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Support - @yield('pageTitle')</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans|Roboto" rel="stylesheet">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>
<body class="bg-grey-lightest">

<header class="page-header flex justify-center mb-5" role="banner">
    <section class="logo my-5">
        <img src="{{ asset('img/logo.png') }}" width="400" alt="{{ config('app.name') }}">
    </section>
</header>

<main role="main" class="flex justify-center mb-5">
    <section class="w-3/5 border bg-white">
        @yield('content')
    </section>
</main>

<footer role="contentinfo" class="flex justify-center">
    <section class="w-3/5 border-t p-5 text-center">
        <p class="text-grey-darker">&copy; {{ date('Y') }} Activate Learning</p>
        <p class="text-grey-darker">44 Amogerone Crossway #7862, Greenwich, CT 06836 Phone: 646-502-5231</p>
    </section>
</footer>

@yield('scripts')
</body>
</html>