<x-app-layout>
    <div class="py-8 bg-gray-50 dark:bg-gray-950 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-8">
                <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white tracking-tight italic uppercase">Mi Progreso</h2>
                <p class="mt-2 text-gray-500 dark:text-gray-400 font-medium">Sigue tu evolución, registra tus pesos y supera tus límites cada día.</p>
            </div>

            @livewire('user-progress')
        </div>
    </div>
</x-app-layout>
