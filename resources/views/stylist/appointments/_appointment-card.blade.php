{{-- resources/views/stylist/appointments/_appointment-card.blade.php --}}
{{-- Partial reutilizable para mostrar una cita en la vista de día --}}

@php
    $statusLabels = [
        'pending'   => 'Pendiente',
        'confirmed' => 'Confirmada',
        'completed' => 'Completada',
        'cancelled' => 'Cancelada',
        'no_show'   => 'No asistió',
    ];
    $statusIcons = [
        'pending'   => 'fa-solid fa-hourglass-half',
        'confirmed' => 'fa-solid fa-circle-check',
        'completed' => 'fa-solid fa-check-double',
        'cancelled' => 'fa-solid fa-ban',
        'no_show'   => 'fa-solid fa-user-xmark',
    ];
@endphp

<div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden hover:shadow-md transition-shadow">
    <div class="flex items-stretch">
        {{-- Barra lateral de color --}}
        <div class="w-1.5 flex-shrink-0" style="background-color: {{ $appointment->status_color }};"></div>

        <div class="flex-1 flex flex-col sm:flex-row sm:items-center gap-4 p-5">
            {{-- Bloque de hora --}}
            <div class="flex-shrink-0 text-center sm:text-right w-20">
                <p class="text-lg font-bold text-gray-800 dark:text-white font-mono">
                    {{ \Carbon\Carbon::parse($appointment->start_time)->format('g:i') }}
                </p>
                <p class="text-xs text-gray-400 dark:text-gray-500 uppercase">
                    {{ \Carbon\Carbon::parse($appointment->start_time)->format('A') }}
                </p>
            </div>

            {{-- Info del servicio y cliente --}}
            <div class="flex-1 min-w-0">
                <h3 class="text-base font-semibold text-gray-800 dark:text-white truncate">
                    {{ $appointment->service->name }}
                </h3>
                <div class="flex flex-wrap items-center gap-x-4 gap-y-1 mt-1.5 text-sm text-gray-500 dark:text-gray-400">
                    <span class="inline-flex items-center gap-1.5">
                        <i class="fa-regular fa-user text-xs"></i>
                        {{ $appointment->client->name }}
                    </span>
                    <span class="inline-flex items-center gap-1.5">
                        <i class="fa-regular fa-clock text-xs"></i>
                        {{ $appointment->time_range }}
                    </span>
                </div>
                @if($appointment->notes)
                    <p class="mt-2 text-xs text-gray-400 dark:text-gray-500 italic truncate">
                        <i class="fa-regular fa-note-sticky mr-1"></i>
                        {{ $appointment->notes }}
                    </p>
                @endif
            </div>

            {{-- Estado --}}
            <div class="flex-shrink-0">
                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium rounded-full"
                      style="background: {{ $appointment->status_color }}15; color: {{ $appointment->status_color }};">
                    <i class="{{ $statusIcons[$appointment->status] ?? 'fa-solid fa-circle' }} text-[10px]"></i>
                    {{ $statusLabels[$appointment->status] ?? ucfirst($appointment->status) }}
                </span>
            </div>
        </div>
    </div>
</div>
