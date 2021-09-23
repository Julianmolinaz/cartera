@section('title','reporte general funcionarios')

@section('contenido')

<div class="row">

  <div class="col-md-12 col-sm-12 col-xs-12">

    <div class="panel panel-primary">

      <div class="panel-heading">Reporte de Ingresos por funcionario [ {{$rango['ini'].' - '.$rango['fin']}} ] 
        <button id="btn_exc_ingreos" class="btn btn-warning"><b>Exportar</b></button></div>
        <div class="panel-body">

         <table id="datatable" class="table table-striped table-bordered">
          <thead>
            <tr style="background-color:#FFC300;">
              <th>  # Fila                </th>
              <th>  Funcionario           </th>
              <th>  Factuara              </th>
              <th>  Concepto del Ingreso  </th>
              <th>  Valor del Ingreso     </th>
              <th>  Tipo de pago          </th>
              <th>  Banco                 </th>
              <th>  Solicitud             </th>
              <th>  Credito               </th>              
              <th>  Cartera               </th>
              <th>  Fecha                 </th>
           </tr>
          </thead>
          <tbody style="font-size:10px"  align="right">
            <div style="display:none;">{{$fila = 1}}</div>  
            

              @foreach($reporte as $data)
              <tr>
                <td>{{$fila++}}</td>
                <td align="left">{{$data['funcionario']}}</td>
                <td>{{$data['factura']}}</td>
                <td>{{$data['concepto']}}</td>
                <td>{{number_format($data['valor'],0,",",".")}}</td>
                <td>{{$data['tipo_pago']}}  </td>
                <td>{{$data['banco']}}
                <td>{{$data['solicitud']}}</td>
                <td>{{$data['credito']}}</td>
                <td>{{$data['cartera']}}</td>
                <td>{{$data['fecha']}}</td>
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
             <th>Punto</th> 
             <th>Funcionario</th>
             <th>Total</th>
            </tr>
          </thead>
          <tbody>
            @foreach($totales as $total)
              <tr>
                <td>{{$total['punto']}}</td>
                <td>{{$total['funcionario']}}</td> 
                <td align="right">{{number_format($total['total'],0,",",".")}}</td> 
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
  'ordering':false,
  'scrollY': 400,
  "scrollCollapse": true,
  "scrollX": true,
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


