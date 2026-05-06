<x-app-layout>
    <div class="py-12 bg-gray-50 dark:bg-gray-950 min-h-screen">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white tracking-tight italic uppercase">Historial de Rutinas</h2>
                    <p class="mt-2 text-gray-500 dark:text-gray-400 font-medium">Cada rutina completada es un paso más hacia tu meta.</p>
                </div>
                <a href="{{ route('progress.index') }}" class="text-sm font-bold text-indigo-600 hover:text-indigo-700">
                    &larr; Volver a Progreso
                </a>
            </div>

            <div class="bg-white dark:bg-gray-900 rounded-3xl shadow-xl shadow-indigo-100/10 border border-gray-100 dark:border-gray-800 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50 dark:bg-gray-800/50">
                                <th class="px-8 py-5 text-xs font-black text-gray-400 uppercase tracking-widest border-b border-gray-100 dark:border-gray-800">Fecha y Hora</th>
                                <th class="px-8 py-5 text-xs font-black text-gray-400 uppercase tracking-widest border-b border-gray-100 dark:border-gray-800">Rutina Completada</th>
                                <th class="px-8 py-5 text-xs font-black text-gray-400 uppercase tracking-widest border-b border-gray-100 dark:border-gray-800 text-right">Estatus</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50 dark:divide-gray-800">
                            @forelse($logs as $log)
                                <tr class="hover:bg-indigo-50/30 dark:hover:bg-indigo-900/10 transition-all group">
                                    <td class="px-8 py-6">
                                        <div class="flex flex-col">
                                            <span class="text-sm font-bold text-gray-900 dark:text-white">{{ date('d/m/Y', strtotime($log->completed_at)) }}</span>
                                            <span class="text-[10px] text-gray-400 font-medium">{{ date('H:i', strtotime($log->completed_at)) }}</span>
                                        </div>
                                    </td>
                                    <td class="px-8 py-6">
                                        <div class="flex items-center gap-3">
                                            <div class="p-2 bg-indigo-100 dark:bg-indigo-900/30 rounded-lg text-indigo-600 dark:text-indigo-400">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                                            </div>
                                            <span class="text-sm font-black text-gray-800 dark:text-gray-200 uppercase italic tracking-tight">{{ $log->routine->name }}</span>
                                        </div>
                                    </td>
                                    <td class="px-8 py-6 text-right">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-black bg-emerald-100 dark:bg-emerald-900/40 text-emerald-700 dark:text-emerald-400 uppercase tracking-tighter shadow-sm border border-emerald-200/50 dark:border-emerald-800/50">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                            Completado
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-8 py-20 text-center">
                                        <div class="flex flex-col items-center">
                                            <svg class="w-16 h-16 text-gray-200 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                                            <p class="text-gray-400 font-medium italic">Aún no has completado ninguna rutina. ¡Empieza hoy!</p>
                                        </div>
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
