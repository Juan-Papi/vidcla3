@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Planes de pago</h1>
@stop

@section('content')
    @livewire('plan-pago-component')
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop