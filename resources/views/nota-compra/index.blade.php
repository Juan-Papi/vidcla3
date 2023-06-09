@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Notas de compras</h1>
@stop

@section('content')
    @livewire('admin-nota-compra')
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop