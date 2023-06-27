<div>
    @if (session('info'))
        <div class="alert alert-primary" role="alert">
            <strong>¡Éxito!</strong>
            {{ session('info') }}
        </div>
    @endif
    <div class="card">

        <div class="card-header">
            <a class="btn btn-secondary" href="{{ route('cliente.create') }}">NUEVO CLIENTE</a>
        </div>

        @if ($clientes->count())
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>

                            <th>C.I</th>
                            <th>Nombre</th>
                            <th>Paterno</th>
                            <th>Materno</th>
                            <th>Ciudad</th>
                            <th>Sexo</th>
                            <th colspan="2"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($clientes as $cliente)
                            <tr>
                                <td>
                                    {{ $cliente->carnet }}
                                </td>
                                <td>
                                    {{ $cliente->nombre }}
                                </td>
                                <td>
                                    {{ $cliente->paterno }}
                                </td>
                                <td>
                                    {{ $cliente->materno }}
                                </td>
                                <td>
                                    {{ $cliente->ciudad }}
                                </td>
                                <td>
                                    {{ $cliente->sexo }}
                                </td>
                                {{-- para que el boton quede pegado a la derecha->width=10px --}}
                                <td width="10px">
                                    <a class="btn btn-primary"
                                        href="{{ route('cliente.edit', $cliente) }}">Editar/Ver</a>
                                </td>
                                <td width="10px">
                                    {{-- el form es necesario para cuando queremos eliminar por eso no pusimos la etiqueta <a href=""></a> --}}
                                    <form action="{{ route('cliente.destroy', $cliente) }}" method="POST">
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
                {{ $clientes->links() }}
            </div>
        @else
            <div class="card-body">
                <strong>No hay registros ...</strong>
            </div>
        @endif

    </div>
</div>
