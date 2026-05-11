<section class="space-y-6">
    <header class="mb-10">
        <p class="text-slate-400 text-sm font-medium leading-relaxed">
            Una vez que tu cuenta sea eliminada, todos sus recursos y datos se borrarán de forma permanente. Por favor, descarga cualquier dato que desees conservar antes de proceder.
        </p>
    </header>

    <button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="px-8 py-4 bg-rose-600/10 hover:bg-rose-600 text-rose-500 hover:text-white text-[10px] font-black uppercase tracking-widest rounded-2xl transition-all border border-rose-500/20"
    >
        Eliminar Cuenta Definitivamente
    </button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-10 glass bg-slate-950/90 backdrop-blur-2xl">
            @csrf
            @method('delete')

            <h2 class="text-2xl font-black text-white uppercase tracking-tighter mb-4">
                ¿Confirmas la eliminación total?
            </h2>

            <p class="text-slate-400 text-sm font-medium leading-relaxed mb-8">
                Esta acción es irreversible. Para confirmar que deseas eliminar permanentemente tu cuenta y todo tu historial de entrenamiento, por favor introduce tu contraseña.
            </p>

            <div class="space-y-3">
                <label for="password" class="block text-[10px] font-black text-rose-400 uppercase tracking-widest">Contraseña de Confirmación</label>
                <input id="password" name="password" type="password" 
                       class="w-full px-6 py-4 glass bg-slate-900/50 rounded-2xl text-white outline-none focus:ring-2 focus:ring-rose-500/50 transition-all font-bold text-sm border-white/5" 
                       placeholder="Introduce tu contraseña">
                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2 text-[10px] font-black text-rose-500 uppercase" />
            </div>

            <div class="mt-10 flex justify-end gap-4">
                <button type="button" x-on:click="$dispatch('close')" class="px-8 py-4 glass text-slate-400 hover:text-white text-[10px] font-black uppercase tracking-widest rounded-2xl transition-all border border-white/5">
                    Abortar
                </button>

                <button type="submit" class="px-8 py-4 bg-rose-600 hover:bg-rose-500 text-white text-[10px] font-black uppercase tracking-widest rounded-2xl transition-all shadow-xl shadow-rose-500/20">
                    Eliminar Cuenta
                </button>
            </div>
        </form>
    </x-modal>
</section>
