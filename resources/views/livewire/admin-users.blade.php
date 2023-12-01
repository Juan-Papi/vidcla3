<div>
    <div class="card">

        <div class="card-header">
            <input wire:keydown="limpiar_page" wire:model="buscar" class="form-control w-100"
                placeholder="Escriba un nombre ..." type="text">
        </div>
        @if (session('info'))
            <div class="alert alert-primary" role="alert">
                <strong>¡Éxito!</strong>
                {{ session('info') }}
            </div>
        @endif
        <div class="card-header">
            <a class="btn btn-secondary" href="{{ route('admin.users.create') }}">NUEVO USUARIO</a>
        </div>
        @if ($users->count())
            <div class="table-responsive">
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Email</th>
                                <th>Roles</th>
                                <th></th>
                                {{-- para el editar y eliminar --}}
                                <th colspan="2"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>

                                    <td>
                                        {{ $user->id }}
                                    </td>
                                    <td>
                                        {{ $user->name }}
                                    </td>
                                    <td>
                                        {{ $user->email }}
                                    </td>
                                    <td>
                                        {{-- aqui va los roles que tiene cada usuario considerando que estamos trabajando con laravel permissions y en caso de que no tenga rol debe decir ninguno --}}
                                        @if ($user->roles()->count() > 0)
                                            @foreach ($user->roles as $role)
                                                <span class="badge badge-primary">{{ $role->name }}</span>
                                            @endforeach
                                        @else
                                            Ninguno
                                        @endif
                                    </td>

                                    {{-- para que el boton quede pegado a la derecha->width=10px --}}
                                    <td width="10px">
                                        <a class="btn btn-success" href="{{ route('admin.users.rol', $user) }}"><i
                                                class="fas fa-user-tag"></i></a>
                                    </td>
                                    <td width="10px">
                                        <a class="btn btn-primary" href="{{ route('admin.users.edit', $user) }}"><i
                                                class="fas fa-user-edit"></i></a>
                                    </td>
                                    <td width="10px">
                                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST">
                                            @method('delete')
                                            @csrf
                                            <button class="btn btn-danger" type="submit"><i
                                                    class="fas fa-user-minus"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>


            <div class="card-footer">
                {{ $users->links() }}
            </div>
        @else
            <div class="card-body">
                <strong>No hay registros ...</strong>
            </div>
        @endif

    </div>
</div>
