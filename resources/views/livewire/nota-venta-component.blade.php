<div>
    @if (session('info'))
        <div class="alert alert-primary" role="alert">
            <strong>¡Éxito!</strong>
            {{ session('info') }}
        </div>
    @endif
    @if (session()->has('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    {{-- Tablas --}}
    <div class="card">


        <div class="card-header">
            <a class="btn btn-secondary" href="{{ route('nota_venta.create') }}">NUEVA VENTA</a>
        </div>

        @if ($nota_ventas->count())
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Usuario</th>
                            <th>Plan de pago</th>
                            <th>Fecha</th>
                            <th>Factura</th>
                            {{-- El monto total es la suma de todos los importes o subtotales --}}
                            <th>Monto Total</th>
                            <th>CI Cliente</th>
                            <th>Almacen</th>
                            <th colspan="2"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($nota_ventas as $nota_venta)
                            <tr>
                                <td>
                                    {{ $nota_venta->user->name }}
                                </td>
                                <td>
                                    @isset($nota_venta->plan_pago)
                                        <a href="{{ route('plan-pago.show', ['pago' => $nota_venta->plan_pago]) }}">
                                            {{ $nota_venta->plan_pago->id }}
                                        </a>
                                    @else
                                        N/A
                                    @endisset
                                </td>
                                <td>
                                    {{ $nota_venta->fecha }}
                                </td>
                                <td>
                                    @isset($nota_venta->factura)
                                        {{ $nota_venta->factura->id }}
                                    @else
                                        N/A
                                    @endisset
                                </td>
                                <td>
                                    BS. {{ $nota_venta->monto_total }}
                                </td>
                                <td>
                                    CI. {{ $nota_venta->cliente->carnet }}
                                </td>
                                <td>
                                    ID: {{ $nota_venta->almacen->id }}, {{ $nota_venta->almacen->nombre }}
                                </td>

                                {{-- para que el boton quede pegado a la derecha->width=10px --}}

                                <td width="10px">
                                    <a class="btn btn-primary"
                                        href="{{ route('nota_venta.edit', $nota_venta->id) }}">Edit</a>
                                </td>
                                <td width="10px">
                                    <button class="btn btn-danger" type="button"
                                        onclick="confirmDelete({{ $nota_venta->id }})">Del</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="card-footer">
                {{ $nota_ventas->links() }}
            </div>
        @else
            <div class="card-body">
                <strong>No hay registros ...</strong>
            </div>
        @endif

    </div>
    <script>
        function confirmDelete(nota_venta_id) {
            if (confirm('¿Estás seguro/a?')) {
                @this.call('deleteVenta', nota_venta_id);
            }
        }
    </script>
</div>
