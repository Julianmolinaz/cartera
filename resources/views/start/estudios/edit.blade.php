@section('title','crear estudio')

@section('contenido')


  <div class="col-md-12 col-sm-12 col-xs-12">
    

    <!-- PANEL DE VALIDACION DE CREDITO -->
    
    <div class="col-md-6  col-sm-6 col-xs-12">

      <div class="panel panel-primary">
        <div class="panel-heading"><h3 style="margin-top: 8px;">
         <i class="fab fa-fly"></i>
        Estudio 
        @if($id_codeudor == 0)
          cliente
        @else
          codeudor
        @endif
       </h3></div>
        <div class="panel-body">
          @include('templates.error')
          @include('flash::message')
            
          <form class="form-horizontal form-label-left" action="{{route('start.estudios.update', $estudio)}}" method="POST">   

                <input type="hidden" name="_method" value="PUT">     

                <!-- Funcionario -->

          <div class="form-group">
          <div class="col-md-12 col-sm-12 col-xs-12">
              <label for="">Asesor *: </label>
              <select class="form-control" name="funcionario_id" id="funcionario_id">
                <option value="" readonly selected hidden="">- -</option>
                @foreach($users as $user)
                <option value="{{$user->id}}" {{ $estudio->funcionario_id == $user->id ? "selected":"" }}>{{$user->name}}</option>
                @endforeach  
              </select>
            </div>
            </div>

            <!-- est_lab  Valoración Laboral-->

            <div class="form-group">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <label for="">Estabilidad Laboral *: </label>
            <select class="form-control" placeholder="Calificación Perfil Laboral" name="estLaboral_id" id="estLaboral_id">
                <option value="" readonly selected hidden="">- -</option>
                @foreach($laborales as $laboral)
                <option value="{{ $laboral->id }}" {{ $estudio->estLaboral_id == $laboral->id ? "selected":"" }}>{{  $laboral->criterio }}</option>
                @endforeach
              </select>
            </div>
          </div>

          <!-- time_vivienda = Tiempo en Vivienda-->

            <div class="form-group">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <label for="">Duración en Vivienda *: </label>
              <select class="form-control" placeholder="" name="estVivienda_id" id="estVivienda_id">
                <option value="" readonly selected hidden="">- -</option>
                @foreach($viviendas as $vivienda)
                <option value="{{ $vivienda->id }}" {{ $estudio->estVivienda_id == $vivienda->id ? "selected":"" }}>{{  $vivienda->criterio }}</option>
                @endforeach
              </select>
            </div>
          </div>

          <!-- referencias -->

          <div class="form-group">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <label for="">Coincidencia en las Refrencias *: </label>
              <select class="form-control" placeholder="" name="estReferencia_id" id="estReferencia_id">
                <option value="" readonly selected hidden="">- -</option>
                @foreach($referencias as $referencia)
                <option value="{{ $referencia->id }}" {{ $estudio->estReferencia_id == $referencia->id ? "selected":"" }}>{{  $referencia->criterio }}</option>
                @endforeach
              </select>
            </div>
          </div>

          <!-- datacredito -->

          <div class="form-group">  
            <div class="col-md-6 col-sm-6 col-xs-12">
              <label for="">Datacredito *: </label>
              <select class="form-control" placeholder="" name="estDatacredito_id" id="estDatacredito_id">
                <option value="" readonly selected hidden="">- -</option>
                @foreach($datacreditos as $datacredito)
                <option value="{{ $datacredito->id }}" {{ $estudio->estDatacredito_id == $datacredito->id ? "selected":"" }}>{{  $datacredito->criterio }}</option>
                @endforeach
              </select>
            </div>

            <!--  cal_asesor  -->

            <div class="col-md-6 col-sm-6 col-xs-12">
              <label>Calificación Asesor</label>
                <input type="number" min="0" max="5" step="any" title="0 action 5" class="form-control" id="cal_asesor" name="cal_asesor"  autocomplete="off" placeholder="Ingrese un valor entre 0 y 5"  value="{{$estudio->cal_asesor}}">
              </div>
  
            </div>

            <!--  observaciones  -->

            <div class="form-group">  
              <div class="col-md-12 col-sm-12 col-xs-12">
                <label>Observaciones</label>
                <textarea class="form-control" rows="3" id="observaciones" name="observaciones" placeholder='Escriba las observaciones y recordatorios' value="{{$estudio->observaciones}}" style="height: 88px;">{{$estudio->observaciones}}</textarea>
              </div>
                
              </div> 
 


              <center>
                <div class="form-group">
                  <a href="javascript:window.history.back();"><button type="button" class="btn btn-primary">Volver</button></a>
                  <button type="submit" class="btn btn-danger">&nbsp;&nbsp;Guardar Estudio&nbsp;&nbsp;</button>
                </div>  

              </center>


                <!-- Botones -->  
              <br>

              <input type="hidden" name="_token" value="{{ csrf_token() }}" />
              <input type="hidden" name="objeto" value="{{$objeto}}" />
              <input type="hidden" name="id_cliente" value="{{$id_cliente}}" />
              <input type="hidden" name="id_codeudor" value="{{$id_codeudor}}" />

          </form>

        </div>
      </div>
    </div>
      <!-- END PANEL DE VALIDACION DE CREDITO -->


      <!-- PANEL DE VALIDACION DE CREDITO -->
      <div class="col-md-6  col-sm-6 col-xs-12">

        <div class="panel panel-primary">
          <div class="panel-heading">
            <h3 style="margin-top: 8px;">
            <i class="fas fa-users"></i>
              Referencias 
              @if($id_codeudor == 0)
                cliente
              @else
                codeudor
              @endif
            </h3>
          </div>
          <div class="panel-body">
            @include('templates.error')
            @include('flash::message')
              
            <form class="form-horizontal form-label-left" action="{{route('start.estudios.create.ref')}}" method="POST">   

            <input type="hidden" name="_method" value="PUT">     

            <div class="form-group">  
              <div class="col-md-12 col-sm-12 col-xs-12">
                <label>Referencia 1</label>
                <textarea class="form-control input-sm" 
                          rows="4" id="ref_1" 
                          name="ref_1" 
                          placeholder="Escriba la referencia 1" 
                          autocomplete="on" 
                          value="{{ $estudio->ref_1 }}">{{ $estudio->ref_1 }}</textarea>
              </div>    
            </div> 

            <div class="form-group">  
              <div class="col-md-12 col-sm-12 col-xs-12">
                <label>Referencia 2</label>
                <textarea class="form-control input-sm" 
                          rows="4" id="ref_2" 
                          name="ref_2" 
                          placeholder='Escriba la referencia 2'  
                          value="{{ $estudio->ref_2}}">{{$estudio->ref_2}}</textarea>
              </div>    
            </div> 

            <div class="form-group">  
              <div class="col-md-12 col-sm-12 col-xs-12">
                <label>Referencia 3</label>
                <textarea class="form-control input-sm" 
                          rows="4" id="ref_3" 
                          name="ref_3"
                          placeholder='Escriba la referencia 3' 
                          value="{{ $estudio->ref_3}}">{{$estudio->ref_3}}</textarea>
              </div>    
            </div> 

            <div class="form-group">  
              <div class="col-md-12 col-sm-12 col-xs-12">
                <label>Referencia 4</label>
                <textarea class="form-control input-sm" 
                          rows="4" 
                          id="ref_4" 
                          name="ref_4" 
                          placeholder='Escriba la referencia 4' 
                          value="{{ $estudio->ref_4}}">{{$estudio->ref_4}}</textarea>
              </div>    
            </div>                    


              <center>
                <div class="form-group">
                  <a href="javascript:window.history.back();"><button type="button" class="btn btn-primary">Volver</button></a>
                  <button type="submit" class="btn btn-danger">&nbsp;&nbsp;Guradar Referencias&nbsp;&nbsp;</button>
                </div>  

              </center>


                <!-- Botones -->  

              <input type="hidden" name="_token" value="{{ csrf_token() }}" />
              <input type="hidden" name="objeto" value="{{$objeto}}" />
              <input type="hidden" name="id_cliente" value="{{$id_cliente}}" />
              <input type="hidden" name="id_codeudor" value="{{$id_codeudor}}" />

          </form>
            
          <br>
          </div>
        </div>
      </div>
      <!-- END PANEL DE VALIDACION DE CREDITO -->
    </div>
  </div>



@endsection
@include('templates.main2')
