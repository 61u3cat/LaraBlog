<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>forgot password</title>
</head>

<body>

{{-- this link content is sending via Mail/content --}}
    your reset link is a : 
    <a
        href="{{ url('/') }}/reset-password/{{ $email . '/' . $token }}">
        {{ url('/') }}/reset-password/{{ $email . '/' . $token }}
    </a>

</body>

</html>
