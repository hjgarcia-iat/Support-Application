<!doctype html>
<html lang="en">

<head>
    @include('layouts.partials.meta')
    @include('layouts.partials.styles')
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
        @include('layouts.partials.header')
        <main role="main" class="page-content">
            <section class="container mx-auto">
                @yield('content')
            </section>
        </main>
        @include('layouts.partials.footer')
    </div>
</div>
@yield('scripts')
</body>

</html>