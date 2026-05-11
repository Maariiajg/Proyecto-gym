<x-guest-layout>
    <div class="mb-8">
        <h2 class="text-3xl font-black text-white uppercase tracking-tighter">Bienvenido de <span class="text-indigo-500 italic">Vuelta</span></h2>
        <p class="text-slate-500 text-[10px] font-black uppercase tracking-[0.2em] mt-2">Accede a tu centro de entrenamiento personal</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-[10px] font-black text-indigo-400 uppercase tracking-widest mb-3">Correo Electrónico</label>
            <input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" 
                   class="w-full px-5 py-4 glass rounded-2xl text-white outline-none focus:ring-2 focus:ring-indigo-500/50 transition-all font-bold text-sm bg-slate-900/50">
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-[10px] font-black text-rose-500 uppercase" />
        </div>

        <!-- Password -->
        <div>
            <div class="flex justify-between items-center mb-3">
                <label for="password" class="block text-[10px] font-black text-indigo-400 uppercase tracking-widest">Contraseña</label>
            </div>
            <input id="password" type="password" name="password" required autocomplete="current-password"
                   class="w-full px-5 py-4 glass rounded-2xl text-white outline-none focus:ring-2 focus:ring-indigo-500/50 transition-all font-bold text-sm bg-slate-900/50">
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-[10px] font-black text-rose-500 uppercase" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center">
            <label for="remember_me" class="flex items-center cursor-pointer group">
                <div class="relative">
                    <input id="remember_me" type="checkbox" name="remember" class="sr-only">
                    <div class="w-5 h-5 glass rounded-md group-hover:border-indigo-500 transition-colors"></div>
                    <div class="absolute inset-0 flex items-center justify-center opacity-0 group-has-[:checked]:opacity-100 transition-opacity">
                        <div class="w-2.5 h-2.5 bg-indigo-500 rounded-sm"></div>
                    </div>
                </div>
                <span class="ms-3 text-[10px] font-black text-slate-500 uppercase tracking-widest group-hover:text-slate-300 transition-colors">Recordar sesión</span>
            </label>
        </div>

        <div class="pt-4 space-y-4">
            <button type="submit" class="w-full py-5 bg-indigo-600 hover:bg-indigo-500 text-white font-black uppercase tracking-widest text-xs rounded-2xl shadow-xl shadow-indigo-500/20 transition-all active:scale-95">
                Iniciar Sesión
            </button>
            
            <p class="text-center text-[10px] font-black text-slate-600 uppercase tracking-widest">
                ¿No tienes cuenta? 
                <a href="{{ route('register') }}" class="text-indigo-400 hover:text-indigo-300 ml-1 transition-colors">Regístrate en la élite</a>
            </p>

            <div class="text-center pt-4 border-t border-white/5 mt-4">
                <a href="/" class="text-[9px] font-black text-slate-500 hover:text-white uppercase tracking-widest transition-colors flex items-center justify-center gap-2">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                    Volver a la página principal
                </a>
            </div>
        </div>
    </form>
</x-guest-layout>
