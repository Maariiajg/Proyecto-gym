<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Crear Nuevo Ejercicio') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('exercises.store') }}" method="POST" class="space-y-6">
                        @csrf

                        <div>
                            <x-input-label for="name" :value="__('Nombre del Ejercicio')" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name')" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>

                        <div>
                            <x-input-label for="muscle_group" :value="__('Grupo Muscular')" />
                            <x-text-input id="muscle_group" name="muscle_group" type="text" class="mt-1 block w-full" :value="old('muscle_group')" required />
                            <x-input-error class="mt-2" :messages="$errors->get('muscle_group')" />
                        </div>

                        <div>
                            <x-input-label for="description" :value="__('Descripción')" />
                            <textarea id="description" name="description" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" rows="4" required>{{ old('description') }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('description')" />
                        </div>

                        <div>
                            <x-input-label for="media_url" :value="__('URL de Media (Imagen/Video)')" />
                            <x-text-input id="media_url" name="media_url" type="url" class="mt-1 block w-full" :value="old('media_url')" placeholder="https://..." />
                            <x-input-error class="mt-2" :messages="$errors->get('media_url')" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Guardar Ejercicio') }}</x-primary-button>
                            <a href="{{ route('exercises.index') }}" class="text-sm text-gray-600 hover:text-gray-900 underline">
                                {{ __('Cancelar') }}
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
