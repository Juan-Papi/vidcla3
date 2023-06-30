@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Nuevo Personal</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            {!! Form::open(['route' => 'personal.store']) !!}
            <div class="row">
                <div class="col-md-6">

                    <div class="form-group">
                        {!! Form::label('nombre', 'Nombre: ') !!}
                        {!! Form::text('nombre', null, [
                            'class' => 'form-control' . ($errors->has('nombre') ? ' is-invalid' : ''),
                            'placeholder' => 'Ingrese el nombre...',
                        ]) !!}
                        @error('nombre')
                            <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        {!! Form::label('paterno', 'Apellido Paterno: ') !!}
                        {!! Form::text('paterno', null, [
                            'class' => 'form-control' . ($errors->has('paterno') ? ' is-invalid' : ''),
                            'placeholder' => 'Ingrese el apellido paterno...',
                        ]) !!}
                        @error('paterno')
                            <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        {!! Form::label('materno', 'Apellido Materno: ') !!}
                        {!! Form::text('materno', null, [
                            'class' => 'form-control' . ($errors->has('materno') ? ' is-invalid' : ''),
                            'placeholder' => 'Ingrese el apellido materno...',
                        ]) !!}
                        @error('materno')
                            <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        {!! Form::label('carnet', 'Carnet: ') !!}
                        {!! Form::number('carnet', null, [
                            'class' => 'form-control' . ($errors->has('carnet') ? ' is-invalid' : ''),
                            'placeholder' => 'Ingrese el número de carnet...',
                        ]) !!}
                        @error('carnet')
                            <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        {!! Form::label('estado', 'Estado: ') !!}
                        {!! Form::select('estado', ['activo' => 'Activo', 'inactivo' => 'Inactivo'], null, [
                            'class' => 'form-control' . ($errors->has('estado') ? ' is-invalid' : ''),
                            'placeholder' => 'Seleccione el estado...',
                        ]) !!}
                        @error('estado')
                            <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>


                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('ciudad', 'Ciudad: ') !!}
                        {!! Form::text('ciudad', null, [
                            'class' => 'form-control' . ($errors->has('ciudad') ? ' is-invalid' : ''),
                            'placeholder' => 'Ingrese la ciudad...',
                        ]) !!}
                        @error('ciudad')
                            <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        {!! Form::label('pais', 'Pais: ') !!}
                        {!! Form::text('pais', null, [
                            'class' => 'form-control' . ($errors->has('pais') ? ' is-invalid' : ''),
                            'placeholder' => 'Ingrese el pais...',
                        ]) !!}
                        @error('pais')
                            <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        {!! Form::label('sexo', 'Sexo: ') !!}
                        {!! Form::select('sexo', ['M' => 'Masculino', 'F' => 'Femenino'], null, [
                            'class' => 'form-control' . ($errors->has('sexo') ? ' is-invalid' : ''),
                            'placeholder' => 'Seleccione el sexo...',
                        ]) !!}
                        @error('sexo')
                            <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        {!! Form::label('user_id', 'Usuarios libres: ') !!}
                        {!! Form::select('user_id', $users->pluck('email', 'id'), null, [
                            'class' => 'form-control' . ($errors->has('user_id') ? ' is-invalid' : ''),
                            'placeholder' => 'Seleccione la cuenta de usuario...',
                        ]) !!}
                        @error('user_id')
                            <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        {!! Form::label('cargo', 'Cargo: ') !!}
                        {!! Form::text('cargo', null, [
                            'class' => 'form-control' . ($errors->has('cargo') ? ' is-invalid' : ''),
                            'placeholder' => 'Ingrese el cargo...',
                        ]) !!}
                        @error('cargo')
                            <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
            {!! Form::submit('Crear Personal', ['class' => 'btn btn-primary mt-2']) !!}
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
