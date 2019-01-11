@extends('layout.app')
@section('pageTitle','Return Request')
@section('content')
    <div id="request-quote-form">
        <return-request-form></return-request-form>
    </div>
@endsection

@section('scripts')
    <script src="{{ mix('js/return_request.js') }}"></script>
@endsection