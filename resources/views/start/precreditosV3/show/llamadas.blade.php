<div class="panel panel-default">
    <div class="panel-body">

        <h2>Llamadas</h2>

        <hr>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Criterio</th>
                        <th>Observaciones</th>
                        <th>Agenda</th>
                        <th>Gestionó</th>
                        <th>Efectiva</th>
                       <th>Fecha gestion</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data['llamadas'] as $llamada)
                    <tr class="llamadas-detail">
                        <td>{{ $llamada->criterio }}</td>
                        <td class="llamadas-detail__observaciones">{{ $llamada->observaciones }}</td>
                        <td>{{ ddmmyyyy($llamada->agenda) }}</td>
                        <td>{{ $llamada->created_by }}</td>
                        <td>{{ $llamada->efectiva ? 'Si' : 'No' }}</td>
                        <td>{{ ddmmyyyyhhmmss($llamada->created_at) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
