<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-100 leading-tight">
                {{ $routine->name }}
            </h2>
            <a href="{{ route('routines.index') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">
                &larr; Volver a Rutinas
            </a>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50 dark:bg-gray-900 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <!-- Routine Info -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl p-8 shadow-sm border border-gray-100 dark:border-gray-700">
                <p class="text-gray-600 dark:text-gray-300 text-lg mb-4">{{ $routine->description }}</p>
                <div class="flex items-center gap-4 text-sm text-gray-500">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-indigo-50 dark:bg-indigo-900/30 text-indigo-700 dark:text-indigo-400 font-bold">
                        💪 {{ $routine->exercises->count() }} ejercicios
                    </span>
                    <span>Creado por: {{ $routine->creator->name ?? 'Sistema' }}</span>
                </div>
            </div>

            <!-- Exercises List -->
            <div>
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-6">Ejercicios en esta Rutina</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse($routine->exercises as $exercise)
                        <div class="bg-white dark:bg-gray-800 rounded-2xl overflow-hidden shadow-sm border border-gray-100 dark:border-gray-700 group cursor-pointer" onclick="window.location.href='{{ route('exercises.show', $exercise) }}'">
                            <div class="h-40 bg-gray-200 dark:bg-gray-700 relative overflow-hidden">
                                @if($exercise->getFirstMediaUrl('exercises'))
                                    <img src="{{ $exercise->getFirstMediaUrl('exercises') }}" alt="{{ $exercise->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                @else
                                    <div class="flex items-center justify-center h-full text-gray-400">
                                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    </div>
                                @endif
                                <div class="absolute top-4 right-4">
                                    <span class="px-3 py-1 bg-white/90 dark:bg-gray-900/90 backdrop-blur-sm text-[10px] font-bold uppercase rounded-full shadow-sm
                                        {{ $exercise->difficulty_level === 'principiante' ? 'text-green-600' : ($exercise->difficulty_level === 'intermedio' ? 'text-orange-600' : 'text-red-600') }}">
                                        {{ $exercise->difficulty_level }}
                                    </span>
                                </div>
                            </div>
                            <div class="p-5">
                                <h4 class="text-lg font-bold text-gray-900 dark:text-white mb-1">{{ $exercise->name }}</h4>
                                <p class="text-xs font-semibold text-indigo-600 dark:text-indigo-400 mb-3 uppercase tracking-wider">{{ $exercise->target_muscle }}</p>
                                
                                <div class="flex items-center justify-between mt-4 p-3 bg-gray-50 dark:bg-gray-900/50 rounded-xl border border-gray-100 dark:border-gray-700">
                                    <div class="text-center px-2 border-r border-gray-200 dark:border-gray-700">
                                        <span class="block text-xs text-gray-500">Series</span>
                                        <span class="block font-bold text-gray-900 dark:text-white">{{ $exercise->pivot->sets ?? '-' }}</span>
                                    </div>
                                    <div class="text-center px-2 border-r border-gray-200 dark:border-gray-700">
                                        <span class="block text-xs text-gray-500">Reps</span>
                                        <span class="block font-bold text-gray-900 dark:text-white">{{ $exercise->pivot->reps ?? '-' }}</span>
                                    </div>
                                    <div class="text-center px-2">
                                        <span class="block text-xs text-gray-500">Descanso</span>
                                        <span class="block font-bold text-gray-900 dark:text-white">{{ $exercise->pivot->rest_time_seconds ?? '-' }}s</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-3 text-center py-12 text-gray-500">
                            No hay ejercicios asignados a esta rutina.
                        </div>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
