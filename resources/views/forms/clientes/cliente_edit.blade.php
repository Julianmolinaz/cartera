         <!-- NOMBRE**************************************************************************-->


         <div class="form-group  marg-bott-small">

          <div class="col-md-12 col-sm-12 col-xs-12 ">  
            <label class="title-section">Datos personales del solicitante</label>
            <hr class="linea">
          </div>

          <div class="col-md-6 col-sm-6 col-xs-12">
            <label class="txt-small">Primer nombre *:</label>
            <input type="text" 
                   class="form-control input-small" 
                   placeholder="primer nombre" 
                   id="primer_nombre" 
                   name="primer_nombre"  
                   value="{{$cliente->primer_nombre}}" >
          </div>


          <div class="col-md-6 col-sm-6 col-xs-12">
            <label class="txt-small">Segundo nombre :</label>
            <input type="text" 
                   class="form-control input-small" 
                   placeholder="segundo nombre" 
                   id="segundo_nombre" 
                   name="segundo_nombre"  
                   value="{{$cliente->segundo_nombre}}">
          </div>
        </div>  

        <div class="form-group marg-bott-small">  
          <div class="col-md-6 col-sm-6 col-xs-12">
            <label class="txt-small">Primer Apellido *:</label>
            <input type="text" 
                   class="form-control input-small" 
                   placeholder="primer apellido" 
                   id="primer_apellido" 
                   name="primer_apellido"  
                   value="{{$cliente->primer_apellido}}">
          </div>


          <div class="col-md-6 col-sm-6 col-xs-12">
            <label class="txt-small">Segundo Apellido :</label>
            <input type="text" 
                   class="form-control input-small" 
                   placeholder="segundo apellido" 
                   id="segundo_apellido" 
                   name="segundo_apellido"  
                   value="{{$cliente->segundo_apellido}}">
          </div>
        </div> 
            
            <!-- NUM DOC **************************************************************************-->
          <div class="form-group marg-bott-small">  

            <div class="col-md-6 col-sm-6 col-xs-12">
              <label>Tipo de documento *:</label>
              <select class="form-control input-small" id="tipo_doc" name="tipo_doc">
                <option value="" disabled selected hidden=""></option>
                @foreach($tipos_documento as $tipo_doc)
                  <option value="{{$tipo_doc}}" {{ $cliente->tipo_doc == $tipo_doc ? "selected":"" }}>{{$tipo_doc}}</option>
                @endforeach
              </select>

            </div>

            <div class="col-md-6 col-sm-6 col-xs-12">
              <label class="txt-small">Documento *: </label>
              <input type="number" 
                     class="form-control input-small" 
                     placeholder="ingrese número de documento" 
                     id="num_doc" 
                     name="num_doc" 
                     value="{{$cliente->num_doc}}">

            </div>
          </div>

          <div class="form-group marg-bott-small">
            <!-- FECHA NACIMIENTO***************************************************************-->
            <div class="col-md-6 col-sm-6 col-xs-12">
            <label class="txt-small"><small>F. nacimiento *:</small></label>
              <input type="date" 
                     class="form-control input-small" 
                     id="fecha_nacimiento" 
                     name="fecha_nacimiento" 
                     value="{{ ($cliente->fecha_nacimiento) ? 
                               substr($cliente->fecha_nacimiento,0,4).'-'.
                               substr($cliente->fecha_nacimiento,5,2).'-'.
                               substr($cliente->fecha_nacimiento,8,2) : ''}}">
            </div>    
           </div>

          <br>   
          <label class="title-section">Datos del cónyuge  </label>
          <hr class="linea">


          <div class="form-group marg-bott-small">

            <div class="col-md-6 col-sm-6 col-xs-12 ">

              <label class="txt-small">Primer nombre conyuge*:</label>
              <input type="text" 
                     class="form-control input-small" 
                     placeholder="primer nombre cónyuge" 
                     id="p_nombrey" 
                     name="p_nombrey"  
                     value="{{ ($cliente->conyuge) ? $cliente->conyuge->p_nombrey : '' }}">

            </div>

            <div class="col-md-6 col-sm-6 col-xs-12">

              <label class="txt-small">Segundo nombre cónyuge :</label>
              <input type="text" 
                     class="form-control input-small" 
                     placeholder="segundo nombre cóyuge" 
                     id="s_nombrey" 
                     name="s_nombrey"  
                     value="{{ ($cliente->conyuge) ? $cliente->conyuge->s_nombrey : '' }}">

            </div>
          </div>  

          <div class="form-group marg-bott-small">  

            <div class="col-md-6 col-sm-6 col-xs-12">

              <label class="txt-small">Primer apellido cónyuge *:</label>
              <input type="text" 
                     class="form-control input-small" 
                     placeholder="primer apellido" 
                     id="p_apellidoy" 
                     name="p_apellidoy"  
                     value="{{ ($cliente->conyuge) ? $cliente->conyuge->p_apellidoy : ''}}">
            </div>


            <div class="col-md-6 col-sm-6 col-xs-12">

              <label class="txt-small">Segundo apellido cónyuge :</label>
              <input type="text" 
                     class="form-control input-small" 
                     placeholder="segundo apellido cónyuge" 
                     id="s_apellidoy" 
                     name="s_apellidoy"  
                     value="{{ ($cliente->conyuge) ? $cliente->conyuge->s_apellidoy : '' }}">
            </div>
          </div>                   

            <!-- NUM DOC **************************************************************************-->
          <div class="form-group marg-bott-small">  

            <div class="col-md-6 col-sm-6 col-xs-12">
              <label class="txt-small">Tipo de documento cónyuge :</label>
              <select class="form-control input-small" id="tipo_docy" name="tipo_docy">
                <option value="" disabled selected hidden=""></option>
                @foreach($tipos_documentoy as $tipo_docy)
                  <option value="{{$tipo_docy}}" 
                          {{ ( $cliente->conyuge && $cliente->conyuge->tipo_docy == $tipo_docy ? "selected":"") }}>
                          {{ $tipo_docy }}
                  </option>
                @endforeach
              </select>

            </div>

            <div class="col-md-6 col-sm-6 col-xs-12">
              <label class="txt-small">Documento cónyuge *: </label>
              <input type="number" 
                     class="form-control input-small " 
                     placeholder="#" 
                     id="num_docy" 
                     name="num_docy" 
                     value="{{ ($cliente->conyuge) ? $cliente->conyuge->num_docy : '' }}">
            </div>
          </div>

            <div class="form-group marg-bott-small">    
              <!-- MOVIL -->

              <div class="col-md-6 col-sm-6 col-xs-12">
                <label class="txt-small">Celular conyuge *:</label>
                  <input type="text" 
                         class="form-control input-small" 
                         id="movily" 
                         name="movily" 
                         value="{{ ($cliente->conyuge) ? $cliente->conyuge->movily : ''}}">
              </div>
              
              <!-- Fijo -->

              <div class="col-md-6 col-sm-6 col-xs-12">
                <label class="txt-small">Teléfono conyuge :</label>
                  <input type="text" 
                         class="form-control input-small" 
                         id="fijoy" 
                         name="fijoy" 
                         value="{{ ($cliente->conyuge) ? $cliente->conyuge->fijoy : '' }}">
              </div>
            </div>


            <!-- DIRECCIÓN CONYUGE *******-->

            <div class="form-group marg-bott-small">

              <div class="col-md-12 col-sm-12 col-xs-12">
                <label class="txt-small">Dirección conyuge*:</label>
                  <input type="text" 
                         class="form-control input-small" 
                         id="diry" 
                         name="diry" 
                         value="{{ ($cliente->conyuge) ? $cliente->conyuge->diry : '' }}">
              </div>
            </div>
            

            <br>   
            <label class="title-section">Datos de ubicación</label>
            <hr class="linea">


          <!-- DIRECCION **************************************************************************-->
          <div class="form-group">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <label class="txt-small">Dirección *:</label>
              <input type="text" 
                     class="form-control input-small" 
                     placeholder="ingrese dirección" 
                     id="direccion" 
                     name="direccion"  
                     value="{{$cliente->direccion}}">
            </div>
          </div>  
            <!-- BARRIO **************************************************************************-->
          <div class="form-group">  
            <div class="col-md-6 col-sm-6 col-xs-12">
              <label class="txt-small">Barrio/Vereda *: </label>
              <input type="text" 
                     class="form-control input-small" 
                     placeholder="ingrese barrio" 
                     id="barrio" 
                     name="barrio" 
                     value="{{$cliente->barrio}}">

            </div>

            <!-- MUNICIIPIO **************************************************************************-->
            <div class="col-md-6 col-sm-6 col-xs-12">
              <label>Municipio *:</label>
              <select class="form-control input-small" name="municipio_id" id="municipio_id" required>
               <option value="" disabled selected hidden="">- -</option>
               @foreach($municipios as $municipio)
                  <option value="{{$municipio->id}}" {{ $cliente->municipio->id == $municipio->id ? "selected":"" }}>
                    {{$municipio->nombre.' ('.$municipio->departamento.')'}}</option>
               @endforeach  

             </select>
           </div>
           </div>

           <div class="form-group">
           <!-- MOVIL **************************************************************************-->
            <div class="col-md-6 col-sm-6 col-xs-12">
              <label class="txt-small">Celular *:</label>
              <input type="tel" class="form-control input-small" placeholder="ingrese # celular" id="movil" name="movil"  value="{{$cliente->movil}}">
            </div>
            <!-- FIJO **************************************************************************-->
            <div class="col-md-6 col-sm-6 col-xs-12">
              <label class="txt-small">Telefono : </label>
              <input type="tel" class="form-control input-small" placeholder="ingrese # teléfono" id="fijo" name="fijo" value="{{$cliente->fijo}}">
            </div>
          </div>    

          <div class="form-group marg-bott-small"> 
            <div class="col-md-12 col-sm-12 col-xs-12">
              <label>Email :</label>
            <input type="email" class="form-control input-small" placeholder="correo electrónico" id="email" name="email" value="{{ $cliente->email }}"  size="60">
          </div>
      </div>         

        <br>

    <label class="title-section">Datos laborales</label>
    <hr class="linea">       

         <!-- OCUPACION **************************************************************************-->
         <div class="form-group">
            <div class="col-md-6 col-sm-6 col-xs-12">
              <label class="txt-small">Ocupación *:</label>
              <input type="text" class="form-control input-small" placeholder="ingrese ocupación" id="ocupacion" name="ocupacion"  value="{{$cliente->ocupacion}}">
            </div>
            <!-- TIPO DE ACTIVIDAD *****************************************************-->
            <div class="col-md-6 col-sm-6 col-xs-12">
              <label class="txt-small"><small>Tipo  Actividad *: </small></label>
              <select class="form-control input-small" name="tipo_actividad" id="tipo_actividad">
              @foreach($tipo_actividades as $tipo_actividad)
               <option value="{{$tipo_actividad}}" {{ $cliente->tipo_actividad == $tipo_actividad ? "selected":"" }}>{{$tipo_actividad}}</option>
              @endforeach 
              </select> 
            </div>
           </div> 

           <div class="form-group marg-bott-small">
         <!-- EMPRESA **************************************************************************-->
            <div class="col-md-6 col-sm-6 col-xs-12">
              <label class="txt-small">Nombre empresa :</label>
              <input type="text" 
                     class="form-control input-small" 
                     placeholder="ingrese empresa" 
                     id="empresa" 
                     name="empresa"  
                     value="{{$cliente->empresa}}">
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <label class="txt-small">Teléfono empresa :</label>
              <input type="text" 
                     class="form-control input-small" 
                     placeholder="ingrese teléfono empresa" 
                     id="tel_empresa" 
                     name="tel_empresa"  
                     value="{{ $cliente->tel_empresa }}">
            </div>
          </div>  

            <!-- DIRECCION EMPRESA -->
          <div class="form-group marg-bott-small">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <label class="txt-small">Dirección empresa :</label>
              <input type="text" 
                     class="form-control input-small" 
                     placeholder="ingrese dirección empresa" 
                     id="dir_empresa" 
                     name="dir_empresa"  
                     value="{{ $cliente->dir_empresa }}">
            </div>
          </div>

          <!-- PLACA VEHIUCLO **************************************************************************-->
        <div class="form-group" > 
          <div class="col-md-6 col-sm-6 col-xs-12">
            <label>Placa :</label>
          <input type="text" class="form-control input-small" placeholder="placa" id="placa" name="placa" value="{{$cliente->placa}}">
        </div>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <label>F. vencimiento SOAT :</label>
          <input type="date" class="form-control input-small" id="soat" name="soat" value="{{ ($cliente->soat) ? $cliente->soat->vencimiento : ''}}">
        </div>
      </div>
          <!-- Email VEHIUCLO **************************************************************************-->




         <!-- BOTONES **************************************************************************-->
