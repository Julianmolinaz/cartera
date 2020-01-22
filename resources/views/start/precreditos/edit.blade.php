@section('title','editar solicitud')

@section('contenido')


<div class="row">

<div class="col-md-2 col-sm-2"></div>

  <div class="col-md-8 col-sm-8 col-xs-12">

  <div class="panel panel-primary">
    <div class="panel-heading"><h4>Editar Solicitud de Crédito 
      <small style="color: #000;">{{$precredito->cliente->nombre.' '.$precredito->cliente->num_doc}}</small></h4>
    </div>  
    <div class="panel-body">
        @include('templates.error')
        @include('flash::message')
        <br />

        <!--FORMULARIO ********** -->
        <form class="form-horizontal form-label-left" action="{{route('start.precreditos.update',$precredito)}}" method="POST">

          <input type="hidden" name="_method" value="PUT">
          <div class="form-group">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <label for="">Aprobado *: </label>
              <select class="form-control" placeholder="primera fecha" name="aprobado" id="aprobado" 
		{{ (Auth::user()->rol != 'Administrador') ? 'disabled' : ''}}>
              <option value="" readonly selected hidden="aprobado">{{old('aprobado')}}</option>
              @foreach(['Si','No','En estudio','Desistio'] as $key => $tipo)
              <option id="aprobado" name="aprobado" value="{{ $tipo }}" {{ $precredito->aprobado == $tipo ? "selected":"" }}>{{  $tipo }}</option>
              @endforeach
            </select>
            </div>
          </div>  


          <!-- NUM_FACT **************************************************************************-->
          <div class="form-group">
            <div class="col-md-4 col-sm-4 col-xs-12">
              <label for="">Número de Factura *:</label>
              <input type="text" class="form-control" placeholder="ingrese número de factura" id="num_fact" name="num_fact"  value="{{$precredito->num_fact}}" autofocus>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-12">
                <label for="">Fecha:</label>
                <input type="text" class="form-control" data-inputmask="'mask': '99-99-9999'" placeholder="dd-mm-aaaa" id="fecha" name="fecha" value="{{$precredito->fecha}}">
              </div>
            <div class="col-md-4 col-sm-4 col-xs-12">
              <label>Cartera *:</label>
                  <select class="form-control" name="cartera_id" id="cartera_id">
                     <option value="" disabled selected hidden="">- -</option>
                     @foreach($carteras as $cartera)
                     <option value="{{$cartera->id}}" {{ $precredito->cartera->id == $cartera->id ? "selected":"" }}>{{$cartera->nombre}}</option>
                     @endforeach  
                   </select>
                 </div>  
            </div>
            <!-- VLR_FIN **************************************************************************-->
            <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12">
              <label for="">Centro de Costos *: </label>
              <input type="text" class="form-control" placeholder="ingrese monto solicitado" id="vlr_fin" name="vlr_fin" value="{{$precredito->vlr_fin}}" >
            </div>

            <!-- PRODUCTO ****-->
            <div class="col-md-6 col-sm-6 col-xs-12">
              <label>Producto *:</label>
                  <select class="form-control" name="producto_id" id="producto_id">
                     <option value="" disabled selected hidden="">- -</option>
                     @foreach($productos as $producto)
                     <option value="{{$producto->id}}" {{ $precredito->producto_id == $producto->id ? "selected":"" }}>{{$producto->nombre}}</option>
                     @endforeach  
                   </select>
                 </div>
          </div>
          <!--PERIODO -->

          <div class="form-group">  

            <div class="col-md-3 col-sm-3 col-xs-12">
              <label for="">Periodo *: </label>
              <select class="form-control" placeholder="periodo" name="periodo" id="periodo" >
              <option value="" readonly selected hidden="periodo">- -</option>
              @foreach(['Quincenal','Mensual'] as $key => $tipo)
              <option id="periodo" name="periodo" value="{{ $tipo }}" {{ $precredito->periodo == $tipo ? "selected":"" }}>{{  $tipo }}</option>
              @endforeach
            </select>
            </div>

            <!--MESES-->
           <div class="col-md-3 col-sm-3 col-xs-12">
            <label># Meses *:</label>
              <input type="number" class="form-control" id="meses" name="meses"  autocomplete="off" placeholder="Meses" min="{{$variables->meses_min}}" max="{{$variables->meses_max}}" step="1" value="{{$precredito->meses}}">
            </div>

            <!--CUOTAS-->
           <div class="col-md-6 col-sm-6 col-xs-12">
            <label># Cuotas *:</label>
              <input type="number" class="form-control" id="cuotas" name="cuotas"  autocomplete="off" placeholder="cuotas" readonly value="{{$precredito->cuotas}}">
            </div>
 
           </div>

           <!--VLR_CUOTA-->

           <div class="form-group">

            <div class="col-md-6 col-sm-6 col-xs-12">
              <label for="">Valor cuota *: </label>
              <input type="text" class="form-control" placeholder="ingrese valor " id="vlr_cuota" name="vlr_cuota" value="{{$precredito->vlr_cuota}}" >
            </div>

            <!--P_FECHA-->

            <div class="col-md-3 col-sm-3 col-xs-12">
              <label for="">Fecha 1 *: </label>
              <select class="form-control" placeholder="primera fecha" name="p_fecha" id="p_fecha" >
              <option value="" readonly selected hidden="p_fecha"></option>
              @foreach([
                '1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30',
              ] as $key => $tipo)
              <option id="p_fecha" name="p_fecha" value="{{ $tipo }}" {{ $precredito->p_fecha == $tipo ? "selected":"" }}>{{  $tipo }}</option>
              @endforeach
            </select>
            </div>

            <!--S_FECHA-->

            <div class="col-md-3 col-sm-3 col-xs-12">
              <label for="">Fecha 2 : </label>
              <select class="form-control" placeholder="segunda fecha" name="s_fecha" id="s_fecha" >
              <option value="" readonly selected hidden="s_fecha"></option>
              @foreach([
                '1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30',
              ] as $key => $tipo)
              <option id="s_fecha" name="s_fecha" value="{{ $tipo }}" {{ $precredito->s_fecha == $tipo ? "selected":"" }}>{{  $tipo }}</option>
              @endforeach
            </select>
            </div>
          </div>


          <!--ESTUDIO-->
          <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12">
              <label for="">Estudio *: </label>
              <select class="form-control" placeholder="primera fecha" name="estudio" id="estudio" >
              <option value="" readonly selected hidden="estudio">{{old('estudio')}}</option>
              @foreach(['Tipico','Domicilio','Sin estudio'] as $key => $tipo)
              <option id="estudio" name="estudio" value="{{ $tipo }}" {{ $precredito->estudio == $tipo ? "selected":"" }}>{{  $tipo }}</option>
              @endforeach
            </select>
            </div>
            <!--CUOTA INICIAL-->
            <div class="col-md-6 col-sm-6 col-xs-12">

              <label for="">Cuota Inicial : </label>
              <input type="number" class="form-control" id="cuota_inicial" name="cuota_inicial"  autocomplete="off" placeholder="cuota inicial" value="{{$precredito->cuota_inicial}}">
            </div>

          </div>  

            <div class="form-group">
            <!--FUNCIONARIO_ID-->
            <div class="col-md-12 col-sm-12 col-xs-12">
              <label for="">Funcionario *: </label>
            <select class="form-control" name="funcionario_id" id="funcionario_id">
              <option value="" disabled selected hidden="">- -</option>
              @foreach($users as $user)
              <option value="{{$user->id}}" {{ $precredito->funcionario_id == $user->id ? "selected":"" }}>{{$user->name}}</option>
              @endforeach  
            </select>
            </div>


            </div>

          <!--OBSERVACIONES-->
          <div class="form-group">  
            <div class="col-md-12 col-sm-12 col-xs-12">
              <label>Observaciones</label>
              <textarea class="form-control" rows="3" id="observaciones" name="observaciones" placeholder='Escriba la descripción de la modalidad' autocomplete="on"  value="{{$precredito->observaciones}}">{{$precredito->observaciones}}</textarea>
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
      </form>
      <!-- END FORMULARIO ******-->




  </div>
  </div>

</div>

<div class="col-md-2 col-sm-2"></div>

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

</script>




@endsection
@include('templates.main2')
