<div class="card">
    @if ($plan_pago)
        <div class="card-body">
            <h2>Detalles del Plan de Pago</h2>
            <table class="table">
                <tbody>
                    <tr>
                        <th>ID:</th>
                        <td>{{ $plan_pago->id }}</td>
                    </tr>
                    <tr>
                        <th>Fecha:</th>
                        <td>{{ $plan_pago->fecha }}</td>
                    </tr>
                    <tr>
                        <th>Total:</th>
                        <td>{{ $plan_pago->monto_total }}</td>
                    </tr>
                    <tr>
                        <th>Plazo:</th>
                        <td>{{ $plan_pago->plazo }}</td>
                    </tr>
                </tbody>
            </table>

            @if ($plan_pago->cuotas->count() > 0)
                <h3>Cuotas:</h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Descripción</th>
                            <th>Fecha</th>
                            <th>Monto</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($plan_pago->cuotas as $cuota)
                            <tr>
                                <td>{{ $cuota->descripcion }}</td>
                                <td>{{ $cuota->fecha }}</td>
                                <td>{{ $cuota->monto }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>No hay cuotas asociadas a este plan de pago.</p>
            @endif
        </div>
    @else
        <div class="card-body">
            <strong>No se encontró el plan de pago.</strong>
        </div>
    @endif
</div>
