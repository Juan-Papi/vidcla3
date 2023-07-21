<div>
    @if (session('info'))
        ||
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
    {{-- Filtros --}}
    <div class="card my-4">
        <h5 class="card-header">Filtros de búsqueda</h5>
        <div class="card-body">

            <div class="form-row">
                <!-- Usuario -->
                <div class="col-md-2">
                    <label for="usuario">Usuario vendedor</label>
                    <select wire:model="usuario" id="usuario" class="form-control">
                        <option value="">Todos</option>
                        @foreach ($usuarios as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>
                <!-- Cliente -->
                <div class="col-md-2">
                    <label for="cliente">Cliente</label>
                    <select wire:model="cliente" id="cliente" class="form-control">
                        <option value="">Todos</option>
                        @foreach ($clientes as $client)
                            <option value="{{ $client->id }}">{{ $client->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <!-- Almacén -->
                <div class="col-md-2">
                    <label for="almacen">Almacén</label>
                    <select wire:model="almacen" id="almacen" class="form-control">
                        <option value="">Todos</option>
                        @foreach ($almacenes as $alma)
                            <option value="{{ $alma->id }}">{{ $alma->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <!-- Desde -->
                <div class="col-md-3">
                    <label for="desde">Desde</label>
                    <input wire:model="desde" type="date" class="form-control" id="desde">
                </div>
                <!-- Hasta -->
                <div class="col-md-3">
                    <label for="hasta">Hasta</label>
                    <input wire:model="hasta" type="date" class="form-control" id="hasta">
                </div>
            </div>


            <!-- Botones -->
            <div class="row mt-3">
                <div class="col-md-2">
                    <button type="button" wire:click="resetFilters" class="btn btn-secondary">Reiniciar
                        filtros</button>
                    {{-- FORMA 1 no funciona por alguna extraña razon --}}
                    {{-- <a href="{{ route('nota_venta.reporte', ['desde' => $desde, 'hasta' => $hasta, 'cliente' => $cliente, 'usuario' => $usuario, 'almacen' => $almacen]) }}"
                target="_blank" class="btn btn-success mt-3">Generar Reporte</a> --}}
                </div>
                <div class="col-md-2">
                    <!-- FORMA 2 con POST funciona-->
                    <form action="{{ route('nota_venta.reporte') }}" method="post" target="_blank">
                        @csrf
                        <input type="hidden" name="desde" value="{{ $desde }}">
                        <input type="hidden" name="hasta" value="{{ $hasta }}">
                        <input type="hidden" name="cliente" value="{{ $cliente }}">
                        <input type="hidden" name="usuario" value="{{ $usuario }}">
                        <input type="hidden" name="almacen" value="{{ $almacen }}">
                        <button type="submit" class="btn btn-success">Generar Reporte</button>
                    </form>
                </div>
            </div>

        </div>
    </div>

    {{-- Tablas --}}
    <div class="card">

        @can('Crear ventas')
            <div class="card-header">
                <a class="btn btn-info" href="{{ route('nota_venta.create') }}">NUEVA VENTA</a>
            </div>
        @endcan

        @if ($nota_ventas->count())
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Usuario</th>
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
                                    <a class="btn btn-outline-info"
                                        href="{{ route('nota_venta.pdf', $nota_venta->id) }}"><i
                                            class="fas fa-file-pdf"></i>
                                    </a>
                                </td>

                                {{-- para que el boton quede pegado a la derecha->width=10px --}}
                                @can('Actualizar ventas')
                                    <td width="10px">
                                        <a class="btn btn-primary"
                                            href="{{ route('nota_venta.edit', $nota_venta->id) }}"><i
                                                class="fas fa-user-edit"></i></a>
                                    </td>
                                @endcan
                                @can('Eliminar ventas')
                                    <td width="10px">
                                        <button class="btn btn-danger" type="button"
                                            onclick="confirmDelete({{ $nota_venta->id }})"><i
                                                class="fas fa-user-minus"></i></button>
                                    </td>
                                @endcan
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
