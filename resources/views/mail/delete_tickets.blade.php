<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
            content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tickets Deleted</title>
</head>
<body>
<h1>Tickets Deleted</h1>

@if($count > 1)
    <p>{{$count}} tickets were deleted.</p>
@elseif($count == 1)
    <p>1 ticket was deleted from the system.</p>
@endif
</body>
</html>