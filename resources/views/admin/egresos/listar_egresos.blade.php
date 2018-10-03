@section('title','todos los egresos')

@section('contenido')

<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h2>
          Todos los Egresos
          <button type="button" class="btn btn-default pull-right" id="btn_exc" onclick="Exportar();">&nbsp;&nbsp;Exportar&nbsp;&nbsp;</button> 
        </h2>
      </div>
      <div class="panel-body">
        <p>
         @include('flash::message')
         <!--DataTables has most features enabled by default, so all you need to do to use it with your own tables is to call the construction function: <code>$().DataTable();</code>-->
       </p>

       <table id="datatable" class="compact display" style="width:100%">
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
      processing: true,
      serverSide: true,
      ajax: "{{ url('data/egresos') }}",  
      columns: [
        {data: 'id'},
        {data: 'comprobante_egreso'},
        {data: 'concepto'},
        {data: 'fecha'},
        {data: 'valor'},
        {data: 'observaciones'},
        //{data: 'cartera'},
        //{data: 'creo'}
      ] 
    });

  });

</script>

@endsection

@include('templates.main2')