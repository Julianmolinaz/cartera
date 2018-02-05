@section('title','Wiki')
@section('contenido')


<div class="row" id="wiki">
    <div class="col-md-10 col-md-offset-1">
    <div class="jumbotron">
        <div class="container">
        <h1>Roles</h1>
        <table id="datatable" class="table table-bordered">
        <thead>
            <tr>
                <th scope="row"></th>
                <th>Administrador</th>
                <th>Asesor</th>
                <th>Asesor VIP</th>
                <th>Call</th>
                <th>Call VIP</th>
                <th>Recaudador</th>
            </tr>
            </thead>
            <tr><th>Registrar llamada</th><td>X</td><td>X</td><td>X</td><td>X</td><td></td><td></td></tr>
            <tr><th>Listar cliente</th><td>X</td><td>X</td><td>X</td><td>X</td><td>X</td><td></td></tr>
            <tr><th>Crear cliente</th><td>X</td><td>X</td><td>X</td><td></td><td></td><td></td></tr>
            <tr><th>Editar cliente</th><td>X</td><td>X</td><td>X</td><td>X</td><td>X</td><td></td></tr>
            <tr><th>Borrar cliente</th><td>X</td><td></td><td></td><td></td><td></td><td></td></tr>
            <tr><th>Listar crédito</th><td>X</td><td>X</td><td>X</td><td>X</td><td>X</td><td>X</td></tr>
            <tr><th>Crear crédito</th><td>X</td><td></td><td></td><td></td><td></td><td></td></tr>
            <tr><th>Editar crédito</th><td>X</td><td></td><td></td><td></td><td></td><td></td></tr>
            <tr><th>Listar egreso</th><td>X</td><td></td><td></td><td></td><td></td><td></td></tr>
            <tr><th>Crear egreso</th><td>X</td><td></td><td></td><td></td><td></td><td></td></tr>
            <tr><th>Editar egreso</th><td>X</td><td></td><td></td><td></td><td></td><td></td></tr>
            <tr><th>Borrar egreso</th><td>X</td><td></td><td></td><td></td><td></td><td></td></tr>
            <tr><th>Crear estudio</th><td>X</td><td>X</td><td>X</td><td>X</td><td>X</td><td></td></tr>
            <tr><th>Editar estudio</th><td>X</td><td>X</td><td>X</td><td>X</td><td>X</td><td></td></tr>
            <tr><th>Listar factura</th><td>X</td><td>X</td><td>X</td><td>X</td><td>X</td><td>X</td></tr>
            <tr><th>Crear factura</th><td>X</td><td>X</td><td>X</td><td></td><td></td><td>X</td></tr>    
            <tr><th>Crear otros ingresos</th><td><X/td><td>X</td><td>X</td><td></td><td></td><td>X</td></tr>
            <tr><th>Listar otros ingresos</th><td>X</td><td>X</td><td>X</td><td></td><td></td><td>X</td></tr>
<!-- Listar solicitudes
CREAR SOLICITUDES
Editar solicitudes
Listado de reportes
Reporte general
reporte general por carteras
Reporte general por funcionarios
Reporte venta de créditos
Reporte venta de créditos por asesor
Historial de créditos
Reporte cartera castigada
Reporte call center
Reporte auditoria del sistema
Reporte Procredito
Reporte Datacredito
Simulador -->
            
        </table>
        </div>
        </div>
    </div>

</div>

<script>
      $( document ).ready(function() {

        $('#datatable').dataTable( {
        'scrollY': 400,
        "scrollCollapse": true,
        "iDisplayLength": 500,
        'paging'        : false,
        'ordering'      :false

        });

        });
</script>

@endsection
@include('templates.main2')