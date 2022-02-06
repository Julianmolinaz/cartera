@section('title','reporte')

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
              <th>  Tipo de Pago  </th>
              <th>  Banco         </th>
              <th>  Cuotas        </th>
              <th>  Sanciones     </th>
              <th>  Juridico      </th>
              <th>  Prejuridico   </th>
              <th>  Saldos a Favor</th>
              <th>  Estudios      </th>
              <th>  Inicial       </th>
              <th>  Otros Ingresos</th>
              <th>  Concepto      </th>
              <th>  # Factura     </th>
              <th>  Fecha_Pago    </th> 
              <th>  Cartera       </th>
              <th>  Encargado     </th>
              <th>  Create___     </th>
           </tr>
          </thead>
          <tbody style="font-size:10px"  align="right">
            @foreach($cuotas as $cuota)
            <tr>
              <td> {{ $cuota->credito_id  }} </td>
              <td> {{ $cuota->cliente     }} </td>
              <td> {{ $cuota->documento   }} </td>
              <td> {{ $cuota->tipo_pago   }} </td>
              <td> {{ $cuota->banco       }} </td>
              <td> {{ number_format($cuota->cuotas,0,",",".") }} </td>
              <td></td> <td></td> <td></td>  <td></td>  <td></td>  <td></td>   <td></td> <td></td> 
              <td> {{ $cuota->num_fact    }} </td>
              <td> {{ $cuota->fecha       }} </td>
              <td> {{ $cuota->cartera     }} </td>
              <td> {{ $cuota->user_create }}</td>
              <td style="font-size:10px"> {{ $cuota->created_at}}</td>
            </tr>
            @endforeach  
            @foreach($sanciones as $sancion)
            <tr>
              <td> {{ $sancion->credito_id  }} </td>
              <td> {{ $sancion->cliente     }} </td>
              <td> {{ $sancion->documento   }} </td>
              <td> {{ $sancion->tipo_pago   }} </td>
              <td> {{ $sancion->banco       }} </td>            
              <td></td> 
              <td align="right"> {{ number_format($sancion->sanciones,0,",",".")  }} </td>
              <td></td>  <td></td>  <td></td>  <td></td>  <td></td>  <td></td>   <td></td>
              <td> {{ $sancion->num_fact    }} </td>
              <td> {{ $sancion->fecha       }} </td>
              <td> {{ $sancion->cartera     }} </td>
              <td> {{ $sancion->user_create }}</td>
              <td> {{ $sancion->created_at}}</td>
            </tr>
            @endforeach   
            @foreach($juridicos as $juridico)
            <tr align="right">
              <td> {{ $juridico->credito_id}} </td>
              <td> {{ $juridico->cliente   }} </td>
              <td> {{ $juridico->documento }} </td>
              <td> {{ $juridico->tipo_pago }} </td>   
              <td> {{ $juridico->banco     }} </td>            
              <td> </td> <td> </td>
              <td> {{ number_format($juridico->juridico,0,",",".")  }} </td>
              <td></td> <td></td> <td></td>  <td></td>  <td></td>  <td></td>
              <td> {{ $juridico->num_fact  }} </td>
              <td> {{ $juridico->fecha     }} </td>
              <td> {{ $juridico->cartera   }} </td>
              <td> {{ $juridico->user_create}}</td>
              <td> {{ $juridico->created_at}} </td>
            </tr>
            @endforeach
            @foreach($prejuridicos as $prejuridico)
            <tr>
              <td> {{ $prejuridico->credito_id}} </td>
              <td> {{ $prejuridico->cliente   }} </td>
              <td> {{ $prejuridico->documento }} </td>
              <td> {{ $prejuridico->tipo_pago }} </td>  
              <td> {{ $prejuridico->banco     }} </td>            
              <td></td> <td></td> <td></td>
              <td> {{ number_format($prejuridico->prejuridico,0,",",".") }} </td>
              <td></td>  <td></td> <td></td>  <td></td>  <td></td>
              <td> {{ $prejuridico->num_fact  }} </td>
              <td> {{ $prejuridico->fecha     }} </td>            
              <td> {{ $prejuridico->cartera   }} </td>
              <td> {{ $prejuridico->user_create}}</td>
              <td> {{ $prejuridico->created_at}} </td>
            </tr>
            @endforeach    
            @foreach($saldos_favor as $saldo)
            <tr>
              <td> {{ $saldo->credito_id}} </td>
              <td> {{ $saldo->cliente   }} </td>
              <td> {{ $saldo->documento }} </td>
              <td> {{ $saldo->tipo_pago }} </td> 
              <td> {{ $saldo->banco     }} </td> 
              <td></td> <td></td> <td></td>  <td></td>
              <td> {{ number_format($saldo->saldo_favor,0,",",".")  }} </td>   
              <td></td> <td></td>  <td></td>   <td></td>
              <td> {{ $saldo->num_fact  }} </td>
              <td> {{ $saldo->fecha     }} </td>            
              <td> {{ $saldo->cartera   }} </td>
              <td> {{ $saldo->user_create}}</td>
              <td> {{ $saldo->created_at}}</td>
            </tr>
            @endforeach 
            @foreach($estudios as $estudio)
            <tr>
              <td> {{ $estudio['credito_id']    }} </td>
              <td> {{ $estudio['cliente']       }}</td>
              <td> {{ $estudio['documento']     }}</td>
              <td></td> <td></td> <td></td>  <td></td> <td></td>  <td></td> <td></td>
              <td> {{ number_format($estudio['valor_estudio'],0,",",".") }}</td>
              <td></td> <td></td>  <td></td>
              <td> {{ $estudio['factura']       }} </td>
              <td> {{ $estudio['fecha']         }}</td>            
              <td> {{ $estudio['cartera']       }}</td>
              <td> {{ $estudio['user_create']   }}</td>
              <td> {{ $estudio['created_at']    }}</td>
            </tr>
            @endforeach   
            @foreach($iniciales as $inicial)
            <tr>
              <td> {{ $inicial->credito_id   }} </td>
              <td> {{ $inicial->cliente}}       </td>
              <td> {{ $inicial->documento}}     </td> <td></td>  <td></td> <td></td>  <td></td> <td></td>  <td></td> <td></td>    <td></td> <td></td>
              <td> {{ number_format($inicial->cta_inicial,0,",",".")}} </td>
              <td></td>
              <td> {{ $inicial->factura}}</td>
              <td> {{ $inicial->fecha }}</td>            
              <td> {{ $inicial->cartera}}</td>
              <td> {{ $inicial->user_create}}</td>
              <td> {{ $inicial->created_at}}</td>
            </tr>
            @endforeach            
            @foreach($otros_pagos as $otro_pago)
            <tr>
              <td></td> <td></td>  <td></td>
              <td>{{$otro_pago->tipo}}</td>
              <td></td> <td></td> <td></td>  <td></td> <td></td>  <td></td> <td></td>  <td></td>
              <td> {{ number_format($otro_pago->subtotal,0,",",".") }} </td>
              <td> {{ $otro_pago->concepto }} </td>
              <td> {{ $otro_pago->factura }} </td>
              <td> {{ $otro_pago->fecha }} </td>
              <td> {{ $otro_pago->cartera }} </td>
              <td> {{ $otro_pago->user_create }} </td>
              <td> {{ $otro_pago->created_at }} </td>
            </tr>  
            @endforeach 
            <tr style="background-color:#CCCCCC;">
              <td></td><td></td><td></td><td></td>
              <td><b>Subtales Ingresos :</b></td>
              <td><b>{{number_format($total_cuotas,0,",",".")}}</b></td>
              <td><b>{{number_format($total_sanciones,0,",",".")}}</b></td>
              <td><b>{{number_format($total_juridicos,0,",",".")}}</b></td>
              <td><b>{{number_format($total_prejuridicos,0,",",".")}}</b></td>
              <td><b>{{number_format($total_saldos,0,",",".")}}</b></td>
              <td><b>{{number_format($total_estudios,0,",",".")}}</b></td>
              <td><b>{{number_format($total_iniciales,0,",",".")}}</b></td>
              <td><b>{{number_format($total_otros_ingresos,0,",",".")}}</b></td>
              <td></td> <td></td>  <td></td> <td></td>  <td></td> <td></td>
            </tr>
          </tbody>
         </table>
    </div>
  </div>
</div>
</div>

<div class="row">

  <div class="col-md-12 col-sm-12 col-xs-12">

    <div class="panel panel-primary">

      <div class="panel-heading">Reporte de Egresos
        <button id="btn_exc_egresos" class="btn btn-warning"><b>Exportar</b></button>
      </div>
      <div class="panel-body">

      <div class="table-responsive">
        <table id="tbl_egresos" class="table table-striped table-bordered" style="font-size:12px">
          <thead style="background-color:#FFC300;">
            <tr>
              <th>  Comprobante de Egreso</th>
              <th>  Gastos               </th>
              <th>  Compras              </th>
              <th>  Prestamos            </th>
              <th>  Pago a proveedotes   </th>
              <th align="left">  Observaciones        </th>
              <th>  Fecha                </th>
              <th>  Cartera              </th>
              <th>  Encargado            </th>   
              <th>  Create</th>
            </tr>
          </thead>
          <tbody align="right">
            @foreach($gastos as $gasto)
            <tr>
              <td>  {{  $gasto->comprobante_egreso  }}              </td>
              <td>  {{  number_format($gasto->valor,0,",",".")  }}  </td>
              <td></td>
              <td></td>
              <td></td>
              <td align="left"> {{  $gasto->observaciones }}        </td>
              <td>  {{  $gasto->fecha         }}                    </td>
              <td>  {{  $gasto->cartera->nombre }}                  </td>
              <td>  {{  $gasto->user_create->name}}                 </td>
              <td>{{$gasto->created_at}}                            </td>
            </tr>  
            @endforeach  

            @foreach($compras as $compra)
            <tr>
              <td>{{$compra->comprobante_egreso}}                   </td>
              <td></td>
              <td>{{number_format($compra->valor,0,",",".")}}       </td>
              <td></td>
              <td></td>
              <td align="left">{{$compra->observaciones}}           </td>
              <td>{{$compra->fecha        }}                        </td>
              <td>{{$compra->cartera->nombre   }}                   </td>
              <td>  {{  $compra->user_create->name}}                </td>
              <td>{{$compra->created_at}}                           </td>
            </tr>  
            @endforeach  

            @foreach($prestamos as $prestamo)
            <tr>
              <td>{{$prestamo->comprobante_egreso}}                 </td>
              <td></td>
              <td></td>
              <td>{{number_format($prestamo->valor,0,",",".")}}     </td>
              <td></td>
              <td align="left">{{$prestamo->observaciones}}         </td>
              <td>{{$prestamo->fecha        }}                      </td>
              <td>{{$prestamo->cartera->nombre}}                    </td>
              <td>  {{  $prestamo->user_create->name}}              </td>
              <td>{{$prestamo->created_at}}                         </td>
            </tr>  
            @endforeach 

            @foreach($pago_proveedores as $pago_proveedor)
            <tr>
              <td>{{$pago_proveedor->comprobante_egreso}}           </td>
              <td></td>
              <td></td>
              <td></td>
              <td>{{number_format($pago_proveedor->valor,0,",",".")}}</td>
              <td align="left">{{$pago_proveedor->observaciones}}   </td>
              <td>{{$pago_proveedor->fecha        }}                </td>
              <td>{{$pago_proveedor->cartera->nombre}}              </td>
              <td>  {{  $pago_proveedor->user_create->name}}        </td>
              <td>{{$pago_proveedor->created_at}}                   </td>
            </tr>  
            @endforeach 


            <tr  style="background-color:#CCCCCC;">
              <td><b>Subtotales Egresos</td>
              <td> <b>{{number_format($total_gastos,0,",",".")}}</b></td>
              <td> <b>{{number_format($total_compras,0,",",".")}}</b></td>
              <td> <b>{{number_format($total_prestamos,0,",",".")}}</b></td>
              <td> <b>{{number_format($total_pago_proveedores,0,",",".")}}</b></td>
              <td> </td>
              <td> </td>
              <td> </td>
              <td></td>
              <td></td>
            </tr>


          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
</div>

<div class="row">
  <div class="col-md-3 col-sm-3 col-xs-12"></div>
  <div class="col-md-6 col-sm-6 col-xs-12">

    <div class="panel panel-primary">

      <div class="panel-heading"><h2>Totales

         <button id="btn_exc_total" class="btn btn-warning"><b>Exportar</b></button>

      </h2>
      </div>
        <div class="panel-body">
        <div class="table-responsive">
          <table id="tbl_total" class="table table-striped table-bordered">
            <thead>
              <tr style="background-color:#FFC300;">
              <th>Cartera</th>
              <th>Ingresos</th>
              <th>Egresos</th>
              <th>Diferencia</th>
              </tr>
            </thead>
            <tbody>
            @foreach($carteras as $cartera)
              <tr>
                <td><br>{{$cartera['nombre']}}</td></td>
                <td align="right">{{number_format($cartera['ingreso'],0,",",".")}}</td>
                <td align="right">{{number_format($cartera['egreso'],0,",",".")}}</td>
                <td align="right">{{number_format($cartera['diferencia'],0,",",".")}}</td>
              </tr>
            @endforeach 
              <tr  style="background-color:#CCCCCC;">
                <td><b>Total</b></td>
                <td align="right"><b>{{ number_format($total['ingresos'],0,",",".")}}</b></td>
                <td align="right"><b>{{ number_format($total['egresos'],0,",",".") }}</b></td>
                <td align="right"><b>{{ number_format($total['diferencia'],0,",",".") }}</b></td>
              </tr> 
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

     <div class="col-md-3 col-sm-3 col-xs-12">



    </div>

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


