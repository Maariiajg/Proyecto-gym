<x-app-layout>
    <x-slot name="header">
        {{ auth()->user()->hasRole('admin') ? 'Panel de Gestión' : 'Panel del Atleta' }}
    </x-slot>

    <div class="py-8 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Welcome Banner Premium -->
            <div class="relative mb-10 overflow-hidden rounded-[2.5rem] bg-gradient-to-br from-indigo-600 via-indigo-700 to-slate-900 p-10 shadow-2xl shadow-indigo-500/20 group">
                <!-- Decorative effects -->
                <div class="absolute -top-24 -right-24 w-96 h-96 bg-white/10 rounded-full blur-3xl group-hover:scale-110 transition-transform duration-700"></div>
                <div class="absolute -bottom-32 -left-20 w-80 h-80 bg-indigo-400/20 rounded-full blur-3xl"></div>

                <div class="relative z-10 flex flex-col lg:flex-row items-start lg:items-center justify-between gap-8">
                    <div>
                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 border border-white/20 text-white text-[10px] font-bold tracking-widest uppercase mb-4">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                            Estado: {{ auth()->user()->hasRole('admin') ? 'Sistema Operativo' : 'Entrenamiento Activo' }}
                        </div>
                        <h1 class="text-4xl md:text-5xl font-black text-white tracking-tighter uppercase mb-3">
                            {{ auth()->user()->hasRole('admin') ? 'Gestión' : 'Bienvenido' }}, <span class="text-indigo-200">{{ Auth::user()->name }}</span>
                        </h1>
                        <p class="text-indigo-100/80 max-w-xl text-lg font-medium leading-relaxed">
                            @role('admin')
                                Central de control para la gestión de usuarios, biblioteca de ejercicios y optimización de rutinas del sistema.
                            @else
                                Mantén la disciplina. Estás visualizando tus estadísticas en tiempo real basadas en tus últimos entrenamientos.
                            @endrole
                        </p>
                    </div>
                    <div class="flex flex-wrap gap-4">
                        @role('admin')
                            <a href="{{ route('users.index') }}" class="px-8 py-3.5 bg-white text-indigo-700 font-bold rounded-2xl hover:bg-indigo-50 transition-all shadow-xl flex items-center gap-2 group/btn">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                                Gestionar Usuarios
                            </a>
                        @else
                            <a href="{{ route('exercises.index') }}" class="glass px-8 py-3.5 text-white font-bold rounded-2xl hover:bg-white/10 transition-all flex items-center gap-2 group/btn">
                                <svg class="w-5 h-5 group-hover/btn:rotate-12 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                                Explorar Ejercicios
                            </a>
                            <a href="{{ route('routines.index') }}" class="px-8 py-3.5 bg-white text-indigo-700 font-bold rounded-2xl hover:bg-indigo-50 transition-all shadow-xl flex items-center gap-2 group/btn">
                                <svg class="w-5 h-5 group-hover/btn:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2" /></svg>
                                Mis Rutinas
                            </a>
                        @endrole
                    </div>
                </div>
            </div>

            <!-- Stats Grid Premium -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
                @role('admin')
                    <!-- Usuarios -->
                    <div class="glass p-6 rounded-[2rem] hover:border-indigo-500/30 transition-all duration-300 group">
                        <div class="flex items-center justify-between mb-6">
                            <div class="p-3 bg-indigo-500/10 rounded-2xl text-indigo-400 group-hover:scale-110 transition-transform">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                            </div>
                        </div>
                        <p class="text-4xl font-black text-white tracking-tighter">{{ $stats['users'] }}</p>
                        <p class="text-xs text-slate-500 font-bold uppercase tracking-widest mt-1">Usuarios Totales</p>
                    </div>
                @endrole

                <!-- Ejercicios -->
                <div class="glass p-6 rounded-[2rem] hover:border-indigo-500/30 transition-all duration-300 group">
                    <div class="flex items-center justify-between mb-6">
                        <div class="p-3 bg-indigo-500/10 rounded-2xl text-indigo-400 group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        </div>
                    </div>
                    <p class="text-4xl font-black text-white tracking-tighter">{{ $stats['exercises'] }}</p>
                    <p class="text-xs text-slate-500 font-bold uppercase tracking-widest mt-1">Biblioteca</p>
                </div>

                <!-- Rutinas (Sistema para Admin, Mis Rutinas para Cliente) -->
                <div class="glass p-6 rounded-[2rem] hover:border-indigo-500/30 transition-all duration-300 group">
                    <div class="flex items-center justify-between mb-6">
                        <div class="p-3 bg-indigo-500/10 rounded-2xl text-indigo-400 group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2" /></svg>
                        </div>
                    </div>
                    <p class="text-4xl font-black text-white tracking-tighter">{{ $stats['routines'] }}</p>
                    <p class="text-xs text-slate-500 font-bold uppercase tracking-widest mt-1">{{ auth()->user()->hasRole('admin') ? 'Rutinas Sistema' : 'Mis Rutinas' }}</p>
                </div>

                @unless(auth()->user()->hasRole('admin'))
                    <!-- Completadas (Solo Cliente) -->
                    <div class="glass p-6 rounded-[2rem] hover:border-indigo-500/30 transition-all duration-300 group">
                        <div class="flex items-center justify-between mb-6">
                            <div class="p-3 bg-indigo-500/10 rounded-2xl text-indigo-400 group-hover:scale-110 transition-transform">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                        </div>
                        <p class="text-4xl font-black text-white tracking-tighter">{{ $stats['completed_routines'] }}</p>
                        <p class="text-xs text-slate-500 font-bold uppercase tracking-widest mt-1">Entrenamientos</p>
                    </div>
                @endunless
            </div>

            <!-- Dashboard Layout Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <!-- Left Column -->
                <div class="lg:col-span-2 space-y-8">
                    
                    @unless(auth()->user()->hasRole('admin'))
                        <!-- Progress Chart (Solo Cliente) -->
                        <div class="glass rounded-[2.5rem] overflow-hidden">
                            <div class="p-8 border-b border-white/5 flex items-center justify-between">
                                <div>
                                    <h3 class="text-xl font-bold text-white uppercase tracking-tight">Volumen de Entrenamiento</h3>
                                    <p class="text-xs text-slate-500 font-bold uppercase tracking-widest mt-1">Carga total levantada (kg) - Últimos 12 días</p>
                                </div>
                            </div>
                            <div class="p-8 h-64 flex items-end gap-2 group">
                                @php 
                                    $maxVolume = count($fullChartData) > 0 ? max(max($fullChartData), 1) : 1; 
                                @endphp
                                @foreach($fullChartData as $date => $volume)
                                    <div class="flex-1 bg-indigo-500/20 rounded-t-lg relative group/bar hover:bg-indigo-500/40 transition-all duration-300" style="height: {{ ($volume / $maxVolume) * 90 + 5 }}%">
                                        <div class="absolute -top-10 left-1/2 -translate-x-1/2 bg-indigo-600 text-[10px] font-black px-2 py-1 rounded opacity-0 group-hover/bar:opacity-100 transition-opacity whitespace-nowrap z-30">
                                            {{ number_format($volume, 0) }}kg
                                            <span class="block text-[8px] opacity-70">{{ \Carbon\Carbon::parse($date)->format('d/m') }}</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endunless

                    <!-- Recent Routines (System Routines) -->
                    <div class="glass rounded-[2.5rem] overflow-hidden">
                        <div class="p-8 border-b border-white/5 flex items-center justify-between">
                            <div>
                                <h3 class="text-xl font-bold text-white uppercase tracking-tight">Rutinas del Sistema</h3>
                                <p class="text-xs text-slate-500 font-bold uppercase tracking-widest mt-1">Configuración actual de sesiones maestras</p>
                            </div>
                            <a href="{{ route('routines.index') }}" class="text-xs font-black text-indigo-400 hover:text-indigo-300 uppercase tracking-widest transition-colors">Ver todas →</a>
                        </div>
                        <div class="divide-y divide-white/5">
                            @forelse($recentRoutines as $routine)
                                <div class="px-8 py-5 flex items-center justify-between hover:bg-white/5 transition-colors cursor-pointer group" onclick="window.location.href='{{ route('routines.show', $routine) }}'">
                                    <div class="flex items-center gap-5">
                                        <div class="w-12 h-12 bg-slate-900 rounded-2xl flex items-center justify-center text-2xl group-hover:scale-110 transition-transform shadow-inner">💪</div>
                                        <div>
                                            <p class="text-white font-bold text-lg group-hover:text-indigo-400 transition-colors">{{ $routine->name }}</p>
                                            <p class="text-xs text-slate-500 font-bold uppercase tracking-widest mt-0.5">{{ $routine->exercises->count() }} Ejercicios · {{ $routine->difficulty_level ?? 'Intermedio' }}</p>
                                        </div>
                                    </div>
                                    <svg class="w-6 h-6 text-slate-700 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                </div>
                            @empty
                                <div class="p-10 text-center text-slate-500 font-bold uppercase tracking-widest italic">No hay rutinas disponibles aún.</div>
                            @endforelse
                        </div>
                    </div>

                    @role('admin')
                        <!-- Seccion Adicional para Admin: Usuarios Recientes -->
                        <div class="glass rounded-[2.5rem] overflow-hidden">
                            <div class="p-8 border-b border-white/5">
                                <h3 class="text-xl font-bold text-white uppercase tracking-tight">Gestión Directa</h3>
                                <p class="text-xs text-slate-500 font-bold uppercase tracking-widest mt-1">Accesos rápidos de administración</p>
                            </div>
                            <div class="p-8 grid grid-cols-1 md:grid-cols-2 gap-6">
                                <a href="{{ route('users.create') }}" class="p-6 rounded-3xl bg-white/5 border border-white/5 hover:border-indigo-500/30 transition-all group">
                                    <h4 class="text-white font-bold mb-2 flex items-center gap-2">
                                        <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" /></svg>
                                        Nuevo Usuario
                                    </h4>
                                    <p class="text-xs text-slate-500">Alta rápida de nuevos atletas en el sistema.</p>
                                </a>
                                <a href="{{ route('exercises.create') }}" class="p-6 rounded-3xl bg-white/5 border border-white/5 hover:border-indigo-500/30 transition-all group">
                                    <h4 class="text-white font-bold mb-2 flex items-center gap-2">
                                        <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" /></svg>
                                        Nuevo Ejercicio
                                    </h4>
                                    <p class="text-xs text-slate-500">Añadir movimientos técnicos a la biblioteca.</p>
                                </a>
                            </div>
                        </div>
                    @endrole
                </div>

                <!-- Right Column -->
                <div class="space-y-8">
                    
                    @role('admin')
                        <!-- Admin Quick Stats/Links -->
                        <div class="glass rounded-[2.5rem] p-8 border-indigo-500/20 border">
                            <h3 class="text-lg font-bold text-white uppercase tracking-tight mb-6">Estado del Sistema</h3>
                            <div class="space-y-6">
                                <div class="flex items-center justify-between">
                                    <span class="text-xs font-bold text-slate-400 uppercase tracking-widest">Servidor</span>
                                    <span class="px-2 py-1 bg-emerald-500/20 text-emerald-400 text-[10px] font-black rounded-lg uppercase">Online</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-xs font-bold text-slate-400 uppercase tracking-widest">Base de Datos</span>
                                    <span class="px-2 py-1 bg-emerald-500/20 text-emerald-400 text-[10px] font-black rounded-lg uppercase">Sincronizada</span>
                                </div>
                            </div>
                            <div class="mt-8 pt-8 border-t border-white/5">
                                <a href="{{ route('memberships.index') }}" class="w-full py-4 bg-indigo-600 text-white text-[10px] font-black uppercase tracking-[0.2em] rounded-2xl hover:bg-indigo-500 transition-all text-center block shadow-lg shadow-indigo-600/20">
                                    Membresías Activadas
                                </a>
                            </div>
                        </div>
                    @else
                        <!-- Weekly Plan Widget (Solo Cliente) -->
                        <div class="glass rounded-[2.5rem] p-8 border-indigo-500/20 border">
                            <div class="flex items-center justify-between mb-8">
                                <h3 class="text-lg font-bold text-white uppercase tracking-tight">Tu Plan Semanal</h3>
                                <a href="{{ route('planner.index') }}" class="p-2 bg-white/5 hover:bg-white/10 rounded-xl transition-colors">
                                    <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </a>
                            </div>
                            
                            <div class="space-y-4">
                                @forelse($weeklyPlans as $day => $plan)
                                    <div class="relative group">
                                        <div class="flex items-center gap-4 p-4 rounded-2xl bg-white/5 border border-white/5 hover:border-indigo-500/30 transition-all cursor-pointer" onclick="window.location.href='{{ route('routines.show', $plan->routine) }}'">
                                            <div class="w-14 h-14 bg-slate-900 rounded-xl flex flex-col items-center justify-center border border-white/5 group-hover:border-indigo-500/50 transition-colors">
                                                <span class="text-[10px] font-black text-indigo-400 uppercase leading-none mb-1">{{ substr(__($day), 0, 3) }}</span>
                                                <span class="text-xl leading-none">🏋️</span>
                                            </div>
                                            <div class="flex-1">
                                                <p class="text-sm font-bold text-white group-hover:text-indigo-400 transition-colors">{{ $plan->routine->name }}</p>
                                                <p class="text-[10px] text-slate-500 font-bold uppercase tracking-widest mt-1">{{ $plan->routine->exercises->count() }} Ejercicios</p>
                                            </div>
                                            <form action="{{ route('routines.complete', $plan->routine) }}" method="POST" class="relative z-20">
                                                @csrf
                                                <button type="submit" class="p-2.5 bg-emerald-500/10 text-emerald-400 rounded-xl hover:bg-emerald-500 hover:text-white transition-all">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                @empty
                                    <div class="p-6 text-center bg-white/5 rounded-2xl border border-dashed border-white/10">
                                        <p class="text-xs text-slate-500 font-bold uppercase tracking-widest mb-4">Sin planificar</p>
                                        <a href="{{ route('planner.index') }}" class="inline-block px-5 py-2 bg-indigo-600 text-white text-[10px] font-black uppercase tracking-widest rounded-xl hover:bg-indigo-500 transition-all">Configurar Semana</a>
                                    </div>
                                @endforelse
                            </div>
                        </div>

                        <!-- Personal Records (Solo Cliente) -->
                        <div class="glass rounded-[2.5rem] p-8">
                            <h3 class="text-lg font-bold text-white uppercase tracking-tight mb-6">Récords Personales</h3>
                            <div class="space-y-6">
                                @forelse($personalRecords as $pr)
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center gap-3">
                                            <div class="w-2 h-2 rounded-full bg-indigo-500 shadow-[0_0_10px_rgba(99,102,241,1)]"></div>
                                            <span class="text-xs font-bold text-slate-300 uppercase tracking-widest">{{ $pr->exercise->name }}</span>
                                        </div>
                                        <span class="text-lg font-black text-white">{{ number_format($pr->max_weight, 1) }}<span class="text-[10px] text-slate-500 ml-1">KG</span></span>
                                    </div>
                                @empty
                                    <p class="text-xs text-slate-500 font-bold uppercase tracking-widest text-center italic">Registra tu primer ejercicio para ver tus récords.</p>
                                @endforelse
                            </div>
                        </div>
                    @endrole

                    <!-- Quick Tip / System Status -->
                    <div class="relative overflow-hidden bg-indigo-600 rounded-[2.5rem] p-8 group">
                        <div class="absolute -top-10 -right-10 w-32 h-32 bg-white/10 rounded-full blur-2xl group-hover:scale-150 transition-transform duration-700"></div>
                        <div class="relative z-10">
                            <span class="text-[10px] font-black text-white/60 uppercase tracking-[0.3em] mb-4 block">{{ auth()->user()->hasRole('admin') ? 'Nota de Sistema' : 'Consejo Pro' }}</span>
                            <h4 class="text-xl font-bold text-white mb-3 tracking-tight">{{ auth()->user()->hasRole('admin') ? 'Optimización' : 'Sobrecarga Progresiva' }}</h4>
                            <p class="text-sm text-indigo-100/80 leading-relaxed mb-6">
                                {{ auth()->user()->hasRole('admin') 
                                    ? 'Asegúrate de revisar periódicamente la biblioteca de ejercicios para mantener los estándares técnicos actualizados.' 
                                    : 'Anotar tus pesos cada día te permite asegurar que estás mejorando sesión tras sesión. La data no miente.' }}
                            </p>
                            <div class="w-full h-1.5 bg-white/10 rounded-full overflow-hidden">
                                <div class="h-full bg-white rounded-full {{ auth()->user()->hasRole('admin') ? 'w-full' : 'w-3/4' }} shadow-[0_0_10px_rgba(255,255,255,0.5)]"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>