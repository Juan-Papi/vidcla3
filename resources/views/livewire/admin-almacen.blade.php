<div>
    @if (session('info'))
        <div class="alert alert-primary" role="alert">
            <strong>¡Éxito!</strong>
            {{ session('info') }}
        </div>
    @endif
    <div class="card">

        {{-- <div class="card-header">
            <input wire:keydown="limpiar_page" wire:model="buscar" class="form-control w-100"
                placeholder="Escriba un nombre ..." type="text">
        </div> --}}
        <div class="card-header">
            <a class="btn btn-secondary" href="{{ route('admin.almacen.create') }}">NUEVO ALMACEN</a>
        </div>

        @if ($almacens->count())
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>

                            {{-- en descripcion ira vehiculo con marca --}}
                            <th>Nombre</th>
                            <th>Ubicacion</th>
                            <th>Capacidad</th>

                            <th colspan="3"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($almacens as $almacen)
                            <tr>

                                <td>
                                    {{ $almacen->nombre }}
                                </td>
                                <td>
                                    {{ $almacen->ubicacion }}
                                </td>
                                <td>
                                    {{ $almacen->capacidad }}
                                </td>


                                {{-- para que el boton quede pegado a la derecha->width=10px --}}
                                <td width="10px">
                                    <a class="btn btn-outline-info"
                                        href="{{ route('admin.almacen.show', $almacen) }}">Ver</a>
                                </td>

                                <td width="10px">
                                    <a class="btn btn-primary"
                                        href="{{ route('admin.almacen.edit', $almacen) }}">Editar</a>
                                </td>
                                <td width="10px">
                                    {{-- el form es necesario para cuando queremos eliminar por eso no pusimos la etiqueta <a href=""></a> --}}
                                    <form action="{{ route('admin.almacen.destroy', $almacen) }}" method="POST">
                                        @method('delete')
                                        @csrf
                                        <button class="btn btn-danger" type="submit">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="card-footer">
                {{ $almacens->links() }}
            </div>
        @else
            <div class="card-body">
                <strong>No hay registros ...</strong>
            </div>
        @endif

    </div>
</div>
