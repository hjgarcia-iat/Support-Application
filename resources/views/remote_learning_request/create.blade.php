@extends('layout.app')

@section('pageTitle','Remote Learning Request')

@section('content')
    <div id="remote-learning-request">
        <remote-learning-request></remote-learning-request>
    </div>
@endsection

@section('scripts')
    <script src="{{ mix('js/remote_learning_request.js') }}"></script>
@endsection