@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Editar ROL</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        {{-- para editar abrimos el formulario con Form::model --}}

        {{-- tomar en cuenta que la ruta update necesita que le pasemos un parametro --}}
        {!! Form::model($role, ['route' => ['admin.roles.update', $role], 'method' => 'put']) !!}

          {{-- directiva de blade -> include --}}
          {{-- Para poner la ruta del form debe ser relativa(con referencia) 
          a la vista views --}}
           @include('roles.partials.form')

        {!! Form::submit('Actualizar ROL', ['class' => 'btn btn-primary mt-2']) !!}

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