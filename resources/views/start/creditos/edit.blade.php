@section('title','editar credito')

@section('contenido')


<div class="row">
<!-- <div class="col-md-2 col-sm-2 col-xs-12"></div> -->
  <div class="col-md-8 col-md-offset-2   col-sm-8  col-xs-12">
  <div class="panel panel-primary">
    <div class="panel-heading">Editar Crédito <small>{{$credito->precredito->cliente->nombre.' '.$credito->precredito->cliente->num_doc}}</small></div>
    <div class="panel-body">
        @include('templates.error')
        @include('flash::message')
        <br />
        <!--FORMULARIO ********** -->
        <form class="form-horizontal form-label-left" action="{{route('start.creditos.update',$credito)}}" method="POST">

          <input type="hidden" name="_method" value="PUT">

          <div class="form-group">
            <div class="col-md-3 col-sm-3 col-xs-12">
              <label for="">Aprobado *: </label>
              <select class="form-control input-sm" placeholder="primera fecha" name="aprobado" id="aprobado" >
              <option value="" readonly selected hidden="aprobado">{{old('aprobado')}}</option>
              @foreach(['Si','No','En estudio','Desistio'] as $key => $tipo)
              <option id="aprobado" name="aprobado" value="{{ $tipo }}" {{ $credito->precredito->aprobado == $tipo ? "selected":"" }}>{{  $tipo }}</option>
              @endforeach
            </select>
            </div>

          <!-- NUM_FACT **************************************************************************-->

            <div class="col-md-3 col-sm-3 col-xs-12">
              <label for=""># de Factura *:</label>
              <input type="text" class="form-control input-sm" placeholder="ingrese número de factura" id="num_fact" name="num_fact"  value="{{$credito->precredito->num_fact}}" autofocus>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-12">
                <label for="">Fecha de solicitud *:</label>
                <input type="text" class="form-control input-sm" data-inputmask="'mask': '99-99-9999'" placeholder="dd-mm-aaaa" id="fecha" name="fecha" value="{{$credito->precredito->fecha}}">
            </div>
            <div class="col-md-3 col-sm-3 col-xs-12">
              <label>Cartera *:</label>
                  <select class="form-control input-sm" name="cartera_id" id="cartera_id">
                     <option value="" disabled selected hidden="">- -</option>
                     @foreach($carteras as $cartera)
                     <option value="{{$cartera->id}}" {{ $credito->precredito->cartera->id == $cartera->id ? "selected":"" }}>{{$cartera->nombre}}</option>
                     @endforeach  
                   </select>
                 </div>  
            </div>
            <!-- VLR_FIN **************************************************************************-->
            <div class="form-group">
              <div class="col-md-3 col-sm-3 col-xs-12">
                <label for="">Ref Mes *: </label>
                <select class="form-control input-sm" name="mes" id="mes">
                @foreach(['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'] as $mes)
                  <option value="{{ $mes }}" {{ $credito->mes == $mes ? "selected" : '' }}>{{ $mes }}</option>
                @endforeach
                </select>
              </div>

            <div class="col-md-3 col-sm-3 col-xs-12">
              <label for="">Centro de Costos *: </label>
              <input type="text" class="form-control input-sm" placeholder="ingrese monto solicitado" id="vlr_fin" name="vlr_fin" value="{{$credito->precredito->vlr_fin}}" >
            </div>

            <!-- PRODUCTO ****-->
            <div class="col-md-6 col-sm-6 col-xs-12">
              <label>Producto *:</label>
                  <select class="form-control input-sm" name="producto_id" id="producto_id">
                     <option value="" disabled selected hidden="">- -</option>
                     @foreach($productos as $producto)
                     <option value="{{$producto->id}}" {{ $credito->precredito->producto_id == $producto->id ? "selected":"" }}>{{$producto->nombre}}</option>
                     @endforeach  
                   </select>
                 </div>
          </div>
          <!--PERIODO -->

          <div class="form-group">  

            <div class="col-md-3 col-sm-3 col-xs-12">
              <label for="">Periodo *: </label>
              <select class="form-control input-sm" placeholder="periodo" name="periodo" id="periodo" >
              <option value="" readonly selected hidden="periodo">- -</option>
              @foreach(['Quincenal','Mensual'] as $key => $tipo)
              <option id="periodo" name="periodo" value="{{ $tipo }}" {{ $credito->precredito->periodo == $tipo ? "selected":"" }}>{{  $tipo }}</option>
              @endforeach
            </select>
            </div>

            <!--MESES-->
           <div class="col-md-3 col-sm-3 col-xs-12">
            <label># Meses *:</label>
              <input type="number" class="form-control input-sm" id="meses" name="meses"  autocomplete="off" placeholder="Meses" min="{{$variables->meses_min}}" max="{{$variables->meses_max}}" step="1" value="{{$credito->precredito->meses}}">
            </div>

            <!--CUOTAS-->
           <div class="col-md-6 col-sm-6 col-xs-12">
            <label># Cuotas *:</label>
              <input type="number" class="form-control input-sm" id="cuotas" name="cuotas"  autocomplete="off" placeholder="cuotas" readonly value="{{$credito->precredito->cuotas}}">
            </div>
 
           </div>

           <!--VLR_CUOTA-->

           <div class="form-group">

            <div class="col-md-6 col-sm-6 col-xs-12">
              <label for="">Valor cuota *: </label>
              <input type="text" class="form-control input-sm" placeholder="ingrese valor " id="vlr_cuota" name="vlr_cuota" value="{{$credito->precredito->vlr_cuota}}" >
            </div>

            <!--P_FECHA-->

            <div class="col-md-3 col-sm-3 col-xs-12">
              <label for="">Fecha 1 *: </label>
              <select class="form-control input-sm" placeholder="primera fecha" name="p_fecha" id="p_fecha" >
              <option value="" readonly selected hidden="p_fecha"></option>
              @foreach(range(1, 30) as $key => $tipo)
              <option id="p_fecha" name="p_fecha" value="{{ $tipo }}" {{ $credito->precredito->p_fecha == $tipo ? "selected":"" }}>{{  $tipo }}</option>
              @endforeach
            </select>
            </div>

            <!--S_FECHA-->

            <div class="col-md-3 col-sm-3 col-xs-12">
              <label for="">Fecha 2 : </label>
              <select class="form-control input-sm" placeholder="segunda fecha" name="s_fecha" id="s_fecha" >
              <option value="" readonly selected hidden="s_fecha"></option>
              @foreach(range(1, 30) as $key => $tipo)
              <option id="s_fecha" name="s_fecha" value="{{ $tipo }}" {{ $credito->precredito->s_fecha == $tipo ? "selected":"" }}>{{  $tipo }}</option>
              @endforeach
            </select>
            </div>
          </div>


          <!--ESTUDIO-->
          <div class="form-group">
            <div class="col-md-3 col-sm-3 col-xs-12">
              <label for="">Estudio *: </label>
              <select class="form-control input-sm" placeholder="primera fecha" name="estudio" id="estudio" >
              <option value="" readonly selected hidden="estudio">{{old('estudio')}}</option>
              @foreach(['Tipico','Domicilio','Sin estudio'] as $key => $tipo)
              <option id="estudio" name="estudio" value="{{ $tipo }}" {{ $credito->precredito->estudio == $tipo ? "selected":"" }}>{{  $tipo }}</option>
              @endforeach
            </select>
            </div>
            <!--CUOTA INICIAL-->
            <div class="col-md-3 col-sm-3 col-xs-12">

              <label for="">Cuota Inicial : </label>
              <input type="number" class="form-control input-sm" id="cuota_inicial" name="cuota_inicial"  autocomplete="off" placeholder="cuota inicial" value="{{$credito->precredito->cuota_inicial}}">
            </div>

            <!--FUNCIONARIO_ID-->
            <div class="col-md-6 col-sm-6 col-xs-12">
              <label for="">Funcionario *: </label>
            <select class="form-control input-sm" name="funcionario_id" id="funcionario_id">
              <option value="" disabled selected hidden="">- -</option>
              @foreach($users as $user)
              <option value="{{$user->id}}" {{ $credito->precredito->funcionario_id == $user->id ? "selected":"" }}>{{$user->name}}</option>
              @endforeach  
            </select>
            </div>
            </div>

            
            <!--CUOTAS FALTANTES-->
            <div class="form-group">
            <div class="col-md-3 col-sm-3 col-xs-12">
              <label for="">Cuotas Faltantes : </label>
              <input type="number" class="form-control input-sm" id="cuotas_faltantes" name="cuotas_faltantes"  autocomplete="off" placeholder="cuota inicial" value="{{$credito->cuotas_faltantes}}">
            </div>

            <!--SALDO-->
            <div class="col-md-3 col-sm-3 col-xs-12">
              <label for="">Saldo : </label>
              <input type="number" class="form-control input-sm" id="saldo" name="saldo"  autocomplete="off" placeholder="cuota inicial" value="{{$credito->saldo}}">
            </div>    

            <!--SALDO A FAVOR-->
            <div class="col-md-3 col-sm-3 col-xs-12">
              <label for="">Saldo a Favor : </label>
              <input type="number" class="form-control input-sm" id="saldo_favor" name="saldo_favor"  autocomplete="off" placeholder="saldo a favor" value="{{$credito->saldo_favor}}">
            </div>  

            <!--ESTADO CREDITO-->
            <div class="col-md-3 col-sm-3 col-xs-12">
              <label for="">Estado Credito *: </label>
            <select class="form-control input-sm" name="estado_credito" id="estado_credito">
              @foreach($estados_credito as $estado_credito)
              <option value="{{$estado_credito}}" {{ $credito->estado == $estado_credito ? "selected":"" }}>{{$estado_credito}}</option>
              @endforeach  
            </select>
            </div>
            </div>

            

            <!--RENDIMIENTO-->
            <div class="form-group">
            <div class="col-md-3 col-sm-3 col-xs-12">
              <label for="">Rendimiento: </label>
              <input type="number" class="form-control input-sm" id="rendimiento" name="rendimiento"  autocomplete="off" placeholder="rendimiento" value="{{$credito->rendimiento}}" >
            </div>

            <!--VALOR DEL CREDITO-->
            <div class="col-md-3 col-sm-3 col-xs-12">
              <label for="">Valor Total Crédito: </label>
              <input type="number" class="form-control input-sm" id="valor_credito" name="valor_credito"  autocomplete="off" placeholder="valor_credito" value="{{$credito->valor_credito}}" >
            </div>

            <!--CASTIGADA-->
            <div class="col-md-3 col-sm-3 col-xs-12">
              <label for="">Castigada *: </label>
            <select class="form-control input-sm" name="castigada" id="castigada">
              @foreach(['Si','No'] as $castigada)
              <option value="{{$castigada}}" {{ $credito->castigada == $castigada ? "selected":"" }}>{{$castigada}}</option>
              @endforeach  
            </select>
            </div>  

            <div class="col-md-3 col-sm-3 col-xs-12">
              <label for="" style="color:#dd4437;">Fecha de Pago *:</label>
                <input type="text" class="form-control input-sm" data-inputmask="'mask': '99-99-9999'" placeholder="dd-mm-aaaa" id="fecha_pago" name="fecha_pago" value="{{$fecha_de_pago}}">
            </div>
          </div>

          <!--OBSERVACIONES-->
          <div class="form-group">  
            <div class="col-md-6 col-sm-6 col-xs-12">
              <label>Observaciones</label>
              <textarea class="form-control input-sm" rows="3" id="observaciones" name="observaciones" placeholder='Escriba la descripción de la modalidad' autocomplete="on"  value="{{$credito->precredito->observaciones}}">{{$credito->precredito->observaciones}}</textarea>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <label>Recordatorio Pago</label>
              <textarea class="form-control input-sm" rows="3" id="recordatorio" name="recordatorio" 
                placeholder='Escriba el recordatorio del pago' autocomplete="on"  value="{{$credito->recordatorio}}">{{$credito->recordatorio}}</textarea>
            </div>
            </div>

         <!-- BOTONES **************************************************************************-->
         <div class="form-group">
         
          <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-4"><br>

            <a href="javascript:window.history.back();">
            <button type="button" class="btn btn-primary">Volver</button></a>

            <button type="submit" class="btn btn-danger">&nbsp;&nbsp;Guardar Cambios&nbsp;&nbsp;</button>
          </div>

        </div>


        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        <input type="hidden" name="calificacion" id="calificacion"  />

            

      </form>
      <!-- END FORMULARIO ******-->
      @include('start.clientes.calificar_cliente_modal')
    </div> 
  </div>

  </div>
</div>




<script>
$(document).ready(function(){


$('#meses').on('change',function(e){

    var meses2 = $('#meses').val();

    var min = $('#meses').attr("min") * 1;
    var max = $('#meses').attr("max") * 1;


    if(meses2 < min || meses2 > max){
      alert('EL valor debe estar entre '+min+' '+max);
    }

    });

  $('#meses').on('keyup',function(e){

    var periodo =  $('#periodo').val();
    var meses = $('#meses').val();


    /** Calculo del número de cuotas segun los meses se modifiquen  **/

    if(periodo == 'Quincenal'){
        $('#cuotas').val(meses*2);
    }
    else if(periodo == 'Mensual'){
        $('#cuotas').val(meses);
    }
        else{
          $('#cuotas').val('');
    }
  });//fin del $('#meses').on('keyup'..


  $('#periodo').on('change',function(){
    var periodo =  $('#periodo').val();
    var meses = $('#meses').val();

    if(meses == ''){
      $('#cuotas').val('');
    }
    else if(periodo == 'Quincenal'){
      $('#cuotas').val(meses*2);
    }
    else{
      $('#cuotas').val(meses);
    }
  });//fin de $('#periodo').on('change'....


});//fin del $(document).ready...


$('#estado_credito').on('change',function(){
  

    $('#calificar_cliente').modal('show');

    if("{{$credito->precredito->cliente->calificacion}}" == ""){
      
      $('#modalLabel').text('No hay calificación del cliente '+
        '{{$credito->precredito->cliente->nombre}}'+'!!!');

    } else{

      $('#modalLabel').text("Calificación del cliente "+"{{$credito->precredito->cliente->nombre}} => "+"{{$credito->precredito->cliente->calificacion}}");
    }
});



</script>




@endsection
@include('templates.main2')