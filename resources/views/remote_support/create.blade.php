@extends('layout.app')@section('pageTitle','Student/Parent Support')
@section('content')
    <div id="student-request-form">
        <student-request-form></student-request-form>
    </div>
@endsection

@section('scripts')
    <script src="{{ mix('js/student_request.js') }}"></script>
@endsection