@section('title','callcenter cliente')

@section('contenido')
<!-- Panel Cliente-->
<div class="row">

  <div class="col-md-1 col-sm-1"></div>
  <div class="col-md-10 col-sm-10 col-xs-12">
  <div class="panel panel-default">
    <div class="panel-heading" style="color:#dd4437;">Cliente</div>
    <div class="panel-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="table_cliente" style="font-size:12px">

            <tr>
              <th>Documento</th>
              <th>Nombre</th>
              <th>Fecha Nacimiento</th>
              <th>Placa</th>
              <th>Ocupación</th>
              <th>Tipo de Actividad</th>
              <th>Empresa</th>
                          
            </tr>

            <tr>
              <td>{{$credito->precredito->cliente->num_doc}}</td>
              <td>{{$credito->precredito->cliente->nombre}}</td>
              <td>{{$credito->precredito->cliente->fecha_nacimiento}}</td>
              <td>{{$credito->precredito->cliente->placa}}</td>
              <td>{{$credito->precredito->cliente->ocupacion}}</td>
              <td>{{$credito->precredito->cliente->tipo_actividad}}</td>
              <td>{{$credito->precredito->cliente->empresa}}</td>

            </tr>

            <tr><th></th></tr>
            <tr>
              <th>Movil</th>
              <th>Fijo</th>
              <th>Email</th>
              <th colspan="2">Dirección</th>
              <th>Creó</th>
              <th>Actualizó</th>

            </tr>

            <tr>
              <td>{{$credito->precredito->cliente->movil}}</td>
              <td>{{$credito->precredito->cliente->fijo}}</td>
              <td>{{$credito->precredito->cliente->email}}</td>
              <td colspan="2">{{$credito->precredito->cliente->direccion
                    .' - '.$credito->precredito->cliente->barrio
                    .' - '.$credito->precredito->cliente->municipio->nombre
                    .' - '.$credito->precredito->cliente->municipio->departamento}}</td>
              <td>{{$credito->precredito->cliente->user_create->name.' '.
                    $credito->precredito->cliente->created_at}}</td>
              <td>{{$credito->precredito->cliente->user_update->name.' '.
                    $credito->precredito->cliente->updated_at}}</td>
            </tr>

        </table>
      </div>
      <center>
            <a href="javascript:window.history.back();"  class="text-right">
              <button type="button" class="btn btn-primary">Volver</button>
            </a>
            <a href="{{route('start.clientes.edit',$credito->precredito->cliente->id)}}"  class="text-right">
              <button type="button" class="btn btn-danger">Editar</button>
            </a>
      </center>

    </div>
  </div>
</div> 
<div class="col-md-1 col-sm-1"></div>
</div>
<!-- Panel Credito-->
<div class="row">

  <div class="col-md-1 col-sm-1"></div>
  <div class="col-md-10 col-sm-10 col-xs-12">
  <div class="panel panel-default">
    <div class="panel-heading" style="color:#dd4437;">Crédito</div>
    <div class="panel-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="table_credito" style="font-size:12px">

          <tr>
            <th>#</th>
            <th>Aprobación</th>
            <th>Cartera</th>
            <th>Funcionario</th>
            <th>Producto</th>
            <th>Meses</th>
            <th>Periodo</th>
            <th>Cuotas</th> 
            <th>1° Fecha</th>
            <th>2° Fecha</th>   
          </tr>
          <tr>
            <td style="font-weight: bold;font-size: 150%;">{{$credito->id}}</td>
            <td><small>{{$credito->precredito->fecha}}</small></td>
            <td style="font-weight: bold;font-size: 150%;">{{$credito->precredito->cartera->nombre}}</td>
            <td><small>{{$credito->precredito->funcionario->name}}</small></td>
            <td><small>{{$credito->precredito->producto->nombre}}</small></td>
            <td><small>{{$credito->precredito->meses}}</small></td>
            <td><small>{{$credito->precredito->periodo}}</small></td>
            <td><small>{{$credito->precredito->cuotas}}</small></td>
            <td><small>{{$credito->precredito->p_fecha}}</small></td>
            <td><small>{{$credito->precredito->s_fecha}}</small></td>
          </tr>
          <tr><th></th></tr>
          <tr>
            <th>Estudio Credito</th>
            <th>Costo del crédito</th>
            <th>Cuota Inicial</th>              
            <th>Valor Cuota</th>
            <th>Estado</th>
            <th>Castigada</th>
            <th>Cuotas Faltantes</th>
            <th>Saldo Deuda</th>
            <th>Saldo a Favor</th>
            <th>Vlr Total Crédito</th>
          </tr>
          <tr>
            <td><small>{{$credito->precredito->estudio}}</small></td>
            <td align="right"><small>{{number_format($credito->precredito->vlr_fin,0,",",".")}}</small></td>
            <td><small>{{number_format($credito->precredito->cuota_inicial,0,",",".")}}</small></td>
            <td><small>{{number_format($credito->precredito->vlr_cuota,0,",",".")}}</small></td>
            <td  style="font-weight: bold;font-size: 150%;">{{$credito->estado}}</td>
            <td><small>{{$credito->castigada}}</small></td>
            <td><small>{{$credito->cuotas_faltantes}}</small></td>
            <td align="right"><small>{{number_format($credito->saldo,0,",",".")}}</small></td>
            <td align="right"><small>{{number_format($credito->saldo_favor,0,",",".")}}</small></td>
            <td align="right"><small>{{number_format($credito->valor_credito,0,",",".")}}</small></td>
          </tr>
          <tr><th></th></tr>
          <tr>
            <th>Cobro Jurídico</th>
            <th>Cobro Prejurídico</th>
            <th>Sanciones</th>
            <th>Debe Cuotas Parciales</th>
            <th>Fecha Pago</th>
            <th>Creó</th>
            <th>Actualizó</th>              
            <th colspan="3">observaciones</th>
          </tr>
          <tr>
            @if($juridico) <td style="font-weight: bold;" align="right">{{number_format($juridico[0]->valor,0,",",".")}}</td>
            @else          <td></td>
            @endif    
            @if($prejuridico) <td style="font-weight: bold;" align="right">{{number_format($prejuridico[0]->valor,0,",",".")}}</td>
            @else          <td></td>
            @endif   
            <td align="right"><small>{{number_format($sum_sanciones,0,",",".")}}</small></td>
            <td align="right"><small>{{number_format($total_parciales,0,",",".")}}</small></td>
            <td><small>{{$credito->fecha_pago->fecha_pago}}</small></td>
            <td><small>{{$credito->user_create->name.' '.$credito->created_at}}</small></td>
            <td><small>{{$credito->user_update->name.' '.$credito->updated_at}}</small></td>
            <td colspan="3">{{$credito->precredito->observaciones}}</td>
          </tr>

        </table>
      </div>
    </div>
  </div>
  </div>
  <div class="col-md-1 col-sm-1"></div>

</div>

<!-- Panel Pagos-->
<div class="row">

  <div class="col-md-1 col-sm-1"></div>
  <div class="col-md-10 col-sm-10 col-xs-12">
  <div class="panel panel-default">
    <div class="panel-heading" style="color:#dd4437;">Pagos
      <button class="btn btn-danger btn-xs pull-right" id="btn_exc_pagos">Exportar</button>
    </div>
    <div class="panel-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="table_pagos" style="font-size:12px">
          <thead>
            <tr>
              <th>#</th>
              <th>Factura</th>
              <th>Fecha</th>
              <th>Concepto</th>
              <th>Abono</th>
              <th>Debe</th>
              <th>Estado</th>
              <th>Desde</th>
              <th>Hasta</th>
              <th>Abono pago id</th>
            </tr>
          </thead>
          <tbody>
            @foreach($pagos as $pago)
            <tr>
              <td>{{$pago->id}}</td>
              <td>{{$pago->num_fact}}</td>
              <td>{{$pago->fecha_factura}}</td>
              <td>{{$pago->concepto}}</td>
              <td align="right">{{number_format($pago->abono,0,",",".")}}</td>
              <td align="right">{{number_format($pago->debe,0,",",".")}}</td>
              <td>{{$pago->estado}}</td>
              <td>{{$pago->pago_desde}}</td>
              <td>{{$pago->pago_hasta}}</td>
              <td>{{$pago->abono_pago_id}}</td>
            </tr>  
            @endforeach
          
          </tbody>
        </table>
      </div>
    </div>
  </div>
  </div>
  <div class="col-md-1 col-sm-1"></div>
</div>
<!-- Panel Llamadas-->
<div class="row">
  <div class="col-md-1 col-sm-1"></div>
  <div class="col-md-10 col-sm-10 col-xs-12">
  <div class="panel panel-default">
    <div class="panel-heading" style="color:#dd4437;">Llamadas  
        <button class="btn btn-danger btn-xs pull-right" id="btn_exc_llamadas">Exportar</button>
    </div>
    <div class="panel-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="table_llamadas" style="font-size:12px">
          <thead>
            <tr>
              <th>  Criterio      </th>
              <th>  Observaciones </th>
              <th>  Agenda        </th>
              <th>  Creó          </th>
	      <th>  Fecha de creación </th>	
          
            </tr>
          </thead>
          <tbody>
            @foreach($llamadas as $llamada)
            <tr>
              <td>  {{$llamada->criterio->criterio}}  </td>
              <td>  {{$llamada->observaciones}}       </td>
              @if($llamada->agenda == '0000-00-00')
                <td></td>
              @else
                <td>  {{$llamada->agenda}}              </td>
              @endif
              <td>  {{$llamada->user_create->name}}</td>
              <td>  {{$llamada->created_at}}</td>    
            </tr>      
            @endforeach
          </tbody>
        </table>
      </div>         
         <center>
              <a href="javascript:window.history.back();"  class="text-right">
                <button type="button" class="btn btn-primary">Volver</button>
              </a>
          </center>
 
    </div>
  </div>
  </div>
  <div class="col-md-1 col-sm-1"></div>
</div>  
  
<script>
  $(document).ready(function(){
    $('#table_llamadas').DataTable({
      dom: 'Bfrtip',
      order:[[4,"desc"]]
    });

  $('#table_pagos').DataTable({
        dom: 'Bfrtip',
	order:[[3,"desc"]]
      });


  $('#btn_exc_llamadas').click( 
    function(){
      if("{{Auth::user()->rol == 'Administrador'}}"){
        $('#table_llamadas').table2excel({
          name: 'llamadas',
          filename: "historial_llamadas-"+ "{{ $credito->precredito->cliente->num_doc }}"+".xls"
        });
      }
  });
  $('#btn_exc_pagos').click( 
    function(){
      if("{{Auth::user()->rol == 'Administrador'}}"){
        $('#table_pagos').table2excel({
          name: 'pagos',
          filename: "historial_pagos-"+ "{{ $credito->precredito->cliente->num_doc }}"+".xls"
        });
      }
  });
  });

</script>


@endsection
@include('templates.main2')

