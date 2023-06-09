@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Nota de Compra</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        {!! Form::model($nota_compra, ['route' => ['admin.nota_compra.update', $nota_compra], 'method' => 'put']) !!}

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('cantidad', 'Cantidad: ') !!}
                    {!! Form::number('cantidad', null, [
                        'class' => 'form-control' . ($errors->has('cantidad') ? ' is-invalid' : ''),
                        'placeholder' => 'Escriba la cantidad...',
                    ]) !!}
                    @error('cantidad')
                        <span class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    {!! Form::label('fecha', 'Fecha: ') !!}
                    {!! Form::date('fecha', null, [
                        'class' => 'form-control' . ($errors->has('fecha') ? ' is-invalid' : ''),
                        'placeholder' => 'Seleccione la fecha...',
                    ]) !!}
                    @error('fecha')
                        <span class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    {!! Form::label('proveedor_id', 'Proveedor: ') !!}
                    {!! Form::select('proveedor_id', $proveedores->pluck('nombre', 'id'), null, [
                        'class' => 'form-control' . ($errors->has('proveedor_id') ? ' is-invalid' : ''),
                        'placeholder' => 'Seleccione un proveedor...',
                    ]) !!}
                    @error('proveedor_id')
                        <span class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('total', 'Total: ') !!}
                    {!! Form::number('total', null, [
                        'class' => 'form-control' . ($errors->has('total') ? ' is-invalid' : ''),
                        'placeholder' => 'Escriba el total...',
                        'step' => '0.01',
                    ]) !!}
                    @error('total')
                        <span class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    {!! Form::label('almacen_id', 'Almacén: ') !!}
                    {!! Form::select('almacen_id', $almacenes->pluck('nombre', 'id'), null, [
                        'class' => 'form-control' . ($errors->has('almacen_id') ? ' is-invalid' : ''),
                        'placeholder' => 'Seleccione un almacén...',
                    ]) !!}
                    @error('almacen_id')
                        <span class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    {!! Form::label('parabrisa_id', 'Parabrisa: ') !!}
                    {!! Form::select('parabrisa_id', $parabrisas->pluck('descripcion', 'id'), null, [
                        'class' => 'form-control' . ($errors->has('parabrisa_id') ? ' is-invalid' : ''),
                        'placeholder' => 'Seleccione un parabrisa...',
                    ]) !!}
                    @error('parabrisa_id')
                        <span class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
        </div>

        {!! Form::submit('Crear Nota de Compra', ['class' => 'btn btn-primary mt-2']) !!}

        {!! Form::close() !!}
    </div>
</div>


@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop