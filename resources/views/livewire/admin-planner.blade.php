<div class="space-y-10">


    @if($selectedUserId)
        <div class="mb-8">
            <button wire:click="closeUserPlan" class="flex items-center gap-2 px-6 py-3 glass rounded-2xl text-slate-400 hover:text-white transition-all text-[10px] font-black uppercase tracking-widest border border-white/5 shadow-xl">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Volver al listado de Atletas
            </button>
        </div>
        
        <div class="animate-fade-in">
            @livewire('weekly-planner', ['userId' => $selectedUserId], key('user-planner-' . $selectedUserId))
        </div>
    @else
        <!-- Users List Table Premium -->
        <div class="glass rounded-[2.5rem] overflow-hidden border border-white/5 shadow-2xl relative">
            <div class="p-8 border-b border-white/5 bg-slate-900/50 flex flex-col md:flex-row justify-between items-center gap-6">
                <div class="flex items-center gap-4">
                    <div class="w-3 h-3 rounded-full bg-indigo-500 animate-pulse shadow-[0_0_10px_rgba(99,102,241,1)]"></div>
                    <h3 class="text-xl font-bold text-white uppercase tracking-tight">Atletas Registrados</h3>
                </div>
                <div class="relative w-full md:w-80">
                    <input wire:model.live="search" type="text" class="w-full pl-12 pr-6 py-4 glass rounded-2xl text-white outline-none focus:ring-2 focus:ring-indigo-500/50 transition-all font-bold text-sm bg-slate-950/50" placeholder="Buscar atleta por identidad...">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-slate-950/40 text-slate-500 text-[10px] uppercase font-black tracking-[0.2em] border-b border-white/5">
                        <tr>
                            <th class="px-8 py-5">Identidad del Atleta</th>
                            <th class="px-8 py-5 text-center">Frecuencia Semanal</th>
                            <th class="px-8 py-5 text-right">Control de Acceso</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        @forelse($users as $user)
                            <tr wire:key="user-row-{{ $user->id }}" class="hover:bg-white/5 transition-all duration-300 group">
                                <td class="px-8 py-6">
                                    <div class="flex items-center gap-4">
                                        <div class="w-12 h-12 rounded-2xl bg-slate-900 border border-white/5 flex items-center justify-center text-indigo-500 font-black text-lg group-hover:scale-110 transition-transform shadow-inner">
                                            {{ substr($user->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <p class="text-sm font-black text-white uppercase tracking-tight group-hover:text-indigo-400 transition-colors">{{ $user->name }}</p>
                                            <p class="text-[10px] text-slate-500 font-bold uppercase tracking-widest mt-0.5">{{ $user->email }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-6 text-center">
                                    <div class="flex gap-1.5 justify-center">
                                        @php
                                            $daysArr = ['lunes', 'martes', 'miercoles', 'jueves', 'viernes', 'sabado', 'domingo'];
                                            $userPlans = $user->weeklyPlans->keyBy('day_of_week');
                                        @endphp
                                        @foreach($daysArr as $day)
                                            <div title="{{ ucfirst($day) }}: {{ isset($userPlans[$day]) ? ($userPlans[$day]->routine ? $userPlans[$day]->routine->name : 'Sesión Privada') : 'Descanso' }}" 
                                                 class="w-8 h-8 rounded-xl flex items-center justify-center text-[10px] font-black uppercase transition-all {{ isset($userPlans[$day]) ? ( $userPlans[$day]->routine ? 'bg-indigo-500/20 text-indigo-400 border border-indigo-500/30' : 'bg-slate-800 text-slate-500 border border-white/5' ) : 'bg-white/5 text-slate-700 border border-transparent' }}">
                                                {{ substr($day, 0, 1) }}
                                            </div>
                                        @endforeach
                                    </div>
                                </td>
                                <td class="px-8 py-6 text-right">
                                    <button wire:click="selectUser({{ $user->id }})" class="px-6 py-3 bg-indigo-600 hover:bg-indigo-500 text-white text-[10px] font-black uppercase tracking-widest rounded-xl transition-all shadow-xl shadow-indigo-600/20 group-hover:scale-105">
                                        Ver/Editar Plan
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-8 py-14 text-center">
                                    <div class="flex flex-col items-center gap-4">
                                        <svg class="w-12 h-12 text-slate-800" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                                        <p class="text-xs text-slate-500 font-bold uppercase tracking-widest italic">No se han encontrado registros de atletas para esta búsqueda.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="px-8 py-6 border-t border-white/5 bg-slate-950/20">
                {{ $users->links() }}
            </div>
        </div>
    @endif
</div>
