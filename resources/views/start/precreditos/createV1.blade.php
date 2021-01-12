@section('title','Crear Solicitud')

@section('contenido')

<div class="row">

<div class="col-md-2 col-sm-2"></div>

  <div class="col-md-8 col-sm-8 col-xs-12">

  <div class="panel panel-primary">
    <div class="panel-heading">Crear Solicitud de Crédito <small>{{$cliente->nombre.' '.$cliente->num_doc}}</small></div>
    <div class="panel-body">
        @include('templates.error')
        <br />
        <!--FORMULARIO ********** -->
        <form class="form-horizontal form-label-left" action="{{route('start.precreditos.store')}}" method="POST">

          <input type="hidden" name="cliente_id" value="{{$cliente->id}}">

          <!-- ***** num_fact *********-->

          <div class="form-group">
            <div class="col-md-4 col-sm-4 col-xs-12">
              <label for="">Número de Factura *:</label>
              <input type="text" class="form-control input-sm" placeholder="# de factura" id="num_fact" name="num_fact"  value="{{old('num_fact')}}" autofocus>
            </div>

            <!--*** fecha ***-->

            <div class="col-md-4 col-sm-4 col-xs-12">
              <label for="">Fecha:</label>
              <input type="text" class="form-control input-sm" data-inputmask="'mask': '99-99-9999'" placeholder="dd-mm-aaaa" id="fecha" name="fecha" value="{{old('fecha')}}">
            </div>

            <!--*** cartera_id ***-->  

            <div class="col-md-4 col-sm-4 col-xs-12">
              <label>Cartera *:</label>
              <select class="form-control input-sm" name="cartera_id" id="cartera_id">
               <option value="" disabled selected hidden="">- -</option>
               @foreach($carteras as $cartera)
               <option value="{{$cartera->id}}" {{ (old("cartera_id") == $cartera->id ? "selected":"") }}>{{$cartera->nombre}}</option>
               @endforeach  
             </select>
           </div>  
         </div>

         <!-- vlr_fin*****-->

         <div class="form-group">
          <div class="col-md-6 col-sm-6 col-xs-12">
            <label for="">Centro de Costos *: </label>
            <input type="text" class="form-control input-sm" placeholder="ingrese monto solicitado" id="vlr_fin" name="vlr_fin" value="{{old('vlr_fin')}}" >
          </div>

          <div class="col-md-6 col-sm-6 col-xs-12">
            <label>Producto *:</label>
            <select class="form-control input-sm" name="producto_id" id="producto_id">
             <option value="" disabled selected hidden="">- -</option>
             @foreach($productos as $producto)
             <option value="{{$producto->id}}" {{ (old("producto_id") == $producto->id ? "selected":"") }}>{{$producto->nombre}}</option>
             @endforeach  
           </select>
         </div>
       </div>


       <div class="form-group">  

        <div class="col-md-3 col-sm-3 col-xs-12">
          <label for="">Periodo *: </label>
          <select class="form-control input-sm" placeholder="periodo" name="periodo" id="periodo" >
            <option value="" readonly selected hidden="periodo">- -</option>
            @foreach(['Quincenal','Mensual'] as $key => $tipo)
            <option id="periodo" name="periodo" value="{{ $tipo }}" {{ (old("periodo") == $tipo ? "selected":"") }}>{{  $tipo }}</option>
            @endforeach 
          </select>
        </div>

        <div class="col-md-3 col-sm-3 col-xs-12">
          <label># Meses *:</label>
          <input type="number" class="form-control input-sm" id="meses" name="meses"  autocomplete="off" placeholder="Meses" min="{{$variables->meses_min}}" max="{{$variables->meses_max}}" step="1" value="{{old('meses')}}">
        </div>


        <div class="col-md-6 col-sm-6 col-xs-12">
          <label># Cuotas *:</label>
          <input type="number" class="form-control input-sm" id="cuotas" name="cuotas"  autocomplete="off" placeholder="cuotas" readonly value="{{old('cuotas')}}">
        </div>

      </div>

      <div class="form-group">

        <div class="col-md-6 col-sm-6 col-xs-12">
          <label for="">Valor cuota *: </label>
          <input type="text" class="form-control input-sm" placeholder="ingrese valor " id="vlr_cuota" name="vlr_cuota" value="{{old('vlr_cuota')}}" >
        </div>

        <div class="col-md-3 col-sm-3 col-xs-12">
          <label for="">Fecha 1 *: </label>
          <select class="form-control input-sm" placeholder="primera fecha" name="p_fecha" id="p_fecha" >
            <option value="" readonly selected hidden="p_fecha"></option>
            @foreach(range(1, 30) as $tipo)
              <option id="p_fecha" name="p_fecha" value="{{ $tipo }}" {{ (old("p_fecha") == $tipo ? "selected":"") }}>{{  $tipo }}</option>
              @endforeach
            </select>
          </div>
          <div class="col-md-3 col-sm-3 col-xs-12">
            <label for="">Fecha 2 : </label>
            <select class="form-control input-sm" placeholder="segunda fecha" name="s_fecha" id="s_fecha" >
              <option value="" readonly selected hidden="s_fecha"></option>
              @foreach(range(1, 30) as $tipo)
                <option id="s_fecha" name="s_fecha" value="{{ $tipo }}" {{ (old("s_fecha") == $tipo ? "selected":"") }}>{{  $tipo }}</option>
                @endforeach
              </select>
            </div>
          </div>

          <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12">
              <label for="">Estudio *: </label>
              <select class="form-control input-sm" placeholder="primera fecha" name="estudio" id="estudio" >
                <option value="" readonly selected hidden="estudio">{{old('estudio')}}</option>
                @foreach(['Tipico','Domicilio','Sin estudio'] as $key => $tipo)
                <option id="estudio" name="estudio" value="{{ $tipo }}" {{ (old("estudio") == $tipo ? "selected":"") }}>{{  $tipo }}</option>
                @endforeach
              </select>
            </div>
<!--CUOTA INICIAL-->
            <div class="col-md-6 col-sm-6 col-xs-12">

              <label for="">Cuota Inicial : </label>
              <input type="number" class="form-control input-sm" id="cuota_inicial" name="cuota_inicial"  autocomplete="off" placeholder="cuota inicial" value="{{old('cuota_inicial')}}">
            </div>

          </div>

        <!--FUNCIONARIO-->
        <div class="form-group">
          <div class="col-md-12 col-sm-12 col-xs-12">

            <label for="">Funcionario *: </label>
            <select class="form-control input-sm" name="funcionario_id" id="funcionario_id">
              <option value="" disabled selected hidden="">- -</option>
              @foreach($users as $user)
              <option value="{{$user->id}}" {{ (old("funcionario_id") == $user->id ? "selected":"") }}>{{$user->name}}</option>
              @endforeach  
            </select>

          </div>
        </div> 

<!--OBSERVACIONES-->
      <div class="form-group">  
        <div class="col-md-12 col-sm-12 col-xs-12">
          <label>Observaciones</label>
          <textarea class="form-control input-sm" rows="12" id="observaciones" name="observaciones" autocomplete="on"  value="{{old('observaciones')}}"></textarea>
        </div>

      </div>

      <!-- BOTONES **************************************************************************-->

      <center>
          <a href="javascript:window.history.back();"><button type="button" class="btn btn-primary">Volver</button></a>
          <button type="submit" class="btn btn-danger">&nbsp;&nbsp;Crear&nbsp;&nbsp;</button>
      </center>    


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
