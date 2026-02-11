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
        'name'=> 'Editar',
    ]
]">

{{-- PLANTILLA --}}
<div class="card">
    <form action="{{ route('admin.users.update', $user) }}" method="POST">
        @csrf
        @method('PUT')

        <x-validation-errors class="mb-4"/>

        {{-- Nombre --}}
        <div class="mb-4">
            <x-label class="mb-1">
                Nombre
            </x-label>
            <x-input name="name" value="{{ old('name', $user->name) }}" required class="w-full"/>
        </div>

        {{-- Email --}}
        <div class="mb-4">
            <x-label class="mb-1">
                Correo Electrónico
            </x-label>
            <x-input type="email" name="email" value="{{ old('email', $user->email) }}" required class="w-full"/>
        </div>

        {{-- TELÉFONO --}}
        <div class="mb-4">
            <x-label class="mb-1">
                Teléfono
            </x-label>
            <x-input
                type="tel"
                name="phone"
                value="{{ old('phone', $user->phone) }}"
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
            <x-input type="password" name="password" class="w-full"/>
            <small class="text-gray-500">Dejar vacío para mantener la contraseña actual</small>
        </div>

        {{-- Confirmar Password --}}
        <div class="mb-4">
            <x-label class="mb-1">
                Confirmar Contraseña
            </x-label>
            <x-input type="password" name="password_confirmation" class="w-full"/>
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
                                <x-checkbox name="roles[]" value="{{ $role->id }}" :checked="in_array($role-> id, old('roles', $user ->roles->pluck('id')->toArray()))"/>
                                {{ $role->name }}
                            </label>
                        </li>
                    @endforeach
                </ul>
            </div>


        {{-- Enviar datos del formulario --}}
        <div class="flex justify-end space-x-2">
            <x-danger-button onclick="confirmDelete()">
                    Eliminar
            </x-danger-button>
            <x-button>
                Actualizar
            </x-button>
        </div>
    </form>
</div>
{{-- PLANTILLA --}}

{{-- Otro formulario --}}
    <form action="{{ route('admin.users.destroy', $user) }}"  method="POST" id="deleteForm">
        @csrf
        @method('DELETE')
    </form>
    {{-- Otro formulario --}}

    @push('js')
        <script>
            function confirmDelete()
            {
                // START Mensaje de alerta
                Swal.fire({
                    title: "¿Estás seguro?",
                    text: "¡No podrás revertir esto!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "¡Si, borralo!",
                    cancelButtonText: "Cancelar"
                }).then((result) => {
                    if (result.isConfirmed) {
                        //Eliminar Usuario
                        document.getElementById('deleteForm').submit();
                    }
                });
                // END Mensaje de alerta
            }
        </script>
    @endpush
</x-admin-layout>
