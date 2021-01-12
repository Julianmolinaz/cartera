@section('title','reporte venta creditos')

@section('contenido')

<div class="row">

  <div class="col-md-12 col-sm-12 col-xs-12">

    <div class="panel panel-primary">

      <div class="panel-heading">Reporte Venta de Créditos [ {{$rango['ini'].' - '.$rango['fin']}} ]
        <button id="btn_exc_venta_creditos" class="btn btn-warning"><b>Exportar</b></button>
      </div>
        <div class="panel-body">
        <div style="display:none;">{{$fila = 1}}</div>  

         <table id="datatable" class="table table-striped table-bordered" style="font-size:12px">
          <thead>
            <tr style="background-color:#FFC300;">
              <th>#</th>
              <th>  Cartera           </th>
              <th>  <small>Credito Id</small></th>
              <th>  Castigada?        </th>
              <th>  Cliente           </th>
              <th>  Documento         </th>
              <th>  Producto          </th>
              <th>  Periodo           </th>
              <th>  Refinanciado      </th>
              <th>  Crédito Padre     </th>
              <th>  Cuotas            </th>
              <th>  Valor Cuota       </th> 
              <th>  Pago hasta        </th>
              <th>  Centro de Costos  </th>              
              <th>  Valor Crédito     </th>
              <th>  Cuota inicial     </th>
              <th>  Saldo             </th>
              <th>  # Factura         </th> 
              <th>  Create            </th>
           </tr>
          </thead>
          <tbody style="font-size:8px">
            @foreach($creditos as $credito)
              <tr>
                <td>{{$fila++}}             </td>
                <td>{{$credito->cartera}}   </td>
                <td>{{$credito->id}}        </td>
                <td>{{$credito->castigada}} </td>
                <td>{{$credito->cliente}}   </td>
                <td>{{$credito->documento}} </td>
                <td>{{$credito->producto}}  </td>
                <td>{{$credito->periodo}}   </td>
                <td>{{$credito->refinanciado}}</td>
                <td>{{$credito->credito_refinanciado_id}} </td>
                <td align="right">{{ $credito->cuotas}}   </td>       
                <td align="right">{{ number_format($credito->vlr_cuota,0,",",".")}}     </td>
                <td>{{ $credito->fecha_pago }}</td>
                <td align="right">{{ number_format($credito->vlr_fin,0,",",".")}}       </td>
                <td align="right">{{ number_format($credito->vlr_credito,0,",",".")}}   </td>
                <td align="right">{{ number_format($credito->cuota_inicial,0,",",".")}} </td>
                <td align="right">{{ number_format($credito->saldo,0,",",".")}}         </td>
                <td><small>{{$credito->factura}}</small></td>

                <td>{{$credito->created_at}}</td>
              </tr>
            @endforeach  
              <tr style="background-color:#CCCCCC;">
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td><b>Totales :</b></td>
                 <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td> 
                <td></td>
                <td></td>
                <td></td>
                <td align="right"><b>{{number_format($total_vlr_fin,0,",",".")}}</b></td>                
                <td align="right"><b>{{number_format($total_vlr_credito,0,",",".")}}</b></td>
                <td align="right"><b>{{number_format($total_saldo,0,",",".")}}</b></td>
                <td></td>
                <td></td>
                

              </tr>
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
        <button id="btn_exc_total_venta_creditos" class="btn btn-warning"><b>Exportar</b></button>
      </h2></div>
        <div class="panel-body">

        <table id="tbl_total" class="table table-striped table-bordered" style="font-size:12px">
          <thead>
            <tr style="background-color:#FFC300;">
             <th>Cartera</th>
             <th>Centro de Costos</th>
             <th>Valor del Crédito</th>
             <th>Rendimiento</th>
             <th>Saldo Total</th>
            </tr>
          </thead>
          <tbody>
          @foreach($carteras as $cartera)
            <tr>
              <td><br>{{$cartera['nombre']}}</td></td>
              <td align="right">{{number_format($cartera['vlr_fin'],0,",",".")}}</td>
              <td align="right">{{number_format($cartera['vlr_credito'],0,",",".")}}</td>
              <td align="right">{{number_format($cartera['rendimiento'],0,",",".")}}</td>
              <td align="right">{{number_format($cartera['saldo'],0,",",".")}}</td>
            </tr>
          @endforeach 
            <tr style="background-color:#CCCCCC;">
              <td><b>Total</b></td>
              <td align="right"><b>{{ number_format($total['vlr_fin'],0,",",".")}}</b></td>
              <td align="right"><b>{{ number_format($total['vlr_credito'],0,",",".") }}</b></td>
              <td align="right"><b>{{ number_format($total['rendimiento'],0,",",".") }}</b></td>
              <td align="right"><b>{{ number_format($total['saldo'],0,",",".") }}</b></td>
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
    'ordering':false,
    'scrollY': 400,
    "scrollCollapse": true,
    //"scrollX": true,
    "searching": false

  });


$('#btn_exc_venta_creditos').click(function(){
  $('#datatable').table2excel({
    name: 'Reporte',
    filename: "{{'repor_venta_creditos_'.$rango['ini'].'==='.$rango['fin'].'.xls'}}"
  });
});

$('#btn_exc_total_venta_creditos').click(function(){
  $('#tbl_total').table2excel({
    name: 'Reporte',
    filename: "{{'repor_total_venta_creditos_'.$rango['ini'].'==='.$rango['fin'].'.xls'}}"
  });
});




});
</script>

@endsection
@include('templates.main2')


