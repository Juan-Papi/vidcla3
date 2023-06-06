@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    @if (Auth::user()->roles->count() > 0)
        <p>Roles asignados para {{Auth::user()->name}} :</p>
        <ul>
            @foreach (Auth::user()->roles as $role)
                <li>{{ $role->name }}</li>
            @endforeach
        </ul>
    @else
        <p>No se han asignado roles al usuario.</p>
    @endif
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        console.log('Hi!');
    </script>
@stop
