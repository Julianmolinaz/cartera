@section('title','crear factura')

@section('contenido')


<div class="row">
  <div class="col-sm-1"></div>
  <div class="col-sm-6">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <!--panel generador de pagos-->
<!--**********************************************************************-->
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">Generador de pagos</h3>
          </div>
          <div class="panel-body">

            <!--formulario con los campos necesarios para crear pagos y agregarlos a una tabla-->

            <form class="form-horizontal form-label-left" action="" method="POST">

              <div class="form-group">
               <!-- num_factura *****-->
                <div class="col-md-2 col-sm-2 col-xs-12">
                  <label># Factura:</label>
                  <input class="form-control input-sm" type="number" id="num_factura" placeholder="#">
                </div>

                 <!-- fecha_factura *****-->
                <div class="col-md-3 col-sm-3 col-xs-12">
                      <label>Fecha:</label>
                        <input type="text" class="form-control input-sm" data-inputmask="'mask': '99-99-9999'" placeholder="dd-mm-aaaa" id="fecha_factura">
                      </div>

               <!-- monto *****-->
                <div class="col-md-2 col-sm-2 col-xs-12" id="div_monto">
                  <label for="">Monto:</label>
                  <input type="number" class="form-control input-sm" placeholder="$" name="monto" id="monto">
                </div>

                <div class="col-md-3 col-sm-3 col-xs-12">
                  <label for="">Tipo de Pago</label>
                  <select class="form-control input-sm" id="tipo">
                    <option value="" readonly selected hidden="">- -</option>
                    @foreach($tipo_pago as $tipo)
                      <option value="{{$tipo}}">{{$tipo}}</option>
                    @endforeach
                  </select>
                </div>

                <!-- BOTON AGREGAR -->
                <div class="col-md-2 col-sm-2 col-xs-12"><br/>
                {!! link_to('#',$title='Agregar',$attributes =  ['id'=>'agregar','class'=>'btn btn-primary'],$secure = null) !!}

                </div>
              </div>
              <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            </form>

            <!--Fin del formulario creador de pagos-->

          </div><!--fin del panel-body-->
        </div><!-- fin de panel panel-default-->
        <!--end panel generador de pagos-->
      </div>
<!--**********************************************************************-->
      <div class="col-md-12 col-sm-12 col-xs-12">
        <!--panel resumen de pagos-->


        <div class="panel panel-primary">
          <!-- Default panel contents -->
          <div class="panel-heading">
            <h3 class="panel-title">Listado de los pagos</h3>
          </div>
          <div class="panel-body">
            <table id="tabla" class="table table-striped" >
                  <thead>
                    <tr>
                      <th>  Cant        </th>
                      <th>  Concepto    </th>
                      <th>  Pago desde  </th>
                      <th>  Pago hasta  </th>
                      <th>  Subtotal    </th>
                    </tr>
                  </thead>
                  <tbody>
                   <td></td>
                   <td></td>
                   <td></td>
                   <td style="color:#ff0000"><strong>Total:</strong></td>
                   <td id="total" style="color:#ff0000"></td>
                 </tbody>
               </table>

               <!-- BOTON ACEPTAR -->
               <center>
                <div class="col-md-12 col-sm-12 col-xs-12"><br>

                {!! link_to('start/pagos/inicio',$title='Salir',$attributes =  ['id'=>'salir','class'=>'btn btn-warning '],$secure = null) !!}
                {!! link_to('#',$title='Borrar',$attributes =  ['id'=>'borrar','class'=>'btn btn-danger '],$secure = null) !!}
                {!! link_to('#',$title='Aceptar',$attributes =  ['id'=>'aceptar','class'=>'btn btn-primary '],$secure = null) !!}
                </div>
               </center>

          </div>

        </div>


        <!--end panel resumen de pagos-->
      </div>
    </div>
  </div>
  <div class="col-md-4 col-sm-4 col-xs-12">
    <!--panel información de los pagos-->


    <div class="panel panel-default">
      <div class="panel-heading" style="position:relative;">
        <h3 class="panel-title">
          <a href="{{route('start.precreditos.ver',$credito->precredito->id)}}"target="_blank">
            Crédito {{$credito->id}}
          </a>
        </h3>

        <small>{{' Fecha de Aprobación: '.$credito->precredito->fecha.' Cuotas : '.number_format($credito->precredito->vlr_cuota,0,",",".").' * '.$credito->precredito->cuotas.' ['.$credito->estado.']'}}</small>
        <a href="{{route('start.precreditos.ver',$credito->precredito->id)}}"
           class = 'btn btn-default btn-xs' data-toggle="tooltip" 
           data-placement="top" title="Ver crédito"
           style="right:20px; position:absolute;">
           <span class = "glyphicon glyphicon-eye-open" ></span>
        </a>
      </div>
      <div class="panel-body">
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
            <td colspan="2">{{number_format($pago_juridico['juridico'].$pago_juridico['valor'],0,",",".")}}</td>
          </tr>
          <tr>
            <td colspan="2">Prejurídico: </td>
            <td colspan="2">{{number_format($pago_prejuridico['prejuridico'].$pago_prejuridico['valor'],0,",",".")}}</td>
          </tr>
          <tr>
            <td colspan="2">Sanciones:          </td>
            <td colspan="2">{{number_format($sum_sanciones,0,",",".") }} </td>
          </tr>

          <tr>
            <td colspan="2">Debe en pagos parciales: </td>
            <td colspan="2">{{number_format($total_parciales,0,",",".")}}</td>
          </tr>

          <tr>
            <td colspan="2">Total pagos: </td>
            <td colspan="2">{{number_format($total_pagos,0,",",".")}}</td>
          </tr>


       </table>

      </div>
    </div>

    <!--end panel información de los pagos-->
  </div>
  <div class="col-sm-1"></div>

  <form class="form-horizontal form-label-left">
    <input type="hidden" name="_token" id="token" value="{{csrf_token()}}">
    <input type="hidden" name="datos" id="datos" value="">
  </form>

</div>

<div class="row">
  <div class="col-md-1"></div>
  <div class="col-md-10 col-sm-10 col-xs-12">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">Pagos</h3>
      </div>
      <div class="panel-body">

        <table id="datatable" data-order='[[ 0, "desc" ]]' class="table table-striped table-bordered" style="font-size:10px">
          <thead>
            <tr>
              <th>    Id Pago         </th>
              <th>    Id Fact.        </th>
              <th>    # Factura       </th>
              <th>    Fecha           </th>
              <th>    Concepto        </th>
              <th>    Abono           </th>
              <th>    Debe            </th>
              <th>    Estado          </th>
              <th>    Pago Desde      </th>
              <th>    Pago Hasta      </th>
              <th>    Abono Otro Pago </th>
              <th>    Creó      </th>
            </tr>
          </thead>
          <tbody>
          <?php
            $color_A = "<tr style='background-color:#ffffff;'>";
            $color_B = "<tr style='background-color:#D8D8D8;'>";
            $color = $color_A;
            for( $i = 0; $i < count($pagos); $i++){  
              
              if( $i > 0 && $pagos[$i]->factura->num_fact != $pagos[$i-1]->factura->num_fact){
                if( $color == $color_A){
                  $color = $color_B;
                }
                else{
                  $color = $color_A;
                }
              }

              echo $color.
                  "<td>{$pagos[$i]->id}</td>
                  <td>{$pagos[$i]->factura->id}</td>
                  <td>{$pagos[$i]->factura->num_fact}</td>
                  <td>{$pagos[$i]->factura->fecha}</td>
                  <td>{$pagos[$i]->concepto}</td>
                  <td align='right'>".number_format($pagos[$i]->abono,0,',','.')."</td>
                  <td align='right'>".number_format($pagos[$i]->debe,0,',','.')."</td>
                  <td>{$pagos[$i]->estado}</td>
                  <td>{$pagos[$i]->pago_desde}</td>
                  <td>{$pagos[$i]->pago_hasta}</td>
                  <td>{$pagos[$i]->abono_pagos_id}</td>
                  <td>".$pagos[$i]->factura->user_create->name." (".$pagos[$i]->created_at.")</td>
                  </tr>";

            }
          ?>
          </tbody>
        </table>

      </div>
    </div>
  </div>
</div>

@include('mis_js.factura_create_js')


@endsection
@include('templates.main2')
