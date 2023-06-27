<div>
    @if (session('info'))
        <div class="alert alert-primary" role="alert">
            <strong>¡Éxito!</strong>
            {{ session('info') }}
        </div>
    @endif
    <div class="card">

        <div class="card-header">
            <a class="btn btn-secondary" href="{{ route('telefono.create') }}">NUEVO TELEFONO</a>
        </div>

        @if ($telefonos->count())
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Telefono</th>
                            <th>Cliente</th>
                            <th colspan="2"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($telefonos as $telefono)
                            <tr>

                                <td>
                                    {{ $telefono->telefono }}
                                </td>
                                <td>
                                    {{ $telefono->cliente->nombre }} {{ $telefono->cliente->paterno }} {{ $telefono->cliente->materno }}
                                    
                                </td>                           
                                {{-- para que el boton quede pegado a la derecha->width=10px --}}
                                <td width="10px">
                                    <a class="btn btn-primary" href="{{ route('telefono.edit', $telefono) }}">Editar/Ver</a>
                                </td>
                                <td width="10px">
                                    {{-- el form es necesario para cuando queremos eliminar por eso no pusimos la etiqueta <a href=""></a> --}}
                                    <form action="{{ route('telefono.destroy', $telefono) }}" method="POST">
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
                {{ $telefonos->links() }}
            </div>
        @else
            <div class="card-body">
                <strong>No hay registros ...</strong>
            </div>
        @endif

    </div>
</div>
