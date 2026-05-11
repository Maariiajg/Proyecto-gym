<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <h2 class="font-black text-3xl text-white tracking-tighter uppercase">
                Registrar <span class="text-indigo-500 italic">Operador</span>
            </h2>
            <span class="px-3 py-1 bg-slate-900 border border-white/10 rounded-full text-[10px] font-black text-slate-500 uppercase tracking-widest">Alta de Sistema</span>
        </div>
    </x-slot>

    <div class="py-12 min-h-screen">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-10">
            <div class="glass p-10 sm:p-14 rounded-[3rem] border border-white/5 shadow-2xl relative overflow-hidden group">
                <div class="absolute -top-24 -right-24 w-80 h-80 bg-indigo-500/5 rounded-full blur-3xl group-hover:scale-125 transition-transform duration-700"></div>
                
                <form action="{{ route('users.store') }}" method="POST" class="space-y-8 relative z-10">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                        <div class="space-y-3">
                            <label for="name" class="block text-[10px] font-black text-indigo-400 uppercase tracking-widest">Identidad Completa</label>
                            <x-text-input id="name" name="name" type="text" class="w-full" :value="old('name')" required autofocus />
                            <x-input-error class="mt-2 text-[10px] font-black text-rose-500 uppercase" :messages="$errors->get('name')" />
                        </div>

                        <div class="space-y-3">
                            <label for="email" class="block text-[10px] font-black text-indigo-400 uppercase tracking-widest">Acceso Biométrico (Email)</label>
                            <x-text-input id="email" name="email" type="email" class="w-full" :value="old('email')" required />
                            <x-input-error class="mt-2 text-[10px] font-black text-rose-500 uppercase" :messages="$errors->get('email')" />
                        </div>

                        <div class="space-y-3">
                            <label for="password" class="block text-[10px] font-black text-indigo-400 uppercase tracking-widest">Código de Seguridad</label>
                            <x-text-input id="password" name="password" type="password" class="w-full" required autocomplete="new-password" />
                            <x-input-error class="mt-2 text-[10px] font-black text-rose-500 uppercase" :messages="$errors->get('password')" />
                        </div>

                        <div class="space-y-3">
                            <label for="password_confirmation" class="block text-[10px] font-black text-indigo-400 uppercase tracking-widest">Verificación de Código</label>
                            <x-text-input id="password_confirmation" name="password_confirmation" type="password" class="w-full" required />
                            <x-input-error class="mt-2 text-[10px] font-black text-rose-500 uppercase" :messages="$errors->get('password_confirmation')" />
                        </div>

                        <div class="space-y-3">
                            <label for="role" class="block text-[10px] font-black text-indigo-400 uppercase tracking-widest">Nivel de Acceso</label>
                            <select id="role" name="role" class="w-full px-6 py-4 glass bg-slate-900/50 border-white/5 text-white focus:border-indigo-500/50 focus:ring-indigo-500/50 rounded-2xl shadow-inner transition-all font-bold text-sm appearance-none cursor-pointer" required>
                                <option value="" disabled selected>Selecciona una jerarquía</option>
                                @foreach($roles as $role)
                                    <option value="{{ $role->name }}" {{ old('role') == $role->name ? 'selected' : '' }} class="bg-slate-900">
                                        {{ strtoupper($role->name) }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error class="mt-2 text-[10px] font-black text-rose-500 uppercase" :messages="$errors->get('role')" />
                        </div>
                    </div>

                    <div class="flex items-center gap-6 pt-10 border-t border-white/5">
                        <button type="submit" class="px-10 py-4 bg-indigo-600 hover:bg-indigo-500 text-white text-[10px] font-black uppercase tracking-widest rounded-2xl transition-all shadow-xl shadow-indigo-500/20">
                            Consolidar Registro
                        </button>
                        <a href="{{ route('users.index') }}" class="px-8 py-4 glass text-slate-500 hover:text-white text-[10px] font-black uppercase tracking-widest rounded-2xl transition-all border border-white/5">
                            Abortar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
