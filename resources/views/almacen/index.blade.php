@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Lista de almacenes</h1>
@stop

@section('content')
   @livewire('admin-almacen')
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop