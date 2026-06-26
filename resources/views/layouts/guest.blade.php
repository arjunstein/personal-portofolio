<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-screen bg-gray-900 font-sans text-gray-100 antialiased">
        <div class="relative flex min-h-screen items-center justify-center overflow-hidden px-6 py-12">
            <div class="absolute inset-0 bg-gradient-to-br from-purple-900/20 to-indigo-900/20"></div>
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_top,_rgba(168,85,247,0.18),_transparent_35%),radial-gradient(circle_at_bottom_right,_rgba(99,102,241,0.18),_transparent_30%)]"></div>

            <div class="relative z-10 w-full max-w-md">
                <div class="mb-8 text-center">
                    <a href="{{ route('home') }}" wire:navigate class="inline-flex items-center gap-3">
                        <span class="text-3xl font-bold bg-gradient-to-r from-purple-400 to-indigo-400 bg-clip-text text-transparent">
                            Portfolio Admin
                        </span>
                    </a>
                    <p class="mt-3 text-sm text-gray-400">Sign in to manage your portfolio.</p>
                </div>

                <div class="rounded-2xl border border-gray-800 bg-gray-900/80 p-8 shadow-2xl backdrop-blur-sm">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </body>
</html>
