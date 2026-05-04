<div>
    @if (session()->has('message'))
        <div class="mb-6 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 flex justify-between items-center rounded-r-xl">
            <span>{{ session('message') }}</span>
        </div>
    @endif

    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
        <div class="p-6 border-b border-gray-100 dark:border-gray-700 bg-gray-50 dark:bg-gray-900/50">
            <h3 class="text-xl font-bold text-gray-900 dark:text-white">
                @if($userId == auth()->id())
                    Tu Planificación Semanal
                @else
                    Planificación Semanal: {{ $this->getUser()->name }}
                @endif
            </h3>
            <p class="text-sm text-gray-500 mt-1">Asigna una rutina a cada día para mantener el enfoque.</p>
        </div>
        
        <div class="divide-y divide-gray-100 dark:divide-gray-700">
            @foreach($days as $day)
                <div class="p-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4 hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors">
                    <div class="flex items-center gap-4">
                        <div class="w-16 h-16 rounded-xl bg-indigo-50 dark:bg-indigo-900/30 flex items-center justify-center text-indigo-600 dark:text-indigo-400 font-bold capitalize shadow-sm">
                            {{ substr($day, 0, 3) }}
                        </div>
                        <div>
                            <h4 class="text-lg font-bold text-gray-900 dark:text-white capitalize">{{ $day }}</h4>
                            
                            @if($editingDay === $day)
                                <div class="mt-2 flex items-center gap-2">
                                    <select wire:model="selectedRoutine" class="text-sm px-3 py-1.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 dark:text-white focus:ring-2 focus:ring-indigo-500 outline-none">
                                        <option value="">-- Día de descanso --</option>
                                        @foreach($routines as $routine)
                                            <option value="{{ $routine->id }}">{{ $routine->name }}</option>
                                        @endforeach
                                    </select>
                                    <button wire:click="saveDay" class="px-3 py-1.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-bold rounded-lg transition-colors">Guardar</button>
                                    <button wire:click="cancelEdit" class="px-3 py-1.5 bg-gray-200 dark:bg-gray-600 text-gray-700 dark:text-gray-300 hover:bg-gray-300 dark:hover:bg-gray-500 text-sm font-bold rounded-lg transition-colors">Cancelar</button>
                                </div>
                            @else
                                @if(isset($plans[$day]))
                                    <a href="{{ route('routines.show', $plans[$day]->routine_id) }}" class="text-sm text-indigo-600 dark:text-indigo-400 hover:underline font-semibold mt-1 inline-block">
                                        💪 {{ $plans[$day]->routine->name }}
                                    </a>
                                @else
                                    <p class="text-sm text-gray-400 mt-1 italic">Día de descanso</p>
                                @endif
                            @endif
                        </div>
                    </div>
                    
                    @if($editingDay !== $day)
                        <button wire:click="editDay('{{ $day }}')" class="px-4 py-2 bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-800 text-gray-700 dark:text-gray-300 text-sm font-bold rounded-xl transition-colors shadow-sm">
                            {{ isset($plans[$day]) ? 'Cambiar' : 'Asignar' }}
                        </button>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</div>
