<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-black text-3xl text-white tracking-tighter uppercase leading-none">
                    {{ $exercise->name }}
                </h2>
                <p class="text-[10px] font-black text-indigo-400 uppercase tracking-[0.3em] mt-3 italic">Especificación Técnica del Movimiento</p>
            </div>
            <a href="{{ route('exercises.index') }}" class="px-6 py-3.5 glass text-slate-400 hover:text-white text-[10px] font-black uppercase tracking-widest rounded-2xl transition-all border border-white/5 shadow-inner">
                Biblioteca
            </a>
        </div>
    </x-slot>

    <div class="py-12 min-h-screen">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-10">
            <div class="glass rounded-[3rem] overflow-hidden border border-white/5 shadow-2xl relative">
                
                <!-- Hero Section with Media -->
                @if($exercise->getFirstMediaUrl('exercises'))
                    <div class="w-full h-[32rem] bg-slate-950 relative group">
                        <img src="/storage/{{ $exercise->getFirstMedia('exercises')->id }}/{{ $exercise->getFirstMedia('exercises')->file_name }}" alt="{{ $exercise->name }}" class="w-full h-full object-cover opacity-60 group-hover:opacity-80 transition-opacity duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/20 to-transparent"></div>
                        
                        <!-- Floating Details on Image -->
                        <div class="absolute bottom-10 left-10 right-10 flex flex-wrap gap-4">
                            <span class="px-5 py-2 rounded-full glass border border-indigo-500/30 text-[10px] font-black uppercase tracking-widest text-indigo-400">
                                {{ $exercise->target_muscle }}
                            </span>
                            <span class="px-5 py-2 rounded-full glass border border-white/10 text-[10px] font-black uppercase tracking-widest text-white">
                                Dificultad: {{ $exercise->difficulty_level }}
                            </span>
                        </div>
                    </div>
                @else
                    <div class="w-full h-64 bg-slate-900 flex flex-col items-center justify-center border-b border-white/5">
                        <span class="text-6xl font-black text-slate-800 italic select-none">TRENA ELITE</span>
                        <div class="flex gap-4 mt-8">
                            <span class="px-5 py-2 rounded-full glass border border-indigo-500/30 text-[10px] font-black uppercase tracking-widest text-indigo-400">
                                {{ $exercise->target_muscle }}
                            </span>
                            <span class="px-5 py-2 rounded-full glass border border-white/10 text-[10px] font-black uppercase tracking-widest text-white">
                                {{ $exercise->difficulty_level }}
                            </span>
                        </div>
                    </div>
                @endif
                
                <div class="p-12">
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                        <!-- Left: Instructions -->
                        <div class="lg:col-span-2 space-y-10">
                            <div>
                                <h3 class="text-[10px] font-black text-indigo-400 uppercase tracking-[0.3em] mb-6">Protocolo de Ejecución</h3>
                                <div class="text-slate-300 text-lg font-medium leading-relaxed whitespace-pre-wrap glass p-8 rounded-[2rem] border-white/5">
                                    {{ $exercise->description ?: 'No se han adjuntado instrucciones detalladas para este movimiento. Consulta con tu entrenador para la técnica correcta.' }}
                                </div>
                            </div>

                            @if($exercise->video_url)
                                <div>
                                    <h3 class="text-[10px] font-black text-indigo-400 uppercase tracking-[0.3em] mb-6">Demostración Dinámica</h3>
                                    <a href="{{ $exercise->video_url }}" target="_blank" class="inline-flex items-center gap-4 px-8 py-4 bg-rose-600 hover:bg-rose-500 text-white font-black uppercase tracking-widest text-[10px] rounded-2xl transition-all shadow-xl shadow-rose-500/20 group">
                                        <svg class="w-6 h-6 group-hover:scale-110 transition-transform" fill="currentColor" viewBox="0 0 24 24"><path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"/></svg>
                                        Ver Técnica en YouTube
                                    </a>
                                </div>
                            @endif
                        </div>

                        <!-- Right: Tips / Context -->
                        <div class="space-y-8">
                            <div class="glass p-8 rounded-[2rem] border-indigo-500/20 bg-indigo-500/5">
                                <h4 class="text-[10px] font-black text-indigo-400 uppercase tracking-[0.3em] mb-4">Nota de Seguridad</h4>
                                <p class="text-xs text-slate-400 leading-relaxed font-medium">Mantén siempre el control en la fase excéntrica del movimiento para maximizar el reclutamiento de fibras y minimizar el riesgo de lesión articular.</p>
                            </div>
                            
                            <div class="glass p-8 rounded-[2rem] border-white/5">
                                <h4 class="text-[10px] font-black text-slate-500 uppercase tracking-[0.3em] mb-4">Músculos Involucrados</h4>
                                <div class="flex flex-wrap gap-2">
                                    <span class="text-[9px] font-black text-white px-3 py-1 bg-white/5 rounded-lg border border-white/5 uppercase">{{ $exercise->target_muscle }}</span>
                                    <span class="text-[9px] font-black text-slate-600 px-3 py-1 bg-white/5 rounded-lg border border-white/5 uppercase italic">Estabilizadores</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
