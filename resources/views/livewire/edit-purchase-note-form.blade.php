<div class="card">
    <div class="card-body">
        <form wire:submit.prevent="save">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="cantidad">Cantidad:</label>
                        <input type="number" wire:model="cantidad"
                            class="form-control @error('cantidad') is-invalid @enderror"
                            placeholder="Escriba la cantidad...">
                        @error('cantidad')
                            <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="fecha">Fecha:</label>
                        <input type="date" wire:model="fecha"
                            class="form-control @error('fecha') is-invalid @enderror"
                            placeholder="Seleccione la fecha...">
                        @error('fecha')
                            <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="proveedor_id">Proveedor:</label>
                        <select wire:model="proveedor_id"
                            class="form-control @error('proveedor_id') is-invalid @enderror">
                            <option value="">Seleccione un proveedor...</option>
                            @foreach ($proveedores as $proveedor)
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
                        <label for="total">Total:</label>
                        <input type="number" wire:model="total" step="0.01"
                            class="form-control @error('total') is-invalid @enderror" placeholder="Escriba el total...">
                        @error('total')
                            <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="almacen_id">Almacén:</label>
                        <select wire:model="almacen_id" class="form-control @error('almacen_id') is-invalid @enderror">
                            <option value="">Seleccione un almacén...</option>
                            @foreach ($almacenes as $almacen)
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
                        <label for="parabrisa_id">Parabrisa:</label>
                        <select wire:model="parabrisa_id"
                            class="form-control @error('parabrisa_id') is-invalid @enderror">
                            <option value="">Seleccione un parabrisa...</option>
                            @foreach ($parabrisas as $parabrisa)
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
