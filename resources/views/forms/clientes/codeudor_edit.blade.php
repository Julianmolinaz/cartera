
<div style="margin-top:-9px;margin-bottom:15px;">      
  Con codeudor: Si
  <input type="radio"  name="codeudor" id="codeudor" value="si" checked="checked"
  <?php if(Request::old('codeudor')== "si") { echo 'checked="checked"'; } ?>/> 
  No:
  <input type="radio"  name="codeudor" id="codeudor" value="no" 
  <?php if(Request::old('codeudor')== "no") { echo 'checked="checked"'; } ?>/>
</div>

<label class="title-section">Datos personales del codeudor</label>
<hr class="linea">  

<div class="form-group marg-bott-small">

  <div class="col-md-6 col-sm-6 col-xs-12">
    <label class="txt-small">Primer nombre *:</label>
    <input type="text" 
           class="form-control input-small" 
           placeholder="primer nombre" 
           id="primer_nombrec" 
           name="primer_nombrec"  
           value="{{$cliente->codeudor->primer_nombrec}}">
  </div>


  <div class="col-md-6 col-sm-6 col-xs-12">
    <label class="txt-small">Segundo nombre :</label>
    <input type="text" 
           class="form-control input-small" 
           placeholder="segundo nombre" 
           id="segundo_nombrec" 
           name="segundo_nombrec"  
           value="{{$cliente->codeudor->segundo_nombrec}}">
  </div>

</div>  

<div class="form-group marg-bott-small"> 

  <div class="col-md-6 col-sm-6 col-xs-12">
    <label class="txt-small">Primer Apellido *:</label>
    <input type="text" 
           class="form-control input-small" 
           placeholder="primer apellido" id="primer_apellidoc" 
           name="primer_apellidoc"  
           value="{{$cliente->codeudor->primer_apellidoc}}">
  </div>


  <div class="col-md-6 col-sm-6 col-xs-12">
    <label class="txt-small">Segundo Apellido :</label>
    <input type="text" 
           class="form-control input-small" 
           placeholder="segundo apellido" 
           id="segundo_apellidoc" 
           name="segundo_apellidoc"  
           value="{{$cliente->codeudor->segundo_apellidoc}}">
  </div>

</div>  

<div class="form-group marg-bott-small">

  <div class="col-md-6 col-sm-6 col-xs-12">
    <label>Tipo de documento *:</label>
    <select class="form-control input-small" 

            id="tipo_docc" 
            name="tipo_docc">
      <option value="" disabled selected hidden=""></option>
      @foreach($tipos_documentoc as $tipo_docc)
        <option value="{{$tipo_docc}}" 
          {{ $cliente->codeudor->tipo_docc == $tipo_docc ? "selected":"" }}>
          {{$tipo_docc}}
        </option>
      @endforeach
    </select>

  </div>

<!--NUMERO DOCUMENTO  /////////////////////////////////////////////////////////////-->
  <div class="col-md-6 col-sm-6 col-xs-12">
    <label class="txt-small">Documento *:</label>            
    <input type="number" 
           class="form-control input-small" 
           id="" 
           name="num_docc" 
           value="{{$cliente->codeudor->num_docc}}" 
           autocomplete="on" 
           placeholder="documento">
  </div>
  
</div>

  <div class="form-group marg-bott-small">
   <div class="col-md-6 col-sm-6 col-xs-12">
    <label class="txt-small">F. nacimiento *:</label>
      <input type="date" 
             class="form-control input-small" 
             id="fecha_nacimientoc" 
             name="fecha_nacimientoc" 
             value="{{$cliente->codeudor->fecha_nacimientoc}}">
  </div>
    
 </div>

<!-- 

  ********************** DATOS DEL CONYUGE ********************** -->

<br>   
<label class="title-section">Datos del conyuge <i><small>(si aplica)</small></i></label>
<hr class="linea"> 

<div class="form-group marg-bott-small">

  <div class="col-md-6 col-sm-6 col-xs-12 ">

    <label class="txt-small">Primer nombre conyuge*:</label>
    <input type="text" 
           class="form-control input-small" 
           placeholder="primer nombre cónyuge" 
           id="p_nombreyc" 
           name="p_nombreyc"  
           value="{{ ($cliente->codeudor->conyuge) ? $cliente->codeudor->conyuge->p_nombrey : ''}}">

  </div>

  <div class="col-md-6 col-sm-6 col-xs-12">

    <label class="txt-small">Segundo nombre cónyuge :</label>
    <input type="text" 
           class="form-control input-small" 
           placeholder="segundo nombre cóyuge" 
           id="s_nombreyc" 
           name="s_nombreyc"  
           value="{{ ($cliente->codeudor->conyuge) ? $cliente->codeudor->conyuge->s_nombrey : '' }}">

  </div>
</div>  

<div class="form-group marg-bott-small">  

  <div class="col-md-6 col-sm-6 col-xs-12">

    <label class="txt-small">Primer apellido cónyuge *:</label>
    <input type="text" 
           class="form-control input-small" 
           placeholder="primer apellido" 
           id="p_apellidoyc" 
           name="p_apellidoyc"  
           value="{{ ($cliente->codeudor->conyuge) ? $cliente->codeudor->conyuge->p_apellidoy : ''}}">
  </div>


  <div class="col-md-6 col-sm-6 col-xs-12">

    <label class="txt-small">Segundo apellido cónyuge :</label>
    <input type="text" 
           class="form-control input-small" 
           placeholder="segundo apellido cónyuge" 
           id="s_apellidoyc" 
           name="s_apellidoyc"  
           value="{{ ($cliente->codeudor->conyuge) ? $cliente->codeudor->conyuge->s_apellidoy :'' }}">
  </div>
</div>                   

  <!-- NUM DOC **************************************************************************-->
<div class="form-group marg-bott-small">  

  <div class="col-md-6 col-sm-6 col-xs-12">
    <label class="txt-small">Tipo de documento cónyuge :</label>
    <select class="form-control input-small" id="tipo_docyc" name="tipo_docyc">
      <option value="" disabled selected hidden=""></option>
      @foreach($tipos_documentoy as $tipo_docyc)
        <option value="{{$tipo_docyc}}" {{ ($cliente->codeudor->conyuge) ?  (($cliente->codeudor->conyuge->tipo_docy == $tipo_docyc) ? "selected":"" ) : '' }}>
          {{ $tipo_docyc }}
        </option>
      @endforeach
    </select>

  </div>

  <div class="col-md-6 col-sm-6 col-xs-12">
    <label class="txt-small">Documento cónyuge : </label>
    <input type="number" 
           class="form-control input-small " 
           placeholder="#" 
           id="num_docyc" 
           name="num_docyc" 
           value="{{ ($cliente->codeudor->conyuge ) ? $cliente->codeudor->conyuge->num_docy :''}}">
  </div>
</div>

  <div class="form-group marg-bott-small">    
    <!-- MOVIL -->

    <div class="col-md-6 col-sm-6 col-xs-12">
      <label class="txt-small">Celular cónyuge :</label>
        <input type="text" 
               class="form-control input-small" 
               id="movilyc" 
               name="movilyc" 
               value="{{ ($cliente->codeudor->conyuge) ? $cliente->codeudor->conyuge->movily : ''}}">
    </div>
    
    <!-- Fijo -->

    <div class="col-md-6 col-sm-6 col-xs-12">
      <label class="txt-small">Teléfono  cónyuge:</label>
        <input type="text" 
               class="form-control input-small" 
               id="fijoyc" 
               name="fijoyc" 
               value="{{ ($cliente->codeudor->conyuge) ? $cliente->codeudor->conyuge->fijoy :''}}">
    </div>
  </div>


  <!-- DIRECCIÓN CONYUGE *******-->

  <div class="form-group marg-bott-small">

    <div class="col-md-12 col-sm-12 col-xs-12">
      <label class="txt-small">Dirección cónyuge*:</label>
        <input type="text" 
               class="form-control input-small" 
               id="diryc" 
               name="diryc" 
               value="{{ ($cliente->codeudor->conyuge) ? $cliente->codeudor->conyuge->diry : ''}}">
    </div>
  </div>

  <!-- DATOS DE UBICACIÓN  ***********************-->

  <br>   
  <label class="title-section">Datos de ubicación</label>
  <hr class="linea">  
 <!-- DIRECCION **************************************************************************-->
      <div class="form-group marg-bott-small">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <label class="txt-small">Dirección *:</label>
          <input type="text" 
                 class="form-control input-small" 
                 placeholder="dirección" 
                 id="direccionc" 
                 name="direccionc"  
                 value="{{$cliente->codeudor->direccionc}}">
        </div>
      </div>
      
      <div class="form-group marg-bott-small">  
        <!-- BARRIO **************************************************************************-->
        <div class="col-md-6 col-sm-6 col-xs-12">
          <label class="txt-small">Barrio/Vereda  *: </label>
          <input type="text" 
                 class="form-control input-small" 
                 placeholder="ingrese barrio" 
                 id="barrioc" 
                 name="barrioc" 
                 value="{{$cliente->codeudor->barrioc}}">

        </div>

        <!-- MUNICIIPIO **************************************************************************-->
        <div class="col-md-6 col-sm-6 col-xs-12">
          <label>Municipio *:</label>
          <select class="form-control input-small" name="municipioc_id" id="municipioc_id">
           <option value="" disabled selected hidden="">- -</option>
           @foreach($municipios as $municipio)
           <option value="{{$municipio->id}}" {{ $cliente->codeudor->municipioc_id == $municipio->id ? "selected":"" }}>{{$municipio->nombre.' ('.$municipio->departamento.')'}}</option>
           @endforeach
         </select>
       </div>
       </div>

         <div class="form-group marg-bott-small">

      <!-- MOVIL **************************************************************************-->
      <div class="col-md-6 col-sm-6 col-xs-12">
        <label class="txt-small">Celular *:</label>
        <input type="tel" 
               class="form-control input-small" 
               placeholder="ingrese # celular" 
               id="movilc" 
               name="movilc"  
               value="{{$cliente->codeudor->movilc}}">
      </div>
      <!-- FIJO **************************************************************************-->
      <div class="col-md-6 col-sm-6 col-xs-12">
        <label class="txt-small">Telefono : </label>
        <input type="tel" 
               class="form-control input-small" 
               placeholder="ingrese # teléfono" 
               id="fijoc" 
               name="fijoc" 
               value="{{$cliente->codeudor->fijoc}}">

      </div>    
    </div>
    <div class="form-group marg-bott-small"> 
      <div class="col-md-12 col-sm-12 col-xs-12">
        <label>Email :</label>
       <input type="email" 
              class="form-control input-small" 
              placeholder="correo electrónico" 
              id="emailc" 
              name="emailc" 
              value="{{$cliente->codeudor->emailc}}">
     </div>
   </div>

<!-- DATOS LABORALES **************************** -->

<br>   
<label class="title-section">Datos laborales</label>
<hr class="linea">  

  <div class="form-group marg-bott-small">           
    <div class="col-md-6 col-sm-6 col-xs-12">
      <label class="txt-small">Ocupación *:</label>
      <input type="text" 
             class="form-control input-small" 
             placeholder="ocupación" 
             id="ocupacionc" 
             name="ocupacionc"  
             value="{{$cliente->codeudor->ocupacionc}}">
    </div>

    <!-- TIPO DE ACTIVIDAD *****************************************************-->
    <div class="col-md-6 col-sm-6 col-xs-12">
      <label class="txt-small">Tipo de actividad *: </label>

      <select class="form-control input-small" name="tipo_actividadc" id="tipo_actividadc">
        <option value="" disabled selected hidden="">- -</option>
        @foreach($tipo_actividades as $tipo_actividad)
          <option value="{{$tipo_actividad}}" {{ $cliente->codeudor->tipo_actividadc == $tipo_actividad ? "selected":"" }}>{{$tipo_actividad}}</option>
        @endforeach
      </select>

    </div>
  </div>  

 <!-- EMPRESA **************************************************************************-->
 <div class="form-group marg-bott-small">
    <div class="col-md-6 col-sm-6 col-xs-12">
      <label class="txt-small">Nombre empresa :</label>
      <input type="text" 
             class="form-control input-small" 
             placeholder="ingrese empresa" 
             id="empresac" 
             name="empresac"  
             value="{{$cliente->codeudor->empresac}}">
    </div>
    <div class="col-md-6 col-sm-6 col-xs-12">
      <label class="txt-small">Teléfono empresa :</label>
      <input type="text" 
             class="form-control input-small" 
             placeholder="ingrese telefono empresa" 
             id="tel_empresac" 
             name="tel_empresac" 
             value="{{ $cliente->codeudor->tel_empresac }}">
    </div>
  </div>  
     <div class="form-group marg-bott-small">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <label class="txt-small">Dirección empresa :</label>
      <input type="text" 
             class="form-control input-small" 
             placeholder="ingrese empresa" 
             id="dir_empresac" 
             name="dir_empresac" 
             value="{{ $cliente->codeudor->dir_empresac}}">
    </div>
  </div>

    <!-- PLACA VEHIUCLO **************************************************************************-->
  <div class="form-group" > 
    <div class="col-md-6 col-sm-6 col-xs-12">
      <label>Placa :</label>
     <input type="text" 
            class="form-control input-small" 
            placeholder="placa" 
            id="placac" 
            name="placac" 
            value="{{$cliente->codeudor->placac}}">
   </div>
    <div class="col-md-6 col-sm-6 col-xs-12">
      <label>F. vencimiento SOAT :</label>
     <input type="date" 
            class="form-control input-small" 
            id="soatc" 
            name="soatc" 
            value="{{($cliente->codeudor->soat) ? $cliente->codeudor->soat->vencimiento : ''}}">
   </div>
 </div>

  <!-- PLACA VEHIUCLO **************************************************************************-->



