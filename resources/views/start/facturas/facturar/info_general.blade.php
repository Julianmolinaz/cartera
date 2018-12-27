    <div class="panel panel-primary">
      <div class="panel-heading" style="position:relative;">
        <h3 class="panel-title" >
          <a href="{{route('start.precreditos.ver',$credito->precredito->id)}}"target="_blank">
            Crédito {{$credito->id}}
          </a>
        </h3>

        <small>{{' Fecha de Aprobación: '.$credito->precredito->fecha.' Cuotas : '.number_format($credito->precredito->vlr_cuota,0,",",".").' * '.$credito->precredito->cuotas.' ['.$credito->estado.']'}}</small>
        <a href="{{route('start.precreditos.ver',$credito->precredito->id)}}"
           class = 'btn btn-default btn-xs' data-toggle="tooltip" 
           data-placement="top" title="Ver crédito"
           style="right:20px; position:absolute;"
           target="_blank">
           <span class = "glyphicon glyphicon-eye-open" ></span>
        </a>
      </div>
      <div class="panel-body" style="padding: 0px 13px;">
        <table class="table table-condensed">

          <tr>
            <td colspan="2">Cliente</td>
            <td colspan="2" style="font-size:0.8em;">
              <a href="{{route('start.clientes.show',$credito->precredito->cliente->id)}}" target="_blank">{{ $credito->precredito->cliente->nombre}}</a>
            </td>
          </tr>
          <tr>
            <td colspan="2">Documento</td>
            <td colspan="2">{{ $credito->precredito->cliente->num_doc}}</td>

          </tr>
          <tr>
            <td colspan="2">Día de pago: </td>
            <td colspan="2">{{ $credito->precredito->p_fecha.' - '.$credito->precredito->s_fecha}}</td>
          </tr>
            
              <tr class="danger">
                <td colspan="2"><i>Pago hasta:</i></td>
                <td colspan="2"><i>{{$credito->fecha_pago->fecha_pago}}</i></td>
              </tr>
           
          <tr>
            <td colspan="2">Cuotas Faltantes</td>
            <td colspan="2">{{ $credito->cuotas_faltantes.' de '.$credito->precredito->cuotas.' cuotas ,'}}</td>
          </tr>
          <tr>
            <td colspan="2">Saldo de deuda</td>
            <td colspan="2">{{ number_format($credito->saldo,0,",",".")}}</td>
          </tr>
          <tr>
            <td colspan="2">Saldo a Favor</td>
            <td colspan="2">{{ number_format($credito->saldo_favor,0,",",".")}}</td>
          </tr>
          <tr>
            <td colspan="2">Jurídico: </td>
            <td colspan="2">{{number_format($pago_juridico['juridico'],0,",",".").' de '.number_format($pago_juridico['valor'],0,",",".")}}</td>
          </tr>
          <tr>
            <td colspan="2">Prejurídico: </td>
            <td colspan="2">{{number_format($pago_prejuridico['prejuridico'],0,",",".").' de '. number_format($pago_prejuridico['valor'],0,",",".")}}</td>
          </tr>
          <tr>
            <td colspan="2">Debe de cuotas parciales:</td>
            <td colspan="2">{{number_format($total_parciales,0,",",".")}}</td>
          </tr>  
          <tr>
            <td colspan="2">Sanciones:</td>
            <td colspan="2" style="position:relative;">{{number_format($sum_sanciones,0,",",".") }} 
                <select class="form-control input-sm" style="width:65%; position:absolute; top:0px; left:33%;">
                    <?php
                    
                      $debe = 0;
                      $exoneradas = 0;
                      $pagadas = 0;
                      
                      foreach($credito->sanciones as $sancion){
                        if($sancion->estado == 'Debe'){  $debe++;}
                        else if($sancion->estado == 'Exonerada'){  $exoneradas++; }
                        else if($sancion->estado == 'Ok'){  $pagadas++; }
                      }
                      echo  "<option> Debe: ".$debe."</option>".
                            "<option> Pagadas: ".$pagadas."</option>".
                            "<option>Exoneradas: ".$exoneradas."</option>";

                  ?>
                </select>
          </td>
          </tr>

          <tr>
            <td colspan="2">Total pagos: </td>
            <td colspan="2">{{number_format($total_pagos,0,",",".")}}</td>
          </tr>


       </table>

      </div>
    </div>