<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Access Request</title>
</head>
<body>
<h1>Access Request</h1>

<p>
    <strong>Customer First Name</strong>
    : {{ $first_name }}</p>

<p>
    <strong>Customer Last Name</strong>
    : {{ $last_name }}</p>

<p>
    <strong>Customer Email Address</strong>
    : {{ $email }}</p>

<p>
    <strong>Sales Representative Email Address</strong>
    : {{ $sales_rep }}</p>

<p>
    <strong>School District</strong>
    : {{ $school_district }}</p>

<p>
    <strong>School</strong>
    : {{ $school }}</p>

@isset($city)
    <p>
        <strong>City</strong>
        : {{ $city }}</p>
@endisset
@isset($state)
    <p>
        <strong>State</strong>
        : {{ $state }}</p>
@endisset
@isset($zip_code)
    <p>
        <strong>Zip Code</strong>
        : {{ $zip_code }}</p>
@endisset

<p>
    <strong>Resources</strong>
    :
</p>
<ul>
    @foreach($resources as $resource)
        <li>{{ $resource }}</li>
    @endforeach
</ul>

@if($access_type)
    <p>
        <strong>Access Length</strong>
        :{{ $access_type }}</p>
@endif

@if($version)
    <p>
        <strong>Version</strong>
        :{{ $version }}</p>
@endif

@if($ebooks)
    <p>
        <strong>E-Books</strong>
        :
    </p>
    <ul>
        @foreach($ebooks as $ebook)
            <li>{{ $ebook }}</li>
        @endforeach
    </ul>
@endif

<p>
    <strong>Time Frame</strong>
    :{{ $time_frame }}</p>

<p>
    <strong>Notes</strong>
    : {{ $note }}</p>
</body>
</html>