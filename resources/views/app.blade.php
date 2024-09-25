<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-white">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @routes()
    @vite('resources/js/app.js')
    @inertiaHead
    <title>{{ config('app.name') }}</title>
</head>

<body class="h-full">
    @inertia
</body>

</html>