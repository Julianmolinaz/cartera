    <div class="panel panel-default">
      <div class="panel-heading" style="position:relative;">
        <h3 class="panel-title" >
          <a href="{{route('start.precreditos.ver',$precredito->id)}}"target="_blank">
            Solicitud {{$precredito->id}} <small> {{ '-- Aprobado: ' . $precredito->aprobado}}</small>
          </a>
        <a href="#"
           class = 'btn btn-default btn-xs' data-toggle="tooltip" 
           data-placement="top" title="Ver solicitud"
           style="right:20px; position:absolute;">
           <span class = "glyphicon glyphicon-eye-open" ></span>
        </a>
        </h3>
      </div>
      <div class="panel-body" style="padding: 0px 13px;">
          <table class="table table-condensed">
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
              <td colspan="2">Día de pago: </td>
              <td colspan="2">{{ $precredito->p_fecha.' - '.$precredito->s_fecha}}</td>
            </tr>
            <tr>
              <td colspan="2">Cuota inicial: </td>
              <td colspan="2">{{ ($precredito->inicial) ? $precredito->inicial : 'No' }}</td>
            </tr>              
            <tr>
              <td colspan="2">Estudio: </td>
              <td colspan="2">{{ $precredito->estudio }}</td>
            </tr>
          </table>  
      </div>
    </div>