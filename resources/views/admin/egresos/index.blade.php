@section('title','egresos')

@section('contenido')

<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="panel panel-default">
      <div class="panel-heading">Egresos
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <a href="{{route('admin.egresos.create')}}"><button type="button" class="btn btn-default">Crear Egreso</button></a>
        <button type="button" class="btn btn-default pull-right" id="btn_exc" onclick="Exportar();">&nbsp;&nbsp;Exportar&nbsp;&nbsp;</button> 
      </div>
      <div class="panel-body">
        <p>
         @include('flash::message')
         <!--DataTables has most features enabled by default, so all you need to do to use it with your own tables is to call the construction function: <code>$().DataTable();</code>-->
       </p>

       <table id="datatable" data-order='[[ 0, "desc" ]]' class="table table-striped table-bordered" style="font-size:12px">
        <thead>
          <tr>
            <th>    Egreso id               </th>
            <th>    Comprobante de Egreso   </th>
            <th>    Concepto                </th>
            <th>    Fecha                   </th>
            <th>    Valor                   </th>
            <th>    Observaciones           </th>
            <th>    Cartera                 </th>
            <th>    Creó                    </th>
            <th>    Actualizó               </th>
            <th>    Actividad               </th>

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
$(document).ready(funcion(){
  $('#datatable').DataTable({
    processing: true,
    serverSide: true,
    ajax: "{{ url('data/egresos') }}",  
    columns: [
      {data: 'id'},
      {data: 'comprobante'},
      {data: 'concepto'},
      {data: 'fecha'},
      {data: 'valor'},
      {data: 'observaciones'},
      {data: 'cartera'},
      {data: 'creo'}
    ]
    ]
    ]


});

</script>


@endsection

@include('templates.main2')