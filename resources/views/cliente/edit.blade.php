@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>EDITAR CLIENTE</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        {!! Form::model($cliente, ['route' => ['cliente.update', $cliente], 'method' => 'put']) !!}
        
        <div class="row">
            <div class="col-md-6">
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
            </div>
            
            <div class="col-md-6">
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
            </div>
        </div>

        {!! Form::submit('Actualizar cliente', ['class' => 'btn btn-primary mt-2']) !!}

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
