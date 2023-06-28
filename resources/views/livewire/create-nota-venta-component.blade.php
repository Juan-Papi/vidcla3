<div>
    <div class="card">
        <div class="card-body">
            <form wire:submit.prevent="createNotaVenta">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="almacen_id">Almacén: </label>
                            <select class="form-control @error('almacen_id') is-invalid @enderror"
                                wire:model="almacen_id">
                                <option value="">Seleccione un almacén...</option>
                                @foreach ($almacenes as $almacen)
                                    <option value="{{ $almacen->id }}">ID: {{ $almacen->id }}, {{ $almacen->nombre }}</option>
                                @endforeach
                            </select>
                            @error('almacen_id')
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                @foreach ($lineasVenta as $index => $lineaVenta)
                    <div class="row mt-3">
                        <div class="col-md-3">
                            <label for="parabrisa_id">Parabrisa: </label>
                            <select
                                class="form-control @error('lineasVenta.' . $index . '.parabrisa_id') is-invalid @enderror"
                                wire:model="lineasVenta.{{ $index }}.parabrisa_id">
                                <option value="">Seleccione un parabrisa...</option>
                                @foreach ($parabrisas as $parabrisa)
                                    <option value="{{ $parabrisa->id }}">ID: {{ $parabrisa->id }}</option>
                                @endforeach
                            </select>
                            @error('lineasVenta.' . $index . '.parabrisa_id')
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label for="cantidad">Cantidad: </label>
                            <input type="number"
                                class="form-control @error('lineasVenta.' . $index . '.cantidad') is-invalid @enderror"
                                placeholder="Escriba la cantidad..."
                                wire:model="lineasVenta.{{ $index }}.cantidad">
                            @error('lineasVenta.' . $index . '.cantidad')
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label for="precio_venta">Precio Venta: </label>
                            <input type="number"
                                class="form-control @error('lineasVenta.' . $index . '.precio_venta') is-invalid @enderror"
                                placeholder="Escriba el precio de venta..."
                                wire:model="lineasVenta.{{ $index }}.precio_venta">
                            @error('lineasVenta.' . $index . '.precio_venta')
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <label for="importe">Importe: </label>
                            <input type="number" class="form-control" placeholder="Importe calculado..."
                                wire:model="lineasVenta.{{ $index }}.importe" readonly>
                        </div>
                    </div>
                @endforeach

                <div class="mt-3">
                    <button class="btn btn-info" type="button" wire:click="addLineaVenta"> <span class="icono-add">
                        <i class="fas fa-plus"></i>
                      </span>Add</button>
                </div>

                <div class="row mt-3">
                    <div class="col-md-6">
                        <label for="total">Total:</label>
                        <input type="number" class="form-control" placeholder="Total calculado..." wire:model="total"
                            readonly>
                    </div>
                </div>

                @if (session()->has('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                <button type="submit" class="btn btn-primary mt-2">Crear Nota de Venta</button>
            </form>
        </div>
    </div>

</div>