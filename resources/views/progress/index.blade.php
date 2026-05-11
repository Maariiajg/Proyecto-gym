<x-app-layout>
    <x-slot name="header">
        Mi Progreso
    </x-slot>

    <div class="py-8 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-10">

            @livewire('user-progress')
        </div>
    </div>
</x-app-layout>
