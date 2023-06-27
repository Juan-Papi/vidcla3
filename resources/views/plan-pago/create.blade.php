@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Nuevo Plan de pago</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            {!! Form::open(['route' => 'plan-pago.store']) !!}

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
                {!! Form::label('plazo', 'Plazo: ') !!}
                {!! Form::text('plazo', null, [
                    'class' => 'form-control' . ($errors->has('plazo') ? ' is-invalid' : ''),
                    'placeholder' => 'Ingrese el plazo...',
                ]) !!}

                @error('plazo')
                    <span class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                {!! Form::label('monto_total', 'Monto Total: ') !!}
                {!! Form::number('monto_total', null, [
                    'class' => 'form-control' . ($errors->has('monto_total') ? ' is-invalid' : ''),
                    'placeholder' => 'Ingrese el monto total...',
                ]) !!}

                @error('monto_total')
                    <span class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            {!! Form::submit('Crear Plan de Pago', ['class' => 'btn btn-primary mt-2']) !!}

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
