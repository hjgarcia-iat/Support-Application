<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
            content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Remote Learning Request</title>
</head>
<body>
<h1>Remote Learning Request</h1>
<p><strong>Name</strong>: {{ request('name') }}</p>
<p><strong>Email</strong>: {{ request('email') }}</p>
<p><strong>School</strong>: {{ request('school') }}</p>
<p><strong>District</strong>: {{ request('district') }}</p>
<p><strong>District</strong>: {{ request('state') }}</p>
<ul>
    @foreach(request('units') as $unit)
        <li>{{ $unit }}</li>
    @endforeach
</ul>
</body>
</html>