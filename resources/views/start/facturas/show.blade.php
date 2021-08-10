@section('title','ver factura')

@section('contenido')

<div class="row">
    <div class="col-md-1 col-sm-1"></div>

    <!--Panel Precredito-->
    <div class="col-md-10 col-sm-10 col-xs-12">

        <div class="panel panel-default">
            <div class="panel-heading" >{{ $factura->descuento == true ? 'Comprobante Descuento' : 'Recibo de Pago'}}</div>
            @include('flash::message')

            <div class="panel-body">

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>    #           </th>
                        <th>    Cliente     </th>
                        <th>    Crédito id  </th>
                        <th>    # Recibo    </th>
                        <th>    Fecha       </th>
                        <th>    Total       </th>
                        <th>    Tipo de pago</th>
                        <th>    Banco       </th>
                        <th>    Creó        </th>
                        <th style="display:none;">Actualizacion  </th>
                        <th>    Actividad    </th>

                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td> {{ $factura->id }}    </td>
                        <td> {{ ($factura->credito) ? $factura->credito->precredito->cliente->nombre : ''}} </td>
                        <td> {{ ($factura->credito) ? $factura->credito_id : ''}} </td>
                        <td> {{ $factura->num_fact }}</td>
                        <td> {{ $factura->fecha }}</td>
                        <td> {{ number_format($factura->total,0,",",".") }}</td>
                        <td> {{ $factura->tipo }}</td>
                        <td> {{ $factura->banco }}</td>
                        <td> {{ $factura->user_create->name.' '.$factura->created_at }} </td>
                        <td style="display:none;"> {{$factura->updated_at}}</td>
                        <td>
                            @permission('anular_pago_credito')
                                <a href="#" class = 'btn btn-default btn-xs' title="anular factura" 
                                    OnClick="Anular({{$factura->id}},'{{$factura->num_fact}}');" data-toggle="modal" data-target="#modal">
                                    <span class = "glyphicon glyphicon-fire"  ></span>
                                </a>
                            @endpermission
                            @if($factura->credito)
                                <a href="{{route('start.precreditos.ver',$factura->credito->precredito->id)}}" class = 'btn btn-default btn-xs'>
                                    <span class="glyphicon glyphicon-sunglasses"  data-toggle="tooltip" data-placement="top" title="Ver Crédito"></span>
                                </a>
                                <a 
                                    href="#" 
                                    class='btn btn-default btn-xs' 
                                    onclick="print('{{$factura->id}}', 'credito')" 
                                    title="Imprimir"
                                >
                                    <span class="glyphicon glyphicon-print" ></span>
                                </a>                
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>

        <a href="javascript:window.history.back();">
            <button class="btn btn-default" id="btn_volver" style="margin-right: 5px; ">
                <i class="glyphicon glyphicon-arrow-left"></i>&nbsp;&nbsp;Volver&nbsp;&nbsp;
            </button>
        </a>


    </div>
  </div>
</div>
<div class="col-md-1 col-sm-1"></div>
</div>

@include('start.pagos.print_js')






<div class="row">
  <div class="col-md-1 col-sm-1"></div>

  <!--Panel Precredito-->
  <div class="col-md-10 col-sm-10 col-xs-12">

    <div class="panel panel-default">
      <div class="panel-heading">Conceptos</div>
      @include('flash::message')


      <div class="panel-body">

          @if(isset($factura->pagos[0]))

            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>   id         </th>
                  <th>   Crédito    </th>
                  <th>   Concepto   </th>
                  <th>   Abono      </th>
                  <th>   Debe       </th>
                  <th>   Estado     </th>
                  <th>   Pago desde </th>
                  <th>   Pago hasta </th>
                </tr>
              </thead>

              <tbody>

              @foreach( $factura->pagos as $pago)
              <tr>
                <td> {{ $pago->id}}</td>
                <td> {{ $factura->credito_id}} </td>
                <td> {{ $pago->concepto }}     </td>
                <td align="right"> {{ number_format($pago->abono,0,",",".") }}  </td>
                <td align="right"> {{ number_format($pago->debe,0,",",".")  }}  </td>
                <td> {{ $pago->estado}}        </td>
                <td> {{ $pago->pago_desde}}    </td>
                <td> {{ $pago->pago_hasta}}    </td>
              </tr>
              @endforeach

            @elseif(isset($factura->otro_pago[0]))

              <table class="table table-bordered">
              <thead>
                <tr>
                  <th>   id             </th>
                  <th>   Cartera        </th>
                  <th>   Concepto       </th>
                  <th>   Valor unitario </th>
                  <th>   Cantidad       </th>
                  <th>   subtotal       </th>
                </tr>
              </thead>

              <tbody>
              @foreach( $factura->otro_pago as $pago )
              <tr>
                <td> {{ $pago->id }} </td>
                <td> {{ $pago->cartera->nombre }}</td> 
                <td> {{ $pago->concepto }}</td>
                <td> {{ $pago->valor_unitario }}</td>
                <td> {{ $pago->cantidad }}</td>
                <td> {{ $pago->subtotal }}</td>
                
              </tr>
              @endforeach
              @else
              <table class="table table-bordered">
              <thead>
                <tr>
                  <th>    id        </th>
                  <th>    Crédito   </th>
                  <th>    Concepto  </th>
                  <th>    Abono     </th>
                  <th>    Debe      </th>
                  <th>    Estado    </th>
                  <th>   Pago desde </th>
                  <th>   Pago hasta </th>
                  @if( isset($factura->pago[0]) )
                    <th>    Actividad    </th>
                  @endif
                </tr>
              </thead>

              <tbody>
              </tbody>

            @endif

          </tbody>
        </table>

        @include('start.facturas.anularFacturaModal')

       <a href="javascript:window.history.back();">
        <button class="btn btn-default" id="btn_volver" style="margin-right: 5px; ">
        <i class="glyphicon glyphicon-arrow-left"></i>&nbsp;&nbsp;Volver&nbsp;&nbsp;
        </button>
      </a>

      </div>
    </div>
  </div>

  <div class="col-md-1 col-sm-1"></div>

</div>

<script>
  var Anular = 
  function(factura_id, num_factura){ 
    $('#factura_id').val(factura_id);
    $('#num_fact').val(num_factura);
    $('#titulo').text('Escriba el motivo por el que va a  anular la factura '+num_factura);   
    $('#motivo_anulacion').val("");
    }
</script>
@endsection

@include('templates.main2')
