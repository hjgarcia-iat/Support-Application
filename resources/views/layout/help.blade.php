<!doctype html>
<html lang="en">

<head>
    @include('layout.partials.meta')
    @include('layout.partials.styles')
    <script src="{{ asset('js/alpine.js') }}"></script>
</head>

<body>
    <div x-data="{mobile_nav:false, search:false}" class="h-full">
        <div class="grid-help h-full relative">
            @include('layout.partials.header')
            <main role="main" class="page-content">
                <section class="w-full md:w-3/5 xl:w-2/5 mx-auto">
                    @yield('content')
                </section>
            </main>
            @include('layout.partials.footer')
        </div>
        <a @click.prevent="mobile_nav = false" x-show="mobile_nav === true" class="absolute opacity-30 bg-black top-0 left-0 h-full w-full z-10 cursor-pointer"></a>
    </div>
    @yield('scripts')
</body>

</html>