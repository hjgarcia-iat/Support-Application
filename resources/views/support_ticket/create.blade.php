@extends('layout.help')
@section('pageTitle','Create Support Ticket')
@section('content')

    <h1 class="text-center font-bold text-blue-brand-medium text-3xl mb-4">Submit A Support Ticket</h1>
    <div class="grid grid-cols-1 md:grid-cols-12 mx-4 py-4 gap-8">
        <div class="md:col-span-8">
            <div id="support-ticket-form">
                <support_ticket_form></support_ticket_form>
            </div>
        </div>
        <div class="md:col-span-4">
            <h2 class="font-bold text-gray-600 mb-4 text-2xl text-center">About Activate Learning Support</h2>
            <p class="text-gray-600">Our dedicated Customer and Product Support Teams are available Monday through
                Friday 9 AM – 6:30 PM EST. All inquiries sent to our Support Department are converted to a ticket,
                immediately receive an automated email confirming receipt, and will receive a response from one of our
                support agents within one business day. When urgent assistance is requested, a response will be provided
                within 4 hours. All incoming inquiries are monitored to ensure our team is providing a timely response
                and resolution. When customers need to speak with a manager, calls will be first handled by the Customer
                Support Supervisor. As needed, calls may be escalated to the Department Manager and finally to the Chief
                Product Officer.</p>
            <img src="{{ asset('img/support-logo.jpg') }}"  alt="Activate Learning Support" class="mx-auto w-48">
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ mix('js/support_ticket.js') }}"></script>
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