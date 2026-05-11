<x-app-layout>
    <div class="py-12 min-h-screen">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-10">
            <div class="flex items-center justify-between mb-10">
                <div>
                    <h2 class="text-4xl font-black text-white uppercase tracking-tighter mb-2">Cronología de <span class="text-indigo-500 italic">Sesiones</span></h2>
                    <p class="text-slate-500 text-sm font-bold uppercase tracking-widest mt-1">Tu disciplina forjada en registros históricos</p>
                </div>
                <a href="{{ route('progress.index') }}" class="px-6 py-3 glass text-slate-400 hover:text-white text-[10px] font-black uppercase tracking-widest rounded-2xl transition-all border border-white/5">
                    &larr; Volver
                </a>
            </div>

            <div class="glass rounded-[3rem] border border-white/5 shadow-2xl overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="bg-slate-950/40">
                                <th class="px-8 py-6 text-[10px] font-black text-slate-500 uppercase tracking-widest">Cronología Técnica</th>
                                <th class="px-8 py-6 text-[10px] font-black text-slate-500 uppercase tracking-widest">Sistema Ejecutado</th>
                                <th class="px-8 py-6 text-[10px] font-black text-slate-500 uppercase tracking-widest text-right">Estatus</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/5">
                            @forelse($logs as $log)
                                <tr class="hover:bg-white/5 transition-all group">
                                    <td class="px-8 py-6">
                                        <div class="flex items-center gap-3">
                                            <div class="w-2 h-2 rounded-full bg-indigo-500/50 group-hover:bg-indigo-500 transition-colors"></div>
                                            <div class="flex flex-col">
                                                <span class="text-sm font-black text-white italic uppercase tracking-tighter">{{ date('d/m/Y', strtotime($log->completed_at)) }}</span>
                                                <span class="text-[10px] text-slate-500 font-black uppercase tracking-widest">{{ date('H:i', strtotime($log->completed_at)) }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-8 py-6">
                                        <div class="flex items-center gap-4">
                                            <div class="w-10 h-10 bg-slate-900 rounded-xl flex items-center justify-center text-xl shadow-inner group-hover:scale-110 transition-transform">💪</div>
                                            <span class="text-sm font-black text-white uppercase italic tracking-tight group-hover:text-indigo-400 transition-colors">{{ $log->routine->name }}</span>
                                        </div>
                                    </td>
                                    <td class="px-8 py-6 text-right">
                                        <span class="inline-flex items-center px-4 py-1.5 rounded-full glass border border-emerald-500/20 text-[9px] font-black text-emerald-400 uppercase tracking-widest shadow-lg">
                                            <svg class="w-3 h-3 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                            Misión Cumplida
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-8 py-24 text-center">
                                        <p class="text-slate-600 font-black text-[10px] uppercase tracking-[0.3em] italic">No se han registrado sesiones completadas en el sistema.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
