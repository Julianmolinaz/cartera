@section('title','callcenter cliente')

@section('contenido')
<!-- Panel Cliente-->
<div class="row">

  <div class="col-md-1 col-sm-1"></div>
  <div class="col-md-10 col-sm-10 col-xs-12">
  <div class="panel panel-default">
    <div class="panel-heading" style="color:#dd4437;">Cliente</div>
    <div class="panel-body">

      <table class="table table-bordered" style="font-size:12px">

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

              <div class="col-md-6">
              <h2>Reglas del negocio</h2>
              <ul>
                <li>Credito id: {{$credito->id}}</li>
                <li>Cartera: {{$credito->precredito->cartera->nombre}}</li>
                <li>Aprobado: {{$credito->precredito->fecha}}</li>
                <li>Producto: {{$credito->precredito->producto->nombre}}</li>
                <li>Centro de costos: {{number_format($credito->precredito->vlr_fin,0,",",".")}}</li>
                <li>Número de cuotas: {{$credito->precredito->cuotas}}</li>
                <li>Periodo: {{$credito->precredito->periodo}}</li>
                <li>Valor cuota: {{number_format($credito->precredito->vlr_cuota,0,",",".")}}</li>
                <li>Primera fecha: {{$credito->precredito->p_fecha}}</li>
                <li>Segunda fecha: {{$credito->precredito->s_fecha}}</li>
              </ul>

              </div>
              <div class="col-md-6">
              <h2>Estado de la obligación</h2>
              <ul>
                <li>Estado: {{$credito->estado}}</li>
                <li>Castigada: {{$credito->castigada}}</li>
                <li>Cuotas Faltantes: {{$credito->cuotas_faltantes}}</li>
                <li>Saldo Deuda: {{$credito->saldo}}</li>
                <li>Saldo a Favor: {{$credito->saldo_favor}}</li>
                <li>Valor total crédito: {{$credito->valor_credito}}</li>
                <li>Observaciones:<br/>{{$credito->precredito->observaciones}}</li>
                <li>Recordatorio pago:<br/>{{$credito->recordatorio}}</li>
              </ul>
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
    <div class="panel-heading" style="color:#dd4437;">Pagos</div>
    <div class="panel-body">

      <table class="table table-bordered" style="font-size:12px">
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
            <td>{{$pago->factura->num_fact}}</td>
            <td>{{$pago->factura->fecha}}</td>
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
  <div class="col-md-1 col-sm-1"></div>
</div>
<!-- Panel Llamadas-->
<div class="row">
  <div class="col-md-1 col-sm-1"></div>
  <div class="col-md-10 col-sm-10 col-xs-12">
  <div class="panel panel-default">
    <div class="panel-heading" style="color:#dd4437;">Llamadas  </div>
    <div class="panel-body">

        <table class="table table-bordered" style="font-size:12px">
          <thead>
            <tr>
              <th>  Criterio      </th>
              <th>  Observaciones </th>
              <th>  Agenda        </th>
              <th>  Creó          </th>
          
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
              <td>  {{$llamada->user_create->name.' '.$llamada->created_at}}</td>    
            </tr>      
            @endforeach
          </tbody>
        </table>

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
  


@endsection
@include('templates.main2')

