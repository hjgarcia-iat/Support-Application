@extends('layout.app') 
@section('content')
<div id="request-quote-form">
    <request-quote-form></request-quote-form>
</div>
@endsection
 
@section('scripts')
<script src="{{ mix('js/request_quote_form.js') }}"></script>
@endsection