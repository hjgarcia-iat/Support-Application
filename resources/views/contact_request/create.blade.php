@extends('layout.simple')
@section('pageTitle','Contact Us')
@section('content')
    <div id="contact-request">
        <contact_request_form></contact_request_form>
    </div>
@endsection

@section('scripts')
    <script src="{{ mix('js/contact_request.js') }}"></script>
@endsection