<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
            content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Support - @yield('pageTitle')</title>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>
<body class="bg-gray-100">
<div class="h-full app-grid w-full md:w-3/5 xl:w-2/5 mx-auto">
    <main role="main" class="mt-8">
        <section class="mb-5 border bg-white">
            @yield('content')
        </section>
    </main>
</div>
@yield('scripts')
</body>
</html>