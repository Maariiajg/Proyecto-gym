<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'GymMaster') }}</title>

        <!-- Fonts: Inter from Google -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

        <!-- Scripts & Tailwind -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Livewire Styles -->
        @livewireStyles

        <style>
            body { font-family: 'Inter', sans-serif; }
            [x-cloak] { display: none !important; }
        </style>
    </head>
    <body class="font-sans antialiased bg-gray-50 dark:bg-gray-950 h-full overflow-hidden">
        <div class="flex h-full">
            <!-- Sidebar Navigation -->
            @include('layouts.navigation')

            <!-- Main Content Area -->
            <div class="flex-1 flex flex-col min-w-0 overflow-hidden">

                <!-- Page Header (Desktop & Mobile Content Header) -->
                @isset($header)
                    <header class="bg-white dark:bg-gray-900 border-b border-gray-100 dark:border-gray-800">
                        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-10 flex items-center justify-between">
                            <div class="flex items-center gap-4">
                                <h2 class="font-black text-2xl text-gray-900 dark:text-white tracking-tight">
                                    {{ $header }}
                                </h2>
                                <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest {{ auth()->user()->hasRole('admin') ? 'bg-red-100 text-red-600 dark:bg-red-900/30 dark:text-red-400' : 'bg-green-100 text-green-600 dark:bg-green-900/30 dark:text-green-400' }}">
                                    {{ auth()->user()->hasRole('admin') ? 'Administrador' : 'Cliente' }}
                                </span>
                            </div>
                        </div>
                    </header>
                @endisset

                <!-- Main Scrollable Content -->
                <main class="flex-1 overflow-y-auto relative focus:outline-none bg-gray-50 dark:bg-gray-950">
                    <div class="py-6">
                        {{ $slot }}
                    </div>
                </main>
            </div>
        </div>

        <!-- Livewire Scripts -->
        @livewireScripts
    </body>
</html>
