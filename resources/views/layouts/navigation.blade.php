<!-- Sidebar Component (Fixed/Permanent) -->
<div class="flex flex-col w-72 bg-white dark:bg-gray-900 border-r border-gray-100 dark:border-gray-800 shadow-sm z-50">
    
    <!-- Sidebar Header (Logo) -->
    <div class="flex items-center h-24 px-8">
        <div class="bg-indigo-600 rounded-2xl p-2 shadow-lg shadow-indigo-200 dark:shadow-none">
            <x-application-logo class="h-6 w-auto fill-current text-white" />
        </div>
        <span class="ml-3 font-extrabold text-xl tracking-tight text-gray-900 dark:text-white uppercase">{{ config('app.name', 'GymMaster') }}</span>
    </div>

    <!-- Navigation Menu -->
    <div class="flex-1 px-4 py-4 space-y-10 overflow-y-auto">
        
        <!-- General Section -->
        <div>
            <h3 class="px-6 text-[10px] font-black text-indigo-400 uppercase tracking-[0.2em] mb-6">Principal</h3>
            <div class="space-y-2">
                <a href="{{ route('dashboard') }}" 
                   class="group flex items-center px-6 py-4 text-sm font-bold rounded-2xl transition-all duration-200 {{ request()->routeIs('dashboard') ? 'bg-indigo-50 text-indigo-700 dark:bg-indigo-900/20 dark:text-indigo-400' : 'text-gray-500 hover:bg-gray-50 dark:hover:bg-gray-800/50 hover:text-indigo-600 dark:hover:text-white' }}">
                    <svg class="mr-4 h-5 w-5 transition-transform group-hover:scale-110" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    Dashboard
                </a>

                @role('admin')
                <a href="{{ route('users.index') }}" 
                   class="group flex items-center px-6 py-4 text-sm font-bold rounded-2xl transition-all duration-200 {{ request()->routeIs('users.*') ? 'bg-indigo-50 text-indigo-700 dark:bg-indigo-900/20 dark:text-indigo-400' : 'text-gray-500 hover:bg-gray-50 dark:hover:bg-gray-800/50 hover:text-indigo-600 dark:hover:text-white' }}">
                    <svg class="mr-4 h-5 w-5 transition-transform group-hover:scale-110" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    Usuarios
                </a>
                @endrole

                <a href="{{ route('exercises.index') }}" 
                   class="group flex items-center px-6 py-4 text-sm font-bold rounded-2xl transition-all duration-200 {{ request()->routeIs('exercises.*') ? 'bg-indigo-50 text-indigo-700 dark:bg-indigo-900/20 dark:text-indigo-400' : 'text-gray-500 hover:bg-gray-50 dark:hover:bg-gray-800/50 hover:text-indigo-600 dark:hover:text-white' }}">
                    <svg class="mr-4 h-5 w-5 transition-transform group-hover:scale-110" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                    Ejercicios
                </a>

                <a href="{{ route('routines.index') }}" 
                   class="group flex items-center px-6 py-4 text-sm font-bold rounded-2xl transition-all duration-200 {{ request()->routeIs('routines.*') ? 'bg-indigo-50 text-indigo-700 dark:bg-indigo-900/20 dark:text-indigo-400' : 'text-gray-500 hover:bg-gray-50 dark:hover:bg-gray-800/50 hover:text-indigo-600 dark:hover:text-white' }}">
                    <svg class="mr-4 h-5 w-5 transition-transform group-hover:scale-110" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                    </svg>
                    Rutinas
                </a>
            </div>
        </div>

        <!-- Personal Section -->
        <div>
            <h3 class="px-6 text-[10px] font-black text-indigo-400 uppercase tracking-[0.2em] mb-6">Mi Perfil</h3>
            <div class="space-y-2">
                <a href="{{ route('planner.index') }}" 
                   class="group flex items-center px-6 py-4 text-sm font-bold rounded-2xl transition-all duration-200 {{ request()->routeIs('planner.*') ? 'bg-indigo-50 text-indigo-700 dark:bg-indigo-900/20 dark:text-indigo-400' : 'text-gray-500 hover:bg-gray-50 dark:hover:bg-gray-800/50 hover:text-indigo-600 dark:hover:text-white' }}">
                    <svg class="mr-4 h-5 w-5 transition-transform group-hover:scale-110" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    Mi Plan
                </a>
                <a href="{{ route('profile.edit') }}" 
                   class="group flex items-center px-6 py-4 text-sm font-bold rounded-2xl transition-all duration-200 {{ request()->routeIs('profile.*') ? 'bg-indigo-50 text-indigo-700 dark:bg-indigo-900/20 dark:text-indigo-400' : 'text-gray-500 hover:bg-gray-50 dark:hover:bg-gray-800/50 hover:text-indigo-600 dark:hover:text-white' }}">
                    <svg class="mr-4 h-5 w-5 transition-transform group-hover:scale-110" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    Configuración
                </a>
            </div>
        </div>
    </div>

    <!-- User Profile Footer -->
    <div class="p-4 bg-gray-50/50 dark:bg-gray-950/50 border-t border-gray-100 dark:border-gray-800">
        <div class="flex items-center px-4 py-3 rounded-2xl bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 mb-4 shadow-sm">
            <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-indigo-600 to-indigo-700 flex items-center justify-center font-bold text-white shadow-inner">
                {{ substr(Auth::user()->name, 0, 1) }}
            </div>
            <div class="ml-3 overflow-hidden">
                <p class="text-sm font-bold text-gray-900 dark:text-white truncate">{{ Auth::user()->name }}</p>
                <p class="text-[10px] font-black {{ auth()->user()->hasRole('admin') ? 'text-red-500' : 'text-green-500' }} truncate uppercase tracking-widest">{{ auth()->user()->hasRole('admin') ? 'ADMINISTRADOR' : 'CLIENTE' }}</p>
            </div>
        </div>
        
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full flex items-center justify-center px-4 py-3 text-sm font-bold text-gray-500 hover:text-red-500 hover:bg-red-50 dark:hover:bg-red-900/10 rounded-2xl transition-all duration-200">
                <svg class="mr-3 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
                Cerrar Sesión
            </button>
        </form>
    </div>
</div>