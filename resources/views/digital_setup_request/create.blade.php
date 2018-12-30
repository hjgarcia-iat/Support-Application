@extends('layout.app')

@section('content')
    <div id="digital-setup-request">
        <digital-setup-request-form></digital-setup-request-form>
    </div>
@endsection

@section('scripts')
    <script src="{{ mix('js/access_request_form.js') }}"></script>
@endsection