@section('title','crear conyuge')
@section('contenido')


  <div class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-12">


      <div class="row">

        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="panel panel-primary">
            <div class="panel-heading">Editar conyuge del {{ ($tipo == 'cliente' ) ? ' cliente ' . $obj->nombre : ' codeudor '.$obj->nombrec}}</div>
              <div class="panel-body">
                @include('templates.error')
                @include('flash::message')

                <form class="form-horizontal form-label-left" 
                    action="{{route('start.conyuges.update',$obj)}}" 
                    method="POST">

                    <input type="hidden" name="tipo" value="{{$tipo}}">
                    <input type="hidden" name="obj_id" value="{{$obj->id}}">
                    <input type="hidden" name="conyuge_id" value="{{$obj->conyuge->id}}">
                    <input type="hidden" name="_method" value="PUT">


                    <div class="form-group">

                    <div class="col-md-6 col-sm-6 col-xs-12 ">

                        <label class="txt-small">Primer nombre conyuge*:</label>
                        <input type="text" 
                            class="form-control" 
                            placeholder="primer nombre cónyuge" 
                            id="p_nombrey" 
                            name="p_nombrey"  
                            value="{{$obj->conyuge->p_nombrey }}">

                    </div>

                    <div class="col-md-6 col-sm-6 col-xs-12">

                        <label class="txt-small">Segundo nombre cónyuge :</label>
                        <input type="text" 
                            class="form-control" 
                            placeholder="segundo nombre cóyuge" 
                            id="s_nombrey" 
                            name="s_nombrey"  
                            value="{{ $obj->conyuge->s_nombrey }}">

                    </div>
                    </div>  

                    <div class="form-group">  

                    <div class="col-md-6 col-sm-6 col-xs-12">

                        <label class="txt-small">Primer apellido cónyuge *:</label>
                        <input type="text" 
                            class="form-control" 
                            placeholder="primer apellido" 
                            id="p_apellidoy" 
                            name="p_apellidoy"  
                            value="{{ $obj->conyuge->p_apellidoy }}">
                    </div>


                    <div class="col-md-6 col-sm-6 col-xs-12">

                        <label class="txt-small">Segundo apellido cónyuge :</label>
                        <input type="text" 
                            class="form-control" 
                            placeholder="segundo apellido cónyuge" 
                            id="s_apellidoy" 
                            name="s_apellidoy"  
                            value="{{ $obj->conyuge->s_apellidoy}}">
                    </div>
                    </div>                   

                    <!-- NUM DOC **************************************************************************-->
                    <div class="form-group">  

                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <label class="txt-small">Tipo de documento cónyuge :</label>
                        <select class="form-control" id="tipo_docy" name="tipo_docy">
                        <option value="" disabled selected hidden=""></option>
                        @foreach($tipos_documento as $tipo_docy)
                            <option value="{{$tipo_docy}}" {{ ( $obj->conyuge->tipo_docy) == $tipo_docy ? "selected":"" }}>
                            {{ $tipo_docy }}
                            </option>
                        @endforeach
                        </select>

                    </div>

                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <label class="txt-small">Documento cónyuge *: </label>
                        <input type="number" 
                            class="form-control " 
                            placeholder="#" 
                            id="num_docy" 
                            name="num_docy" 
                            value="{{ $obj->conyuge->num_docy }}">
                    </div>
                    </div>

                    <div class="form-group">    
                        <!-- MOVIL -->

                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <label class="txt-small">Celular conyuge *:</label>
                            <input type="text" 
                                class="form-control" 
                                id="movily" 
                                name="movily" 
                                value="{{ $obj->conyuge->movily }}">
                        </div>
                        
                        <!-- Fijo -->

                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <label class="txt-small">Teléfono conyuge :</label>
                            <input type="text" 
                                class="form-control" 
                                id="fijoy" 
                                name="fijoy" 
                                value="{{ $obj->conyuge->fijoy }}">
                        </div>
                    </div>


                    <!-- DIRECCIÓN CONYUGE *******-->

                    <div class="form-group">

                        <div class="col-md-12 col-sm-12 col-xs-12">
                        <label class="txt-small">Dirección conyuge*:</label>
                            <input type="text" 
                                class="form-control" 
                                id="diry" 
                                name="diry" 
                                value="{{ $obj->conyuge->diry }}">
                        </div>
                    </div>
                    

                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    <br>

                    <center>
                    <a href="javascript:window.history.back();"><button type="button" class="btn btn-primary">Volver</button></a>
                    <button type="submit" class="btn btn-danger">&nbsp;&nbsp;Guardar Cambios&nbsp;&nbsp;</button>
                    </center>  

              </div>
            </div>                  
        </div>  

      
    </form>

  </div>

@endsection
@include('templates.main2')