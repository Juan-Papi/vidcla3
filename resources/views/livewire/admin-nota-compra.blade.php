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
            <a class="btn btn-secondary" href="{{ route('admin.nota_compra.create') }}">NUEVA COMPRA</a>
        </div>

        @if ($nota_compras->count())
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>ID_P</th>
                            <th>Parabrisa</th>
                            <th>Cantidad</th>
                            <th>Total</th>                         
                            <th>Almacen</th>
                            <th>Proveedor</th>

                            <th colspan="2"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($nota_compras as $nota_compra)
                            <tr>

                                <td>
                                    {{ $nota_compra->fecha }}
                                </td>
                                <td>
                                    {{ $nota_compra->parabrisa->id }}
                                </td>
                                <td>
                                    Ab:{{ $nota_compra->parabrisa->abajo }}
                                    Ar:{{ $nota_compra->parabrisa->arriba }}
                                    Co:{{ $nota_compra->parabrisa->costado }}
                                    Me:{{ $nota_compra->parabrisa->medio }}
                                    Pre: BS. {{ $nota_compra->parabrisa->precio }}
                                </td>
                                <td>
                                    {{ $nota_compra->cantidad }}
                                </td>
                                <td>
                                    {{ $nota_compra->total}}
                                </td>
                                <td>
                                    {{ $nota_compra->almacen->nombre }}
                                </td>
                                <td>
                                    {{ $nota_compra->proveedor->nombre }}
                                </td>

                                {{-- para que el boton quede pegado a la derecha->width=10px --}}

                                <td width="10px">
                                    <a class="btn btn-primary"
                                        href="{{ route('admin.nota_compra.edit', $nota_compra) }}">Edit</a>
                                </td>
                                <td width="10px">
                                    <button class="btn btn-danger" type="button" onclick="confirmDelete({{ $nota_compra->id }})">Del</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="card-footer">
                {{ $nota_compras->links() }}
            </div>
        @else
            <div class="card-body">
                <strong>No hay registros ...</strong>
            </div>
        @endif

    </div>

    <script>
        function confirmDelete(nota_compra_id) {
            if (confirm('¿Estás seguro/a?')) {
                @this.call('deleteCompra', nota_compra_id);
            }
        }
    </script>
</div>
