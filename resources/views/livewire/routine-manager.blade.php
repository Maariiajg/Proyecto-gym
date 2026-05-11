<div class="space-y-10">
    <!-- Header with Search & Add -->
    <div class="flex flex-col md:flex-row justify-between items-center gap-6">
        <div>
            <h1 class="text-4xl font-black text-white uppercase tracking-tighter mb-2">Mis <span class="text-indigo-500 italic">Rutinas</span></h1>
            <p class="text-slate-500 text-sm font-bold uppercase tracking-widest">Sistemas de entrenamiento personalizados para tu evolución</p>
        </div>
        
        <div class="flex items-center gap-4 w-full md:w-auto">
            <div class="relative flex-1 md:w-80 group">
                <span class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-slate-500 group-hover:text-indigo-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </span>
                <input wire:model.live="search" type="text" class="block w-full pl-12 pr-4 py-4 glass rounded-2xl text-white placeholder-slate-600 focus:ring-2 focus:ring-indigo-500/50 outline-none transition-all font-bold text-sm" placeholder="Buscar rutinas...">
            </div>
            
            <button wire:click="openModal()" class="px-6 py-4 bg-indigo-600 hover:bg-indigo-500 text-white font-black uppercase tracking-widest text-[10px] rounded-2xl transition-all shadow-xl shadow-indigo-500/20 flex items-center gap-3">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                Crear Rutina
            </button>
        </div>
    </div>

    @if (session()->has('message'))
        <div class="p-4 bg-indigo-500/10 border border-indigo-500/20 text-indigo-400 rounded-2xl flex items-center gap-3 animate-pulse shadow-lg indigo-glow">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <span class="font-bold italic">{{ session('message') }}</span>
        </div>
    @endif

    <!-- Routines Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($routines as $routine)
            <div class="glass rounded-[2.5rem] overflow-hidden border border-white/5 hover:border-indigo-500/30 transition-all duration-500 group flex flex-col h-full relative">
                <a href="{{ route('routines.show', $routine) }}" class="absolute inset-0 z-0"></a>
                
                <div class="p-8 flex-grow relative z-10 pointer-events-none">
                    <div class="flex justify-between items-start mb-6">
                        <div class="w-14 h-14 bg-slate-900 rounded-2xl flex items-center justify-center text-3xl shadow-inner border border-white/5 group-hover:scale-110 transition-transform">
                            🏋️
                        </div>
                        <span class="px-4 py-1.5 rounded-full glass border border-white/10 text-[9px] font-black uppercase tracking-widest text-indigo-400 shadow-lg">
                            {{ $routine->exercises->count() }} Movimientos
                        </span>
                    </div>

                    <h4 class="text-2xl font-black text-white tracking-tight uppercase group-hover:text-indigo-400 transition-colors mb-4 leading-tight">{{ $routine->name }}</h4>
                    <p class="text-sm text-slate-400 font-medium leading-relaxed line-clamp-3 mb-6">
                        {{ $routine->description ?: 'Esta rutina optimiza el rendimiento general mediante una selección estratégica de ejercicios.' }}
                    </p>
                    
                    <div class="flex items-center gap-3">
                        <div class="w-6 h-6 rounded-full bg-indigo-500/20 border border-indigo-500/30 flex items-center justify-center text-[10px] font-black text-indigo-400">
                            {{ substr($routine->creator->name ?? 'S', 0, 1) }}
                        </div>
                        <span class="text-[9px] font-black text-slate-500 uppercase tracking-widest">Autor: {{ $routine->creator->name ?? 'Sistema' }}</span>
                    </div>
                </div>
                
                <div class="px-8 pb-8 pt-4 flex justify-between items-center relative z-20 pointer-events-auto">
                    <div class="flex gap-2">
                        @if(auth()->user()->hasRole('admin') || $routine->creator_id === auth()->id())
                        <button wire:click="edit({{ $routine->id }})" class="p-3 glass rounded-xl text-slate-500 hover:text-indigo-400 transition-all shadow-inner border border-white/5">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                        </button>
                        <button wire:click="delete({{ $routine->id }})" wire:confirm="¿Seguro que deseas eliminar esta rutina de tu sistema?" class="p-3 glass rounded-xl text-slate-500 hover:text-rose-500 transition-all shadow-inner border border-white/5">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        </button>
                        @endif
                    </div>
                    <a href="{{ route('routines.show', $routine) }}" class="text-[10px] font-black text-indigo-400 hover:text-white uppercase tracking-[0.2em] transition-colors flex items-center gap-2 group/link">
                        Detalles
                        <svg class="w-4 h-4 group-hover/link:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </a>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Modal Premium -->
    @if($isModalOpen)
        <div class="fixed inset-0 z-[60] flex items-center justify-center p-4">
            <div class="fixed inset-0 bg-slate-950/80 backdrop-blur-xl transition-opacity" wire:click="closeModal()"></div>

            <div class="relative glass rounded-[2.5rem] w-full max-w-3xl overflow-hidden shadow-2xl border border-white/10 animate-scale-in">
                <form wire:submit.prevent="store">
                    <div class="p-10">
                        <div class="flex justify-between items-center mb-10">
                            <div>
                                <h3 class="text-3xl font-black text-white uppercase tracking-tighter">{{ $routineId ? 'Modificar' : 'Crear' }} <span class="text-indigo-500 italic">Rutina</span></h3>
                                <p class="text-slate-500 text-[10px] font-black uppercase tracking-widest mt-2">Configura tu secuencia de entrenamiento</p>
                            </div>
                            <button type="button" wire:click="closeModal()" class="p-3 glass rounded-full text-slate-500 hover:text-white transition-colors shadow-inner">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                            </button>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                            <div class="space-y-8">
                                <div>
                                    <label class="block text-[10px] font-black text-indigo-400 uppercase tracking-widest mb-3">Nombre del Sistema</label>
                                    <input wire:model="name" type="text" class="w-full px-5 py-4 glass rounded-2xl text-white outline-none focus:ring-2 focus:ring-indigo-500/50 transition-all font-bold">
                                    @error('name') <span class="text-rose-500 text-[10px] font-black uppercase mt-2 block">{{ $message }}</span> @enderror
                                </div>

                                <div>
                                    <label class="block text-[10px] font-black text-indigo-400 uppercase tracking-widest mb-3">Descripción de Objetivos</label>
                                    <textarea wire:model="description" rows="5" class="w-full px-5 py-4 glass rounded-2xl text-white outline-none focus:ring-2 focus:ring-indigo-500/50 transition-all font-medium text-sm"></textarea>
                                    @error('description') <span class="text-rose-500 text-[10px] font-black uppercase mt-2 block">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div>
                                <label class="block text-[10px] font-black text-indigo-400 uppercase tracking-widest mb-3">Ejercicios Incluidos</label>
                                <div class="glass rounded-[2rem] p-4 max-h-[16rem] overflow-y-auto space-y-2 custom-scrollbar shadow-inner border border-white/5">
                                    @foreach($availableExercises as $ex)
                                        <div wire:click="toggleExercise({{ $ex->id }})" class="group cursor-pointer flex items-center justify-between p-4 rounded-2xl transition-all border border-transparent {{ in_array($ex->id, $selectedExercises) ? 'bg-indigo-600/20 border-indigo-500/30' : 'hover:bg-white/5' }}">
                                            <div class="flex items-center gap-4">
                                                <div class="w-10 h-10 rounded-xl bg-slate-950 flex items-center justify-center shadow-inner group-hover:scale-110 transition-transform">
                                                    <span class="text-xs font-black {{ in_array($ex->id, $selectedExercises) ? 'text-indigo-400' : 'text-slate-700' }} uppercase leading-none">{{ substr($ex->name, 0, 2) }}</span>
                                                </div>
                                                <div>
                                                    <p class="text-xs font-bold {{ in_array($ex->id, $selectedExercises) ? 'text-white' : 'text-slate-400 group-hover:text-slate-300' }} transition-colors uppercase tracking-tight">{{ $ex->name }}</p>
                                                    <p class="text-[9px] font-black text-slate-600 uppercase tracking-widest mt-1">{{ $ex->target_muscle }}</p>
                                                </div>
                                            </div>
                                            @if(in_array($ex->id, $selectedExercises))
                                                <div class="w-6 h-6 bg-indigo-500 rounded-full flex items-center justify-center shadow-lg shadow-indigo-500/30">
                                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                                </div>
                                            @else
                                                <div class="w-6 h-6 border border-white/10 rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                                    <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                                <p class="text-[9px] text-slate-500 font-bold uppercase tracking-widest mt-4 flex items-center gap-2 px-2">
                                    <svg class="w-4 h-4 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    Selecciona los movimientos que compondrán esta sesión.
                                </p>
                            </div>
                        </div>

                        <div class="mt-10 pt-10 border-t border-white/5 flex flex-col md:flex-row items-center justify-end gap-6">
                            <button type="button" wire:click="closeModal()" class="w-full md:w-auto px-10 py-4 glass rounded-2xl text-[10px] font-black uppercase tracking-widest text-slate-500 hover:text-white transition-all">Cancelar</button>
                            <button type="submit" class="w-full md:w-auto px-10 py-4 bg-indigo-600 hover:bg-indigo-500 text-white font-black uppercase tracking-widest text-[10px] rounded-2xl transition-all shadow-xl shadow-indigo-500/20">Finalizar Rutina</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
