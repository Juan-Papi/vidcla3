@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>POSICIONES</h1>
@stop

@section('content')
    
@if (session('info'))
<div class="alert alert-primary" role="alert">
    <strong>¡Éxito!</strong>
    {{session('info')}}
</div>
@endif

<div class="card">

<div class="card-header">
    <a class="btn btn-secondary" href="{{ route('admin.posicion.create') }}">CREAR POSICION</a>
</div>


<div class="card-body">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th colspan="2"></th>
            </tr>
        </thead>

        <tbody>
            {{-- Forelse te permite mostrar algo si la coleccion esta vacia --}}
            @forelse ($posiciones as $posicion)
                <tr>
                    <td>{{ $posicion->id }}</td>
                    <td>{{ $posicion->nombre }}</td>
                    <td width="10px">
                        <a class="btn btn-secondary" href="{{ route('admin.posicion.edit', $posicion) }}">Editar</a>
                    </td>
                    <td width="10px">
                        {{-- el form es necesario para cuando queremos eliminar por eso no pusimos la etiqueta <a href=""></a> --}}
                        <form action="{{ route('admin.posicion.destroy', $posicion)}}" method="POST">
                            @method('delete')
                            @csrf
                            <button class="btn btn-danger" type="submit">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    {{-- colspan->espaciado de 4 columnas --}}
                    <td colspan="4">
                        No hay ninguna POSICION registrada
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop