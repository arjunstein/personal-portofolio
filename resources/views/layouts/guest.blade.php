<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Portfolio Admin') }}</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-screen bg-gray-950 text-gray-100 antialiased">
        <div class="relative flex min-h-screen items-center justify-center overflow-hidden px-6 py-12">
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_top,_rgba(168,85,247,0.2),_transparent_30%),radial-gradient(circle_at_bottom_right,_rgba(99,102,241,0.22),_transparent_28%),linear-gradient(135deg,_rgba(17,24,39,1)_0%,_rgba(3,7,18,1)_100%)]"></div>
            <div class="absolute inset-0 opacity-30 [background-image:linear-gradient(rgba(255,255,255,0.04)_1px,transparent_1px),linear-gradient(90deg,rgba(255,255,255,0.04)_1px,transparent_1px)] [background-size:36px_36px]"></div>

            <div class="relative z-10 w-full max-w-md">
                <div class="mb-8 text-center">
                    <a href="{{ route('home') }}" wire:navigate class="inline-flex items-center gap-3">
                        <span class="text-3xl font-bold bg-gradient-to-r from-purple-400 via-fuchsia-300 to-indigo-400 bg-clip-text text-transparent">
                            Portfolio Admin
                        </span>
                    </a>
                    <p class="mt-3 text-sm text-gray-400">Private access for managing projects, skills, experience, and messages.</p>
                </div>

                <div class="rounded-3xl border border-white/10 bg-gray-900/75 p-8 shadow-2xl shadow-black/40 backdrop-blur-xl">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </body>
</html>
