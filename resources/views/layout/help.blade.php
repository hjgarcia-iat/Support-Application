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
        <div class="overlay relative h-full py-2 px-3 flex justify-between items-center md:py-10 md:px-5">
            <div class="md:hidden text-white">
                <a href="">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </a>
            </div>
            <div>
                <a href="https://help.activatelearning.com/s/">
                    <img src="{{ asset('img/logo-w.png') }}"
                            class="w-48 md:w-64"
                         alt="Activate Learning">
                </a>
            </div>
            <nav class="absolute hidden  flex flex-col bg-white w-full left-0 top-12 md:flex-row md:relative md:top-0 z-10 md:gap-20 md:ml-auto md:bg-transparent md:w-auto md:block">
                <a class="text-gray-700 md:text-white px-5 py-3 border-b md:border-none block md:inline-block hover:text-orange-500 hover:bg-blue-50"
                   href="https://help.activatelearning.com/s/">Home</a>
                <a class="text-gray-700 md:text-white px-5 py-3 border-b md:border-none block md:inline-block hover:text-orange-500 hover:bg-blue-50"
                   href="https://help.activatelearning.com/s/system-status">System Status</a>
                <a class="text-gray-700 md:text-white px-5 py-3 border-b md:border-none block md:inline-block hover:text-orange-500 hover:bg-blue-50"
                   href="https://help.activatelearning.com/s/contactsupport">Contact Support</a>
            </nav>
            <div class="text-white md:ml-16">
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