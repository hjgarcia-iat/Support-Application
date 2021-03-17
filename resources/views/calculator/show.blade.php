@extends('layout.app')
@section('pageTitle','Calculator')
@section('content')
    <div id="calculator">
        <calculator></calculator>
    </div>
@endsection

@section('scripts')
    <script src="{{ mix('js/calculator.js') }}"></script>
@endsection