 

<div class="form-group marg-bott-small">

  <div class="col-md-12 col-sm-12 col-xs-12 ">  
    <label class="title-section">Datos personales del solicitante</label>
    <hr class="linea">
  </div>

  <div class="col-md-6 col-sm-6 col-xs-12 ">


    <label class="txt-small">Primer nombre *:</label>
    <input type="text" 
           class="form-control input-small" 
           placeholder="primer nombre" 
           id="primer_nombre" 
           name="primer_nombre"  
           value="{{old('primer_nombre')}}">

  </div>


  <div class="col-md-6 col-sm-6 col-xs-12">
    <label class="txt-small">Segundo nombre :</label>
    <input type="text" 
           class="form-control input-small" 
           placeholder="segundo nombre" 
           id="segundo_nombre" 
           name="segundo_nombre"  
           value="{{old('segundo_nombre')}}">
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
           value="{{old('primer_apellido')}}">
  </div>


  <div class="col-md-6 col-sm-6 col-xs-12">
    <label class="txt-small">Segundo Apellido :</label>
    <input type="text" 
           class="form-control input-small" 
           placeholder="segundo apellido" 
           id="segundo_apellido" 
           name="segundo_apellido"  
           value="{{old('segundo_apellido')}}">
  </div>
</div>                   

  <!-- NUM DOC **************************************************************************-->
<div class="form-group marg-bott-small">  

  <div class="col-md-6 col-sm-6 col-xs-12">
    <label class="txt-small">Tipo de documento *:</label>
    <select class="form-control input-small" 
            id="tipo_doc" 
            name="tipo_doc">

      <option value="" disabled selected hidden=""></option>
      @foreach($tipos_documento as $tipo_doc)
        <option value="{{$tipo_doc}}" {{ (old("tipo_doc") == $tipo_doc ? "selected":"") }}>{{$tipo_doc}}</option>
      @endforeach
    </select>

  </div>

  <div class="col-md-6 col-sm-6 col-xs-12">
    <label class="txt-small">Documento *: </label>
    <input type="number" 
           class="form-control input-small" 
           placeholder="#" 
           id="num_doc" 
           name="num_doc" 
           value="{{old('num_doc')}}">
  </div>
</div>  
  <!-- FECHA NACIMIENTO***************************************************************-->

<div class="form-group marg-bott-small">
  <div class="col-md-6 col-sm-6 col-xs-12">
    <label class="txt-small">F. nacimiento *:</label>
      <input type="date" 
             class="form-control input-small" 
             id="fecha_nacimiento" 
             name="fecha_nacimiento" 
             value="{{old('fecha_nacimiento')}}">
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
           value="{{old('p_nombrey')}}">

  </div>

  <div class="col-md-6 col-sm-6 col-xs-12">

    <label class="txt-small">Segundo nombre cónyuge :</label>
    <input type="text" 
           class="form-control input-small" 
           placeholder="segundo nombre cóyuge" 
           id="s_nombrey" 
           name="s_nombrey"  
           value="{{old('s_nombrey')}}">

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
           value="{{old('p_apellidoy')}}">
  </div>


  <div class="col-md-6 col-sm-6 col-xs-12">

    <label class="txt-small">Segundo apellido cónyuge :</label>
    <input type="text" 
           class="form-control input-small" 
           placeholder="segundo apellido cónyuge" 
           id="s_apellidoy" 
           name="s_apellidoy"  
           value="{{old('s_apellidoy')}}">
  </div>
</div>                   

  <!-- NUM DOC **************************************************************************-->
<div class="form-group marg-bott-small">  

  <div class="col-md-6 col-sm-6 col-xs-12">
    <label class="txt-small">Tipo de documento cónyuge :</label>
    <select class="form-control input-small" id="tipo_docy" name="tipo_docy">
      <option value="" disabled selected hidden=""></option>
      @foreach($tipos_documento as $tipo_docy)
        <option value="{{$tipo_docy}}" {{ (old("tipo_docy") == $tipo_docy ? "selected":"") }}>
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
           value="{{old('num_docy')}}">
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
               value="{{old('movily')}}">
    </div>
    
    <!-- Fijo -->

    <div class="col-md-6 col-sm-6 col-xs-12">
      <label class="txt-small">Teléfono conyuge :</label>
        <input type="text" 
               class="form-control input-small" 
               id="fijoy" 
               name="fijoy" 
               value="{{old('fijoy')}}">
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
               value="{{old('diry')}}">
    </div>
  </div>
  

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
           id="direccion" 
           name="direccion"  
           value="{{old('direccion')}}">
  </div>
</div>
          
<div class="form-group marg-bott-small">  
  <!-- BARRIO **************************************************************************-->
  <div class="col-md-6 col-sm-6 col-xs-12">
    <label class="txt-small">Barrio/Vereda  *: </label>
    <input type="text" 
           class="form-control input-small" 
           placeholder="ingrese barrio" 
           id="barrio" 
           name="barrio" 
           value="{{old('barrio')}}">

  </div>

  <!-- MUNICIIPIO **************************************************************************-->
  <div class="col-md-6 col-sm-6 col-xs-12">
    <label class="txt-small">Municipio *:</label>
    <select class="form-control input-small" name="municipio_id" id="municipio_id">
       <option value="" disabled selected hidden="">- -</option>
       @foreach($municipios as $municipio)
       <option value="{{$municipio->id}}" {{ (old("municipio_id") == $municipio->id ? "selected":"") }}>{{$municipio->nombre.' ('.$municipio->departamento.')'}}</option>
       @endforeach
   </select>
 </div>
 </div>

 <div class="form-group marg-bott-small">
 <!-- MOVIL **************************************************************************-->
  <div class="col-md-6 col-sm-6 col-xs-12">
    <label class="txt-small">Celular *:</label>
    <input type="tel" class="form-control input-small" placeholder="ingrese # celular" id="movil" name="movil"  value="{{old('movil')}}">
  </div>
  <!-- FIJO **************************************************************************-->
  <div class="col-md-6 col-sm-6 col-xs-12">
    <label class="txt-small">Telefono : </label>
    <input type="tel" 
           class="form-control input-small" 
           placeholder="ingrese # teléfono" 
           id="fijo" 
           name="fijo" 
           value="{{old('fijo')}}">

  </div>
</div>  

    <!-- Email **************************************************************************-->
  <div class="form-group marg-bott-small" > 
    <div class="col-md-12 col-sm-12 col-xs-12">
      <label class="txt-small">Email :</label>
      <input type="email" 
            class="form-control input-small" 
            placeholder="correo electrónico" 
            id="email" 
            name="email" 
            value="{{old('email')}}"  
            size="60">
   </div>
 </div>
  
  <br>

    <label class="title-section">Datos laborales</label>
    <hr class="linea">

                     
<!-- OCUPACION **************************************************************************-->

<div class="form-group marg-bott-small">           
  <div class="col-md-6 col-sm-6 col-xs-12">
    <label class="txt-small">Ocupación *:</label>
    <input type="text-small" 
           class="form-control input-small" 
           placeholder="ocupación" 
           id="ocupacion" 
           name="ocupacion"  
           value="{{old('ocupacion')}}">
  </div>

              <!-- TIPO DE ACTIVIDAD *****************************************************-->
  <div class="col-md-6 col-sm-6 col-xs-12">
    <label class="txt-small">Tipo de actividad *: </label>
    <select class="form-control input-small" 
            name="tipo_actividad" 
            id="tipo_actividad">
     <option value="" disabled selected hidden="">- -</option>
        @foreach($tipo_actividades as $tipo_actividad)
            <option value="{{$tipo_actividad}}" {{ (old("tipo_actividad") == $tipo_actividad ? "selected":"") }}>{{$tipo_actividad}}</option>
     @endforeach
   </select>
  </div>
</div>  

 <!-- EMPRESA **************************************************************************-->
 <div class="form-group marg-bott-small">
    
    <div class="col-md-6 col-sm-6 col-xs-12">
      <label class="txt-small ">Nombre empresa :</label>
      <input type="text" 
              class="form-control input-small" 
              placeholder="ingrese empresa" 
              id="empresa" 
              name="empresa"  
              value="{{old('empresa')}}">
    </div>
    <div class="col-md-6 col-sm-6 col-xs-12">
      <label class="txt-small">Teléfono empresa :</label>
      <input type="text" 
             class="form-control input-small" 
             placeholder="ingrese teléfono empresa" 
             id="tel_empresa" 
             name="tel_empresa"  
             value="{{old('tel_empresa')}}">
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
             value="{{old('dir_empresa')}}">
    </div>
  </div>

    <!-- PLACA VEHIUCLO **************************************************************************-->
  <div class="form-group marg-bott-small" > 

    <div class="col-md-6 col-sm-6 col-xs-12">
      <label class="txt-small">Placa :</label>
     <input type="text" 
            class="form-control input-small" 
            placeholder="placa" 
            id="placa" 
            name="placa" 
            value="{{old('placa')}}">
   </div>

    <div class="col-md-6 col-sm-6 col-xs-12">
      <label class="txt-small">F. vencimiento SOAT :</label>
     <input type="date" 
            class="form-control input-small" 
            id="soat" 
            name="soat" 
            value="{{old('soat')}}">
   </div>
 </div>

<br>
