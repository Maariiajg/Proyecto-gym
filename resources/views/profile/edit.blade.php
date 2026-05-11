<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <h2 class="font-black text-3xl text-white tracking-tighter uppercase">
                Configuración de <span class="text-indigo-500 italic">Cuenta</span>
            </h2>
            <span class="px-3 py-1 bg-slate-900 border border-white/10 rounded-full text-[10px] font-black text-slate-500 uppercase tracking-widest">Ajustes del Sistema</span>
        </div>
    </x-slot>

    <div class="py-12 min-h-screen">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-10 space-y-10">
            
            <!-- Identidad Biometrica -->
            <div class="glass p-8 sm:p-12 rounded-[3rem] border border-white/5 shadow-2xl relative overflow-hidden group">
                <div class="absolute -top-24 -right-24 w-64 h-64 bg-indigo-500/5 rounded-full blur-3xl group-hover:scale-125 transition-transform duration-700"></div>
                <div class="max-w-xl relative z-10">
                    <div class="flex items-center gap-3 mb-8">
                        <div class="w-10 h-10 bg-indigo-600/20 rounded-xl flex items-center justify-center text-indigo-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        </div>
                        <h3 class="text-xl font-black text-white uppercase tracking-tight">Información de Perfil</h3>
                    </div>
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <!-- Seguridad -->
            <div class="glass p-8 sm:p-12 rounded-[3rem] border border-white/5 shadow-2xl relative overflow-hidden group">
                <div class="absolute -bottom-24 -left-24 w-64 h-64 bg-purple-500/5 rounded-full blur-3xl group-hover:scale-125 transition-transform duration-700"></div>
                <div class="max-w-xl relative z-10">
                    <div class="flex items-center gap-3 mb-8">
                        <div class="w-10 h-10 bg-purple-600/20 rounded-xl flex items-center justify-center text-purple-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                        </div>
                        <h3 class="text-xl font-black text-white uppercase tracking-tight">Seguridad de Acceso</h3>
                    </div>
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <!-- Zona de Peligro -->
            <div class="glass p-8 sm:p-12 rounded-[3rem] border border-rose-500/10 shadow-2xl relative overflow-hidden group">
                <div class="absolute inset-0 bg-rose-500/5 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                <div class="max-w-xl relative z-10">
                    <div class="flex items-center gap-3 mb-8 text-rose-500">
                        <div class="w-10 h-10 bg-rose-500/10 rounded-xl flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        </div>
                        <h3 class="text-xl font-black uppercase tracking-tight text-white">Eliminar Cuenta</h3>
                    </div>
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
