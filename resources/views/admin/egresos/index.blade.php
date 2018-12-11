@section('title','todos los egresos')

@section('contenido')

<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h2>
          Todos los Egresos
          <button type="button" class="btn btn-default pull-right" id="btn_exc" onclick="Exportar();">&nbsp;&nbsp;Exportar&nbsp;&nbsp;</button> 
          <a href="{{route('admin.egresos.create')}}" class="btn btn-default pull-right">Crear Egreso</a>
        </h2>
      </div>
      <div class="panel-body">
        <p>
         @include('flash::message')
         <!--DataTables has most features enabled by default, so all you need to do to use it with your own tables is to call the construction function: <code>$().DataTable();</code>-->
       </p>

       <table id="datatable" class="table table-striped table-bordered" style="width:100%; font-size: 11px;">
        <thead>
          <tr>
            <th>    Egreso id               </th>
            <th>    Comprobante de Egreso   </th>
            <th>    Concepto                </th>
            <th>    Fecha                   </th>
            <th>    Valor                   </th>
            <th>    Observaciones           </th>
            <th>    Punto                   </th>
            <th>    Cartera                 </th>
            <th>    Creó                    </th>
            <th>    Actualizó               </th>

          </tr>
        </thead>

        <tbody>
        </tbody>
      </table>

    </div>
  </div>
</div>     
</div>


<script>
  $(document).ready(function(){

    $('#datatable').DataTable({
      pageLength: 1000,
      processing: true,
      serverSide: true,
      dom: 'Bfrtip',
      buttons: [
        'excel'
      ],
      ajax: "{{ url('data/egresos') }}",  
      columns: [
        {data: 'id'},
        {data: 'comprobante_egreso'},
        {data: 'concepto'},
        {data: 'fecha'},
        {data: 'valor'},
        {data: 'observaciones'},
/*        {data: 'punto.nombre' },*/
        {data: 'cartera.nombre'},
        {data: 'user_create.name'},
        {data: 'btn', searchable: false}

      ] 
    });

  });

    $('#btn_exc').click(function(){
        $('#datatable').table2excel({
            name: 'Reporte',
            filename: "{{'repor_egresos.xls'}}"
        });
    });

</script>

@endsection

@include('templates.main2')