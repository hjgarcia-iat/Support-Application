@extends('layout.app')
@section('pageTitle','Digital Setup Request')
@section('content')
    <div id="digital-setup">
        <digital-setup-form></digital-setup-form>
    </div>
@endsection

@section('scripts')
    <script src="{{ mix('js/digital_setup_form.js') }}"></script>
@endsection