<!-- Sidebar Component (Fixed/Permanent) -->
<div class="flex flex-col w-72 bg-slate-950 border-r border-white/5 shadow-2xl z-50">
    
    <!-- Sidebar Header (Logo) -->
    <div class="flex items-center h-24 px-8 border-b border-white/5">
        <div class="w-10 h-10 text-indigo-500">
            <x-application-logo />
        </div>
        <span class="ml-3 font-black text-xl tracking-tighter text-white uppercase italic">TRENA<span class="text-indigo-500 not-italic">ELITE</span></span>
    </div>

    <!-- Navigation Menu -->
    <div class="flex-1 px-4 py-8 space-y-10 overflow-y-auto">
        
        <!-- General Section -->
        <div>
            <h3 class="px-6 text-[10px] font-black text-indigo-400/60 uppercase tracking-[0.3em] mb-6">Principal</h3>
            <div class="space-y-2">
                <a href="{{ route('dashboard') }}" 
                   class="group flex items-center px-6 py-4 text-sm font-bold rounded-2xl transition-all duration-300 {{ request()->routeIs('dashboard') ? 'glass text-white shadow-lg indigo-glow' : 'text-slate-500 hover:text-white hover:bg-white/5' }}">
                    <svg class="mr-4 h-5 w-5 transition-transform group-hover:scale-110" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    Panel de Control
                </a>

                @role('admin')
                <a href="{{ route('users.index') }}" 
                   class="group flex items-center px-6 py-4 text-sm font-bold rounded-2xl transition-all duration-300 {{ request()->routeIs('users.*') ? 'glass text-white shadow-lg indigo-glow' : 'text-slate-500 hover:text-white hover:bg-white/5' }}">
                    <svg class="mr-4 h-5 w-5 transition-transform group-hover:scale-110" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    Usuarios
                </a>
                @endrole

                <a href="{{ route('exercises.index') }}" 
                   class="group flex items-center px-6 py-4 text-sm font-bold rounded-2xl transition-all duration-300 {{ request()->routeIs('exercises.*') ? 'glass text-white shadow-lg indigo-glow' : 'text-slate-500 hover:text-white hover:bg-white/5' }}">
                    <svg class="mr-4 h-5 w-5 transition-transform group-hover:scale-110" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                    Ejercicios
                </a>

                <a href="{{ route('routines.index') }}" 
                   class="group flex items-center px-6 py-4 text-sm font-bold rounded-2xl transition-all duration-300 {{ request()->routeIs('routines.*') ? 'glass text-white shadow-lg indigo-glow' : 'text-slate-500 hover:text-white hover:bg-white/5' }}">
                    <svg class="mr-4 h-5 w-5 transition-transform group-hover:scale-110" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                    </svg>
                    Rutinas
                </a>
            </div>
        </div>

        <!-- Personal Section -->
        <div>
            <h3 class="px-6 text-[10px] font-black text-indigo-400/60 uppercase tracking-[0.3em] mb-6">Mi Perfil</h3>
            <div class="space-y-2">
                <a href="{{ route('planner.index') }}" 
                   class="group flex items-center px-6 py-4 text-sm font-bold rounded-2xl transition-all duration-300 {{ request()->routeIs('planner.*') ? 'glass text-white shadow-lg indigo-glow' : 'text-slate-500 hover:text-white hover:bg-white/5' }}">
                    <svg class="mr-4 h-5 w-5 transition-transform group-hover:scale-110" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    Planificador
                </a>
                @unless(auth()->user()->hasRole('admin'))
                <a href="{{ route('progress.index') }}" 
                   class="group flex items-center px-6 py-4 text-sm font-bold rounded-2xl transition-all duration-300 {{ request()->routeIs('progress.*') ? 'glass text-white shadow-lg indigo-glow' : 'text-slate-500 hover:text-white hover:bg-white/5' }}">
                    <svg class="mr-4 h-5 w-5 transition-transform group-hover:scale-110" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                    Mi Progreso
                </a>
                @endunless
                <a href="{{ route('profile.edit') }}" 
                   class="group flex items-center px-6 py-4 text-sm font-bold rounded-2xl transition-all duration-300 {{ request()->routeIs('profile.*') ? 'glass text-white shadow-lg indigo-glow' : 'text-slate-500 hover:text-white hover:bg-white/5' }}">
                    <svg class="mr-4 h-5 w-5 transition-transform group-hover:scale-110" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    Configuración
                </a>
            </div>
        </div>
    </div>

    <!-- User Profile Footer -->
    <div class="p-6 border-t border-white/5 bg-slate-900/30">
        <div class="flex items-center p-4 rounded-2xl glass mb-6 group cursor-pointer">
            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-indigo-500 to-indigo-700 flex items-center justify-center font-black text-white shadow-lg shadow-indigo-500/20 group-hover:scale-110 transition-transform">
                {{ substr(Auth::user()->name, 0, 1) }}
            </div>
            <div class="ml-3 overflow-hidden">
                <p class="text-xs font-black text-white truncate uppercase tracking-tighter">{{ Auth::user()->name }}</p>
                <p class="text-[9px] font-black {{ auth()->user()->hasRole('admin') ? 'text-red-400' : 'text-indigo-400' }} truncate uppercase tracking-[0.2em] mt-0.5">{{ auth()->user()->hasRole('admin') ? 'ADMINISTRADOR' : 'ATLETA ELITE' }}</p>
            </div>
        </div>
        
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full flex items-center justify-center gap-3 px-4 py-3.5 text-xs font-black text-slate-500 hover:text-white hover:bg-white/5 rounded-2xl transition-all duration-300 uppercase tracking-widest">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
                Cerrar Sesión
            </button>
        </form>
    </div>
</div>