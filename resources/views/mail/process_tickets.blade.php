<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
            content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible"
            content="ie=edge">
    <title>Access Request</title>
</head>
<body>
<h1>New Ticket Submitted</h1>

<p><strong>Reason</strong>: {{ $reason }}</p>
<p><strong>Name</strong>: {{ $name }}</p>
<p><strong>Email</strong>: {{ $email }}</p>
<p><strong>District</strong>: {{ $district }}</p>
<p><strong>Details</strong>: {{ $details }}</p>
@if(count($files) > 0)
    <p><strong>Files</strong>:</p>
    <ul>
    @foreach($files as $file)
        <li><strong>File</strong>: <a href="{{ Storage::disk('s3')->url("contact-request/$file->file") }}"
            target="_blank">View File</a></li>
    @endforeach
    </ul>
@endif

</body>
</html>