@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Editar CUOTA</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            {!! Form::model($cuota, ['route' => ['cuota.update', $cuota], 'method' => 'put']) !!}

            <div class="form-group">
                {!! Form::label('descripcion', 'Descripción: ') !!}
                {!! Form::textarea('descripcion', null, [
                    'class' => 'form-control' . ($errors->has('descripcion') ? ' is-invalid' : ''),
                    'placeholder' => 'Escriba la descripción...',
                ]) !!}

                @error('descripcion')
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
                {!! Form::label('monto', 'Monto: ') !!}
                {!! Form::number('monto', null, [
                    'class' => 'form-control' . ($errors->has('monto') ? ' is-invalid' : ''),
                    'placeholder' => 'Ingrese el monto...',
                ]) !!}

                @error('monto')
                    <span class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                {!! Form::label('pago_id', 'Plan de Pago: ') !!}
                {!! Form::select('pago_id', $pagos->pluck('id', 'id'), null, [
                    'class' => 'form-control' . ($errors->has('pago_id') ? ' is-invalid' : ''),
                    'placeholder' => 'Seleccione un plan de pago...',
                ]) !!}

                @error('pago_id')
                    <span class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            {!! Form::submit('Actualizar Cuota', ['class' => 'btn btn-primary mt-2']) !!}

            {!! Form::close() !!}
        </div>
    </div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        console.log('Hi!');
    </script>
@stop
