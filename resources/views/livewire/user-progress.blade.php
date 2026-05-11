<div class="space-y-10">
    <div class="flex flex-col md:flex-row justify-between items-end gap-6 mb-10">
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
        <!-- Input Form Premium -->
        <div class="space-y-8">
            <div class="glass rounded-[2.5rem] p-8 border border-white/5 shadow-2xl relative overflow-hidden group">
                <div class="absolute -top-10 -right-10 w-24 h-24 bg-indigo-500/10 rounded-full blur-2xl group-hover:scale-150 transition-transform duration-700"></div>
                
                <div class="flex items-center gap-4 mb-10">
                    <div class="w-12 h-12 bg-slate-900 rounded-2xl flex items-center justify-center text-indigo-400 shadow-inner border border-white/5">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-black text-white uppercase tracking-tighter">{{ $isEditMode ? 'Editar' : 'Registrar' }} <span class="text-indigo-500">Log</span></h3>
                        <p class="text-[9px] font-black text-slate-500 uppercase tracking-widest mt-1">Ingreso de data técnica</p>
                    </div>
                    @if($isEditMode)
                        <button wire:click="cancelEdit" class="ml-auto text-[10px] font-black text-rose-500 uppercase tracking-widest hover:text-rose-400 transition-colors">Cancelar</button>
                    @endif
                </div>
                
                <form wire:submit.prevent="store" class="space-y-6">
                    <div>
                        <label class="block text-[10px] font-black text-indigo-400 uppercase tracking-widest mb-3">Filtrar por Rutina</label>
                        <select wire:model.live="selectedRoutineId" class="w-full px-5 py-4 glass rounded-2xl text-white outline-none focus:ring-2 focus:ring-indigo-500/50 transition-all font-bold text-sm bg-slate-900">
                            <option value="">-- Todos los ejercicios --</option>
                            @foreach($routines as $routine)
                                <option value="{{ $routine->id }}">{{ $routine->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-[10px] font-black text-indigo-400 uppercase tracking-widest mb-3">Seleccionar Ejercicio</label>
                        <select wire:model.live="selectedExerciseId" class="w-full px-5 py-4 glass rounded-2xl text-white outline-none focus:ring-2 focus:ring-indigo-500/50 transition-all font-bold text-sm bg-slate-900">
                            <option value="">-- Elegir movimiento --</option>
                            @foreach($exercises as $exercise)
                                @php $isLogged = in_array($exercise->id, $loggedToday); @endphp
                                <option value="{{ $exercise->id }}" {{ $isLogged ? 'disabled' : '' }}>
                                    {{ $exercise->name }} {{ $isLogged ? '✓' : '' }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <label class="block text-[10px] font-black text-indigo-400 uppercase tracking-widest mb-3">Peso (KG)</label>
                            <input type="number" step="0.5" wire:model.live="weight" placeholder="0.0" class="w-full px-5 py-4 glass rounded-2xl text-white outline-none focus:ring-2 focus:ring-indigo-500/50 transition-all font-bold text-center">
                        </div>
                        <div>
                            <label class="block text-[10px] font-black text-indigo-400 uppercase tracking-widest mb-3">Reps</label>
                            <input type="number" wire:model.live="repetitions" placeholder="0" class="w-full px-5 py-4 glass rounded-2xl text-white outline-none focus:ring-2 focus:ring-indigo-500/50 transition-all font-bold text-center">
                        </div>
                    </div>

                    <div>
                        <label class="block text-[10px] font-black text-indigo-400 uppercase tracking-widest mb-3">Fecha del Log</label>
                        <input type="date" wire:model.live="log_date" class="w-full px-5 py-4 glass rounded-2xl text-white outline-none focus:ring-2 focus:ring-indigo-500/50 transition-all font-bold bg-slate-900">
                    </div>

                    <button type="submit" class="w-full py-5 {{ $isEditMode ? 'bg-amber-600 hover:bg-amber-500' : 'bg-indigo-600 hover:bg-indigo-500' }} text-white font-black uppercase tracking-widest text-xs rounded-2xl shadow-xl transition-all flex items-center justify-center gap-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        {{ $isEditMode ? 'Actualizar Registro' : 'Confirmar Registro' }}
                    </button>
                </form>

                @if (session()->has('error'))
                    <div class="mt-6 p-4 bg-rose-500/10 border border-rose-500/20 text-rose-500 text-[10px] font-black uppercase tracking-widest rounded-xl flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        {{ session('error') }}
                    </div>
                @endif
            </div>

            <!-- Routine History Link Premium -->
            <div class="relative overflow-hidden bg-indigo-600 rounded-[2.5rem] p-8 group cursor-pointer shadow-xl shadow-indigo-500/20" onclick="window.location.href='{{ route('progress.routines') }}'">
                <div class="absolute -top-10 -right-10 w-32 h-32 bg-white/10 rounded-full blur-2xl group-hover:scale-150 transition-transform duration-700"></div>
                <div class="relative z-10">
                    <h4 class="text-xl font-black text-white uppercase tracking-tighter mb-2">Historial de Sesiones</h4>
                    <p class="text-[10px] text-indigo-100/70 font-bold uppercase tracking-widest mb-6 leading-relaxed">Consulta la cronología completa de tus rutinas finalizadas.</p>
                    <div class="inline-flex items-center gap-3 text-[10px] font-black text-white uppercase tracking-widest group-hover:gap-5 transition-all">
                        Explorar Historial
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Chart / Stats Premium -->
        <div class="lg:col-span-2 space-y-10">
            <div class="glass rounded-[2.5rem] p-10 border border-white/5 shadow-2xl relative overflow-hidden">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-12">
                    <div class="flex items-center gap-6">
                        @php
                            $currentEx = \App\Models\Exercise::find($selectedExerciseId);
                        @endphp
                        @if($currentEx && $currentEx->getFirstMediaUrl('exercises'))
                            <div class="w-20 h-20 rounded-2xl overflow-hidden border border-white/10 shadow-2xl group">
                                <img src="/storage/{{ $currentEx->getFirstMedia('exercises')->id }}/{{ $currentEx->getFirstMedia('exercises')->file_name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" alt="Vista previa">
                            </div>
                        @else
                            <div class="w-20 h-20 rounded-2xl bg-slate-900 flex items-center justify-center text-[10px] font-black text-slate-700 border border-white/5 uppercase tracking-widest text-center px-2">
                                Sin Preview
                            </div>
                        @endif
                        <div>
                            <h3 class="text-2xl font-black text-white uppercase tracking-tighter">Evolución <span class="text-indigo-500 italic">Biomecánica</span></h3>
                            <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest mt-2">Seguimiento de carga: <span class="text-indigo-400">{{ $currentEx['name'] ?? 'Selecciona un ejercicio' }}</span></p>
                        </div>
                    </div>
                    <div class="flex items-center gap-4 px-5 py-3 glass rounded-2xl border-indigo-500/20 self-end md:self-center">
                        <div class="w-3 h-3 bg-indigo-500 rounded-full shadow-[0_0_10px_rgba(99,102,241,1)]"></div>
                        <span class="text-[10px] font-black text-slate-300 uppercase tracking-widest">Peso Levantado (KG)</span>
                    </div>
                </div>
                
                @if(count($chartData) > 0)
                    <div class="overflow-x-auto pb-10 custom-scrollbar">
                        <div class="h-80 flex items-end justify-start gap-3 px-4 pb-12 border-b border-white/5 min-w-[900px]">
                            @php
                                $maxWeight = collect($chartData)->max('weight') ?: 1;
                            @endphp
                            @foreach($chartData as $data)
                                @php 
                                    $isSelected = $data['log_date'] === $log_date;
                                @endphp
                                <div class="flex-1 flex flex-col items-center group relative h-full justify-end min-w-[40px]">
                                    @if($data['has_data'])
                                        <div class="absolute bottom-full mb-6 left-1/2 -translate-x-1/2 glass px-4 py-3 rounded-2xl opacity-0 group-hover:opacity-100 whitespace-nowrap pointer-events-none transition-all shadow-2xl z-20 border-indigo-500/30">
                                            <p class="text-xs font-black text-white uppercase">{{ $data['weight'] }}kg</p>
                                            <p class="text-[9px] font-black text-indigo-400 uppercase tracking-widest mt-1">{{ $data['repetitions'] }} Repeticiones</p>
                                        </div>
                                    @endif

                                    <div class="w-full rounded-2xl transition-all duration-500 hover:brightness-125 cursor-pointer relative shadow-2xl {{ $data['has_data'] ? '' : 'opacity-20' }}" 
                                         style="height: {{ $data['has_data'] ? max(20, ($data['weight'] / $maxWeight) * 100) : 10 }}%; 
                                                background: {{ $data['has_data'] ? ($isSelected ? 'linear-gradient(to top, #4f46e5, #818cf8)' : 'linear-gradient(to top, #312e81, #4f46e5)') : 'rgba(255,255,255,0.05)' }};">
                                        
                                        @if($isSelected)
                                            <div class="absolute -top-14 left-1/2 -translate-x-1/2">
                                                <span class="flex h-4 w-4">
                                                  <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-indigo-400 opacity-75"></span>
                                                  <span class="relative inline-flex rounded-full h-4 w-4 bg-indigo-600 shadow-lg shadow-indigo-500/50"></span>
                                                </span>
                                            </div>
                                        @endif
                                    </div>
                                    
                                    <div class="absolute top-full mt-6 flex flex-col items-center">
                                        <span class="text-[10px] font-black {{ $isSelected ? 'text-indigo-400' : ($data['has_data'] ? 'text-slate-400' : 'text-slate-700') }} uppercase tracking-widest">
                                            {{ date('d', strtotime($data['log_date'])) }}
                                            <span class="block text-[8px] opacity-50 text-center">{{ strtoupper(date('M', strtotime($data['log_date']))) }}</span>
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @else
                    <div class="h-80 flex flex-col items-center justify-center text-slate-600 glass rounded-[2rem] border-2 border-dashed border-white/5 bg-slate-900/20">
                        <svg class="w-16 h-16 mb-4 opacity-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                        <p class="font-black text-[10px] uppercase tracking-[0.3em] opacity-40">Sin data histórica disponible</p>
                    </div>
                @endif
            </div>

            <!-- History Table Premium -->
            <div class="glass rounded-[2.5rem] border border-white/5 shadow-2xl overflow-hidden">
                <div class="p-8 border-b border-white/5 flex items-center justify-between bg-slate-900/50">
                    <h3 class="text-xl font-black text-white uppercase tracking-tight italic">Registros <span class="text-indigo-500">Recientes</span></h3>
                    <div class="px-4 py-1.5 glass rounded-full text-[9px] font-black text-indigo-400 uppercase tracking-widest border border-indigo-500/20 shadow-lg">
                        Últimos 15 Logs
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="bg-slate-950/40">
                                <th class="px-8 py-5 text-[10px] font-black text-slate-500 uppercase tracking-widest">Cronología</th>
                                <th class="px-8 py-5 text-[10px] font-black text-slate-500 uppercase tracking-widest text-center">Carga Absoluta</th>
                                <th class="px-8 py-5 text-[10px] font-black text-slate-500 uppercase tracking-widest text-center">Reps</th>
                                <th class="px-8 py-5 text-[10px] font-black text-slate-500 uppercase tracking-widest text-right">Gestión</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/5">
                            @forelse($logs->take(15) as $log)
                                <tr class="hover:bg-white/5 transition-all group">
                                    <td class="px-8 py-6">
                                        <div class="flex items-center gap-3">
                                            <div class="w-2 h-2 rounded-full bg-indigo-500/50 group-hover:bg-indigo-500 transition-colors"></div>
                                            <span class="text-sm font-black text-white italic uppercase tracking-tighter">{{ date('d/m/Y', strtotime($log->log_date)) }}</span>
                                        </div>
                                    </td>
                                    <td class="px-8 py-6 text-center">
                                        <span class="inline-flex items-center px-5 py-2 rounded-xl glass border border-indigo-500/20 text-xs font-black text-white shadow-inner group-hover:border-indigo-500/50 transition-all">
                                            {{ number_format($log->weight, 1) }} KG
                                        </span>
                                    </td>
                                    <td class="px-8 py-6 text-center">
                                        <span class="text-sm font-black text-slate-400 group-hover:text-indigo-400 transition-colors">{{ $log->repetitions }} <span class="text-[9px] text-slate-600 uppercase ml-1">Reps</span></span>
                                    </td>
                                    <td class="px-8 py-6 text-right">
                                        <div class="flex justify-end gap-3">
                                            <button wire:click="edit({{ $log->id }})" class="p-3 glass rounded-xl text-slate-500 hover:text-amber-500 transition-all shadow-inner border border-white/5">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                            </button>
                                            <button wire:click="delete({{ $log->id }})" wire:confirm="¿Confirmas la eliminación permanente de este registro?" class="p-3 glass rounded-xl text-slate-500 hover:text-rose-500 transition-all shadow-inner border border-white/5">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-8 py-20 text-center text-slate-600 font-black text-[10px] uppercase tracking-[0.3em] italic">
                                        No hay registros históricos para este movimiento.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
