<div class="p-6">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Input Form -->
        <div class="bg-white dark:bg-gray-900 rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-gray-800">
            <div class="flex items-center gap-3 mb-6">
                <div class="p-2 bg-indigo-100 dark:bg-indigo-900/30 rounded-lg">
                    <svg class="w-5 h-5 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900 dark:text-white italic">{{ $isEditMode ? 'Editar registro' : 'Apuntar progreso' }}</h3>
                @if($isEditMode)
                    <button wire:click="cancelEdit" class="ml-auto text-xs font-bold text-red-500 uppercase hover:underline">Cancelar</button>
                @endif
            </div>
            
            <form wire:submit.prevent="store" class="space-y-4">
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Filtrar por Rutina</label>
                    <select wire:model.live="selectedRoutineId" class="w-full rounded-xl border-gray-200 dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:ring-indigo-500 transition-all font-medium mb-4">
                        <option value="">-- Todos los ejercicios --</option>
                        @foreach($routines as $routine)
                            <option value="{{ $routine->id }}">{{ $routine->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Ejercicio</label>
                    <select wire:model.live="selectedExerciseId" class="w-full rounded-xl border-gray-200 dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:ring-indigo-500 transition-all font-medium">
                        <option value="">Selecciona un ejercicio</option>
                        @foreach($exercises as $exercise)
                            @php $isLogged = in_array($exercise->id, $loggedToday); @endphp
                            <option value="{{ $exercise->id }}" {{ $isLogged ? 'disabled class=text-gray-400' : '' }}>
                                {{ $exercise->name }} {{ $isLogged ? '(Completado hoy)' : '' }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Peso (kg)</label>
                        <input type="number" step="0.5" wire:model.live="weight" placeholder="0.0" class="w-full rounded-xl border-gray-200 dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:ring-indigo-500">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Repeticiones</label>
                        <input type="number" wire:model.live="repetitions" placeholder="0" class="w-full rounded-xl border-gray-200 dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:ring-indigo-500">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Tiempo (seg)</label>
                        <input type="number" wire:model="time_spent_seconds" placeholder="Opcional" class="w-full rounded-xl border-gray-200 dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:ring-indigo-500">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Fecha</label>
                        <input type="date" wire:model.live="log_date" class="w-full rounded-xl border-gray-200 dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:ring-indigo-500">
                    </div>
                </div>

                <button type="submit" class="w-full py-4 {{ $isEditMode ? 'bg-amber-500 hover:bg-amber-600' : 'bg-indigo-600 hover:bg-indigo-700' }} text-white font-bold rounded-xl shadow-lg transition-all flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    {{ $isEditMode ? 'Actualizar Registro' : 'Guardar Registro' }}
                </button>
            </form>

                @if (session()->has('error'))
                    <div class="mt-4 p-4 bg-red-50 dark:bg-red-900/20 text-red-700 dark:text-red-400 text-sm font-bold rounded-xl border border-red-100 dark:border-red-800 flex items-center gap-2">
                        {{ session('error') }}
                    </div>
                @endif

                @if (session()->has('message'))
                    <div class="mt-4 p-4 bg-emerald-50 dark:bg-emerald-900/20 text-emerald-700 dark:text-emerald-400 text-sm font-bold rounded-xl border border-emerald-100 dark:border-emerald-800 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                        {{ session('message') }}
                    </div>
                @endif
            </div>

            <!-- Routine History Link -->
            <div class="bg-indigo-600 rounded-2xl p-6 shadow-lg text-white">
                <h4 class="font-bold mb-2">Historial de Rutinas</h4>
                <p class="text-xs text-indigo-100 mb-4">Consulta cuándo completaste tus rutinas favoritas.</p>
                <a href="{{ route('progress.routines') }}" class="inline-flex items-center text-xs font-bold bg-white text-indigo-600 px-4 py-2 rounded-lg hover:bg-indigo-50 transition-colors">
                    Ver historial de rutinas &rarr;
                </a>
            </div>
        </div>

        <!-- Chart / Stats -->
        <div class="lg:col-span-2 space-y-8">
            <div class="bg-white dark:bg-gray-900 rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-gray-800">
                <div class="flex items-center justify-between mb-8">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white italic">Evolución: {{ collect($exercises)->firstWhere('id', $selectedExerciseId)['name'] ?? '' }}</h3>
                    <div class="flex items-center gap-2">
                        <span class="w-3 h-3 bg-indigo-500 rounded-full"></span>
                        <span class="text-xs font-bold text-gray-500 uppercase">Peso (kg)</span>
                    </div>
                </div>
                
                @if(count($chartData) > 0)
                    <div class="overflow-x-auto pb-4 custom-scrollbar">
                        <div class="h-64 flex items-end justify-start gap-1 px-2 pb-10 border-b border-gray-100 dark:border-gray-800 min-w-[800px]">
                            @php
                                $maxWeight = collect($chartData)->max('weight') ?: 1;
                            @endphp
                            @foreach($chartData as $data)
                                @php 
                                    $isToday = $data['log_date'] === date('Y-m-d');
                                    $isSelected = $data['log_date'] === $log_date;
                                @endphp
                                <div class="flex-1 flex flex-col items-center group relative h-full justify-end min-w-[32px]">
                                    <div class="w-6 rounded-t-lg transition-all hover:scale-y-110 cursor-pointer relative shadow-md" 
                                         style="height: {{ $data['has_data'] ? max(15, ($data['weight'] / $maxWeight) * 100) : 4 }}%; background-color: {{ $data['has_data'] ? ($isSelected ? '#7e22ce' : '#9333ea') : '#f3f4f6' }};">
                                        
                                        @if($data['has_data'])
                                            <div class="absolute bottom-full mb-3 left-1/2 -translate-x-1/2 bg-gray-900 text-white text-[10px] py-1.5 px-2.5 rounded-lg opacity-0 group-hover:opacity-100 whitespace-nowrap pointer-events-none transition-all shadow-xl z-20">
                                                <span class="font-bold">{{ $data['weight'] }}kg</span> · {{ $data['repetitions'] }} reps
                                                <div class="absolute top-full left-1/2 -translate-x-1/2 border-8 border-transparent border-t-gray-900"></div>
                                            </div>
                                            <div class="absolute -top-7 inset-x-0 text-center">
                                                <span class="text-[11px] font-black text-black leading-none drop-shadow-sm">{{ (int)$data['weight'] }}</span>
                                            </div>
                                        @endif

                                        @if($isSelected)
                                            <div class="absolute -top-12 left-1/2 -translate-x-1/2">
                                                <span class="flex h-3 w-3">
                                                  <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-purple-400 opacity-75"></span>
                                                  <span class="relative inline-flex rounded-full h-3 w-3 bg-purple-600 shadow-sm"></span>
                                                </span>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="absolute top-full mt-3 flex flex-col items-center">
                                        <span class="text-[10px] font-black {{ $isSelected ? 'text-purple-700' : ($data['has_data'] ? 'text-gray-900' : 'text-gray-400') }}">{{ date('d', strtotime($data['log_date'])) }}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @else
                    <div class="h-64 flex flex-col items-center justify-center text-gray-400 border-2 border-dashed border-gray-100 dark:border-gray-800 rounded-2xl bg-gray-50/50 dark:bg-gray-800/20">
                        <svg class="w-12 h-12 mb-3 opacity-20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                        <p class="font-medium text-sm">Registra más pesos para ver tu progresión gráfica</p>
                    </div>
                @endif
            </div>

            <!-- History Table -->
            <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-800 overflow-hidden">
                <div class="p-6 border-b border-gray-100 dark:border-gray-800 flex items-center justify-between">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white italic text-indigo-600 uppercase tracking-wider">Historial reciente</h3>
                    <div class="p-2 bg-indigo-50 dark:bg-indigo-900/20 rounded-lg text-xs font-bold text-indigo-600">
                        Últimos 15 registros
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50 dark:bg-gray-800/50">
                                <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider border-b border-gray-100 dark:border-gray-800">Fecha</th>
                                <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider border-b border-gray-100 dark:border-gray-800">Peso</th>
                                <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider border-b border-gray-100 dark:border-gray-800">Repeticiones</th>
                                <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider border-b border-gray-100 dark:border-gray-800 text-right">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                            @forelse($logs->take(15) as $log)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-all group">
                                    <td class="px-6 py-4 text-sm text-gray-900 dark:text-white font-medium italic">{{ date('d/m/Y', strtotime($log->log_date)) }}</td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-sm font-bold bg-indigo-100 dark:bg-indigo-900/40 text-indigo-700 dark:text-indigo-300">
                                            {{ $log->weight }} kg
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400 font-bold group-hover:text-indigo-500 transition-colors">{{ $log->repetitions }} reps</td>
                                    <td class="px-6 py-4 text-right">
                                        <div class="flex justify-end gap-2">
                                            <button wire:click="edit({{ $log->id }})" class="p-2 text-gray-400 hover:text-indigo-600 transition-colors">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                            </button>
                                            <button wire:click="delete({{ $log->id }})" wire:confirm="¿Borrar este registro?" class="p-2 text-gray-400 hover:text-red-500 transition-colors">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-12 text-center text-gray-400 italic">
                                        <p>No hay registros para este ejercicio aún.</p>
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
