@extends('layout.help')
@section('pageTitle','System Status')
@section('content')
<div class="m-4">
    <h1 class="text-center font-bold text-blue-brand-medium text-3xl mb-2">System Status</h1>
    <p class="text-gray-600 text-center">If you are experiencing an issue not posted here, please submit a support
        ticket.
    </p>
</div>

<div class="grid grid-cols-1 md:grid-cols-12 mx-4 py-4 gap-8">
    <div class="md:col-span-8">
        <h2 class="font-bold text-gray-600 mb-4 text-2xl text-center">Activate Learning Status</h2>
        @forelse ($statuses as $status)
            <div class="shadow-sm py-5 px-7 bg-gray-100 rounded-md status-block mb-8 status-block status-{{ strtolower($status->type) }}">
                <div class="flex items-center text-sm justify-between uppercase tracking-wide text-blue-brand">
                    <div>{{ $status->created_at->format("F j, Y") }}</div>
                    <div>{{ $status->created_at->format("h:i A T") }}</div>
                </div>
                <p class="text-xl my-3">{{ $status->post }}</p>
            </div>
        @empty
            <p class="text-xl">No status updates available at this time.</p>
        @endforelse
    </div>
    <div class="md:col-span-4">
        <h2 class="font-bold text-gray-600 mb-4 text-2xl text-center">Our Data Integration Partners</h2>
        <p class="text-gray-600">For our customers using any of our LMS integrations, the links below may be helpful
            in determining the source of any issues you may be experiencing.
        </p>
        <p class="my-5 text-center">
            <a href="https://status.clever.com/"
                target="_blank"
                class="text-blue-brand text-xl hover:underline hover:text-orange-500">Clever System Status</a>
        </p>
        <p class="my-5 text-center"><a href="https://status.ed.link/"
                target="_blank"
                class="text-blue-brand text-xl hover:underline hover:text-orange-500">Edlink
                System Status</a></p>
    </div>
</div>
@endsection

@section('scripts')
<script>
    let input = document.getElementById("search-field");

        input.addEventListener("keyup", function (event) {

            if (event.key === 'Enter') {
                event.preventDefault();

                window.location.href = 'https://help.activatelearning.com/s/global-search/' + input.value
            }
        });
</script>
@endsection