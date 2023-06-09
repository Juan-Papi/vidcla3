@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Nuevo ALMACEN</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            {!! Form::open(['route' => 'admin.almacen.store']) !!}

            <div class="form-group">
                {!! Form::label('nombre', 'Nombre: ') !!}
                {!! Form::text('nombre', null, [
                    'class' => 'form-control' . ($errors->has('nombre') ? ' is-invalid' : ''),
                    'placeholder' => 'Escriba el nombre...',
                ]) !!}
                @error('nombre')
                    <span class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                {!! Form::label('ubicacion', 'Ubicación: ') !!}
                {!! Form::text('ubicacion', null, [
                    'class' => 'form-control' . ($errors->has('ubicacion') ? ' is-invalid' : ''),
                    'placeholder' => 'Escriba la ubicación...',
                ]) !!}
                @error('ubicacion')
                    <span class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                {!! Form::label('capacidad', 'Capacidad: ') !!}
                {!! Form::number('capacidad', null, [
                    'class' => 'form-control' . ($errors->has('capacidad') ? ' is-invalid' : ''),
                    'placeholder' => 'Ingrese la capacidad...',
                ]) !!}
                @error('capacidad')
                    <span class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            {!! Form::submit('Crear Almacén', ['class' => 'btn btn-primary mt-2']) !!}

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
