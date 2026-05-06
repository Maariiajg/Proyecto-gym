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
                        <p class="mt-2 text-indigo-200 max-w-md">Explora nuevas rutinas y descubre los mejores ejercicios para alcanzar tus objetivos hoy mismo.</p>
                    </div>
                    <div class="flex gap-3">
                        <a href="{{ route('exercises.index') }}" class="inline-flex items-center px-5 py-2.5 bg-white/20 hover:bg-white/30 text-white text-sm font-semibold rounded-xl transition-all backdrop-blur-sm border border-white/30">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                            Explorar Ejercicios
                        </a>
                        <a href="{{ route('routines.index') }}" class="inline-flex items-center px-5 py-2.5 bg-white text-indigo-700 text-sm font-semibold rounded-xl hover:bg-indigo-50 transition-all shadow-lg">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" /></svg>
                            Mis Rutinas
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
                    <p class="text-3xl font-extrabold text-gray-900 dark:text-white">{{ $stats['exercises'] }}</p>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1 font-medium">Ejercicios Disponibles</p>
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
                    <p class="text-3xl font-extrabold text-gray-900 dark:text-white">{{ $stats['routines'] }}</p>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1 font-medium">Rutinas Creadas</p>
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
                    <p class="text-3xl font-extrabold text-gray-900 dark:text-white">{{ $stats['completed_routines'] }}</p>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1 font-medium">Rutinas Completadas</p>
                </div>
            </div>

            <!-- Two-column layout -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <!-- Recent Registrations -->
                <div class="lg:col-span-2 bg-white dark:bg-gray-900 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-800">
                    <div class="flex items-center justify-between p-6 border-b border-gray-100 dark:border-gray-800">
                        <div>
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white">Rutinas Destacadas</h3>
                            <p class="text-xs text-gray-500 mt-0.5">Explora las rutinas más populares</p>
                        </div>
                        <a href="{{ route('routines.index') }}" class="text-sm font-semibold text-indigo-600 hover:text-indigo-700 transition-colors">Ver todas →</a>
                    </div>
                    <div class="divide-y divide-gray-50 dark:divide-gray-800">
                        @forelse($recentRoutines as $routine)
                        @php
                            $colors = ['indigo', 'orange', 'emerald', 'purple', 'blue', 'pink'];
                            $color = $colors[$loop->index % count($colors)];
                        @endphp
                        <div class="flex items-center justify-between px-6 py-4 hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors cursor-pointer" onclick="window.location.href='{{ route('routines.show', $routine) }}'">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-full bg-{{ $color }}-100 dark:bg-{{ $color }}-900/30 flex items-center justify-center text-xl flex-shrink-0">
                                    💪
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-gray-900 dark:text-white">{{ $routine->name }}</p>
                                    <p class="text-xs text-gray-500 mt-0.5">Por {{ $routine->creator->name ?? 'Sistema' }} · {{ $routine->exercises()->count() }} ejercicios</p>
                                </div>
                            </div>
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-400">
                                Rutina
                            </span>
                        </div>
                        @empty
                        <div class="p-6 text-center text-gray-500">No hay rutinas disponibles aún.</div>
                        @endforelse
                    </div>
                </div>

                <!-- Right column -->
                <div class="space-y-6">
                    <!-- Upcoming Classes -->
                    <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-800 p-6">
                        <div class="flex justify-between items-center mb-5">
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white">Tus Objetivos (Semana)</h3>
                            <a href="{{ route('planner.index') }}" class="text-sm font-semibold text-indigo-600 hover:text-indigo-700 transition-colors">Editar Plan →</a>
                        </div>
                        <div class="space-y-4">
                            @php
                                // Solo mostramos los primeros 3 días que tengan rutina asignada, o si no hay ninguno, un mensaje
                                $daysToShow = $weeklyPlans->keys()->take(3);
                            @endphp
                                                       @forelse($daysToShow as $day)
                                @php $plan = $weeklyPlans[$day]; @endphp
                                <div class="flex items-center gap-4 p-3 rounded-xl bg-gray-50 dark:bg-gray-800 border border-gray-100 dark:border-gray-700 hover:bg-indigo-50 dark:hover:bg-indigo-900/20 transition-colors group relative">
                                    <div class="flex items-center gap-4 cursor-pointer flex-1" onclick="window.location.href='{{ route('routines.show', $plan->routine) }}'">
                                        <div class="text-center bg-white dark:bg-gray-900 rounded-lg px-3 py-2 shadow-sm min-w-16">
                                            <span class="block text-xs font-bold text-indigo-600 uppercase tracking-wider">{{ substr($day, 0, 3) }}</span>
                                            <span class="block text-xl font-extrabold text-gray-900 dark:text-white leading-tight">💪</span>
                                        </div>
                                        <div>
                                            <p class="text-sm font-bold text-gray-900 dark:text-white">{{ $plan->routine->name }}</p>
                                            <p class="text-xs text-gray-500 mt-0.5">{{ $plan->routine->exercises->count() }} ejercicios</p>
                                        </div>
                                    </div>
                                    <form action="{{ route('routines.complete', $plan->routine) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="p-2 bg-emerald-100 dark:bg-emerald-900/30 text-emerald-600 dark:text-emerald-400 rounded-lg hover:bg-emerald-500 hover:text-white transition-all shadow-sm relative z-20" title="Marcar como completada">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                        </button>
                                    </form>
                                </div>
                            @empty
                                <div class="p-4 text-center bg-gray-50 dark:bg-gray-800 rounded-xl border border-gray-100 dark:border-gray-700">
                                    <p class="text-sm text-gray-500 mb-2">Aún no has planificado tu semana.</p>
                                    <a href="{{ route('planner.index') }}" class="inline-block px-4 py-2 bg-indigo-600 text-white text-xs font-bold rounded-lg hover:bg-indigo-700">Comenzar a planificar</a>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <!-- Quick tip card -->
                    <div class="relative overflow-hidden bg-gradient-to-br from-gray-900 to-indigo-950 rounded-2xl p-6 text-white shadow-lg">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-indigo-500/20 rounded-full blur-2xl -mr-8 -mt-8"></div>
                        <div class="relative z-10">
                            <div class="inline-flex items-center px-2.5 py-1 bg-indigo-500/20 border border-indigo-500/30 rounded-full text-indigo-300 text-xs font-bold mb-3">
                                ✨ NOVEDAD
                            </div>
                            <h4 class="font-bold text-white mb-2">Crea tu propia rutina</h4>
                            <p class="text-xs text-gray-400 leading-relaxed mb-4">Combina tus ejercicios favoritos y crea una rutina personalizada que se adapte a tus necesidades.</p>
                            <a href="{{ route('routines.index') }}" class="inline-flex items-center text-xs font-bold text-indigo-400 hover:text-indigo-300 transition-colors">
                                Empezar ahora →
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>