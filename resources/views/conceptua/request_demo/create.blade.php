@extends('layout.app')

@section('content')
    <div id="request-demo-form">
        <request-demo-form></request-demo-form>
    </div>
@endsection

@section('scripts')
    <script src="{{ mix('js/request_demo_form.js') }}"></script>
@endsection