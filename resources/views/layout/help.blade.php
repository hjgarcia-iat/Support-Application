<!doctype html>
<html lang="en">

<head>
    @include('layout.partials.meta')
    @include('layout.partials.styles')
    @if(config('app.env') === 'production')
        <script>
            document.domain = 'activatelearning.com';
        </script>
    @endif
    <script src="{{ asset('js/alpine.js') }}"></script>
</head>

<body>
<div x-data="{mobile_nav:false, search:false}" class="h-full">
    <div class="grid-help h-full relative">
        @include('layout.partials.header')
        <main role="main" class="page-content">
            <section class="container mx-auto">
                @yield('content')
            </section>
        </main>
        @include('layout.partials.footer')
    </div>
</div>
@yield('scripts')
</body>

</html>