<!DOCTYPE html>
<html>
<head>
    <title>Almacén</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        h2, h3 {
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }
        th, td {
            border: 1px solid #000;
            padding: 5px 10px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Almacén: {{ $almacen->nombre }}</h2>
    <p>Ubicación: {{ $almacen->ubicacion }}</p>
    <p>Capacidad: {{ $almacen->capacidad }}</p>
    <p>Total Ocupado: {{ $totalOcupado }}</p>

    <h3>Parabrisas</h3>
    <table>
        <tr>
            <th>ID</th>
            <th>Descripción</th>
            <th>Medida Abajo</th>
            <th>Medida Arriba</th>
            <th>Medida Costado</th>
            <th>Medida Medio</th>
            <th>Observación</th>
            <th>Stock</th>
        </tr>
        @foreach($parabrisas as $parabrisa)
        <tr>
            <td>{{ $parabrisa->id }}</td>
            <td>{{ $parabrisa->descripcion }}</td>
            <td>{{ $parabrisa->abajo }}</td>
            <td>{{ $parabrisa->arriba }}</td>
            <td>{{ $parabrisa->costado }}</td>
            <td>{{ $parabrisa->medio }}</td>
            <td>{{ $parabrisa->observacion }}</td>
            <td>{{ $parabrisa->pivot->stock }}</td>
        </tr>
        @endforeach
    </table>
</body>
</html>
