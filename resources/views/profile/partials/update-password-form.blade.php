<section>
    <header class="mb-10">
        <p class="text-slate-400 text-sm font-medium leading-relaxed">
            Asegúrate de que tu cuenta utilice una contraseña robusta y aleatoria para mantener la integridad de tu progreso.
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="space-y-8">
        @csrf
        @method('put')

        <div class="space-y-3">
            <label for="update_password_current_password" class="block text-[10px] font-black text-indigo-400 uppercase tracking-widest">Contraseña Actual</label>
            <input id="update_password_current_password" name="current_password" type="password" 
                   class="w-full px-6 py-4 glass rounded-2xl text-white outline-none focus:ring-2 focus:ring-indigo-500/50 transition-all font-bold text-sm bg-slate-900/50 border-white/5" 
                   autocomplete="current-password">
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2 text-[10px] font-black text-rose-500 uppercase" />
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="space-y-3">
                <label for="update_password_password" class="block text-[10px] font-black text-indigo-400 uppercase tracking-widest">Nueva Contraseña</label>
                <input id="update_password_password" name="password" type="password" 
                       class="w-full px-6 py-4 glass rounded-2xl text-white outline-none focus:ring-2 focus:ring-indigo-500/50 transition-all font-bold text-sm bg-slate-900/50 border-white/5" 
                       autocomplete="new-password">
                <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2 text-[10px] font-black text-rose-500 uppercase" />
            </div>

            <div class="space-y-3">
                <label for="update_password_password_confirmation" class="block text-[10px] font-black text-indigo-400 uppercase tracking-widest">Confirmar Nueva</label>
                <input id="update_password_password_confirmation" name="password_confirmation" type="password" 
                       class="w-full px-6 py-4 glass rounded-2xl text-white outline-none focus:ring-2 focus:ring-indigo-500/50 transition-all font-bold text-sm bg-slate-900/50 border-white/5" 
                       autocomplete="new-password">
                <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2 text-[10px] font-black text-rose-500 uppercase" />
            </div>
        </div>

        <div class="flex items-center gap-6 pt-4">
            <button type="submit" class="px-10 py-4 bg-purple-600 hover:bg-purple-500 text-white text-[10px] font-black uppercase tracking-widest rounded-2xl transition-all shadow-xl shadow-purple-500/20">
                Actualizar Seguridad
            </button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-[10px] font-black text-emerald-400 uppercase tracking-widest flex items-center gap-2"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    Seguridad reforzada
                </p>
            @endif
        </div>
    </form>
</section>
