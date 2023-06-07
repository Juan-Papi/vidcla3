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
            <a class="btn btn-secondary" href="{{ route('admin.parabrisa.create') }}">NUEVO PARABRISA</a>
        </div>

        @if ($parabrisas->count())
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Posicion</th>
                            {{-- en descripcion ira vehiculo con marca --}}
                            <th>Descripcion</th>
                            <th>Precio</th>
                            <th>Abajo</th>
                            <th>Arriba</th>
                            <th>Costado</th>
                            <th>Medio</th>
                            
                            <th>OBS</th>
                            <th colspan="2"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($parabrisas as $parabrisa)
                            <tr>

                                <td>
                                    {{ $parabrisa->id }}
                                </td>
                                <td>
                                    {{ $parabrisa->posicion->nombre }}
                                </td>
                                <td>
                                    {{ $parabrisa->vehiculo->descripcion }} //
                                    Año: {{ $parabrisa->vehiculo->año}} //
                                    Placa: {{ $parabrisa->vehiculo->matricula}} //
                                    Marca: {{ $parabrisa->vehiculo->marca->nombre}}
                                </td>
                                <td>
                                    {{ $parabrisa->precio }}
                                </td>
                                <td>
                                    {{ $parabrisa->abajo }}
                                </td>
                                <td>
                                    {{ $parabrisa->arriba }}
                                </td>
                                <td>
                                    {{ $parabrisa->costado }}
                                </td>
                                <td>
                                    {{ $parabrisa->medio }}
                                </td>
                                <td>
                                    {{ $parabrisa->observacion }}
                                </td>
                                {{-- para que el boton quede pegado a la derecha->width=10px --}}
                                <td width="10px">
                                    <a class="btn btn-primary"
                                        href="{{ route('admin.parabrisa.edit', $parabrisa) }}">Editar/Ver</a>
                                </td>
                                <td width="10px">
                                    {{-- el form es necesario para cuando queremos eliminar por eso no pusimos la etiqueta <a href=""></a> --}}
                                    <form action="{{ route('admin.parabrisa.destroy', $parabrisa) }}" method="POST">
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
                {{ $parabrisas->links() }}
            </div>
        @else
            <div class="card-body">
                <strong>No hay registros ...</strong>
            </div>
        @endif

    </div>
</div>
