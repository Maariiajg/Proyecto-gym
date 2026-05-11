<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
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
            [x-cloak] { display: none !important; }
        </style>
    </head>
    <body class="font-sans antialiased bg-slate-950 text-slate-100 h-full overflow-hidden selection:bg-indigo-500 selection:text-white">
        <style>
            .glass {
                background: rgba(255, 255, 255, 0.03);
                backdrop-filter: blur(12px);
                -webkit-backdrop-filter: blur(12px);
                border: 1px solid rgba(255, 255, 255, 0.1);
            }
            .text-gradient {
                background: linear-gradient(135deg, #fff 0%, #818cf8 100%);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
            }
            .indigo-glow {
                box-shadow: 0 0 20px rgba(99, 102, 241, 0.2);
            }
            ::-webkit-scrollbar { width: 8px; }
            ::-webkit-scrollbar-track { background: transparent; }
            ::-webkit-scrollbar-thumb { background: rgba(255, 255, 255, 0.1); border-radius: 4px; }
            ::-webkit-scrollbar-thumb:hover { background: rgba(255, 255, 255, 0.2); }

            /* Fix for dropdown visibility */
            select option {
                background-color: white !important;
                color: black !important;
            }
        </style>
        <div class="flex h-full">
            <!-- Sidebar Navigation -->
            @include('layouts.navigation')

            <!-- Main Content Area -->
            <div class="flex-1 flex flex-col min-w-0 overflow-hidden">

                <!-- Page Header (Desktop & Mobile Content Header) -->
                @isset($header)
                    <header class="bg-slate-950/50 backdrop-blur-md border-b border-white/5">
                        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-10 flex items-center justify-between">
                            <div class="flex items-center gap-4">
                                <h2 class="font-black text-2xl text-white tracking-tight uppercase">
                                    {{ $header }}
                                </h2>
                                <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest {{ auth()->user()->hasRole('admin') ? 'bg-red-500/20 text-red-400 border border-red-500/30' : 'bg-emerald-500/20 text-emerald-400 border border-emerald-500/30' }}">
                                    {{ auth()->user()->hasRole('admin') ? 'Administrador' : 'Atleta Elite' }}
                                </span>
                            </div>
                        </div>
                    </header>
                @endisset

                <!-- Main Scrollable Content -->
                <main class="flex-1 overflow-y-auto relative focus:outline-none bg-slate-950">
                    <div class="py-6">
                        @if (session()->has('message'))
                            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-10 mb-6">
                                <div class="p-4 bg-indigo-500/10 border border-indigo-500/20 text-indigo-400 rounded-2xl flex items-center gap-3 animate-pulse shadow-lg indigo-glow">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    <span class="font-bold italic">{{ session('message') }}</span>
                                </div>
                            </div>
                        @endif
                        {{ $slot }}
                    </div>
                </main>
            </div>
        </div>
    </body>
</html>
