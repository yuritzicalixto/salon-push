<x-admin-layout :breadcrumbs="[
    [
        'name'=> 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name'=> 'Usuarios',
        'route' => route('admin.users.index'),
    ],
    [
        'name'=> 'Nuevo',
    ]
]">

{{-- PLANTILLA --}}
<div class="card">
    <form action="{{ route('admin.users.store') }}" method="POST">
        @csrf

        <x-validation-errors class="mb-4"/>

        {{-- Nombre --}}
        <div class="mb-4">
            <x-label class="mb-1">
                Nombre
            </x-label>
            <x-input name="name" value="{{ old('name') }}" required class="w-full"/>
        </div>

        {{-- Email --}}
        <div class="mb-4">
            <x-label class="mb-1">
                Correo Electrónico
            </x-label>
            <x-input type="email" name="email" value="{{ old('email') }}" required class="w-full"/>
        </div>

        {{-- TELÉFONO --}}
        <div class="mb-4">
            <x-label class="mb-1">
                Teléfono
            </x-label>
            <x-input
                type="tel"
                name="phone"
                value="{{ old('phone') }}"
                required
                class="w-full"
                placeholder="Ej: 9511234567"
                maxlength="15"
            />
        </div>

        {{-- Password --}}
        <div class="mb-4">
            <x-label class="mb-1">
                Contraseña
            </x-label>
            <x-input type="password" name="password" required class="w-full"/>
        </div>

        {{-- Confirmar Password --}}
        <div class="mb-4">
            <x-label class="mb-1">
                Confirmar Contraseña
            </x-label>
            <x-input type="password" name="password_confirmation" required class="w-full"/>
        </div>

        {{--Roles--}}
            <div class="mb-4">
                <x-label class="mb-1">
                    Roles
                </x-label>

                <ul>
                    @foreach ($roles as $role)
                        <li>
                            <label>
                                <x-checkbox name="roles[]" value="{{ $role->id }}" :checked="in_array($role-> id, old('roles', []))"/>
                                {{ $role->name }}
                            </label>
                        </li>
                    @endforeach
                </ul>
            </div>

        {{-- Enviar datos del formulario --}}
        <div class="flex justify-end">
            <x-button>
                Guardar
            </x-button>
        </div>
    </form>
</div>
{{-- PLANTILLA --}}

</x-admin-layout>
