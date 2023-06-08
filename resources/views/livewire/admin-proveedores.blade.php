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
            <a class="btn btn-secondary" href="{{ route('admin.proveedor.create') }}">NUEVO PROVEEDOR</a>
        </div>

        @if ($proveedores->count())
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                                                 
                            {{-- en descripcion ira vehiculo con marca --}}
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Telefono</th>
                            <th>Ciudad</th>
                            <th>Pais</th>          
                            <th colspan="2"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($proveedores as $proveedor)
                            <tr>

                                <td>
                                    {{ $proveedor->nombre }}
                                </td>                            
                                <td>
                                    {{ $proveedor->email }}
                                </td>
                                <td>
                                    {{ $proveedor->telefono }}
                                </td>
                                <td>
                                    {{ $proveedor->ciudad }}
                                </td>
                                <td>
                                    {{ $proveedor->pais }}
                                </td>
                                                       
                                {{-- para que el boton quede pegado a la derecha->width=10px --}}
                             
                                <td width="10px">
                                    <a class="btn btn-primary"
                                        href="{{ route('admin.proveedor.edit', $proveedor) }}">Editar</a>
                                </td>
                                <td width="10px">
                                    {{-- el form es necesario para cuando queremos eliminar por eso no pusimos la etiqueta <a href=""></a> --}}
                                    <form action="{{ route('admin.proveedor.destroy', $proveedor) }}" method="POST">
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
                {{ $proveedores->links() }}
            </div>
        @else
            <div class="card-body">
                <strong>No hay registros ...</strong>
            </div>
        @endif

    </div>
</div>
