@extends('layout.app')
@section('pageTitle','Next Gen PET Fulfillment Support Form')
@section('content')
    <div id="nextgenpet-form">
        <nextgenpet-form></nextgenpet-form>
    </div>
@endsection

@section('scripts')
    <script src="{{ mix('js/nextgenpet_request.js') }}"></script>
@endsection