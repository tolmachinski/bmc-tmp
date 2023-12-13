<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<body>

<a href="{{ route('home') }}" class="logo">
            <img src="{{ asset('images/logo-header.png') }}" width="137" height="75" alt="Black Mountain Capital Logo"/>
</a>
<p>Job:{{$career->title}}</p>
<p>Job Num: {{$career->id}}</p>
<br>
<p><b>Applicant Details: </b></p>
<p>Name: {{ $apply->name }}</p>
<p>Email: {{ $apply->email }}</p>
<p>Contact number: {{ $apply->phone }}</p>
<p>Remarks: {{ $apply->remarks }}</p>
    
</body>
</html>
