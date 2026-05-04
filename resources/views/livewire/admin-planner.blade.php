<div>
    @role('admin')
        <div class="flex p-1 bg-gray-200 dark:bg-gray-800 rounded-xl w-fit mb-6">
            <button wire:click="setTab('all')" class="px-6 py-2 rounded-lg text-sm font-bold transition-all {{ $activeTab === 'all' ? 'bg-white dark:bg-gray-700 shadow-sm text-indigo-600 dark:text-indigo-400' : 'text-gray-500 hover:text-gray-700 dark:hover:text-gray-300' }}">
                Planes de Usuarios
            </button>
            <button wire:click="setTab('mine')" class="px-6 py-2 rounded-lg text-sm font-bold transition-all {{ $activeTab === 'mine' ? 'bg-white dark:bg-gray-700 shadow-sm text-indigo-600 dark:text-indigo-400' : 'text-gray-500 hover:text-gray-700 dark:hover:text-gray-300' }}">
                Mi Propio Plan
            </button>
        </div>
    @endrole

    @if($activeTab === 'mine')
        <div class="max-w-4xl mx-auto">
            @livewire('weekly-planner', ['key' => 'my-own-planner'])
        </div>
    @elseif($selectedUserId)
        <div class="mb-6">
            <button wire:click="closeUserPlan" class="inline-flex items-center text-sm font-medium text-indigo-600 hover:text-indigo-500">
                &larr; Volver a la lista de usuarios
            </button>
        </div>
        
        @livewire('weekly-planner', ['userId' => $selectedUserId], key('user-planner-' . $selectedUserId))
    @else
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
            <div class="p-6 border-b border-gray-100 dark:border-gray-700 bg-gray-50 dark:bg-gray-900/50 flex flex-col md:flex-row justify-between items-center gap-4">
                <div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white">Gestión de Planes Semanales</h3>
                    <p class="text-sm text-gray-500 mt-1">Supervisa y edita la planificación de todos los usuarios.</p>
                </div>
                <div class="relative w-full md:w-64">
                    <input wire:model.live="search" type="text" class="block w-full pl-10 pr-3 py-2 border border-gray-300 dark:border-gray-700 rounded-xl bg-white dark:bg-gray-800 text-gray-900 dark:text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 sm:text-sm" placeholder="Buscar usuario...">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-gray-50 dark:bg-gray-900/50 text-gray-500 dark:text-gray-400 text-xs uppercase font-bold">
                        <tr>
                            <th class="px-6 py-4">Usuario</th>
                            <th class="px-6 py-4">Plan Semanal (Resumen)</th>
                            <th class="px-6 py-4 text-right">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                        @forelse($users as $user)
                            <tr wire:key="user-row-{{ $user->id }}" class="hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-full bg-indigo-100 dark:bg-indigo-900/30 flex items-center justify-center text-indigo-600 dark:text-indigo-400 font-bold">
                                            {{ substr($user->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <p class="text-sm font-bold text-gray-900 dark:text-white">{{ $user->name }}</p>
                                            <p class="text-xs text-gray-500">{{ $user->email }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex gap-1 flex-wrap">
                                        @php
                                            $daysArr = ['lunes', 'martes', 'miercoles', 'jueves', 'viernes', 'sabado', 'domingo'];
                                            $userPlans = $user->weeklyPlans->keyBy('day_of_week');
                                        @endphp
                                        @foreach($daysArr as $day)
                                            <div title="{{ ucfirst($day) }}: {{ isset($userPlans[$day]) ? $userPlans[$day]->routine->name : 'Descanso' }}" 
                                                 class="w-6 h-6 rounded flex items-center justify-center text-[10px] font-bold {{ isset($userPlans[$day]) ? 'bg-indigo-100 text-indigo-700 dark:bg-indigo-900/50 dark:text-indigo-300' : 'bg-gray-100 text-gray-400 dark:bg-gray-700 dark:text-gray-500' }}">
                                                {{ substr($day, 0, 1) }}
                                            </div>
                                        @endforeach
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <button wire:click="selectUser({{ $user->id }})" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold rounded-xl transition-all shadow-sm">
                                        Ver/Editar Plan
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-6 py-8 text-center text-gray-500">
                                    No se encontraron usuarios.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="px-6 py-4 border-t border-gray-100 dark:border-gray-700">
                {{ $users->links() }}
            </div>
        </div>
    @endif
</div>
