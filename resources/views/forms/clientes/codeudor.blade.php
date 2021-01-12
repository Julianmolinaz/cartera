
<div style="margin-top:-9px;margin-bottom:15px;">      
  Con codeudor: Si
  <input type="radio"  name="codeudor" id="codeudor" value="si" checked="checked"
  <?php if(Request::old('codeudor')== "si") { echo 'checked="checked"'; } ?>/> 
  No:
  <input type="radio"  name="codeudor" id="codeudor" value="no" 
  <?php if(Request::old('codeudor')== "no") { echo 'checked="checked"'; } ?>/>
</div>


<!-- ******************** DATOS PERSONALES ****************** -->
 
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
           value="{{old('primer_nombrec')}}">
  </div>


  <div class="col-md-6 col-sm-6 col-xs-12">
    <label class="txt-small">Segundo nombre :</label>
    <input type="text" 
           class="form-control input-small" 
           placeholder="segundo nombrec" 
           id="segundo_nombrec" 
           name="segundo_nombrec"  
           value="{{old('segundo_nombrec')}}">
  </div>

</div>  

<div class="form-group marg-bott-small"> 

  <div class="col-md-6 col-sm-6 col-xs-12">
    <label class="txt-small">Primer Apellido *:</label>
    <input type="text" 
           class="form-control input-small" 
           placeholder="primer apellido" 
           id="primer_apellidoc" 
           name="primer_apellidoc"  
           value="{{old('primer_apellidoc')}}">
  </div>


  <div class="col-md-6 col-sm-6 col-xs-12">
    <label class="txt-small">Segundo Apellido :</label>
    <input type="text" 
           class="form-control input-small" 
           placeholder="segundo apellido" 
           id="segundo_apellidoc" 
           name="segundo_apellidoc"  
           value="{{old('segundoapellidoc')}}">
  </div>

</div>  

<div class="form-group marg-bott-small">

  <div class="col-md-6 col-sm-6 col-xs-12">
    <label class="txt-small">Tipo documento *:</label>
    <select class="form-control input-small" 
            id="tipo_docc" 
            name="tipo_docc">
      <option value="" disabled selected hidden=""></option>
      @foreach($tipos_documento as $tipo_docc)
        <option value="{{$tipo_docc}}" {{ (old("tipo_docc") == $tipo_docc ? "selected":"") }}>{{$tipo_docc}}</option>
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
           value="{{(old('num_docc'))}}" 
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
             value="{{old('fecha_nacimientoc')}}">
  </div>
  
</div>


<!-- ********************** DATOS DEL CONYUGE ********************** -->

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
           value="{{old('p_nombreyc')}}">

  </div>

  <div class="col-md-6 col-sm-6 col-xs-12">

    <label class="txt-small">Segundo nombre cónyuge :</label>
    <input type="text" 
           class="form-control input-small" 
           placeholder="segundo nombre cóyuge" 
           id="s_nombreyc" 
           name="s_nombreyc"  
           value="{{old('s_nombreyc')}}">

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
           value="{{old('p_apellidoyc')}}">
  </div>


  <div class="col-md-6 col-sm-6 col-xs-12">

    <label class="txt-small">Segundo apellido cónyuge :</label>
    <input type="text" 
           class="form-control input-small" 
           placeholder="segundo apellido cónyuge" 
           id="s_apellidoyc" 
           name="s_apellidoyc"  
           value="{{old('s_apellidoyc')}}">
  </div>
</div>                   

  <!-- NUM DOC **************************************************************************-->
<div class="form-group marg-bott-small">  

  <div class="col-md-6 col-sm-6 col-xs-12">
    <label class="txt-small">Tipo de documento cónyuge :</label>
    <select class="form-control input-small" id="tipo_docyc" name="tipo_docyc">
      <option value="" disabled selected hidden=""></option>
      @foreach($tipos_documentoy as $tipo_docyc)
        <option value="{{$tipo_docyc}}" {{ (old("tipo_docyc") == $tipo_docyc ? "selected":"") }}>
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
           value="{{old('num_docyc')}}">
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
               value="{{old('movilyc')}}">
    </div>
    
    <!-- Fijo -->

    <div class="col-md-6 col-sm-6 col-xs-12">
      <label class="txt-small">Teléfono  cónyuge:</label>
        <input type="text" 
               class="form-control input-small" 
               id="fijoyc" 
               name="fijoyc" 
               value="{{old('fijoyc')}}">
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
               value="{{old('diryc')}}">
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
             value="{{old('direccionc')}}">
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
             value="{{old('barrioc')}}">

    </div>

    <!-- MUNICIPIO **************************************************************************-->
    <div class="col-md-6 col-sm-6 col-xs-12">
      <label class="txt-small">Municipio *:</label>
      <select class="form-control input-small" name="municipioc_id" id="municipioc_id">
       <option value="" disabled selected hidden="">- -</option>
       @foreach($municipios as $municipio)
       <option value="{{$municipio->id}}" {{ (old("municipioc_id") == $municipio->id ? "selected":"") }}>{{$municipio->nombre.' ('.$municipio->departamento.')'}}</option>
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
           value="{{old('movilc')}}">
  </div>
  <!-- FIJO **************************************************************************-->
  <div class="col-md-6 col-sm-6 col-xs-12">
    <label class="txt-small">Telefono : </label>
    <input type="tel" 
           class="form-control input-small" 
           placeholder="ingrese # teléfono" 
           id="fijoc" 
           name="fijoc" 
           value="{{old('fijoc')}}">

  </div>    
</div>
  <div class="form-group" > 
    <div class="col-md-12 col-sm-12 col-xs-12">
      <label class="txt-small">Email :</label>
     <input type="email" 
            class="form-control input-small" 
            placeholder="correo electrónico" 
            id="emailc" 
            name="emailc" 
            value="{{old('emailc')}}">
   </div>
 </div>

<!-- DATOS LABORALES **************************** -->

<br>   
<label class="title-section">Datos laborales</label>
<hr class="linea">  
  <!-- OCUPACION ******************************************-->

<div class="form-group marg-bott-small">           
  <div class="col-md-6 col-sm-6 col-xs-12">
    <label class="txt-small">Ocupación *:</label>
    <input type="text" 
           class="form-control input-small" 
           placeholder="ocupación" 
           id="ocupacionc" 
           name="ocupacionc"  
           value="{{old('ocupacionc')}}">
  </div>

  <!-- TIPO DE ACTIVIDAD *****************************************************-->
  <div class="col-md-6 col-sm-6 col-xs-12">
    <label class="txt-small">Tipo de actividad *: </label>

    <select class="form-control input-small" name="tipo_actividadc" id="tipo_actividadc">
      <option value="" disabled selected hidden="">- -</option>
      @foreach($tipo_actividades as $tipo_actividad)
        <option value="{{$tipo_actividad}}" {{ (old("tipo_actividadc") == $tipo_actividad ? "selected":"") }}>{{$tipo_actividad}}</option>
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
             value="{{old('empresac')}}">
    </div>
    <div class="col-md-6 col-sm-6 col-xs-12">
      <label class="txt-small">Teléfono empresa :</label>
      <input type="text" 
             class="form-control input-small" 
             placeholder="ingrese telefono empresa" 
             id="tel_empresac" 
             name="tel_empresac" 
             value="{{old('tel_empresac')}}">
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
             value="{{old('dir_empresac')}}">
    </div>
  </div>

    <!-- PLACA VEHIUCLO **************************************************************************-->
  <div class="form-group marg-bott-small"> 
    <div class="col-md-6 col-sm-6 col-xs-12">
      <label class="txt-small">Placa :</label>
     <input type="text" 
            class="form-control input-small" 
            placeholder="placa" 
            id="placac" 
            name="placac" 
            value="{{old('placac')}}">
   </div>
    <div class="col-md-6 col-sm-6 col-xs-12">
      <label class="txt-small">F. vencimiento SOAT :</label>
     <input type="date" 
            class="form-control input-small" 
            id="soatc"
            name="soatc" 
            value="{{old('soatc')}}">
   </div>
 </div>
    <!-- PLACA VEHIUCLO **************************************************************************-->



