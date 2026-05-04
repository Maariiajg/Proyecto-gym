<x-app-layout>
    <div class="py-8 bg-gray-50 dark:bg-gray-950 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Welcome Banner -->
            <div class="relative mb-8 overflow-hidden rounded-2xl bg-gradient-to-r from-indigo-600 via-violet-600 to-purple-700 p-8 shadow-2xl shadow-indigo-500/30">
                <!-- Decorative circles -->
                <div class="absolute -top-16 -right-16 w-72 h-72 bg-white/10 rounded-full blur-2xl"></div>
                <div class="absolute -bottom-20 -left-10 w-64 h-64 bg-purple-400/20 rounded-full blur-3xl"></div>

                <div class="relative z-10 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                    <div>
                        <p class="text-indigo-200 text-sm font-medium mb-1">👋 Bienvenido de vuelta</p>
                        <h1 class="text-3xl font-extrabold text-white tracking-tight">{{ Auth::user()->name }}</h1>
                        <p class="mt-2 text-indigo-200 max-w-md">Aquí tienes el resumen de actividad del gimnasio. Tienes <strong class="text-white">5 nuevas inscripciones</strong> esta semana.</p>
                    </div>
                    <div class="flex gap-3">
                        <a href="{{ route('exercises.index') }}" class="inline-flex items-center px-5 py-2.5 bg-white/20 hover:bg-white/30 text-white text-sm font-semibold rounded-xl transition-all backdrop-blur-sm border border-white/30">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                            Ejercicios
                        </a>
                        <a href="{{ route('users.index') }}" class="inline-flex items-center px-5 py-2.5 bg-white text-indigo-700 text-sm font-semibold rounded-xl hover:bg-indigo-50 transition-all shadow-lg">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                            Usuarios
                        </a>
                    </div>
                </div>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
                <!-- Card: Socios -->
                <div class="bg-white dark:bg-gray-900 rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-gray-800 hover:shadow-lg hover:-translate-y-0.5 transition-all duration-200">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-2.5 bg-blue-50 dark:bg-blue-900/30 rounded-xl">
                            <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        <span class="inline-flex items-center text-xs font-bold text-emerald-600 bg-emerald-50 dark:bg-emerald-900/30 px-2.5 py-1 rounded-full">
                            ↑ 12%
                        </span>
                    </div>
                    <p class="text-3xl font-extrabold text-gray-900 dark:text-white">1,284</p>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1 font-medium">Socios Activos</p>
                </div>

                <!-- Card: Ingresos -->
                <div class="bg-white dark:bg-gray-900 rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-gray-800 hover:shadow-lg hover:-translate-y-0.5 transition-all duration-200">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-2.5 bg-violet-50 dark:bg-violet-900/30 rounded-xl">
                            <svg class="w-5 h-5 text-violet-600 dark:text-violet-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <span class="inline-flex items-center text-xs font-bold text-emerald-600 bg-emerald-50 dark:bg-emerald-900/30 px-2.5 py-1 rounded-full">
                            ↑ 8%
                        </span>
                    </div>
                    <p class="text-3xl font-extrabold text-gray-900 dark:text-white">€12,450</p>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1 font-medium">Ingresos del Mes</p>
                </div>

                <!-- Card: Asistencia -->
                <div class="bg-white dark:bg-gray-900 rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-gray-800 hover:shadow-lg hover:-translate-y-0.5 transition-all duration-200">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-2.5 bg-orange-50 dark:bg-orange-900/30 rounded-xl">
                            <svg class="w-5 h-5 text-orange-600 dark:text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                        </div>
                        <span class="inline-flex items-center text-xs font-bold text-red-500 bg-red-50 dark:bg-red-900/30 px-2.5 py-1 rounded-full">
                            ↓ 2%
                        </span>
                    </div>
                    <p class="text-3xl font-extrabold text-gray-900 dark:text-white">142</p>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1 font-medium">Asistencia Hoy</p>
                </div>

                <!-- Card: Clases -->
                <div class="bg-white dark:bg-gray-900 rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-gray-800 hover:shadow-lg hover:-translate-y-0.5 transition-all duration-200">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-2.5 bg-teal-50 dark:bg-teal-900/30 rounded-xl">
                            <svg class="w-5 h-5 text-teal-600 dark:text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <span class="inline-flex items-center text-xs font-bold text-gray-400 bg-gray-50 dark:bg-gray-800 px-2.5 py-1 rounded-full">
                            Sin cambios
                        </span>
                    </div>
                    <p class="text-3xl font-extrabold text-gray-900 dark:text-white">24</p>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1 font-medium">Clases Activas</p>
                </div>
            </div>

            <!-- Two-column layout -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <!-- Recent Registrations -->
                <div class="lg:col-span-2 bg-white dark:bg-gray-900 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-800">
                    <div class="flex items-center justify-between p-6 border-b border-gray-100 dark:border-gray-800">
                        <div>
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white">Inscripciones Recientes</h3>
                            <p class="text-xs text-gray-500 mt-0.5">Últimas altas de socios</p>
                        </div>
                        <a href="{{ route('users.index') }}" class="text-sm font-semibold text-indigo-600 hover:text-indigo-700 transition-colors">Ver todos →</a>
                    </div>
                    <div class="divide-y divide-gray-50 dark:divide-gray-800">
                        @foreach([
                            ['initials' => 'JD', 'name' => 'Juan Díaz', 'plan' => 'Premium', 'time' => 'Hace 2 horas', 'status' => 'activo', 'color' => 'indigo'],
                            ['initials' => 'ML', 'name' => 'María López', 'plan' => 'Básico', 'time' => 'Hace 5 horas', 'status' => 'activo', 'color' => 'purple'],
                            ['initials' => 'RG', 'name' => 'Roberto García', 'plan' => 'Prueba', 'time' => 'Ayer', 'status' => 'pendiente', 'color' => 'orange'],
                            ['initials' => 'CS', 'name' => 'Carla Sánchez', 'plan' => 'Premium', 'time' => 'Hace 2 días', 'status' => 'activo', 'color' => 'pink'],
                        ] as $member)
                        <div class="flex items-center justify-between px-6 py-4 hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-full bg-{{ $member['color'] }}-100 dark:bg-{{ $member['color'] }}-900/30 flex items-center justify-center text-{{ $member['color'] }}-700 dark:text-{{ $member['color'] }}-400 font-bold text-sm flex-shrink-0">
                                    {{ $member['initials'] }}
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-gray-900 dark:text-white">{{ $member['name'] }}</p>
                                    <p class="text-xs text-gray-500 mt-0.5">Plan {{ $member['plan'] }} · {{ $member['time'] }}</p>
                                </div>
                            </div>
                            @if($member['status'] === 'activo')
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-emerald-50 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-400">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Activo
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-amber-50 dark:bg-amber-900/30 text-amber-700 dark:text-amber-400">
                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span> Pendiente
                                </span>
                            @endif
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Right column -->
                <div class="space-y-6">
                    <!-- Upcoming Classes -->
                    <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-800 p-6">
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-5">Próximas Clases</h3>
                        <div class="space-y-4">
                            <div class="flex items-center gap-4 p-3 rounded-xl bg-indigo-50 dark:bg-indigo-900/20 border border-indigo-100 dark:border-indigo-800">
                                <div class="text-center bg-white dark:bg-gray-900 rounded-lg px-3 py-2 shadow-sm min-w-16">
                                    <span class="block text-xs font-bold text-indigo-600 uppercase tracking-wider">Hoy</span>
                                    <span class="block text-xl font-extrabold text-gray-900 dark:text-white leading-tight">18:00</span>
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-gray-900 dark:text-white">Crossfit Avanzado</p>
                                    <p class="text-xs text-gray-500 mt-0.5">Coach: Alex Torres</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-4 p-3 rounded-xl bg-gray-50 dark:bg-gray-800 border border-gray-100 dark:border-gray-700">
                                <div class="text-center bg-white dark:bg-gray-900 rounded-lg px-3 py-2 shadow-sm min-w-16">
                                    <span class="block text-xs font-bold text-gray-500 uppercase tracking-wider">Hoy</span>
                                    <span class="block text-xl font-extrabold text-gray-900 dark:text-white leading-tight">19:30</span>
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-gray-900 dark:text-white">Yoga & Mindfulness</p>
                                    <p class="text-xs text-gray-500 mt-0.5">Coach: Sara Moon</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-4 p-3 rounded-xl bg-gray-50 dark:bg-gray-800 border border-gray-100 dark:border-gray-700">
                                <div class="text-center bg-white dark:bg-gray-900 rounded-lg px-3 py-2 shadow-sm min-w-16">
                                    <span class="block text-xs font-bold text-gray-500 uppercase tracking-wider">Mañana</span>
                                    <span class="block text-xl font-extrabold text-gray-900 dark:text-white leading-tight">09:00</span>
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-gray-900 dark:text-white">Spinning</p>
                                    <p class="text-xs text-gray-500 mt-0.5">Coach: Marcos Vidal</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick tip card -->
                    <div class="relative overflow-hidden bg-gradient-to-br from-gray-900 to-indigo-950 rounded-2xl p-6 text-white shadow-lg">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-indigo-500/20 rounded-full blur-2xl -mr-8 -mt-8"></div>
                        <div class="relative z-10">
                            <div class="inline-flex items-center px-2.5 py-1 bg-indigo-500/20 border border-indigo-500/30 rounded-full text-indigo-300 text-xs font-bold mb-3">
                                ✨ NOVEDAD
                            </div>
                            <h4 class="font-bold text-white mb-2">Exporta reportes a PDF</h4>
                            <p class="text-xs text-gray-400 leading-relaxed mb-4">Genera reportes de membresías y asistencia directamente desde el panel de administración.</p>
                            <a href="#" class="inline-flex items-center text-xs font-bold text-indigo-400 hover:text-indigo-300 transition-colors">
                                Saber más →
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>