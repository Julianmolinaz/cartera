
    <div class="panel panel-primary"  >
      <div class="panel-heading">

        <h4 style="margin:0px 4px;">Información de Solicitudes Y Créditos
        &nbsp;&nbsp;
          <span class="glyphicon glyphicon-briefcase" style="margin-bottom:-5px;" aria-hidden="true"></span>
          <a href="{{route('start.precreditosV3.create',$cliente->id)}}">
            <button type="button" class="btn btn-warning pull-right" style="margin-top: -4px;">Crear Solicitud</button>
          </a>
        </h4>
      </div>
      <div class="panel-body">

          <br>

          <table id="datatable" data-order='[[ 2, "desc" ]]' class="table table-striped table-bordered" style="font-size:12px">
            <thead>
              <tr>
                <th>    Cartera         </th>
                <th>    # Crédito       </th>
                <th>    # Solicitud     </th>
                <th><span style="font-size:0.7em;"> Consecutivo Formulario </span></th>
                <th>    Producto        </th>
                <th>    Placa           </th>
                <!-- <th>    Centro de Costo </th>
                <th>    Vlr Cuota       </th>
                <th>    Cuotas          </th> -->
                <th>    Aprobado?       </th>
                <th>    Estado          </th> 
                <th>    Acción          </th>
              </tr>
            </thead>
            <tbody>

                @foreach($precreditos as $precredito)
                <tr>
                <td style="font-weight: bold;font-size: 150%;"> {{$precredito->cartera->nombre}}   </td>

                @if($precredito->credito == NULL)
                  <td></td>
                @else
                  <td style="font-weight: bold;font-size: 150%;">{{$precredito->credito->id}}</td>
                @endif
                
                <td> {{$precredito->id}}   </td>
                <td> {{$precredito->num_fact}}   </td>
                <td> {{ isset($precredito->producto) ? $precredito->producto->nombre : '' }}</td>
                @if($precredito->version == 2)
                    <td>  
                        @foreach($precredito->ref_productos as $ref)
                            [{{ $ref->vehiculo->placa }} <span style="font-size:0.6em;">{{$ref->nombre}}</span>]
                        @endforeach
                    </td>
                @else 
                    <td></td>
                @endif
                <!-- <td align="right"> {{ number_format($precredito->vlr_fin,0,",",".")}}   </td>
                <td align="right"> {{ number_format($precredito->vlr_cuota,0,",",".")}}   </td>
                <td> {{$precredito->cuotas}}   </td> -->
                <td> @if($precredito->aprobado == "Si")
                        <span class = "label label-danger">{{ $precredito->aprobado  }}</span>
                     @else 
                        <span class = "label label-primary">{{ $precredito->aprobado  }}</span>
                     @endif
                </td>

                  @if($precredito->credito)
                    <td>{{ $precredito->credito->estado }}</td>
                  @else
                    <td></td>
                  @endif    


                <td>
                  <a href="{{route('start.precreditos.ver',$precredito->id)}}"
                     class = 'btn btn-default btn-xs'
                     data-toggle="tooltip" 
                     data-placement="top" 
                     title="Ver">
                    <span class = "glyphicon glyphicon-eye-open"></span>
                  </a>
                  <a href="{{route('start.fact_precreditos.create',$precredito->id)}}"
                     class = 'btn btn-default btn-xs'
                     data-toggle="tooltip" 
                     data-placement="top" 
                     title="Pagar valores iniciales">
                    <span class = "glyphicon glyphicon-lamp"></span>
                  </a>
                  @if($precredito->credito != NULL && 
                      $precredito->credito->estado != 'Cancelado' &&
                      $precredito->credito->estado != 'Cancelado por refinanciacion')
                    <a href="{{route('start.facturas.create',$precredito->credito->id)}}"
                       class = 'btn btn-default btn-xs'
                       data-toggle="tooltip" 
                       data-placement="top" 
                       title="Pagar">
                      <span class = "glyphicon glyphicon-usd"></span>
                    </a>
                  @endif

    <!--               <a href="{{route('start.precreditos.edit',$precredito->id)}}"
                  class = 'btn btn-default btn-xs'><span class = "glyphicon glyphicon-pencil"></span></a> -->

                   @if(!$precredito->credito)    
                      <a href="{{route('start.precreditos.edit',$precredito->id)}}"
                         class = 'btn btn-default btn-xs' 
                         data-toggle="tooltip" 
                         data-placement="top" 
                         title="Editar" > 
                          <span class = "glyphicon glyphicon-pencil"></span>
                      </a>

                  @elseif($precredito->credito->estado <> 'Cancelado por refinanciacion')
                  <a href="{{route('start.creditos.edit',$precredito->credito->id)}}"
                     class = 'btn btn-default btn-xs'
                     data-toggle="tooltip" 
                     data-placement="top" 
                     title="Editar">
                    <span class = "glyphicon glyphicon-pencil"></span>
                  </a>

                    <a href="{{route('call.index_unique',$precredito->credito->id)}}"
                       class = 'btn btn-default btn-xs'
                       data-toggle="tooltip" 
                       data-placement="top" 
                       title="Llamar">
                      <span class = "glyphicon glyphicon-phone-alt"></span>
                    </a>

                  @endif 

                  
                </td>
              </tr>

              @endforeach
            </tbody>
          </table>

          <center>
            <a href="javascript:window.history.back();">
              <button type="button" class="btn btn-primary  ">&nbsp;&nbsp;&nbsp;&nbsp;Volver&nbsp;&nbsp;&nbsp;&nbsp;</button>
            </a>
          </center>
          <br>
      </div>
    </div>