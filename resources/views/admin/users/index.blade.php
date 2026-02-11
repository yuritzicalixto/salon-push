<x-admin-layout :breadcrumbs="[
    [
        'name'=> 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name'=> 'Usuarios',
    ],
]">

<x-slot name="action">
        <a class="text-blue-500" href="{{ route('admin.users.create') }}">
            Nuevo
        </a>
    </x-slot>

{{-- PLANTILLA --}}
@livewire('user-table')
{{-- PLANTILLA --}}

</x-admin-layout>
