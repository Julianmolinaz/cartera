@extends('templates.main2')

@section('title', 'mis pendientes')

@section('contenido')
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Solicitudes pendientes</h3>
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Solicitud id</th>
                        <th>Estado</th>
                        <th>Fecha de creación</th>
                        <th>Facturación</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pendientes as $solicitud)
                    <tr>
                        <td>{{ $solicitud->id }}</td>
                        <td>{{ $solicitud->aprobado }}</td>
                        <td>{{ ddmmyyyyhhmmss($solicitud->created_at) }}</td>
                        <td>{{ $solicitud->facturado ? 'Si' : 'No'}}</td>
                        <td>
                            <a 
                                href="{{ route('start.precreditosV3.show', $solicitud->id) }}"
                                class="btn btn-xs btn-default"
                                target="_blank"
                            >
                                <span class = "glyphicon glyphicon-eye-open" data-toggle="tooltip" data-placement="top" title="Ver Solicitud"></span>
                            </a>
                            <a 
                                href="{{ route('start.facturacion.index', $solicitud->id) }}"
                                class="btn btn-xs btn-default"
                                target="_blank"
                            >
                                <span class = "glyphicon glyphicon-flash" data-toggle="tooltip" data-placement="top" title="Ver Facturas"></span>
                            </a>
                        </td> 
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
