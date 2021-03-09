@section('title','reporte')

@section('contenido')

<div class="row">

  <div class="col-md-12 col-sm-12 col-xs-12">

    <div class="panel panel-primary">

      <div class="panel-heading">Reporte Call Center [ {{$rango['ini'].' - '.$rango['fin']}} ]
        <button id="btn_exc_call" class="btn btn-warning"><b>Exportar</b></button>
      </div>
        <div class="panel-body">

        <div style="display:none;">{{$fila = 1}}</div>  

         <table id="datatable" class="table table-striped table-bordered" style="font-size:12px">
          <thead>
            <tr style="background-color:#FFC300;">
              <th>  #</th>
              <th>  <small>Llamada Id</small></th>
              <th>  Funcionario   </th>
              <th>  Credito Id   </th>
              <th>  Cliente      </th>
              <th>  Motivo        </th>
              <th>  Efectiva      </th>
              <th>  Descripcion   </th>
              <th>  Fecha         </th>
            </tr>
          </thead>
          <tbody style="font-size:12px">
            @foreach($llamadas as $llamada)
              <tr>
                <td>{{$fila++}}</td>
                <td>{{$llamada->id}}</td>
                <td>{{$llamada->user_create->name}} </td>
                <td>{{$llamada->credito_id}}</td>
                <td>{{$llamada->credito->precredito->cliente->nombre}}</td>
                <td>{{$llamada->criterio->criterio}}</td>
                @if($llamada->efectiva == '1')
                <td>Si</td>
                @elseif($llamada->efectiva == '0')
                <td>No</td>
                @else
                <td>Null</td>
                @endif

                <td>{{$llamada->observaciones}}</td>
                <td>{{$llamada->created_at}}</td>
                
              </tr>
            @endforeach  

          </tbody>
         </table>
    </div>
  </div>
</div>
</div>

<div class="row">
  <div class="col-md-3 col-sm-3 col-xs-12"></div>
  <div class="col-md-6 col-sm-6 col-xs-12">

    <div class="panel panel-primary">

      <div class="panel-heading"><h2>Totales
        <button id="btn_exc_total_call" class="btn btn-warning"><b>Exportar</b></button>
      </h2></div>
        <div class="panel-body">

        <table id="tbl_total" class="table table-striped table-bordered" style="font-size:12px">
          <thead>
            <tr style="background-color:#FFC300;">
             <th>Funcionario</th>
             <th>Número de llamadas</th>  
             <th>Efectivas</th>
             <th>No efectivas</th>           
            </tr>
          </thead>
          <tbody>
            @foreach($array_calls as $call)
              <tr>
               <td>{{$call['user']}}</td>
               <td>{{$call['num_llamadas']}}</td>
               <td>{{$call['efectivas']}}</td>
               <td>{{$call['no_efectivas']}}</td>
              </tr>
            @endforeach 
              <tr>
                <td><b>Total</b></td>
                <td>{{$totales['num_llamadas']}}</td>
                <td>{{$totales['efectivas']}}</td>
                <td>{{$totales['no_efectivas']}}</td>
              </tr>      
          </tbody>
        </table>
      </div>
      </div>
     </div> 
     <div class="col-md-3 col-sm-3 col-xs-12"></div>
    </div>


<script>
$( document ).ready(function() {

  $('#datatable').dataTable( {
    'paging':false,
    'ordering':true,
    'scrollY': 400,
    "scrollCollapse": true,
    //"scrollX": true,
    //"searching": false

  });

});


$('#btn_exc_call').click(function(){
  $('#datatable').table2excel({
    name: 'Reporte',
    filename: "{{'repor_call_'.$rango['ini'].'-a-'.$rango['fin'].'.xls'}}"
  });
});

$('#btn_exc_total_call').click(function(){
  $('#tbl_total').table2excel({
    name: 'Reporte',
    filename: "{{'repor_total_call_'.$rango['ini'].'-a-'.$rango['fin'].'.xls'}}"
  });
});



</script>

@endsection
@include('templates.main2')


