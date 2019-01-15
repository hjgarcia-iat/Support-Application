<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Digital Setup Information</title>
</head>
<body>
<h1>Digital Setup Information</h1>

<p><strong>Customer Name</strong>: {{ $name }}</p>
<p><strong>Customer Email</strong>: {{ $email }}</p>
<p><strong>Customer PO Number</strong>: {{ $po_number }}</p>
<p><strong>School District</strong>: {{ $district }}</p>
<p><strong>Start Date</strong>: {{ $start_date }}</p>
<p><strong>Curriculum</strong>: {{ $curriculum }}</p>

@if($district_manager == 'yes')
    <p><strong>District Manager Name</strong>: {{ $dm_name }}</p>
    <p><strong>District Manager Email</strong>: {{ $dm_email }}</p>
@endif

@if($district_manager == 'no')
    <h4>List of Teachers</h4>
    <ul>
        @foreach($teachers as $teacher)
            <li> {{ $teacher['name'] }} - {{ $teacher['email'] }} - {{ $teacher['school'] }}</li>
        @endforeach
    </ul>
@endif

</body>
</html>