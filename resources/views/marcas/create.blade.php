@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Crear nueva MARCA</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            {{-- con laravel collective ->ya no indicamos el method POST, tampoco el token csrf --}}
            {!! Form::open(['route' => 'admin.marca.store']) !!}

            <div class="form-group">
                {!! Form::label('name', 'Nombre: ') !!}
                {!! Form::text('nombre', null, [
                    'class' => 'form-control' . ($errors->has('nombre') ? ' is-invalid' : ''),
                    'placeholder' => 'Escriba un nombre',
                ]) !!}

                {{-- Directiva de blade->error --}}
                @error('nombre')
                    {{-- La clase "invalid-feedback" necesita que encima de el si o si exista
                   un input con la clase "is-invalid", caso contrario no muestra nada --}}
                    <span class="invalid-feedback">
                        {{-- El mensaje de error esta almacenado temporalmente en una
                    var llamada message --}}
                        <strong>{{ $message }}</strong>

                    </span>
                @enderror

            </div>

            {!! Form::submit('Crear MARCA', ['class' => 'btn btn-primary mt-2']) !!}

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
