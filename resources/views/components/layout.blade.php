<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Rateio' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans bg-app-gradient min-h-screen flex flex-col justify-between text-slate-800 antialiased selection:bg-indigo-500 selection:text-white">
    
    {{ $slot }}

</body>
</html>
