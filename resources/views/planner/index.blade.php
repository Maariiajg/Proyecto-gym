<x-app-layout>
    <x-slot name="header">
        {{ auth()->user()->hasRole('admin') ? 'Gestión de Planificación' : 'Mi Planificación Semanal' }}
    </x-slot>

    <div class="py-8 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-10">
            @role('admin')
                <livewire:admin-planner />
            @else
                <livewire:weekly-planner />
            @endrole
        </div>
    </div>
</x-app-layout>
