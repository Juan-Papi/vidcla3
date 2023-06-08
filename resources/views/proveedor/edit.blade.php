@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Editar PROVEEDOR</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            {!! Form::model($proveedor, ['route' => ['admin.proveedor.update', $proveedor], 'method' => 'put']) !!}

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
                {!! Form::label('email', 'Email: ') !!}
                {!! Form::email('email', null, [
                    'class' => 'form-control' . ($errors->has('email') ? ' is-invalid' : ''),
                    'placeholder' => 'Escriba el email...',
                ]) !!}
                @error('email')
                    <span class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                {!! Form::label('telefono', 'Teléfono: ') !!}
                {!! Form::text('telefono', null, [
                    'class' => 'form-control' . ($errors->has('telefono') ? ' is-invalid' : ''),
                    'placeholder' => 'Escriba el teléfono...',
                ]) !!}
                @error('telefono')
                    <span class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                {!! Form::label('ciudad', 'Ciudad: ') !!}
                {!! Form::text('ciudad', null, [
                    'class' => 'form-control' . ($errors->has('ciudad') ? ' is-invalid' : ''),
                    'placeholder' => 'Escriba la ciudad...',
                ]) !!}
                @error('ciudad')
                    <span class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                {!! Form::label('pais', 'País: ') !!}
                {!! Form::text('pais', null, [
                    'class' => 'form-control' . ($errors->has('pais') ? ' is-invalid' : ''),
                    'placeholder' => 'Escriba el país...',
                ]) !!}
                @error('pais')
                    <span class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            {!! Form::submit('Actualizar Proveedor', ['class' => 'btn btn-primary mt-2']) !!}

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
