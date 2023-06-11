<div class="card">
    <div class="card-body">
        <form wire:submit.prevent="save">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="cantidad">Cantidad: </label>
                        <input type="number" class="form-control @error('cantidad') is-invalid @enderror" placeholder="Escriba la cantidad..." wire:model="cantidad">
                        @error('cantidad')
                            <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="precio_unitario">Precio Unitario: </label>
                        <input type="number" class="form-control @error('precio_unitario') is-invalid @enderror" placeholder="Escriba el precio unitario..." wire:model="precio_unitario">
                        @error('precio_unitario')
                            <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="fecha">Fecha: </label>
                        <input type="date" class="form-control @error('fecha') is-invalid @enderror" placeholder="Seleccione la fecha..." wire:model="fecha">
                        @error('fecha')
                            <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="proveedor_id">Proveedor: </label>
                        <select class="form-control @error('proveedor_id') is-invalid @enderror" wire:model="proveedor_id">
                            <option value="">Seleccione un proveedor...</option>
                            @foreach($proveedores as $proveedor)
                                <option value="{{ $proveedor->id }}">{{ $proveedor->nombre }}</option>
                            @endforeach
                        </select>
                        @error('proveedor_id')
                            <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="importe_total">Importe Total: </label>
                        <input type="number" class="form-control @error('importe_total') is-invalid @enderror" placeholder="Total calculado..." wire:model="importe_total" readonly>
                        @error('importe_total')
                            <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="almacen_id">Almacén: </label>
                        <select class="form-control @error('almacen_id') is-invalid @enderror" wire:model="almacen_id">
                            <option value="">Seleccione un almacén...</option>
                            @foreach($almacenes as $almacen)
                                <option value="{{ $almacen->id }}">{{ $almacen->nombre }}</option>
                            @endforeach
                        </select>
                        @error('almacen_id')
                            <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="parabrisa_id">Parabrisa: </label>
                        <select class="form-control @error('parabrisa_id') is-invalid @enderror" wire:model="parabrisa_id" wire:change="calculateTotal">
                            <option value="">Seleccione un parabrisa...</option>
                            @foreach($parabrisas as $parabrisa)
                                <option value="{{ $parabrisa->id }}">{{ $parabrisa->descripcion }}</option>
                            @endforeach
                        </select>
                        @error('parabrisa_id')
                            <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary mt-2">Actualizar Nota de Compra</button>
        </form>
    </div>
</div>
