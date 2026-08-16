<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-[#080c14] text-slate-200 antialiased font-sans">
    <livewire:layout.navigation />
    {{ $slot }}
    
    @livewireScripts
</body>
</html>
