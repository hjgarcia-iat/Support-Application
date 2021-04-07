@extends('layout.help')
@section('pageTitle','Create Support Ticket')
@section('content')
    <div id="support-ticket-form">
        <h1 class="text-center font-bold text-blue-brand-medium text-3xl mb-10">Submit A Support Ticket</h1>
        <support_ticket_form></support_ticket_form>
    </div>
@endsection

@section('scripts')
    <script src="{{ mix('js/support_ticket.js') }}"></script>
@endsection