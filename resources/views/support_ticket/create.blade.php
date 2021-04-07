@extends('layout.help')
@section('pageTitle','Create Support Ticket')
@section('content')
    <div id="support-ticket-form">
        <support_ticket_form></support_ticket_form>
    </div>
@endsection

@section('scripts')
    <script src="{{ mix('js/support_ticket.js') }}"></script>
@endsection