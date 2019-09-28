@section('title','ver solicitud')

@section('contenido')

  <div class="col-md-1 col-sm-1"></div>

  <!--Panel Precredito-->
  <div class="col-md-6 col-sm-6 col-xs-12">

    @if($precredito->credito && $precredito->credito->refinanciacion == 'Si')
    <div class="panel panel-info">
    @else
      <div class="panel panel-primary">
    @endif  
        <div class="panel-heading">Solicitud  {{' '.$precredito->cliente->nombre.' ('.$precredito->cliente->num_doc.')'}}
      
          @if($precredito->credito &&
              ($precredito->credito->estado == 'Al dia'     ||
              $precredito->credito->estado == 'Mora'        ||
              $precredito->credito->estado == 'Prejuridico' ||
              $precredito->credito->estado == 'Juridico'))

          <a href="{{route('start.creditos.refinanciar',$precredito->credito->id)}}">
            <button type="button" class="btn btn-warning">Refinanciar</button>
          </a>

          @elseif(!$precredito->credito)
            <div id="crear_credito">
              <a href="#" @click="setMes('{{$precredito->id}}')">
                <button type="button" id="btn_crear_credito" class="btn btn-default btn-xs" data-toggle="tooltip" data-placement="top" 
                    title="Para crear un crédito la solicitud debe haber sido aprobada">
                  Crear Credito
                </button>
              </a>
              <a href="{{route('start.fact_precreditos.create',$precredito->id)}}" class = 'btn btn-default btn-xs'>
                <span class="glyphicon glyphicon-lamp" data-toggle="tooltip" data-placement="top" title="Iniciales y estudios"></span>
              </a>

              <!-- MES REFERENCIA -->
              @include('start.precreditos.fecha_ref_modal')    

            </div>  
          @endif  
        </div>


        @include('flash::message')

        <!-- INFORMACION DE LA SOLICITUD  -->

        @include('start.precreditos.info_tbl')

  </div>

  <!-- CUADRO CON EL RECORDATORIO DEL CREDITO SI ESTE EXISTE -->

  @if($precredito->credito && $precredito->credito->recordatorio)
  <div class="panel panel-default">
    <div class="panel-body">
      <label>Recordatorio Pago</label><br>
      {{ $precredito->credito->recordatorio }}
    </div>
  </div>
  @endif

</div>
 
<!-- Panel Precredito -->

@include('start.precreditos.credito')


<!-- ************ PANEL CREDITO ********************* -->


@if($precredito->credito)

<div class="row">
  <div class="col-md-1 col-sm-1"></div>
  <div class="col-md-10 col-sm-10 col-xs-12">

    <div class="panel panel-default">
      <div class="panel-heading">Pagos</div>
      @include('flash::message')

      <div class="panel-body">

        <table id="datatable" data-order='[[ 0, "desc" ]]' class="table table-striped table-bordered" style="font-size:12px">
          <thead>
            <tr>
              <th>    Id Pago   </th>    
              <th>    # Factura </th>
              <th>    Fecha     </th>
              <th>    Concepto  </th>
              <th>    Abono     </th>
              <th>    Debe      </th>
              <th>    Estado    </th>
              <th>    Desde     </th>
              <th>    Hasta     </th>   
              <th>    Abono Otro Pago </th>   
              <th>    Acción </th>
            </tr>
          </thead>

          <tbody>
            <?php
              $color_A = "<tr style='background-color:#ffffff;'>";
              $color_B = "<tr style='background-color:#D8D8D8;'>";
              $color = $color_A;
              $pagos = $precredito->credito->pagos;

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
                    <td>{$pagos[$i]->factura->num_fact}</td>  
                    <td>{$pagos[$i]->factura->fecha}</td>
                    <td>{$pagos[$i]->concepto}</td>
                    <td align='right'>".number_format($pagos[$i]->abono,0,',','.')."</td>
                    <td align='right'>".number_format($pagos[$i]->debe,0,',','.')."</td>
                    <td>{$pagos[$i]->estado}</td>
                    <td>{$pagos[$i]->pago_desde}</td>
                    <td>{$pagos[$i]->pago_hasta}</td>
                    <td>{$pagos[$i]->abono_pagos_id}</td>
                    <td>
                    
                    <a href=".route('start.facturas.show',$pagos[$i]->factura->id)." 
                    class = 'btn btn-default btn-xs'><span class = 'glyphicon glyphicon-eye-open' 
                    data-toggle='tooltip' data-placement='top' title='Ver'></span></a>                   

                      <button class = 'btn btn-default btn-xs' onclick='print(". $pagos[$i]->factura_id .")'>
                        <span class = 'glyphicon glyphicon-print'  data-toggle='tooltip' data-placement='top' title='Imprimir factura'></span>
                      </button>  
                    </td>
                    </tr>";
              }
            ?>
          </tbody>
        </table>
      </div>  
    </div>
  </div>
  <div class="col-md-1 col-sm-1"></div>
</div>

@endif


<!-- ************ PANEL SOLICITUDES ********************* -->


@if(count($precredito->pagos) > 0)

<div class="row">

  <div class="col-md-10 col-md-offset-1">

    <div class="panel panel-success">
      <div class="panel-heading">Pagos por solicitudes</div>
      @include('flash::message')

      <div class="panel-body" id="element">

        <table class="table table-striped table-bordered" style="font-size:12px">
          <thead>
            <tr>
              <th>    # Fact   </th>    
              <th>    Pago id  </th>
              <th>    Fecha    </th>
              <th>    Concepto </th>
              <th>    Funcionario </th>
              <th>    Sistema   </th>
              <th>    Acción   </th>
            </tr>
          </thead>
            <tbody>
            @foreach($precredito->pagos as $pago)
              <tr>
                <td>{{ $pago->factura->num_fact }}</td>
                <td>{{ $pago->id }}</td>
                <td>{{ $pago->factura->fecha }}</td>
                <td>{{ $pago->concepto->nombre }}</td>
                <td>{{ $pago->user_create->name }}</td>
                <td>{{ $pago->created_at }}</td>
                <td>
                  <a href="{{ route('start.precred_pagos.show', $pago->factura->id) }}"
                    class="btn btn-default btn-xs">
                    <span class="glyphicon glyphicon-eye-open"></span>
                  </a>
                  <a href="#" class='btn btn-default btn-xs' @click="print('{{$pago->factura->id}}')">
		                	<span class = "glyphicon glyphicon-print" title="Imprimir"></span>
		                </a>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>

      </div>  

    </div>
  </div>


@endif        



@include('start.pagos.print_js')
@endsection

@include('templates.main2')

