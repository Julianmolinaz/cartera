@section('title','crear estudio')

@section('contenido')

<div class="row">

  <div class="col-md-4 col-sm-4"></div>

  <div class="col-md-4 col-sm-4 col-xs-12">

    <div class="panel panel-primary">
      <div class="panel-heading">Estudio</div>
      <div class="panel-body">
        @include('templates.error')
        @include('flash::message')



        <form class="form-horizontal form-label-left" action="{{route('start.estudios.store')}}" method="POST">        

         <!-- Funcionario -->

         <div class="form-group">
         <div class="col-md-12 col-sm-12 col-xs-12">
            <label for="">Asesor *: </label>
            <select class="form-control input-sm" name="funcionario_id" id="funcionario_id">
              <option value="" readonly selected hidden="">- -</option>
              @foreach($users as $user)
              <option value="{{$user->id}}" {{ (old("funcionario_id") == $user->id ? "selected":"") }}>{{$user->name}}</option>
              @endforeach  
            </select>
          </div>
          </div>

          <!-- est_lab  Valoración Laboral-->

          <div class="form-group">
           <div class="col-md-12 col-sm-12 col-xs-12">
            <label for="">Estabilidad Laboral *: </label>
            <select class="form-control input-sm" placeholder="Calificación Perfil Laboral" name="estLaboral_id" id="estLaboral_id" >
              <option value="" readonly selected hidden="">- -</option>
              @foreach($laborales as $laboral)
              <option value="{{ $laboral->id }}" {{ (old("estLaboral_id") == $laboral->id ? "selected":"") }}>{{  $laboral->criterio }}</option>
              @endforeach
            </select>
          </div>
        </div>

        <!-- time_vivienda = Tiempo en Vivienda-->

          <div class="form-group">
           <div class="col-md-12 col-sm-12 col-xs-12">
            <label for="">Duración en Vivienda *: </label>
            <select class="form-control input-sm" placeholder="" name="estVivienda_id" id="estVivienda_id" >
              <option value="" readonly selected hidden="">- -</option>
              @foreach($viviendas as $vivienda)
              <option value="{{ $vivienda->id }}" {{ (old("estVivienda_id") == $vivienda->id ? "selected":"") }}>{{  $vivienda->criterio }}</option>
              @endforeach
            </select>
          </div>
        </div>

        <!-- referencias -->

        <div class="form-group">
           <div class="col-md-12 col-sm-12 col-xs-12">
            <label for="">Coincidencia en las Refrencias *: </label>
            <select class="form-control input-sm" placeholder="" name="estReferencia_id" id="estReferencia_id" >
              <option value="" readonly selected hidden="">- -</option>
              @foreach($referencias as $referencia)
              <option value="{{ $referencia->id }}" {{ (old("estReferencia_id") == $referencia->id ? "selected":"") }}>{{  $referencia->criterio }}</option>
              @endforeach
            </select>
          </div>
        </div>

        <!-- datacredito -->

        <div class="form-group">  
          <div class="col-md-6 col-sm-6 col-xs-12">
            <label for="">Datacredito *: </label>
            <select class="form-control input-sm" placeholder="" name="estDatacredito_id" id="estDatacredito_id" >
              <option value="" readonly selected hidden="">- -</option>
              @foreach($datacreditos as $datacredito)
              <option value="{{ $datacredito->id }}" {{ (old("estDatacredito_id") == $datacredito->id ? "selected":"") }}>{{  $datacredito->criterio }}</option>
              @endforeach
            </select>
          </div>

          <!--  cal_asesor  -->

          <div class="col-md-6 col-sm-6 col-xs-12">
            <label>Calificación Asesor</label>
              <input type="number" min="0" max="5" step="any" title="0 action 5" class="form-control input-sm" id="cal_asesor" name="cal_asesor"  autocomplete="off" placeholder="Ingrese un valor entre 0 y 5"  value="{{old('cal_asesor')}}">
            </div>
 
          </div>

          <!--  observaciones  -->

          <div class="form-group">  
            <div class="col-md-12 col-sm-12 col-xs-12">
              <label>Observaciones</label>
              <textarea class="form-control input-sm" rows="3" id="observaciones" name="observaciones" placeholder='Escriba las observaciones y recordatorios' autocomplete="on"  value="{{old('observaciones')}}">{{old('observaciones')}}</textarea>
            </div>
              
            </div> 

          <!-- Botones -->  
          <div class="form-group">

          <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-4"><br>
            <a href="javascript:window.history.back();"><button type="button" class="btn btn-primary">Volver</button></a>
            <button type="submit" class="btn btn-danger">&nbsp;&nbsp;Crear&nbsp;&nbsp;</button>
          </div>
        </div>  
        <br>

        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        <input type="hidden" name="objeto" value="{{$objeto}}" />
        <input type="hidden" name="id_cliente" value="{{$id_cliente}}" />
        <input type="hidden" name="id_codeudor" value="{{$id_codeudor}}" />
      </form>



      </div>
    </div>
  </div>
  <div class="col-md-4 col-sm-4"></div>  
</div>    



 

<script>
$(document).ready(function(){}); //end document ready

</script>



@endsection
@include('templates.main2')