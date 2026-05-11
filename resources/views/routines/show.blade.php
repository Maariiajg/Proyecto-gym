<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div>
                <h2 class="font-black text-3xl text-white tracking-tighter uppercase">
                    {{ $routine->name }}
                </h2>
                <div class="flex items-center gap-3 mt-2">
                    <span class="px-3 py-1 rounded-full glass border border-indigo-500/20 text-[10px] font-black uppercase tracking-widest text-indigo-400">
                        {{ $routine->exercises->count() }} Movimientos Técnicos
                    </span>
                    <span class="text-slate-600 text-[10px] font-black uppercase tracking-widest italic">Autor: {{ $routine->creator->name ?? 'Sistema' }}</span>
                </div>
            </div>
            
            <div class="flex items-center gap-4">
                <form action="{{ route('routines.complete', $routine) }}" method="POST">
                    @csrf
                    <button type="submit" class="inline-flex items-center px-8 py-3.5 bg-emerald-600 hover:bg-emerald-500 text-white text-[10px] font-black uppercase tracking-widest rounded-2xl transition-all shadow-xl shadow-emerald-500/20 group">
                        <svg class="w-5 h-5 mr-3 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        Finalizar Sesión
                    </button>
                </form>
                <a href="{{ route('routines.index') }}" class="px-6 py-3.5 glass text-slate-400 hover:text-white text-[10px] font-black uppercase tracking-widest rounded-2xl transition-all border border-white/5">
                    Volver
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-10 space-y-12">
            
            <!-- Routine Abstract -->
            <div class="glass rounded-[3rem] p-12 border border-white/5 shadow-2xl relative overflow-hidden group">
                <div class="absolute -top-20 -right-20 w-64 h-64 bg-indigo-500/5 rounded-full blur-3xl group-hover:scale-125 transition-transform duration-700"></div>
                <div class="relative z-10">
                    <h3 class="text-[10px] font-black text-indigo-400 uppercase tracking-[0.3em] mb-6">Descripción de la Sesión</h3>
                    <p class="text-slate-300 text-xl font-medium leading-relaxed max-w-4xl italic">
                        "{{ $routine->description ?: 'Esta rutina ha sido diseñada para maximizar la respuesta hipertrófica y mejorar la fuerza funcional mediante movimientos multiarticulares.' }}"
                    </p>
                </div>
            </div>

            <!-- Exercises Technical Grid -->
            <div>
                <div class="flex items-center justify-between mb-10">
                    <h3 class="text-2xl font-black text-white uppercase tracking-tight">Desglose de <span class="text-indigo-500 italic">Movimientos</span></h3>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @forelse($routine->exercises as $exercise)
                        <div class="glass rounded-[2.5rem] overflow-hidden border border-white/5 hover:border-indigo-500/30 transition-all duration-500 group cursor-pointer" onclick="window.location.href='{{ route('exercises.show', $exercise) }}'">
                            <div class="h-56 bg-slate-950 relative overflow-hidden">
                                @if($exercise->getFirstMediaUrl('exercises'))
                                    <img src="/storage/{{ $exercise->getFirstMedia('exercises')->id }}/{{ $exercise->getFirstMedia('exercises')->file_name }}" alt="{{ $exercise->name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 opacity-40 group-hover:opacity-100">
                                @else
                                    <div class="flex items-center justify-center h-full text-slate-800 italic font-black text-5xl opacity-20">TRENA</div>
                                @endif
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-transparent to-transparent"></div>
                                
                                <div class="absolute top-6 left-6">
                                    <span class="px-4 py-1.5 rounded-full glass border border-white/10 text-[9px] font-black uppercase tracking-widest text-indigo-400">
                                        {{ $exercise->difficulty_level }}
                                    </span>
                                </div>
                            </div>
                            
                            <div class="p-8">
                                <h4 class="text-2xl font-black text-white tracking-tight uppercase group-hover:text-indigo-400 transition-colors mb-2 leading-none">{{ $exercise->name }}</h4>
                                <p class="text-[10px] font-black text-slate-500 uppercase tracking-widest mb-6">{{ $exercise->target_muscle }}</p>
                                
                                <div class="grid grid-cols-3 gap-1 p-1 bg-slate-950/50 rounded-2xl border border-white/5 shadow-inner">
                                    <div class="text-center py-4 rounded-xl hover:bg-white/5 transition-colors">
                                        <span class="block text-[8px] font-black text-slate-600 uppercase tracking-widest mb-1">Series</span>
                                        <span class="block text-lg font-black text-white">4</span>
                                    </div>
                                    <div class="text-center py-4 rounded-xl hover:bg-white/5 transition-colors border-x border-white/5">
                                        <span class="block text-[8px] font-black text-slate-600 uppercase tracking-widest mb-1">Reps</span>
                                        <span class="block text-lg font-black text-white">10-12</span>
                                    </div>
                                    <div class="text-center py-4 rounded-xl hover:bg-white/5 transition-colors">
                                        <span class="block text-[8px] font-black text-slate-600 uppercase tracking-widest mb-1">Pausa</span>
                                        <span class="block text-lg font-black text-white">90<span class="text-[10px] ml-0.5">S</span></span>
                                    </div>
                                </div>
                                
                                <div class="mt-6 flex justify-center">
                                    <span class="text-[9px] font-black text-indigo-400/50 uppercase tracking-[0.3em] group-hover:text-indigo-400 transition-colors">Ver técnica de ejecución &rarr;</span>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-3 py-20 glass rounded-[2.5rem] border-dashed border-white/10 flex flex-col items-center justify-center text-slate-600">
                            <svg class="w-16 h-16 mb-4 opacity-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                            <p class="font-black text-[10px] uppercase tracking-widest">Sin movimientos asignados</p>
                        </div>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
