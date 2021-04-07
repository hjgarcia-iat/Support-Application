<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{  asset('favicon.png') }}">
    <title>Support - @yield('pageTitle')</title>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <script src="{{ asset('js/alpine.js') }}"></script>
</head>

<body>
    <div x-data="{mobile_nav:false, search:false}" class="h-full">
        <div class="grid-help h-full relative">
            <header class="page-header mb-10 relative z-20 overflow-hidden">
                <div class="overlay h-full">
                    <div class="h-full py-2 px-3 flex justify-between items-center md:py-10 md:px-5 md:w-4/6 mx-auto relative">
                        <div class="md:hidden text-white">
                            <a href="" @click.prevent="mobile_nav = true" x-show="mobile_nav === false">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                                </svg>
                            </a>
                            <a href="" @click.prevent="mobile_nav = false" x-show="mobile_nav === true">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </a>
                        </div>

                        <div>
                            <a href="https://help.activatelearning.com/s/">
                                <img src="{{ asset('img/logo-w.png') }}" class="w-48 md:w-64" alt="Activate Learning">
                            </a>
                        </div>
                        <nav class="absolute flex flex-col bg-white w-full left-0 top-12" x-show="mobile_nav">
                            <a class="text-gray-700 px-5 py-3 border-b block hover:text-orange-500 hover:bg-blue-50" href="https://help.activatelearning.com/s/">Home</a>

                            <a class="text-gray-700 px-5 py-3 border-b block hover:text-orange-500 hover:bg-blue-50" href="https://help.activatelearning.com/s/system-status">System Status</a>

                            <a class="text-gray-700 px-5 py-3 border-b block hover:text-orange-500 hover:bg-blue-50" href="https://help.activatelearning.com/s/contactsupport">Contact Support</a>
                        </nav>

                        <nav class="hidden md:block flex ml-auto" x-show="search===false">
                            <a class="text-white inline-block sm:mx-1 lg:mx-4 hover:opacity-90" href="https://help.activatelearning.com/s/">Home</a>
                            <a class="text-white inline-block sm:mx-1 lg:mx-4 hover:opacity-90" href="https://help.activatelearning.com/s/system-status">System Status</a>
                            <a class="text-white inline-block sm:mx-1 lg:mx-4 hover:opacity-90" href="https://help.activatelearning.com/s/contactsupport">Contact Support</a>
                        </nav>
                        <div class="text-white sm:ml-2 lg:ml-4">
                            <a @click.prevent="search = true" x-show="search === false" class="cursor-pointer">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </a>
                            <div x-show="search === true" class="flex items-center absolute z-50 w-full" style="top: 40%; right: -80%">
                                <input id="search-form" placeholder="Search..." type="text" class="rounded-full mr-2 bg-white text-gray-700 px-4 py-1 border-gray-600 focus:outline-none">
                                <a href="" @click.prevent="search = false" class="cursor-pointer" x-show="search === true">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <main role="main" class="page-content">
                <section class="w-full md:w-3/5 xl:w-2/5 mx-auto">
                    @yield('content')
                </section>
            </main>
            <footer class="bg-black text-white p-5 page-footer">
                <p class="text-center">&copy; Copyright 2021 Activate Learning</p>
            </footer>
        </div>
        <a @click.prevent="mobile_nav = false" x-show="mobile_nav === true" class="absolute opacity-30 bg-black top-0 left-0 h-full w-full z-10 cursor-pointer"></a>
    </div>
    @yield('scripts')
</body>

</html>