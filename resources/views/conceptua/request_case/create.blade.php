@extends('layout.app') 
@section('content')
<div id="request-case-form">
    <request-demo-form></request-demo-form>
</div>
@endsection
 
@section('scripts')
<script src="{{ mix('js/request_case_form.js') }}"></script>
@endsection