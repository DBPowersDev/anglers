@php
$nonce = bin2hex(random_bytes(16)); // ノンスを生成
session(['csp_nonce' => $nonce]); // セッションに保存
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-white">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @routes(nonce: $nonce)
    @vite('resources/js/app.js')
    @inertiaHead
    <title>{{ config('app.name') }}</title>
</head>

<body class="h-full">
    @inertia
</body>

</html>