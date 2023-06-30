<div>
    <div class="card">
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
                                    {{ $bitacora->fecha_hora}}
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
