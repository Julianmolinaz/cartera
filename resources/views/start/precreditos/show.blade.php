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
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      
      @if($precredito->credito &&
          ($precredito->credito->estado == 'Al dia'     ||
          $precredito->credito->estado == 'Mora'        ||
          $precredito->credito->estado == 'Prejuridico' ||
          $precredito->credito->estado == 'Juridico')
      ) 
       
        <a href="{{route('start.creditos.refinanciar',$precredito->credito->id)}}">
          <button type="button" class="btn btn-warning">
            Refinanciar
          </button>
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
            <span class = "glyphicon glyphicon-lamp" data-toggle="tooltip" data-placement="top" title="Iniciales y estudios"></span>
          </a>

        <div class="modal fade" tabindex="-1" role="dialog" id="mes">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-body">
                <div class="form-group">
                  <label for="exampleInputPassword1">Password</label>
                  <select class="form-control" v-model="mes">
                    <option selected disabled>--</option>
                    <option :value="mes" v-for="mes in 
                      ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre']">
                        @{{ mes }}
                      </option>
                  </select>
                  <p class="help-block">Digite el mes al que corresponde el crédito.</p>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" @click="crearCredito()">Crear Crédito</button>
              </div>
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->          


        </div>  
      @endif  
      </div>


      @include('flash::message')

        <table class="table" style="font-size:12px">

          <tr>
            <td style="font-weight: bold;font-size: 150%;"> {{$precredito->cartera->nombre}}</td>
            <td>{{'#   '.$precredito->id}}</td>
            <th scope="row"># Factura</th>
            <td>{{$precredito->num_fact}}</td>
          </tr>

          <tr>
            <th scope="row">Fecha solicitud</th>
            <td> {{$precredito->fecha}}</td>
            <th scope="row">Funcionario gestion</th>
            <td> {{$precredito->funcionario->name}}</td>
          </tr>
          <tr>
            <th scope="row">Aprobado</th>
            <td> 

              @if($precredito->aprobado == "Si")
              <span class = "label label-danger">{{ $precredito->aprobado  }}</span>
              @else
              <span class = "label label-primary">{{ $precredito->aprobado  }}</span>
              @endif  
            </td>
            <th scope="row">Producto</th>
            <td> {{$precredito->producto->nombre}}</td>
          </tr>
          <tr style="color: rgba(84,35,39,1.81);" class="warning" >
            <th scope="row">Centro de Costo</th>
            <td> {{'$ '.  number_format($precredito->vlr_fin,0,",",".")}}</td>
            <th scope="row">Valor Cuota</th>
            <td> {{'$ '.number_format($precredito->vlr_cuota,0,",",".")}}</td>
          </tr>
          <tr>
            <th scope="row">Cuotas</th>
            <td> {{$precredito->cuotas}}</td>
            <th scope="row">Periodo</th>
            <td> {{$precredito->periodo}}</td>
          </tr> 
          <tr>
            <th scope="row">fecha 1</th>
            <td> {{$precredito->p_fecha}}</td>
            <th scope="row">fecha 2</th>
            <td> {{$precredito->s_fecha}}</td>
          </tr>
          <tr>
            <th scope="row">Estudio</th>
            <td>{{$precredito->estudio}} </td>
            <th scope="row">Cuota inicial</th>
            <td>{{'$ '.number_format($precredito->cuota_inicial,0,",",".")}} </td>
          </tr>
          <tr>
            <th scope="row">Calificación cliente</th>
            <td> {{$precredito->cliente->calificacion}}</td>
            <th scope="row"></th>
            <td></td>
          </tr>
          <tr>
            <th scope="row">Registró</th>
            <td> {{$precredito->user_create->name}}</td>
            <th scope="row">Fecha</th>
            <td> {{$precredito->created_at}}</td>
          </tr>
          <tr>
            <th scope="row">Actualizó</th>
            <td> {{$precredito->user_update->name}}</td>
            <th scope="row">Fecha</th>
            <td> {{$precredito->updated_at}}</td>
          </tr>
          <tr>
            <th scope="row">Observaciones</th>
            <td colspan="3"> {{$precredito->observaciones}}</td>
          </tr>

        </table>
        <br>
        <center>
          <a href="javascript:window.history.back();">
            <button type="button" class="btn btn-primary">Volver</button></a>

            <a href="{{route('start.clientes.show',$precredito->cliente_id)}}" class = 'btn btn-primary' title="Cliente">
             <span class = "glyphicon glyphicon-user" data-toggle="tooltip" data-placement="top" title="Ver cliente" ></span></a> 

             @if(!$precredito->credito)    
             <a href="{{route('start.precreditos.edit',$precredito->id)}}">
              <button type="button" class="btn btn-danger">Editar</button></a>
              @else
              <a href="{{route('start.creditos.edit',$precredito->credito->id)}}">
                <button type="button" class="btn btn-danger">Editar</button></a>
                @endif  
        </center>
        <br>
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

@if($precredito->credito)   
<!--***************************************-->
<div class="col-md-4 col-sm-4 col-xs-12">
@if($precredito->credito->refinanciacion == 'No')
  <div class="panel panel-primary">
@else
  <div class="panel panel-info">
@endif  
    <div class="panel-heading" style="font-weight: bold;font-size: 150%;">Crédito{{' # '.$precredito->credito->id}}
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      
      @if($precredito->credito->estado == 'Al dia'  ||
          $precredito->credito->estado == 'Mora'    ||
          $precredito->credito->estado == 'Prejuridico' ||
          $precredito->credito->estado == 'Juridico'
      ) 
             
      <a href="{{route('start.facturas.create',$precredito->credito->id)}}" class = 'btn btn-default btn-xs'
      data-toggle="tooltip" data-placement="top" title="Hacer Pago">
      <span class = "glyphicon glyphicon-usd"></span></a>

      <a href="{{route('start.clientes.show',$precredito->cliente->id)}}" 
            class = 'btn btn-default btn-xs' 
            data-toggle="tooltip" data-placement="top" title="Ver Cliente"><span class = "glyphicon glyphicon-user" ></span></a>

      <a href="{{route('admin.sanciones.show',$precredito->credito->id)}}" 
          class = 'btn btn-default btn-xs' 
          data-toggle="tooltip" data-placement="top" title="Sanciones diarias"><span class = "glyphicon glyphicon-record" ></span></a>

      <a href="{{route('admin.multas.show',$precredito->credito->id)}}" 
          class = 'btn btn-default btn-xs' 
          data-toggle="tooltip" data-placement="top" title="Multas prejuridicas y juridicas"><span class = "glyphicon glyphicon-hourglass" ></span></a>

      <a href="{{route('call.index_unique',$precredito->credito->id)}}"
         class = 'btn btn-default btn-xs'
         data-toggle="tooltip" 
         data-placement="top" 
         title="Llamar">
        <span class = "glyphicon glyphicon-phone-alt"></span>
      </a>
      @if(Auth::user()->rol == 'Administrador')
      <a href="{{route('admin.get_estado_cuenta',$precredito->credito->id)}}"
         class = 'btn btn-default btn-xs'
         data-toggle="tooltip" 
         data-placement="top" 
         title="Estado de cuenta">
        <span><i class="fab fa-laravel"></i></span>
      </a>
      @endif
      @endif    
    </div>
    @include('flash::message')

      <table class="table" style="font-size:12px">
        <tr>  
          <th scope="row">Estado </th>
          <td> {{$precredito->credito->estado}}</td>
        </tr>
        @if($precredito->credito->mes)
        <tr>  
          <th scope="row">Mes de referencia </th>
          <td> <span class="label label-primary">{{$precredito->credito->mes}}</span></td>
        </tr> 
        @endif       
        <tr>  
          <th scope="row">Fecha de aprobacion </th>
          <td> {{$precredito->credito->created_at}}</td>
        </tr>
        <tr>  
          <th scope="row">Fecha límite de pago </th>
          <td style="color:red;"> {{$precredito->credito->fecha_pago->fecha_pago}}</td>
        </tr>        
        <tr>  
          <th scope="row">Valor Total Crédito </th>
          <td> {{'$ '.number_format($precredito->credito->valor_credito,0,",",".")}}</td>
        </tr>
        <tr>  
        <th scope="row">Saldo Deuda </th>
          <td> {{'$ '.number_format($precredito->credito->saldo,0,",",".")}}</td>
        </tr>  
        <tr>  
          <th scope="row">Rendimiento </th>
          <td> {{'$ '.number_format($precredito->credito->rendimiento,0,",",".")}}</td>
        </tr>
        <tr>
          <th scope="row">Cuotas Faltantes</th>
          <td> {{$precredito->credito->cuotas_faltantes.' de '.$precredito->cuotas}}</td>
        </tr>
        <tr>
          <th scope="row">Refinanciación</th>
          <td> {{ $precredito->credito->refinanciacion }} </td>
        </tr>
        <tr>
          <th scope="row">Crédito padre</th>
          @if($precredito->credito->refinanciacion == 'Si')
            <td> 
              <a href="{{route('start.precreditos.ver',$precredito->credito->refinanciado->precredito->id)}}" 
              class="btn btn-info btn-xs">
                {{ $precredito->credito->credito_refinanciado_id }} 
              </a>  
            </td>  
          @else
            <td> </td>
          @endif  
        </tr>
        <tr>
          <th scope="row">Crédito hijo</th>
            @if($hijo)
            <td> 
              <a href="{{route('start.precreditos.ver',$hijo->precredito_id)}}" 
              class="btn btn-info btn-xs">
                {{ $hijo->id }} 
              </a>  
            </td>  
          @else
            <td> </td>
          @endif  
        </tr>
        <tr class="danger">  
          <th scope="row">Saldo a Favor </th>
          <td> {{'$ '.number_format($precredito->credito->saldo_favor,0,",",".")}}</td>
        </tr>
        <tr class="danger">  
          <th scope="row">Juridico </th>
          <td> {{'$ '.number_format($juridico['juridico'],0,",",".").' de '.number_format($juridico['valor'],0,",",".")}}</td>
        </tr>
        <tr class="danger">  
          <th scope="row">Prejuridico </th>
          <td> {{'$ '.number_format((int)$prejuridico['prejuridico'],0,",",".").' de '.$prejuridico['valor']}}</td>
        </tr>  
        <tr class="danger">  
          <th scope="row">Sanciones diarias</th>
          <td style="position:relative;"> {{'$ '.number_format($sanciones,0,",",".")}}
                <select class="form-control input-sm" style="width:40%; position:absolute; top:1px; left:50%;">
                    <?php
                    
                      $debe = 0;
                      $exoneradas = 0;
                      $pagadas = 0;
                      
                      foreach($precredito->credito->sanciones as $sancion){
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
        <tr class="danger">  
          <th scope="row">Debe de pagos parciales</th>
          <td> {{'$ '.number_format($parciales,0,",",".")}}</td>
        </tr> 
        <tr>
          <th scope="row">Total pagos:</th>
          <td>{{'$ '.number_format($total_pagos,0,",",".")}}</td>
        </tr>
        <tr>  
          <th scope="row">Castigada </th>
          <td> {{$precredito->credito->castigada}}</td>
        </tr>     
        <tr>  
          <th scope="row" title="Funcionario que ingreso al sistema">Creó.</th>
          <td> <small>{{$precredito->credito->user_create->name.' '.$precredito->credito->created_at}}</small></td>
        </tr>                   
        <tr>  
          <th scope="row">Actualizó </th>
          <td> <small>{{$precredito->credito->user_update->name.' '.$precredito->credito->updated_at}}</small></td>
        </tr>  
      </table>
  </div>
</div>
<div class="col-md-1"></div>  
</div>

@endif




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

<script>

  var crear_credito = new Vue({
    el: '#crear_credito',
    data: {
      precredito_id : '',
      mes : ''
    },
    methods:{
      setMes(precredito_id){
        this.precredito_id = precredito_id
        $('#mes').modal('show')
      },
      crearCredito(){
        if(this.mes) {
          var route = '/start/creditos/create/'+this.precredito_id+'/'+this.mes;
          $('#mes').modal('toggle')
          window.open(route, "_self")
        } else {
          alert('Seleccione un mes por favor ...')
        }
      }
    },
    created(){

    }
  })

  const element = new Vue({
    el:  '#element',
    methods: {
      print(factura_id){
      	var self = this
        var route = "{{ url('start/precredito-invoice-print') }}/" + factura_id
        axios.get(route).then(function(res){
        	self.print_html(res.data)
        })
      },//.print
      print_html(str){
				var printed = window.open('','Print-Window');
				printed.document.write(str);
				printed.document.close();
				printed.print();
				printed.close();
      }//.print_html
    }
  });
</script>