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
        @can('Crear almacen')
            <div class="card-header">
                <a class="btn btn-secondary" href="{{ route('admin.almacen.create') }}">NUEVO ALMACEN</a>
            </div>
        @endcan

        @if ($almacens->count())
            <div class="table-responsive">
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>

                                {{-- en descripcion ira vehiculo con marca --}}
                                <th>Nombre</th>
                                <th>Ubicacion</th>
                                <th>Ocupado</th>
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
                                        {{ $this->getTotalOcupado($almacen) }}
                                    </td>
                                    <td>
                                        {{ $almacen->capacidad }}
                                    </td>



                                    {{-- para que el boton quede pegado a la derecha->width=10px --}}
                                    <td width="10px">
                                        <a class="btn btn-outline-info"
                                            href="{{ route('almacen.pdf', $almacen->id) }}"><i
                                                class="fas fa-file-pdf"></i>
                                        </a>
                                    </td>

                                    @can('Editar almacen')
                                        <td width="10px">
                                            <a class="btn btn-primary" href="{{ route('admin.almacen.edit', $almacen) }}"><i
                                                    class="fas fa-user-edit"></i></a>
                                        </td>
                                    @endcan

                                    @can('Eliminar almacen')
                                        <td width="10px">
                                            {{-- el form es necesario para cuando queremos eliminar por eso no pusimos la etiqueta <a href=""></a> --}}
                                            <form action="{{ route('admin.almacen.destroy', $almacen) }}" method="POST">
                                                @method('delete')
                                                @csrf
                                                <button class="btn btn-danger" type="submit"><i
                                                        class="fas fa-user-minus"></i></button>
                                            </form>
                                        </td>
                                    @endcan

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
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
