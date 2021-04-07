<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible"
          content="ie=edge">
    <meta name="csrf-token"
          content="{{ csrf_token() }}">
    <title>Support - @yield('pageTitle')</title>
    <link rel="stylesheet"
          href="{{ mix('css/app.css') }}">
</head>
<body>
<div class="h-full grid-help">
    <header class="page-header mb-10">
        <div class="overlay h-full py-10 px-5 flex items-center">
            <div>
                <a href="https://help.activatelearning.com/s/">
                    <img src="{{ asset('img/logo-w.png') }}"
                         width="250px"
                         alt="Activate Learning">
                </a>
            </div>
            <nav class="flex gap-20 ml-auto">
                <a class="text-white hover:text-opacity-90"
                   href="https://help.activatelearning.com/s/">Home</a>
                <a class="text-white hover:text-opacity-90"
                   href="https://help.activatelearning.com/s/system-status">System Status</a>
                <a class="text-white hover:text-opacity-90"
                   href="https://help.activatelearning.com/s/contactsupport">Contact Support</a>
            </nav>
            <div class="text-white ml-16">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </div>
        </div>
    </header>
    <main role="main"
          class="page-content">
        <div class="">
            <section class="w-full md:w-3/5 xl:w-2/5 mx-auto">
                @yield('content')
            </section>
        </div>
    </main>
    <footer class="bg-black text-white p-5 page-footer">
        <p class="text-center">&copy; Copyright 2021 Activate Learning</p>
    </footer>
</div>
@yield('scripts')
</body>
</html>