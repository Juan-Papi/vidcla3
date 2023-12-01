<div>
    @if (session('info'))
        <div class="alert alert-primary" role="alert">
            <strong>¡Éxito!</strong>
            {{ session('info') }}
        </div>
    @endif
    <div class="card">

        <div class="card-header">
            <a class="btn btn-secondary" href="{{ route('personal.create') }}">NUEVO PERSONAL</a>
        </div>

        @if ($personales->count())
            <div class="table-responsive">
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Carnet</th>
                                <th>Nombre</th>
                                <th>Paterno</th>
                                <th>Materno</th>
                                <th>Sexo</th>
                                <th>Cargo</th>
                                <th>Estado</th>
                                {{-- <th>País</th> --}}
                                {{-- <th>Ciudad</th> --}}
                                <th>Usuario</th>
                                <th colspan="2"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($personales as $personal)
                                <tr>
                                    <td>{{ $personal->carnet }}</td>
                                    <td>{{ $personal->nombre }}</td>
                                    <td>{{ $personal->paterno }}</td>
                                    <td>{{ $personal->materno }}</td>
                                    <td>{{ $personal->sexo }}</td>
                                    <td>{{ $personal->cargo }}</td>
                                    <td>{{ $personal->estado }}</td>
                                    {{-- <td>{{ $personal->pais }}</td> --}}
                                    {{-- <td>{{ $personal->ciudad }}</td> --}}
                                    <td>
                                        @if ($personal->user)
                                            {{ $personal->user->name }}
                                        @else
                                            Ninguno
                                        @endif
                                    </td>
                                    <td width="10px">
                                        <a class="btn btn-primary" href="{{ route('personal.edit', $personal) }}"><i
                                                class="fas fa-user-edit"></i></a>
                                    </td>
                                    <td width="10px">
                                        <form action="{{ route('personal.destroy', $personal) }}" method="POST">
                                            @method('delete')
                                            @csrf
                                            <button class="btn btn-danger" type="submit"><i
                                                    class="fas fa-user-minus"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card-footer">
                {{ $personales->links() }}
            </div>
        @else
            <div class="card-body">
                <strong>No hay registros ...</strong>
            </div>
        @endif

    </div>
</div>
