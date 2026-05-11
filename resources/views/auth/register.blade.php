<x-guest-layout>
    <div class="mb-8">
        <h2 class="text-3xl font-black text-white uppercase tracking-tighter">Únete a la <span class="text-indigo-500 italic">Élite</span></h2>
        <p class="text-slate-500 text-[10px] font-black uppercase tracking-[0.2em] mt-2">Inicia tu transformación biomecánica hoy</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-6">
        @csrf

        <!-- Name -->
        <div>
            <label for="name" class="block text-[10px] font-black text-indigo-400 uppercase tracking-widest mb-3">Nombre Completo</label>
            <input id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" 
                   class="w-full px-5 py-4 glass rounded-2xl text-white outline-none focus:ring-2 focus:ring-indigo-500/50 transition-all font-bold text-sm bg-slate-900/50">
            <x-input-error :messages="$errors->get('name')" class="mt-2 text-[10px] font-black text-rose-500 uppercase" />
        </div>

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-[10px] font-black text-indigo-400 uppercase tracking-widest mb-3">Correo Electrónico</label>
            <input id="email" type="email" name="email" :value="old('email')" required autocomplete="username" 
                   class="w-full px-5 py-4 glass rounded-2xl text-white outline-none focus:ring-2 focus:ring-indigo-500/50 transition-all font-bold text-sm bg-slate-900/50">
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-[10px] font-black text-rose-500 uppercase" />
        </div>

        <!-- Password -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="password" class="block text-[10px] font-black text-indigo-400 uppercase tracking-widest mb-3">Contraseña</label>
                <input id="password" type="password" name="password" required autocomplete="new-password"
                       class="w-full px-5 py-4 glass rounded-2xl text-white outline-none focus:ring-2 focus:ring-indigo-500/50 transition-all font-bold text-sm bg-slate-900/50">
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-[10px] font-black text-rose-500 uppercase" />
            </div>

            <!-- Confirm Password -->
            <div>
                <label for="password_confirmation" class="block text-[10px] font-black text-indigo-400 uppercase tracking-widest mb-3">Confirmar</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                       class="w-full px-5 py-4 glass rounded-2xl text-white outline-none focus:ring-2 focus:ring-indigo-500/50 transition-all font-bold text-sm bg-slate-900/50">
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-[10px] font-black text-rose-500 uppercase" />
            </div>
        </div>

        <div class="pt-4 space-y-4">
            <button type="submit" class="w-full py-5 bg-indigo-600 hover:bg-indigo-500 text-white font-black uppercase tracking-widest text-xs rounded-2xl shadow-xl shadow-indigo-500/20 transition-all active:scale-95">
                Crear Cuenta Élite
            </button>
            
            <p class="text-center text-[10px] font-black text-slate-600 uppercase tracking-widest">
                ¿Ya eres miembro? 
                <a href="{{ route('login') }}" class="text-indigo-400 hover:text-indigo-300 ml-1 transition-colors">Inicia sesión</a>
            </p>
        </div>
    </form>
</x-guest-layout>
