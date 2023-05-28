@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Crear nuevo Rol</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            {{-- con laravel collective ->ya no indicamos el method POST, tampoco el token csrf --}}
            {!! Form::open(['route' => 'admin.roles.store']) !!}

              {{-- directiva de blade -> include --}}
              {{-- Para poner la ruta del form debe ser relativa(con referencia) 
              a la vista views --}}
               @include('roles.partials.form')

            {!! Form::submit('Crear Rol', ['class' => 'btn btn-primary mt-2']) !!}

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
