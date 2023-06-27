@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>NUEVO TELEFONO</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            {!! Form::open(['route' => 'telefono.store']) !!}

            <div class="form-group">
                {!! Form::label('cliente_id', 'Cliente: ') !!}
                {!! Form::select('cliente_id', $clientes->pluck('carnet', 'id'), null, [
                    'class' => 'form-control' . ($errors->has('cliente_id') ? ' is-invalid' : ''),
                    'placeholder' => 'Seleccione un cliente...',
                ]) !!}

                @error('cliente_id')
                    <span class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                {!! Form::label('telefono', 'Teléfono: ') !!}
                {!! Form::text('telefono', null, [
                    'class' => 'form-control' . ($errors->has('telefono') ? ' is-invalid' : ''),
                    'placeholder' => 'Ingrese el número de teléfono...',
                ]) !!}

                @error('telefono')
                    <span class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            {!! Form::submit('Crear Teléfono', ['class' => 'btn btn-primary mt-2']) !!}

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
