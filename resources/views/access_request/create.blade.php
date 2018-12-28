@extends('layout.app')

@section('content')
    <div id="access-request">
        <access-request-form></access-request-form>
    </div>
@endsection

@section('scripts')
    <script src="{{ mix('js/access_request_form.js') }}"></script>
    @endsection