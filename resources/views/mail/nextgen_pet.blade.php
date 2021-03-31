<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
            content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Next Gen PET Fulfillment Inquiry</title>
</head>
<body>
<h1>Next Gen PET Fulfillment Inquiry</h1>
<p><strong>Institution Name</strong>: {{ $institution_name }}</p>
<p><strong>Name</strong>: {{ $name }}</p>
<p><strong>Email</strong>: {{ $email }}</p>
<p><strong>Inquiry</strong>: {{ $inquiry }}</p>
<p><strong>PO/Order Number</strong>: {{ $po_number }}</p>
@isset($comment)
    <p><strong>Comment</strong>: <br> {{ $comment }}</p>
@endisset
</body>
</html>