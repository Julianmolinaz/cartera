  <h3>Codeudor  </h3> 
    
     Si:
      <input type="radio" class="flat" name="codeudor" id="codeudor" value="si" 
      <?php if (Request::old('codeudor')== "si" ) { 
        echo 'checked="checked"';
      }
      elseif($cliente->codeudor->codeudor == "si"){
       echo 'checked="checked"';  
      }
       ?>
       /> 
      No:
      <input type="radio" class="flat" name="codeudor" id="codeudor" value="no"
      <?php if(Request::old('codeudor') == "no") {
       echo 'checked="checked"'; 
       } 
      if($cliente->codeudor->codeudor == "no" and Request::old('codeudor')== ""){
       echo 'checked="checked"';  
      } 

       ?>/>


<br><br>

<div class="form-group">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <label for="">Nombre :</label>
    <input type="text" class="form-control input-sm" placeholder="nombre" value="{{$cliente->codeudor->nombrec}}" disabled >
  </div>
</div>

<div class="form-group">

  <div class="col-md-6 col-sm-6 col-xs-12">
    <label for="">Primer nombre *:</label>
    <input type="text" class="form-control input-sm" placeholder="primer nombre" id="primer_nombrec" name="primer_nombrec"  value="{{$cliente->codeudor->primer_nombrec}}">
  </div>


  <div class="col-md-6 col-sm-6 col-xs-12">
    <label for="">Segundo nombre :</label>
    <input type="text" class="form-control input-sm" placeholder="segundo nombre" id="segundo_nombrec" name="segundo_nombrec"  value="{{$cliente->codeudor->segundo_nombrec}}">
  </div>

</div>  

<div class="form-group"> 

  <div class="col-md-6 col-sm-6 col-xs-12">
    <label for="">Primer Apellido *:</label>
    <input type="text" class="form-control input-sm" placeholder="primer apellido" id="primer_apellidoc" name="primer_apellidoc"  value="{{$cliente->codeudor->primer_apellidoc}}">
  </div>


  <div class="col-md-6 col-sm-6 col-xs-12">
    <label for="">Segundo Apellido :</label>
    <input type="text" class="form-control input-sm" placeholder="segundo apellido" id="segundo_apellidoc" name="segundo_apellidoc"  value="{{$cliente->codeudor->segundo_apellidoc}}">
  </div>

</div>  

<div class="form-group">

  <div class="col-md-6 col-sm-6 col-xs-12">
    <label>Tipo de documento *:</label>
    <select class="form-control input-sm" id="tipo_docc" name="tipo_docc">
      <option value="" disabled selected hidden=""></option>
      @foreach($tipos_documentoc as $tipo_docc)
        <option value="{{$tipo_docc}}" {{ $cliente->codeudor->tipo_docc == $tipo_docc ? "selected":"" }}>{{$tipo_docc}}</option>
      @endforeach
    </select>

  </div>

<!--NUMERO DOCUMENTO  /////////////////////////////////////////////////////////////-->
  <div class="col-md-3 col-sm-3 col-xs-12">
    <label for=""><small>Documento *:</small></label>            
    <input type="number" class="form-control input-sm" id="" name="num_docc" value="{{$cliente->codeudor->num_docc}}" autocomplete="on" placeholder="documento">
  </div>
   <div class="col-md-3 col-sm-3 col-xs-12">
    <label for=""><small>F. nacimiento *:</small></label>
      <input type="text" class="form-control input-sm" data-inputmask="'mask': '99-99-9999'" placeholder="dd-mm-aaaa" id="fecha_nacimientoc" name="fecha_nacimientoc" value="{{$cliente->codeudor->fecha_nacimientoc}}">
  </div>
  
</div>



 <!-- DIRECCION **************************************************************************-->
          <div class="form-group">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <label for="">Dirección *:</label>
              <input type="text" class="form-control input-sm" placeholder="dirección" id="direccionc" name="direccionc"  value="{{$cliente->codeudor->direccionc}}">
            </div>
          </div>
          
          <div class="form-group">  
            <!-- BARRIO **************************************************************************-->
            <div class="col-md-6 col-sm-6 col-xs-12">
              <label for="">Barrio/Vereda  *: </label>
              <input type="text" class="form-control input-sm" placeholder="ingrese barrio" id="barrioc" name="barrioc" value="{{$cliente->codeudor->barrioc}}">

            </div>

            <!-- MUNICIIPIO **************************************************************************-->
            <div class="col-md-6 col-sm-6 col-xs-12">
              <label>Municipio *:</label>
              <select class="form-control input-sm" name="municipioc_id" id="municipioc_id">
               <option value="" disabled selected hidden="">- -</option>
               @foreach($municipios as $municipio)
               <option value="{{$municipio->id}}" {{ $cliente->codeudor->municipioc_id == $municipio->id ? "selected":"" }}>{{$municipio->nombre.' ('.$municipio->departamento.')'}}</option>
               @endforeach
             </select>
           </div>
           </div>

             <div class="form-group">

          <!-- MOVIL **************************************************************************-->
          <div class="col-md-6 col-sm-6 col-xs-12">
            <label for="">Celular *:</label>
            <input type="tel" class="form-control input-sm" placeholder="ingrese # celular" id="movilc" name="movilc"  value="{{$cliente->codeudor->movilc}}">
          </div>
          <!-- FIJO **************************************************************************-->
          <div class="col-md-6 col-sm-6 col-xs-12">
            <label for="">Telefono : </label>
            <input type="tel" class="form-control input-sm" placeholder="ingrese # teléfono" id="fijoc" name="fijoc" value="{{$cliente->codeudor->fijoc}}">

          </div>    
        </div>

        <!-- OCUPACION **************************************************************************-->

<div class="form-group">           
  <div class="col-md-6 col-sm-6 col-xs-12">
    <label for="">Ocupación *:</label>
    <input type="text" class="form-control input-sm" placeholder="ocupación" id="ocupacionc" name="ocupacionc"  value="{{$cliente->codeudor->ocupacionc}}">
  </div>

  <!-- TIPO DE ACTIVIDAD *****************************************************-->
  <div class="col-md-6 col-sm-6 col-xs-12">
    <label for="">Tipo de actividad *: </label>

    <select class="form-control input-sm" name="tipo_actividadc" id="tipo_actividadc">
      <option value="" disabled selected hidden="">- -</option>
      @foreach($tipo_actividades as $tipo_actividad)
        <option value="{{$tipo_actividad}}" {{ $cliente->codeudor->tipo_actividadc == $tipo_actividad ? "selected":"" }}>{{$tipo_actividad}}</option>
      @endforeach
    </select>

  </div>
</div>  

 <!-- EMPRESA **************************************************************************-->
 <div class="form-group">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <label for="">Empresa :</label>
      <input type="text" class="form-control input-sm" placeholder="ingrese empresa" id="empresac" name="empresac"  value="{{$cliente->codeudor->empresac}}">
    </div>
  </div>  

    <!-- PLACA VEHIUCLO **************************************************************************-->
  <div class="form-group" > 
    <div class="col-md-6 col-sm-6 col-xs-12">
      <label>Placa :</label>
     <input type="text" class="form-control input-sm" placeholder="placa" id="placac" name="placac" value="{{$cliente->codeudor->placac}}">
   </div>
    <div class="col-md-6 col-sm-6 col-xs-12">
      <label>Email :</label>
     <input type="email" class="form-control input-sm" placeholder="correo electrónico" id="emailc" name="emailc" value="{{$cliente->codeudor->emailc}}">
   </div>
 </div>



