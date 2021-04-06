@extends('layout.app')
@section('pageTitle','Request Product Information')
@section('content')
    <div id="request-product-info-form">
        <request-product-info-form>
            @honeypot
        </request-product-info-form>
    </div>
@endsection

@section('scripts')
    <script src="{{ mix('js/request_product_info.js') }}"></script>
@endsection