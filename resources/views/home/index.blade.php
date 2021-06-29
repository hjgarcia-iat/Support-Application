@extends('layouts.help')
@section('pageTitle','System Status')
@section('content')
    <div class="m-4">
        <h1 class="text-center font-bold text-blue-brand-medium text-3xl mb-2">Welcome to the Activate Learning Support
            Center
        </h1>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-12 mx-4 py-4 gap-8">
        <div class="md:col-span-8">
            <h2 class="font-bold text-gray-600 mb-4 text-2xl text-center">Browse Our Support Articles</h2>
            <div class="grid grid-cols-1 md:grid-cols-12 gap-8">

                @foreach($categories as $category)
                    <div class="col-span-1 md:col-span-4 h-44 shadow-md rounded-lg">
                        <a href="{{ route('categories.show', $category->slug) }}"
                           class="text-white block h-full flex items-center justify-center bg-lightBlue-800 text-center rounded-lg font-bold text-2xl p-3 hover:bg-lightBlue-700">{{ $category->name }}</a>
                    </div>
                @endforeach
            </div>

        </div>

        <div class="md:col-span-4">
            <h2 class="font-bold text-gray-600 mb-4 text-2xl text-center">A Bit About Us</h2>
            <p class="text-gray-600">Activate Learning takes pride in providing high quality support to districts and
                educators implementing our programs. Our dedicated Support Teams are available Monday through Friday 9
                AM – 6:30 PM EST.

            </p>

            <div><img src="{{  asset('img/icon.png') }}"
                      class="h-16 w-16 mx-auto my-4"
                      alt="Activate Learning"></div>

            <p>
                This site is designed to provide the resources necessary to address your needs quickly and easily.
                Please take a moment to explore our support center.
            </p>


            <a id="liveagent_button_online_5733c000000CrAT" href="javascript://Chat" style="display: none;" onclick="liveagent.startChat('5733c000000CrAT')"><!-- Online Chat Content --></a><div id="liveagent_button_offline_5733c000000CrAT" style="display: none;"><!-- Offline Chat Content --></div><script type="text/javascript">
                if (!window._laq) { window._laq = []; }
                window._laq.push(function(){liveagent.showWhenOnline('5733c000000CrAT', document.getElementById('liveagent_button_online_5733c000000CrAT'));
                    liveagent.showWhenOffline('5733c000000CrAT', document.getElementById('liveagent_button_offline_5733c000000CrAT'));
                });</script>

        </div>
    </div>

@endsection

@section('scripts')
    <script type='text/javascript' src='https://c.la3-c2-ph2.salesforceliveagent.com/content/g/js/52.0/deployment.js'></script>
    <script type='text/javascript'>
        liveagent.init('https://d.la3-c2-ph2.salesforceliveagent.com/chat', '5723c000000CqiR', '00D30000001GDNY');
    </script>
@endsection
