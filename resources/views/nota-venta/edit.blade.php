@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Editar Nota de venta</h1>
@stop

@section('content')
    @livewire('edit-nota-venta-component', ['id' => $nota_venta_id])
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        console.log('Hi!');
    </script>
@stop
