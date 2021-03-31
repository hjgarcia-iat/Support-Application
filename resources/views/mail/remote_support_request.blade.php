<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
            content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Student Request Help Form</title>
</head>
<body>
<h1>Student Request Help Form</h1>

<p><strong>Name</strong>: {{ $name }}</p>
<p><strong>Email</strong>: {{ $email }}</p>
<p><strong>Student Name</strong>: {{ $student_name }}</p>
<p><strong>Teacher Name</strong>: {{ $teacher_name }}</p>
<p><strong>District</strong>: {{ $district }}</p>
<p><strong>State</strong>: {{ $state }}</p>
@isset($subject)
    <p><strong>Subject</strong>: {{ $subject }}</p>
@endisset
@isset($comment)
    <p><strong>Comment</strong>: <br> {{ $comment }}</p>
@endisset
</body>
</html>