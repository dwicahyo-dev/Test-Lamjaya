<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lamjaya</title>

    @include('layouts.stylesheet')
    @stack('extraStyles')
</head>

<body>

    {{ $slot }}

</body>

@routes
@include('layouts.javascript')
@stack('extraScripts')

</html>