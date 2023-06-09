@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Nota de Compra</h1>
@stop

@section('content')
@livewire('edit-purchase-note-form', ['notaCompra' => $notaCompra])

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop