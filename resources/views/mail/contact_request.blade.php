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
<h1>Contact Submission</h1>

<p><strong>Reason</strong>: {{ $reason }}</p>
<p><strong>Name</strong>: {{ $name }}</p>
<p><strong>Email</strong>: {{ $email }}</p>
<p><strong>District</strong>: {{ $district }}</p>
<p><strong>Details</strong><br>: {{ $details }}</p>
<p><strong>File</strong><br>: <a href="{{ $file }}" target="_blank">View File</a></p>

</body>
</html>