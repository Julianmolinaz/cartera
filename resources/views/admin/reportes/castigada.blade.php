@section('title','reporte cartera castigada')

@section('contenido')

<div class="row">

  <div class="col-md-12 col-sm-12 col-xs-12">

    <div class="panel panel-primary">

      <div class="panel-heading">Reporte de Ingresos [ {{$rango['ini'].' - '.$rango['fin']}} ] 
        <button id="btn_exc_ingreos" class="btn btn-warning"><b>Exportar</b></button></div>
        <div class="panel-body">

         <table id="datatable" class="table table-striped table-bordered" style="font-size:12px">
          <thead>
            <tr style="background-color:#FFC300;">
              <th>  <small>Credito Id</small></th>
              <th>  Cliente       </th>
              <th>  Documento     </th>
              <th>  Saldo         </th>
              <th>  # Factura     </th>
              <th>  Pago hasta    </th> 
              <th>  Cartera       </th>
              <th>  Fecha del reporte </th>
              <th>Acción</th>
           </tr>
          </thead>
          <tbody style="font-size:10px"  align="right">
          @foreach($castigadas as $castigada)
            <tr>
              <td>{{$castigada->credito->id}}</td>
              <td>{{$castigada->credito->precredito->cliente->nombre}}</td>
              <td>{{$castigada->credito->precredito->cliente->num_doc}}</td>
              <td>{{number_format($castigada->saldo,0,",",".")}}</td>
              <td>{{$castigada->credito->precredito->num_fact}}</td>
              <td>{{$castigada->credito->fecha_pago->fecha_pago}}</td>
              <td>{{$castigada->credito->precredito->cartera->nombre}}</td>
              <td>{{$castigada->created_at}}</td>
              <td>
                <a href="{{route('start.precreditos.ver',$castigada->credito->precredito->id)}}"
                  class = 'btn btn-default btn-xs' title="Ver"><span class = "glyphicon glyphicon-eye-open" ></span></a>

              </td>

            </tr>
          @endforeach  
         

          </tbody>
         </table>
    </div>
  </div>
</div>
</div>
<div class="row">
  <div class="col-md-3 col-sm-3"></div>
  <div class="col-md-6 col-sm-6 col-xs-12">

    <div class="panel panel-primary">

      <div class="panel-heading"><h2>Totales

         <button id="btn_exc_total" class="btn btn-warning"><b>Exportar</b></button>

      </h2>
      </div>
        <div class="panel-body">

        <table id="tbl_total" class="table table-striped table-bordered">
          <thead>
            <tr style="background-color:#FFC300;">
             <th>Cartera</th>
             <th>Valor Castigado</th>
            </tr>
          </thead>
          <tbody>
          @foreach($carteras as $cartera)
            <tr>
              <td><br>{{$cartera['nombre']}}</td></td>
              <td align="right">{{number_format($cartera['cartera_castigada'],0,",",".")}}</td>
            </tr>
          @endforeach 

          </tbody>
        </table>
      </div>
      </div>
     </div>
     <div class="col-md-3 col-sm-3"></div>
    </div>    

 



<script>
$( document ).ready(function() {

$('#datatable').dataTable( {
  'paging':false,
  'ordering':true,
  'scrollY': 400,
  "scrollCollapse": true,
  //"scrollX": true,
  "searching": false

});

$('#btn_exc_ingreos').click(function(){
  $('#datatable').table2excel({
    name: 'Reporte',
    filename: "{{'repor_ingre_'.$rango['ini'].'-'.$rango['fin'].'.xls'}}"
  });
});

$('#btn_exc_egresos').click(function(){
  //alert('egresos');
  $('#tbl_egresos').table2excel({
    name: 'Reporte2',
    filename: "{{'repor_egre_'.$rango['ini'].'-'.$rango['fin'].'.xls'}}"
  });
});

$('#btn_exc_total').click(function(){
  //alert('egresos');
  $('#tbl_total').table2excel({
    name: 'Reporte3',
    filename: "{{'repor_total_'.$rango['ini'].'-'.$rango['fin'].'.xls'}}"
  });
});


} );
</script>
<script type="text/javascript">

$(function() {
    $('input[name="fecha"]').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true
    });
});
</script>

@endsection
@include('templates.main2')


