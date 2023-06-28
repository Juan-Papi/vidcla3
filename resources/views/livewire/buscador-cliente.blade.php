<div>
    <input type="text" wire:model="search" class="form-control" placeholder="Buscar cliente por carnet...">
    <ul class="list-group mt-3">
        @foreach ($clientes as $cliente)
            <li class="list-group-item">
                <div class="row">
                    <div class="col-4">
                        <strong>{{ $cliente->carnet }}</strong>
                    </div>
                    <div class="col-6">
                        {{ $cliente->nombre }} {{ $cliente->paterno }} {{ $cliente->materno }}
                    </div>
                    <div class="col-2 text-right">
                        <button wire:click="$emit('clienteSeleccionado', {{ $cliente->id }})" class="btn btn-sm btn-primary">Seleccionar</button>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
    {{ $clientes->links() }}
</div>
