<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'TRENA ELITE') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,700,900|outfit:300,400,600,900" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script src="https://cdn.tailwindcss.com"></script>

        <style>
            .glass {
                background: rgba(255, 255, 255, 0.03);
                backdrop-filter: blur(12px);
                -webkit-backdrop-filter: blur(12px);
                border: 1px solid rgba(255, 255, 255, 0.1);
            }
            .indigo-glow {
                box-shadow: 0 0 40px rgba(99, 102, 241, 0.15);
            }
            /* Fix for dropdown visibility */
            select option {
                background-color: white !important;
                color: black !important;
            }
        </style>
    </head>
    <body class="font-sans antialiased bg-slate-950 text-slate-100 selection:bg-indigo-500 selection:text-white">
        <div class="min-h-screen relative flex flex-col sm:justify-center items-center pt-6 sm:pt-0 overflow-hidden">
            <!-- Dynamic Background -->
            <div class="absolute inset-0 z-0">
                <div class="absolute top-0 left-0 w-full h-full bg-[radial-gradient(circle_at_50%_50%,rgba(99,102,241,0.1),transparent_70%)]"></div>
                <img src="https://images.unsplash.com/photo-1540497077202-7c8a3999166f?auto=format&fit=crop&q=80&w=2070" class="w-full h-full object-cover opacity-10 grayscale">
                <div class="absolute inset-0 bg-slate-950/80"></div>
            </div>

            <div class="relative z-10 w-full flex flex-col items-center px-4">
                <div class="mb-12">
                    <a href="/" class="flex flex-col items-center gap-4 group">
                        <div class="w-16 h-16 bg-indigo-600 rounded-[1.5rem] flex items-center justify-center font-black text-white text-3xl shadow-2xl shadow-indigo-500/20 group-hover:scale-110 transition-transform duration-500 italic">T</div>
                        <span class="text-2xl font-black tracking-tighter text-white uppercase italic">TRENA<span class="text-indigo-500 not-italic">ELITE</span></span>
                    </a>
                </div>

                <div class="w-full sm:max-w-md px-10 py-12 glass rounded-[3rem] shadow-2xl indigo-glow animate-scale-in">
                    {{ $slot }}
                </div>
                
                <p class="mt-8 text-[10px] font-black text-slate-600 uppercase tracking-[0.3em]">Sistema de Acceso Seguro &copy; 2026</p>
            </div>
        </div>
    </body>
</html>
