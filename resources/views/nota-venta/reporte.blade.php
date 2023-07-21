<!DOCTYPE html>
<html>

<head>
    <title>Nota de venta</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h2,
        h3 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }

        th,
        td {
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
    <h2>Nota de venta: {{ $nota_venta->id }}</h2>
    <p>Fecha: {{ $nota_venta->fecha }}</p>
    <p>Vendedor: {{ $nota_venta->user->name }}</p>
    <p>Cliente: {{ $nota_venta->cliente->nombre }}
        {{ $nota_venta->cliente->paterno }}{{ $nota_venta->cliente->materno }}</p>

    <h3>Parabrisas</h3>
    <table>
        <tr>
            <th>ID</th>
            <th>Descripción</th>
            {{-- <th>Medida Abajo</th>
            <th>Medida Arriba</th>
            <th>Medida Costado</th>
            <th>Medida Medio</th> --}}

            <th>Precio</th>
            <th>Cantidad</th>
            <th>Importe</th>

            {{-- <th>Observación</th> --}}
        </tr>
        @foreach ($parabrisas as $parabrisa)
            <tr>
                <td>{{ $parabrisa->id }}</td>
                <td>{{ $parabrisa->descripcion }}</td>
                {{-- <td>{{ $parabrisa->abajo }}</td>
                <td>{{ $parabrisa->arriba }}</td>
                <td>{{ $parabrisa->costado }}</td>
                <td>{{ $parabrisa->medio }}</td> --}}
                <td>{{ $parabrisa->pivot->precio_venta }}</td>
                <td>{{ $parabrisa->pivot->cantidad }}</td>
                <td>{{ $parabrisa->pivot->importe }}</td>
                {{-- <td>{{ $parabrisa->observacion }}</td> --}}
            </tr>
        @endforeach

        <!-- Fila para mostrar el monto total -->
        <tr>
            <td colspan="3"></td>
            <th>Total:</th>
            <td>{{ $nota_venta->monto_total }}</td>

        </tr>
    </table>
</body>

</html>
