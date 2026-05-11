<section>
    <header class="mb-10">
        <p class="text-slate-400 text-sm font-medium leading-relaxed">
            Actualiza la información de tu perfil y la dirección de correo electrónico vinculada a tu identidad en el sistema.
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-8">
        @csrf
        @method('patch')

        <div class="space-y-3">
            <label for="name" class="block text-[10px] font-black text-indigo-400 uppercase tracking-widest">Nombre Completo</label>
            <input id="name" name="name" type="text" 
                   class="w-full px-6 py-4 glass rounded-2xl text-white outline-none focus:ring-2 focus:ring-indigo-500/50 transition-all font-bold text-sm bg-slate-900/50 border-white/5" 
                   value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
            <x-input-error class="mt-2 text-[10px] font-black text-rose-500 uppercase" :messages="$errors->get('name')" />
        </div>

        <div class="space-y-3">
            <label for="email" class="block text-[10px] font-black text-indigo-400 uppercase tracking-widest">Correo Electrónico</label>
            <input id="email" name="email" type="email" 
                   class="w-full px-6 py-4 glass rounded-2xl text-white outline-none focus:ring-2 focus:ring-indigo-500/50 transition-all font-bold text-sm bg-slate-900/50 border-white/5" 
                   value="{{ old('email', $user->email) }}" required autocomplete="username">
            <x-input-error class="mt-2 text-[10px] font-black text-rose-500 uppercase" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-4 p-4 bg-amber-500/10 border border-amber-500/20 rounded-2xl">
                    <p class="text-xs font-bold text-amber-400 uppercase tracking-tight">
                        Tu dirección de correo electrónico no ha sido verificada.
                        <button form="send-verification" class="block mt-2 underline text-amber-200 hover:text-amber-100 transition-colors">
                            Haz clic aquí para reenviar el correo de verificación.
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 text-[10px] font-black text-emerald-400 uppercase tracking-widest animate-pulse">
                            Se ha enviado un nuevo enlace de verificación a tu correo.
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-6 pt-4">
            <button type="submit" class="px-10 py-4 bg-indigo-600 hover:bg-indigo-500 text-white text-[10px] font-black uppercase tracking-widest rounded-2xl transition-all shadow-xl shadow-indigo-500/20">
                Guardar Cambios
            </button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-[10px] font-black text-emerald-400 uppercase tracking-widest flex items-center gap-2"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    Actualizado con éxito
                </p>
            @endif
        </div>
    </form>
</section>
