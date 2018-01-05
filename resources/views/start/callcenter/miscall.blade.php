@section('title','Clientes')
@section('contenido')


<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
  <div class="panel panel-primary">
    <div class="panel-heading">
      <p><h2>=) Mis Call

        <button type="button" class="btn btn-default pull-right" id="btn_exc">&nbsp;&nbsp;Exportar&nbsp;&nbsp;</button>


      </h2>
      </p>
    </div>
    <div class="panel-body">
        <p>
         @include('flash::message')
         <!--DataTables has most features enabled by default, so all you need to do to use it with your own tables is to call the construction function: <code>$().DataTable();</code>-->
       </p>

       <div style="display:none;">{{$fila = 1}}</div>

        <table id="datatable" data-order='[[ 6, "desc" ]]' class="table table-striped table-bordered" style="font-size:12px">
          <thead>
            <tr style="background-color:#FFC300;">
              <th>    Credito id    </th>
              <th>    Cliente       </th>
              <th>    Documento</th>
              <th>    Criterio      </th>
              <th>    Agenda        </th>
              <th>    Observaciones </th>
              <th>    Fecha         </th>
            </tr>
          </thead>

          <tbody>
          @foreach($calls as $call)
          <tr>
            <td>{{$call->credito_id}}</td>
            <td>{{$call->credito->precredito->cliente->nombre}}</td>
            <td>{{$call->credito->precredito->cliente->num_doc}}</td>
            <td>{{$call->criterio->criterio}}</td>
            <td>{{$call->agenda}}</td>
            <td>{{$call->observaciones}}</td>
            <td>{{$call->created_at}}</td>

            </tr>

          @endforeach


          </tbody>
        </table>
      </div>
    </div>
</div>
{{ $calls->links() }}
<script>


  $( document ).ready(function() {

    $('#datatable').dataTable( {

        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],  
        'scrollY': 400,
        "scrollCollapse": true,
        'paging': false,
        "iDisplayLength": 100,
        
  
      });

  });


  $('#btn_exc').click(
    function(){
      var dateObj = new Date();
      var month = dateObj.getUTCMonth() + 1; //months from 1-12
      var day = dateObj.getUTCDate();
      var year = dateObj.getUTCFullYear();

      newdate = year + "/" + month + "/" + day; 

      $('#datatable').table2excel({
        name: 'clientes',
        filename: "miscall"+newdate+".xls"
      });
  });

</script>


@endsection
@include('templates.main2')
