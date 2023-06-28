@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Nueva nota de venta</h1>
@stop

@section('content')
    @livewire('create-nota-venta-component')
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        console.log('Hi!');
    </script>
@stop
