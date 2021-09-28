    <div class="panel panel-primary">
      <div class="panel-heading" style="position:relative;">

          <h3 class="panel-title" style="display:inline;">
            <span>
              Solicitud {{$precredito->id}} <small style="color:white"> {{ '-- Aprobado: ' . $precredito->aprobado}}</small>
            </span>

          </h3>
          <a href="{{route('start.precreditos.ver',$precredito->id)}}" target="_blank"
             class='btn btn-default btn-xs' data-toggle="tooltip" 
             data-placement="top" title="Ver solicitud"
             style="right:20px; position:absolute;">
             <span class="glyphicon glyphicon-eye-open"></span>
          </a>
      </div>
      <div class="panel-body" style="padding: 0px 13px;">
          <table class="table table-condensed" style="font-size:11px;">
            <tr>
              <td colspan="2">Cliente</td>
              <td colspan="2" style="font-size:0.8em;">
                <a href="{{route('start.clientes.show',$precredito->cliente->id)}}" target="_blank">{{ $precredito->cliente->nombre}}</a>
              </td>
            </tr>

            <tr>
              <td colspan="2">Documento</td>
              <td colspan="2">{{ $precredito->cliente->num_doc}}</td>

            </tr>
            <tr>
              <td colspan="2">Fecha de solicitud</td>
              <td colspan="2">{{ $precredito->fecha }}</td>
            </tr>
            <tr>
              <td colspan="2">Cuota inicial: </td>
              <td colspan="2">{{ ($precredito->cuota_inicial > 0) ? $precredito->cuota_inicial : 'No' }}</td>
            </tr>              
            <tr>
              <td colspan="2">Estudio: </td>
              <td colspan="2">{{ $precredito->estudio }}</td>
            </tr>
            <tr>
              <td colspan="2">Costo del crédito:</td>
              <td colspan="2">{{ $precredito->vlr_fin }}</td>
            </tr>
            <tr>
              <td colspan="2">Valor de la cuota</td>
              <td colspan="2">{{ $precredito->vlr_cuota }}</td>
            </tr>
            <tr>
              <td colspan="2">Día de pago: </td>
              <td colspan="2">{{ $precredito->p_fecha.' - '.$precredito->s_fecha}}</td>
            </tr>
            <tr>
              <td colspan="2">Creó</td>
              <td colspan="2"><small>{{ $precredito->user_create->name }}<small></td>
            </tr>
            <tr>
              <td colspan="2">F. creación</td>
              <td colspan="2">{{ $precredito->created_at }}</td>
            </tr>
            <tr>
              <td colspan="2">Sucursal</td>
              <td colspan="2">{{ $precredito->user_create->punto->nombre }}</td>
            </tr>
            <tr>
              <td colspan="2">Observaciones</td>
              <td colspan="2">{{ $precredito->observaciones }}</td>
            </tr>
          </table>  
      </div>
    </div>

