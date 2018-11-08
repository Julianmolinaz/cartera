@section('title','reporte general')

@section('contenido')

<div class="row">

  <div class="col-md-12 col-sm-12 col-xs-12">

    <div class="panel panel-primary">

      <div class="panel-heading">Reporte de Ingresos [ {{$rango['ini'].' - '.$rango['fin']}} ] 
        <button id="btn_exc_ingreos" class="btn btn-warning"><b>Exportar</b></button></div>
        <div class="panel-body">


          <div class="row">
            <div class="col-xs-4 col-md-4">
              <a href="#" class="thumbnail">
                <div id="piechart"></div>
              </a>
            </div>
            <div class="col-xs-8 col-md-8">
              <a href="#" class="thumbnail">
                <div id="chart_div"></div>
              </a>
            </div>
          </div>

          <div class="row">
            <div class="col-xs-6 col-md-6">
              <a href="#" class="thumbnail">
                <div id="recaudos_por_tipo"></div>
              </a>
            </div>
            <div class="col-xs-6 col-md-6">
              <a href="#" class="thumbnail">
                  <span id="extras"></span>
              </a>
            </div>
          </div>
        

          <ul>
            <li> Número de créditos : {{ $info['num_creditos']  }}  </li>       
            <li> Valor a financiar: {{ $info['vlr_fin_total']  }}  </li>      
            <li> Valor a recaudar: {{ $info['vlr_a_recaudar']  }}  </li>     
            <li> Valor esperado: {{ $info['ingreso_esperado']  }}  </li>     
            <li> Recaudo en cuotas: {{ $info['vlr_recaudado_en_cuotas']  }}  </li>  
            <li> Recaudo en sanciones: {{ $info['vlr_recaudado_en_sanciones'] }} </li>
            <li> Recaudo en prejuridico: {{ $info['vlr_recaudado_prejuridico']  }}  </li>
            <li> Recaudo en juridico: {{ $info['vlr_recaudado_juridico']  }}  </li>   
            <li> # créditos ideales: {{ $info['creditos_ideales']  }}  </li>       
            <li> # créditos 0-1 pago: (20%): {{ $info['creditos_0_1_pago']  }}  </li>    
            <li> # créditos promedio: {{ $info['creditos_promedio']  }}  </li>    
            <li> {{ $info['pago_ideal']  }}  </li>           
            <li> % créditos 0-1 pago: {{ $info['porcien_0_1_pago']  }}  </li>     
            <li> % créditos promedio: {{ $info['porcien_promedio']  }}  </li>     
            <li> % créditos ideales: {{ $info['porcien_ideales']  }}  </li>      
            <li> Total ingresos adicionales: {{ $info['total_ingresos_adicionales'] }} </li>
            <li> Total valor financiado creditos ideales: {{ $info['total_debe_vlr_fin_creditos_ideales']  }}  </li> 
            <li> Total valor financiado creditos 0-1 pago: {{ $info['total_debe_vlr_fin_creditos_0_1_pago']  }}  </li>
            <li> Total valor creditos promedio: {{ $info['total_debe_vlr_fin_creditos_promedio']  }}  </li>
            <li> Saldo menos cartera: {{ $info['saldo_menos_cartera'] }}</li>
            <li> Total costo cartera: {{ $info['total_costo_cartera']  }}  </li>       
          </ul>

            

        
        


         <table id="datatable" class="table table-striped table-bordered" style="font-size:12px">
          <thead>
            <tr style="background-color:#FFC300;">
              <th>  <small>Credito Id</small></th>
              <th>  Cliente               </th>
              <th>  Documento             </th>
              <th>  Cuotas                </th>
              <th>  vlr financiado        </th>
              <th>  vlr a recaudar        </th>
              <th>  Recaudo en cuotas     </th>
              <th>  Recaudo Prejuridico   </th>
              <th>  Recaudo Juridico      </th>
              <th>  Recaudo sanciones     </th>
              <th>  Create___ </th>
           </tr>
          </thead>
          <tbody style="font-size:10px"  align="right">
          @foreach($info['creditos'] as $credito)
            <tr>
              <td>{{ $credito['id'] }}</td>
              <td>{{ $credito['cliente'] }}</td>
              <td>{{ $credito['documento'] }}</td>
              <td>{{ $credito['cuotas'] }}</td>
              <td>{{ $credito['vlr_financiado'] }}</td>
              <td>{{ $credito['vlr_a_recaudar'] }}</td>
              <td>{{ $credito['vlr_recaudado_en_cuotas']}}</td>   
              <td>{{ $credito['vlr_recaudado_prejuridico']}}</td> 
              <td>{{ $credito['vlr_recaudado_juridico']}}</td>    
              <td>{{ $credito['vlr_recaudado_en_sanciones']}}</td>
              <td>{{ $credito['created_at'] }}</td> 
            </tr>
          @endforeach 
            <tr>
              <td></td>
              <td>Totales</td>
              <td></td>
              <td></td>
              <td>{{ $info['total_listados']['vlr_financiado'] }}</td>
              <td>{{ $info['total_listados']['vlr_a_recaudar'] }}</td>
              <td>{{ $info['total_listados']['vlr_recaudado_en_cuotas']}}</td>   
              <td>{{ $info['total_listados']['vlr_recaudado_prejuridico']}}</td> 
              <td>{{ $info['total_listados']['vlr_recaudado_juridico']}}</td>    
              <td>{{ $info['total_listados']['vlr_recaudado_en_sanciones']}}</td>
              <td></td>
            </tr> 
          </tbody>
         </table>
    </div>
  </div>
</div> 
</div>  

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

@include('admin.reportes.financiero.graficas.financiero_operativo_js')
@include('admin.reportes.financiero.graficas.extras_js')
@include('admin.reportes.financiero.graficas.barras_js')
@include('admin.reportes.financiero.graficas.recaudos_por_tipo_js')

@endsection
@include('templates.main2')


