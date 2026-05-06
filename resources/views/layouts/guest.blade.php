<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'trena') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                darkMode: 'class',
                theme: {
                    extend: {
                        fontFamily: {
                            sans: ['Outfit', 'sans-serif'],
                        },
                    }
                }
            }
        </script>
    </head>
    <body class="font-sans text-gray-900 antialiased overflow-hidden">
        <div class="min-h-screen relative flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
            <!-- Background Image -->
            <div class="absolute inset-0 z-0">
                <img src="{{ asset('images/hero.png') }}" alt="Gym Background" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gray-950/80 backdrop-blur-sm"></div>
            </div>

            <div class="relative z-10 w-full flex flex-col items-center">
                <div class="mb-8 hover:scale-110 transition-transform duration-300">
                    <a href="/">
                        <x-application-logo class="w-24 h-24 drop-shadow-2xl" />
                    </a>
                </div>

                <div class="w-full sm:max-w-md px-8 py-10 bg-white dark:bg-gray-900/90 shadow-2xl backdrop-blur-md overflow-hidden rounded-[2.5rem] border border-gray-100 dark:border-gray-800">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </body>
</html>
