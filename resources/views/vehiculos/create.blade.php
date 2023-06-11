@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Nuevo VEHICULO</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            {!! Form::open(['route' => 'admin.vehiculo.store']) !!}

           
            <div class="form-group">
                {!! Form::label('año', 'Año: ') !!}
                {!! Form::text('año', null, [
                    'class' => 'form-control' . ($errors->has('año') ? ' is-invalid' : ''),
                    'placeholder' => 'Escriba el año...',
                ]) !!}

                @error('año')
                    <span class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

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
                {!! Form::label('marca_id', 'Marca: ') !!}
                {!! Form::select('marca_id', $marcas->pluck('nombre', 'id'), null, [
                    'class' => 'form-control' . ($errors->has('marca_id') ? ' is-invalid' : ''),
                    'placeholder' => 'Seleccione una marca...',
                ]) !!}
                

                @error('marca_id')
                    <span class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            {!! Form::submit('Crear VEHICULO', ['class' => 'btn btn-primary mt-2']) !!}

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
