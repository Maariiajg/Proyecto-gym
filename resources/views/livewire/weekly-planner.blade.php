<div class="space-y-10">


    @if (session()->has('message'))
        <div class="p-4 bg-indigo-500/10 border border-indigo-500/20 text-indigo-400 rounded-2xl flex items-center gap-3 animate-pulse shadow-lg indigo-glow">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <span class="font-bold italic">{{ session('message') }}</span>
        </div>
    @endif

    <div class="glass rounded-[2.5rem] overflow-hidden border border-white/5 shadow-2xl">
        <div class="p-10 border-b border-white/5 bg-slate-900/50">
            <h3 class="text-2xl font-black text-white uppercase tracking-tight flex items-center gap-4">
                @if($userId == auth()->id())
                    <span class="w-2 h-2 rounded-full bg-emerald-500 shadow-[0_0_10px_rgba(16,185,129,1)]"></span>
                    Tu Plan Personalizado
                @else
                    <span class="w-2 h-2 rounded-full bg-indigo-500 shadow-[0_0_10px_rgba(99,102,241,1)]"></span>
                    Plan de: {{ $this->getUser()->name }}
                @endif
            </h3>
        </div>
        
        <div class="divide-y divide-white/5 bg-slate-950/20">
            @foreach($days as $day)
                <div class="p-8 flex flex-col sm:flex-row sm:items-center justify-between gap-8 hover:bg-white/5 transition-all duration-300 group">
                    <div class="flex items-center gap-8">
                        <!-- Day Badge -->
                        <div class="w-20 h-20 rounded-[1.5rem] bg-slate-900 flex flex-col items-center justify-center border border-white/5 group-hover:border-indigo-500/50 transition-colors shadow-inner overflow-hidden relative">
                            <div class="absolute inset-0 bg-indigo-500/5 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                            <span class="text-[10px] font-black text-indigo-400 uppercase leading-none mb-1 relative z-10">{{ substr(__($day), 0, 3) }}</span>
                            <span class="text-2xl relative z-10">🗓️</span>
                        </div>
                        
                        <div class="flex-1 min-w-[200px]">
                            <h4 class="text-2xl font-black text-white capitalize tracking-tighter group-hover:text-indigo-400 transition-colors">{{ __($day) }}</h4>
                            
                            @if($editingDay === $day)
                                <div class="mt-6 flex flex-wrap items-center gap-4 animate-fade-in">
                                    <select wire:model="selectedRoutine" class="glass px-5 py-3 rounded-2xl text-white outline-none focus:ring-2 focus:ring-indigo-500/50 transition-all font-bold text-sm bg-slate-900 min-w-[200px]">
                                        <option value="" class="text-black">-- Día de descanso --</option>
                                        @foreach($routines as $routine)
                                            <option value="{{ $routine->id }}" class="text-black">{{ $routine->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="flex gap-2">
                                        <button wire:click="saveDay" class="px-6 py-3 bg-indigo-600 hover:bg-indigo-500 text-white text-[10px] font-black uppercase tracking-widest rounded-xl transition-all shadow-lg shadow-indigo-500/20">Guardar</button>
                                        <button wire:click="cancelEdit" class="px-6 py-3 glass text-slate-400 hover:text-white text-[10px] font-black uppercase tracking-widest rounded-xl transition-all">Cerrar</button>
                                    </div>
                                </div>
                            @else
                                <div class="mt-2 min-h-[1.5rem]">
                                    @if(isset($plans[$day]))
                                        @if($plans[$day]->routine)
                                            <a href="{{ route('routines.show', $plans[$day]->routine_id) }}" class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full glass border border-indigo-500/20 text-indigo-400 hover:text-white hover:border-indigo-500 transition-all font-bold text-[11px] uppercase tracking-widest">
                                                <span class="w-1.5 h-1.5 rounded-full bg-indigo-400 animate-pulse"></span>
                                                {{ $plans[$day]->routine->name }}
                                            </a>
                                        @else
                                            <p class="text-[10px] text-slate-500 font-black uppercase tracking-widest italic flex items-center gap-2">
                                                <svg class="w-4 h-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                                                Sesión Privada
                                            </p>
                                        @endif
                                    @else
                                        <p class="text-[10px] text-slate-600 font-black uppercase tracking-widest italic flex items-center gap-2">
                                            <svg class="w-4 h-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
                                            Día de descanso estratégico
                                        </p>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                    
                    @if($editingDay !== $day)
                        <button wire:click="editDay('{{ $day }}')" class="px-8 py-3.5 glass text-[10px] font-black uppercase tracking-[0.2em] rounded-2xl hover:text-white hover:border-indigo-500/50 transition-all shadow-inner group-hover:bg-white/5">
                            {{ isset($plans[$day]) ? 'Reasignar' : 'Asignar Sesión' }}
                        </button>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
    
    <!-- Visual Progress Legend -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-12">
        <div class="glass p-8 rounded-[2rem] border-emerald-500/10">
            <h5 class="text-[10px] font-black text-emerald-400 uppercase tracking-[0.3em] mb-4">Consistencia</h5>
            <p class="text-sm text-slate-400 font-medium">Mantener el mismo plan durante 4 semanas seguidas activa la adaptación metabólica.</p>
        </div>
        <div class="glass p-8 rounded-[2rem] border-indigo-500/10">
            <h5 class="text-[10px] font-black text-indigo-400 uppercase tracking-[0.3em] mb-4">Frecuencia</h5>
            <p class="text-sm text-slate-400 font-medium">Un mínimo de 3 sesiones semanales es vital para mantener el estado de hipertrofia.</p>
        </div>
        <div class="glass p-8 rounded-[2rem] border-rose-500/10">
            <h5 class="text-[10px] font-black text-rose-500 uppercase tracking-[0.3em] mb-4">Recuperación</h5>
            <p class="text-sm text-slate-400 font-medium">No subestimes los días de descanso; es cuando tus fibras musculares realmente crecen.</p>
        </div>
    </div>
</div>
