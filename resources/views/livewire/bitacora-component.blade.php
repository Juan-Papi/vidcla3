<div>
    <div class="card">
        <div class="card-header">
            <div class="form-group row align-items-center">
                <label for="search" class="col-form-label col-md-3">Buscar por usuario o email:</label>
                <div class="col-md-9">
                    <input type="text" id="search" class="form-control" placeholder="Buscar..." wire:model="search">
                </div>
            </div>
            <div class="form-group row align-items-center">
                <label for="fecha_desde" class="col-form-label col-md-1 mr-2">Desde:</label>
                <div class="col-md-4">
                    <input type="date" id="fecha_desde" class="form-control" placeholder="Desde" wire:model="fecha_desde">
                </div>
                <label for="fecha_hasta" class="col-form-label col-md-1 ml-5 mr-2">Hasta:</label>
                <div class="col-md-4">
                    <input type="date" id="fecha_hasta" class="form-control" placeholder="Hasta" wire:model="fecha_hasta">
                </div>
            </div>
        </div>        
        
        
        @if ($bitacoras->count())
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>USER_ID</th>
                            <th>USER_NAME</th>
                            <th>ACCION</th>
                            <th>FECHA_HORA</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bitacoras as $bitacora)
                            <tr>
                                <td>
                                    {{ $bitacora->id }}
                                </td>
                                <td>
                                    {{ $bitacora->user->id }}
                                </td>
                                <td>
                                    {{ $bitacora->user->name }}
                                </td>
                                <td>
                                    {{ $bitacora->accion }}
                                </td>
                                <td>
                                    {{ $bitacora->fecha_hora }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="card-footer">
                {{ $bitacoras->links() }}
            </div>
        @else
            <div class="card-body">
                <strong>No hay registros ...</strong>
            </div>
        @endif

    </div>
</div>
