<div class="space-y-10">
    <!-- Header with Search & Add -->
    <div class="flex flex-col md:flex-row justify-between items-center gap-6">
        <div>
            <h1 class="text-4xl font-black text-white uppercase tracking-tighter mb-2">Biblioteca de <span class="text-indigo-500 italic">Ejercicios</span></h1>
            <p class="text-slate-500 text-sm font-bold uppercase tracking-widest">Explora y gestiona tu arsenal de entrenamiento</p>
        </div>
        
        <div class="flex items-center gap-4 w-full md:w-auto">
            <div class="relative flex-1 md:w-80 group">
                <span class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-slate-500 group-hover:text-indigo-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </span>
                <input wire:model.live="search" type="text" class="block w-full pl-12 pr-4 py-4 glass rounded-2xl text-white placeholder-slate-600 focus:ring-2 focus:ring-indigo-500/50 outline-none transition-all font-bold text-sm" placeholder="Buscar movimientos...">
            </div>
            
            @role('admin')
            <button wire:click="openModal()" class="px-6 py-4 bg-indigo-600 hover:bg-indigo-500 text-white font-black uppercase tracking-widest text-[10px] rounded-2xl transition-all shadow-xl shadow-indigo-500/20 flex items-center gap-3">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                Añadir
            </button>
            @endrole
        </div>
    </div>

    @if (session()->has('message'))
        <div class="p-4 bg-indigo-500/10 border border-indigo-500/20 text-indigo-400 rounded-2xl flex items-center gap-3 animate-pulse shadow-lg indigo-glow">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <span class="font-bold italic">{{ session('message') }}</span>
        </div>
    @endif

    <!-- Exercises Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($exercises as $exercise)
            <div class="glass rounded-[2.5rem] overflow-hidden border border-white/5 hover:border-indigo-500/30 transition-all duration-500 group relative cursor-pointer" 
                 onclick="window.location.href='{{ route('exercises.show', $exercise) }}'">
                <!-- Card Header with Image/Preview -->
                <div class="h-64 bg-slate-900 relative overflow-hidden">
                    @if($exercise->getFirstMediaUrl('exercises'))
                        <div class="w-full h-full overflow-hidden">
                            <img src="/storage/{{ $exercise->getFirstMedia('exercises')->id }}/{{ $exercise->getFirstMedia('exercises')->file_name }}" alt="{{ $exercise->name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 opacity-60 group-hover:opacity-100">
                        </div>
                    @else
                        <div class="flex items-center justify-center h-full text-slate-800 italic font-black text-6xl select-none group-hover:scale-110 transition-transform">
                            TRENA
                        </div>
                    @endif
                    
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-transparent to-transparent"></div>
                    
                    <!-- Difficulty Badge -->
                    <div class="absolute top-6 left-6">
                        <span class="px-4 py-1.5 rounded-full glass border border-white/10 text-[9px] font-black uppercase tracking-widest
                            {{ $exercise->difficulty_level === 'principiante' ? 'text-emerald-400' : ($exercise->difficulty_level === 'intermedio' ? 'text-orange-400' : 'text-rose-500') }}">
                            {{ $exercise->difficulty_level }}
                        </span>
                    </div>
                </div>

                <!-- Card Content -->
                <div class="p-8 relative">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <h4 class="text-2xl font-black text-white tracking-tight group-hover:text-indigo-400 transition-colors uppercase leading-none">{{ $exercise->name }}</h4>
                            <p class="text-[10px] font-black text-indigo-400 uppercase tracking-widest mt-2 border-b border-indigo-500/20 inline-block pb-1">{{ $exercise->target_muscle }}</p>
                        </div>
                        @if($exercise->video_url)
                            <a href="{{ $exercise->video_url }}" target="_blank" onclick="event.stopPropagation()" class="p-3 glass rounded-xl text-slate-500 hover:text-rose-500 transition-all group/btn shadow-inner">
                                <svg class="w-6 h-6 group-hover/btn:scale-110" fill="currentColor" viewBox="0 0 24 24"><path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"/></svg>
                            </a>
                        @endif
                    </div>
                    
                    <p class="text-sm text-slate-400 font-medium leading-relaxed line-clamp-2 min-h-[3rem] mb-8">
                        {{ $exercise->description ?: 'Instrucciones técnicas no detalladas para este movimiento.' }}
                    </p>
                    
                    <!-- Admin Actions -->
                    @role('admin')
                    <div class="flex gap-4 pt-6 border-t border-white/5">
                        <button wire:click="edit({{ $exercise->id }})" onclick="event.stopPropagation()" class="flex-1 px-4 py-3 glass rounded-xl text-[10px] font-black uppercase tracking-widest text-slate-400 hover:text-white hover:border-indigo-500/50 transition-all">
                            Editar
                        </button>
                        <button wire:click="delete({{ $exercise->id }})" onclick="event.stopPropagation()" wire:confirm="¿Deseas eliminar este ejercicio de la biblioteca?" class="px-4 py-3 glass rounded-xl text-slate-500 hover:text-rose-500 transition-all shadow-inner">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        </button>
                    </div>
                    @endrole
                </div>
            </div>
        @endforeach
    </div>

    <!-- Modal Premium -->
    @if($isModalOpen)
        <div class="fixed inset-0 z-[60] flex items-center justify-center p-4">
            <div class="fixed inset-0 bg-slate-950/80 backdrop-blur-xl transition-opacity" wire:click="closeModal()"></div>

            <div class="relative glass rounded-[2.5rem] w-full max-w-2xl overflow-hidden shadow-2xl border border-white/10 animate-scale-in">
                <form wire:submit.prevent="store">
                    <div class="p-10">
                        <div class="flex justify-between items-center mb-10">
                            <div>
                                <h3 class="text-3xl font-black text-white uppercase tracking-tighter">{{ $exerciseId ? 'Modificar' : 'Crear' }} <span class="text-indigo-500 italic">Ejercicio</span></h3>
                                <p class="text-slate-500 text-[10px] font-black uppercase tracking-widest mt-2">Introduce los parámetros técnicos del movimiento</p>
                            </div>
                            <button type="button" wire:click="closeModal()" class="p-3 glass rounded-full text-slate-500 hover:text-white transition-colors shadow-inner">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                            </button>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div class="space-y-6">
                                <div>
                                    <label class="block text-[10px] font-black text-indigo-400 uppercase tracking-widest mb-3">Nombre del Movimiento</label>
                                    <input wire:model="name" type="text" class="w-full px-5 py-4 glass rounded-2xl text-white outline-none focus:ring-2 focus:ring-indigo-500/50 transition-all font-bold">
                                    @error('name') <span class="text-rose-500 text-[10px] font-black uppercase mt-2 block">{{ $message }}</span> @enderror
                                </div>

                                <div>
                                    <label class="block text-[10px] font-black text-indigo-400 uppercase tracking-widest mb-3">Músculo Objetivo</label>
                                    <input wire:model="target_muscle" type="text" placeholder="Ej: Pectoral Mayor" class="w-full px-5 py-4 glass rounded-2xl text-white outline-none focus:ring-2 focus:ring-indigo-500/50 transition-all font-bold">
                                    @error('target_muscle') <span class="text-rose-500 text-[10px] font-black uppercase mt-2 block">{{ $message }}</span> @enderror
                                </div>

                                <div>
                                    <label class="block text-[10px] font-black text-indigo-400 uppercase tracking-widest mb-3">Nivel de Dificultad</label>
                                    <select wire:model="difficulty_level" class="w-full px-5 py-4 glass rounded-2xl text-white outline-none focus:ring-2 focus:ring-indigo-500/50 transition-all font-bold appearance-none bg-slate-900">
                                        <option value="principiante" class="text-black">Principiante</option>
                                        <option value="intermedio" class="text-black">Intermedio</option>
                                        <option value="avanzado" class="text-black">Avanzado</option>
                                    </select>
                                    @error('difficulty_level') <span class="text-rose-500 text-[10px] font-black uppercase mt-2 block">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="space-y-6">
                                <div>
                                    <label class="block text-[10px] font-black text-indigo-400 uppercase tracking-widest mb-3">Descripción Técnica</label>
                                    <textarea wire:model="description" rows="5" class="w-full px-5 py-4 glass rounded-2xl text-white outline-none focus:ring-2 focus:ring-indigo-500/50 transition-all font-medium text-sm"></textarea>
                                    @error('description') <span class="text-rose-500 text-[10px] font-black uppercase mt-2 block">{{ $message }}</span> @enderror
                                </div>

                                <div>
                                    <label class="block text-[10px] font-black text-indigo-400 uppercase tracking-widest mb-3">Referencia Multimedia (Video/GIF)</label>
                                    <input wire:model="video_url" type="text" placeholder="URL de YouTube o MP4" class="w-full px-5 py-4 glass rounded-2xl text-white outline-none focus:ring-2 focus:ring-indigo-500/50 transition-all font-bold">
                                    @error('video_url') <span class="text-rose-500 text-[10px] font-black uppercase mt-2 block">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mt-10 pt-10 border-t border-white/5 flex flex-col md:flex-row items-center justify-between gap-6">
                            <div class="flex items-center gap-4">
                                <label class="cursor-pointer group">
                                    <div class="px-6 py-4 glass rounded-2xl text-[10px] font-black uppercase tracking-widest text-slate-400 group-hover:text-white transition-all shadow-inner">Subir Imagen</div>
                                    <input wire:model="image" type="file" class="hidden">
                                </label>
                                @if ($image)
                                    <img src="{{ $image->temporaryUrl() }}" class="w-14 h-14 rounded-xl object-cover border-2 border-indigo-500 animate-bounce">
                                @endif
                                @error('image') <span class="text-rose-500 text-[10px] font-black uppercase">{{ $message }}</span> @enderror
                            </div>

                            <div class="flex gap-4 w-full md:w-auto">
                                <button type="button" wire:click="closeModal()" class="flex-1 md:flex-none px-10 py-4 glass rounded-2xl text-[10px] font-black uppercase tracking-widest text-slate-500 hover:text-white transition-all">Cancelar</button>
                                <button type="submit" class="flex-1 md:flex-none px-10 py-4 bg-indigo-600 hover:bg-indigo-500 text-white font-black uppercase tracking-widest text-[10px] rounded-2xl transition-all shadow-xl shadow-indigo-500/20">Guardar Datos</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
