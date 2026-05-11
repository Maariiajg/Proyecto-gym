<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div>
                <h2 class="font-black text-3xl text-white tracking-tighter uppercase">
                    Gestión de <span class="text-indigo-500 italic">Usuarios</span>
                </h2>
                <p class="text-[10px] font-black text-slate-500 uppercase tracking-[0.3em] mt-3 italic">Panel de Control Administrativo</p>
            </div>
            
            <a href="{{ route('users.create') }}" class="inline-flex items-center px-8 py-3.5 bg-indigo-600 hover:bg-indigo-500 text-white text-[10px] font-black uppercase tracking-widest rounded-2xl transition-all shadow-xl shadow-indigo-500/20 group">
                <svg class="w-4 h-4 mr-3 group-hover:rotate-90 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                Registrar Operador
            </a>
        </div>
    </x-slot>

    <div class="py-12 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-10">
            @if(session('success'))
                <div class="p-4 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 rounded-2xl flex items-center gap-3 animate-pulse shadow-lg mb-8">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span class="font-black uppercase tracking-widest text-[10px]">{{ session('success') }}</span>
                </div>
            @endif

            <div class="glass rounded-[3rem] border border-white/5 shadow-2xl overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="bg-slate-950/40">
                                <th class="px-8 py-6 text-[10px] font-black text-slate-500 uppercase tracking-widest">Identidad</th>
                                <th class="px-8 py-6 text-[10px] font-black text-slate-500 uppercase tracking-widest text-center">Acceso (Email)</th>
                                <th class="px-8 py-6 text-[10px] font-black text-slate-500 uppercase tracking-widest text-center">Rol Designado</th>
                                <th class="px-8 py-6 text-[10px] font-black text-slate-500 uppercase tracking-widest text-center">Estado Vital</th>
                                <th class="px-8 py-6 text-[10px] font-black text-slate-500 uppercase tracking-widest text-right">Comandos</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/5">
                            @forelse($users as $user)
                                <tr class="hover:bg-white/5 transition-all group {{ $user->trashed() ? 'opacity-40 grayscale' : '' }}">
                                    <td class="px-8 py-6">
                                        <div class="flex items-center gap-4">
                                            <div class="w-10 h-10 rounded-full bg-slate-900 flex items-center justify-center text-xs font-black text-indigo-400 border border-white/5 shadow-inner">
                                                {{ substr($user->name, 0, 1) }}
                                            </div>
                                            <span class="text-sm font-black text-white uppercase tracking-tighter">{{ $user->name }}</span>
                                        </div>
                                    </td>
                                    <td class="px-8 py-6 text-center">
                                        <span class="text-[10px] font-bold text-slate-400 italic">{{ $user->email }}</span>
                                    </td>
                                    <td class="px-8 py-6 text-center">
                                        @foreach($user->roles as $role)
                                            <span class="px-4 py-1.5 rounded-full glass border border-indigo-500/20 text-[9px] font-black text-indigo-400 uppercase tracking-widest shadow-lg">
                                                {{ $role->name }}
                                            </span>
                                        @endforeach
                                    </td>
                                    <td class="px-8 py-6 text-center">
                                        @if($user->trashed())
                                            <span class="px-3 py-1 bg-rose-500/10 text-rose-500 text-[9px] font-black uppercase tracking-widest rounded-md border border-rose-500/20">Suspendido</span>
                                        @else
                                            <span class="px-3 py-1 bg-emerald-500/10 text-emerald-500 text-[9px] font-black uppercase tracking-widest rounded-md border border-emerald-500/20">Activo</span>
                                        @endif
                                    </td>
                                    <td class="px-8 py-6 text-right">
                                        <div class="flex justify-end gap-3 opacity-0 group-hover:opacity-100 transition-opacity">
                                            <a href="{{ route('users.edit', $user) }}" class="p-2.5 glass rounded-xl text-slate-500 hover:text-white transition-all shadow-inner border border-white/5">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                            </a>
                                            
                                            @if($user->trashed())
                                                <form action="{{ route('users.restore', $user->id) }}" method="POST" class="inline-block">
                                                    @csrf
                                                    <button type="submit" class="p-2.5 glass rounded-xl text-emerald-500 hover:bg-emerald-500/10 transition-all border border-emerald-500/20">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                                                    </button>
                                                </form>
                                            @else
                                                <form action="{{ route('users.destroy', $user) }}" method="POST" class="inline-block" onsubmit="return confirm('¿Confirmas la suspensión de este acceso?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="p-2.5 glass rounded-xl text-rose-500 hover:bg-rose-500/10 transition-all border border-rose-500/20">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-8 py-20 text-center text-slate-600 font-black text-[10px] uppercase tracking-[0.3em] italic">
                                        No se han detectado operadores en la red.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($users->hasPages())
                    <div class="px-8 py-6 border-t border-white/5 bg-slate-950/40">
                        {{ $users->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
