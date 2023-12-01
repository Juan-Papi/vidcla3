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
            <a class="btn btn-secondary" href="{{ route('admin.vehiculo.create') }}">NUEVO VEHICULO</a>
        </div>

        @if ($vehiculos->count())
            <div class="table-responsive">
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>

                                <th>Descripcion</th>
                                <th>Año</th>
                                <th>Marca</th>
                                <th colspan="2"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($vehiculos as $vehiculo)
                                <tr>


                                    <td>
                                        {{ $vehiculo->descripcion }}
                                    </td>
                                    <td>
                                        {{ $vehiculo->año }}
                                    </td>
                                    <td>
                                        {{ $vehiculo->marca->nombre }}
                                    </td>
                                    {{-- para que el boton quede pegado a la derecha->width=10px --}}
                                    <td width="10px">
                                        <a class="btn btn-primary"
                                            href="{{ route('admin.vehiculo.edit', $vehiculo) }}">Editar/Ver</a>
                                    </td>
                                    <td width="10px">
                                        {{-- el form es necesario para cuando queremos eliminar por eso no pusimos la etiqueta <a href=""></a> --}}
                                        <form action="{{ route('admin.vehiculo.destroy', $vehiculo) }}" method="POST">
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
            </div>

            <div class="card-footer">
                {{ $vehiculos->links() }}
            </div>
        @else
            <div class="card-body">
                <strong>No hay registros ...</strong>
            </div>
        @endif

    </div>
</div>
