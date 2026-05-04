<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-100 leading-tight">
                {{ $exercise->name }}
            </h2>
            <a href="{{ route('exercises.index') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">
                &larr; Volver a Ejercicios
            </a>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50 dark:bg-gray-900 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 rounded-2xl overflow-hidden shadow-sm border border-gray-100 dark:border-gray-700">
                @if($exercise->getFirstMediaUrl('exercises'))
                    <div class="w-full h-80 bg-gray-200 dark:bg-gray-700">
                        <img src="{{ $exercise->getFirstMediaUrl('exercises') }}" alt="{{ $exercise->name }}" class="w-full h-full object-cover">
                    </div>
                @endif
                
                <div class="p-8">
                    <div class="flex gap-3 mb-6">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-bold bg-indigo-50 dark:bg-indigo-900/30 text-indigo-700 dark:text-indigo-400">
                            {{ $exercise->target_muscle }}
                        </span>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-bold 
                            {{ $exercise->difficulty_level === 'principiante' ? 'bg-green-50 text-green-700' : ($exercise->difficulty_level === 'intermedio' ? 'bg-orange-50 text-orange-700' : 'bg-red-50 text-red-700') }}">
                            Nivel {{ $exercise->difficulty_level }}
                        </span>
                    </div>

                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Instrucciones</h3>
                    <p class="text-gray-600 dark:text-gray-300 leading-relaxed whitespace-pre-wrap mb-8">{{ $exercise->description ?: 'Sin descripción detallada.' }}</p>

                    @if($exercise->video_url)
                        <div class="mt-8 border-t border-gray-100 dark:border-gray-700 pt-8">
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Video Demostrativo</h3>
                            <a href="{{ $exercise->video_url }}" target="_blank" class="inline-flex items-center gap-2 px-6 py-3 bg-red-600 hover:bg-red-700 text-white font-bold rounded-xl transition-all">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"/></svg>
                                Ver Video
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
