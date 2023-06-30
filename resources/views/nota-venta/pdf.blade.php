<!DOCTYPE html>
<html>
<head>
    <title>Reporte de Ventas</title>
    <style>
        table {
            border: 1px solid black;
            width: 100%;
        }
        th, td {
            border: 1px solid black;
            padding: 5px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h2>Reporte de Ventas</h2>
    <table>
        <thead>
            <tr>
                <th>Usuario</th>
                <th>Fecha</th>
                <th>Factura</th>
                <th>Monto Total</th>
                <th>CI Cliente</th>
                <th>Almacén</th>
            </tr>
        </thead>
        <tbody>
        @foreach($nota_ventas as $venta)
            <tr>
                <td>{{ $venta->user->name }}</td>
                <td>{{ $venta->fecha }}</td>
                <td>NIT {{ $venta->factura ? $venta->factura->nit : 'N/A' }}</td>
                <td>BS. {{ $venta->monto_total }}</td>
                <td>{{ $venta->cliente->carnet }}</td>
                <td>{{ $venta->almacen->nombre }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</body>
</html>
