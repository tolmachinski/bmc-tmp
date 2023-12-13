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
<p>Subject:{{ $loanProgram->title}}</p>

<br>
<p><b>Question: </b></p>
<p>Name: {{ $question->name }}</p>
<p>Email: {{ $question->email }}</p>
<p>Contact number: {{ $question->contact }}</p>
<p>Question: {{ $question->question }}</p>
    
</body>
</html>