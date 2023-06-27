<div>
    @if (session('info'))
        <div class="alert alert-primary" role="alert">
            <strong>¡Éxito!</strong>
            {{ session('info') }}
        </div>
    @endif
    <div class="card">

        <div class="card-header">
            <a class="btn btn-secondary" href="{{ route('plan-pago.create') }}">NUEVO PLAN DE PAGO</a>
        </div>

        @if ($pagos->count())
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Fecha</th>
                            <th>Total</th>
                            <th>Plazo</th>
                            <th colspan="2"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pagos as $pago)
                            <tr>
                                <td>
                                    {{ $pago->id }}
                                </td>
                                <td>
                                    {{ $pago->fecha }}
                                </td>
                                <td>
                                    BS. {{ $pago->monto_total }}
                                </td>
                                <td>
                                    {{ $pago->plazo }}
                                </td>
                                {{-- para que el boton quede pegado a la derecha->width=10px --}}
                                <td width="10px">
                                    <a class="btn btn-primary" href="{{ route('plan-pago.edit', $pago) }}">Editar/Ver</a>
                                </td>
                                <td width="10px">
                                    {{-- el form es necesario para cuando queremos eliminar por eso no pusimos la etiqueta <a href=""></a> --}}
                                    <form action="{{ route('plan-pago.destroy', $pago) }}" method="POST">
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
                {{ $pagos->links() }}
            </div>
        @else
            <div class="card-body">
                <strong>No hay registros ...</strong>
            </div>
        @endif

    </div>
</div>
