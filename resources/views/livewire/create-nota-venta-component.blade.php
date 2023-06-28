<div>
    <div class="card">
        <div class="card-body">
            <form wire:submit.prevent="createNotaVenta">
                <div class="row">

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="almacen_id">Almacén: </label>
                            <select class="form-control @error('almacen_id') is-invalid @enderror"
                                wire:model="almacen_id">
                                <option value="">Seleccione un almacén...</option>
                                @foreach ($almacenes as $almacen)
                                    <option value="{{ $almacen->id }}">ID: {{ $almacen->id }}, {{ $almacen->nombre }}
                                    </option>
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
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="cliente_id">Cliente: </label>
                            @livewire('buscador-cliente')
                            <!-- Mostrando el cliente seleccionado -->
                            @if ($cliente_nombre)
                                <div class="alert alert-success mt-2">
                                    Cliente seleccionado: {{ $cliente_nombre }}
                                </div>
                            @endif
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
                                    <option value="{{ $parabrisa->id }}">ID -> {{ $parabrisa->id }}</option>
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
                        <label for="factura">Factura? </label>
                        <select class="form-control" wire:model="factura">
                            <option value="0">No</option>
                            <option value="1">Sí</option>
                        </select>
                    </div>

                    @if ($factura)
                        <div class="col-md-6">
                            <label for="nit">NIT: </label>
                            <input type="text" class="form-control" placeholder="Ingrese el NIT..." wire:model="nit">
                        </div>
                    @endif
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
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <button type="submit" class="btn btn-primary mt-2">Crear Nota de Venta</button>
            </form>
        </div>
    </div>

</div>
