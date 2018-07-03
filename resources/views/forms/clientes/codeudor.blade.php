
<div style="margin-top:-19px;margin-bottom:15px;">
  <h3>Codeudor</h3>
      
  Si:
  <input type="radio"  name="codeudor" id="codeudor" value="si" checked="checked"
  <?php if(Request::old('codeudor')== "si") { echo 'checked="checked"'; } ?>/> 
  No:
  <input type="radio"  name="codeudor" id="codeudor" value="no" 
  <?php if(Request::old('codeudor')== "no") { echo 'checked="checked"'; } ?>/>
</div>




<div class="form-group">

  <div class="col-md-6 col-sm-6 col-xs-12">
    <label for="">Primer nombre *:</label>
    <input type="text" class="form-control input-sm" placeholder="primer nombre" id="primer_nombrec" name="primer_nombrec"  value="{{old('primer_nombrec')}}">
  </div>


  <div class="col-md-6 col-sm-6 col-xs-12">
    <label for="">Segundo nombre :</label>
    <input type="text" class="form-control input-sm" placeholder="segundo nombrec" id="segundo_nombrec" name="segundo_nombrec"  value="{{old('segundo_nombrec')}}">
  </div>

</div>  

<div class="form-group"> 

  <div class="col-md-6 col-sm-6 col-xs-12">
    <label for="">Primer Apellido *:</label>
    <input type="text" class="form-control input-sm" placeholder="primer apellido" id="primer_apellidoc" name="primer_apellidoc"  value="{{old('primer_apellidoc')}}">
  </div>


  <div class="col-md-6 col-sm-6 col-xs-12">
    <label for="">Segundo Apellido :</label>
    <input type="text" class="form-control input-sm" placeholder="segundo apellido" id="segundo_apellidoc" name="segundo_apellidoc"  value="{{old('segundoapellidoc')}}">
  </div>

</div>  

<div class="form-group">

  <div class="col-md-6 col-sm-6 col-xs-12">
    <label>Tipo documento *:</label>
    <select class="form-control input-sm" id="tipo_docc" name="tipo_docc">
      <option value="" disabled selected hidden=""></option>
      @foreach($tipos_documento as $tipo_docc)
        <option value="{{$tipo_docc}}" {{ (old("tipo_docc") == $tipo_docc ? "selected":"") }}>{{$tipo_docc}}</option>
      @endforeach
    </select>

  </div>

<!--NUMERO DOCUMENTO  /////////////////////////////////////////////////////////////-->
  <div class="col-md-3 col-sm-3 col-xs-12">
    <label for=""><small>Documento *:</small></label>            
    <input type="number" class="form-control input-sm" id="" name="num_docc" value="{{(old('num_docc'))}}" autocomplete="on" placeholder="documento">
  </div>
   <div class="col-md-3 col-sm-3 col-xs-12">
    <label for=""><small>F. nacimiento *:</small></label>
      <input type="text" class="form-control input-sm" data-inputmask="'mask': '99-99-9999'" placeholder="dd-mm-aaaa" id="fecha_nacimientoc" name="fecha_nacimientoc" value="{{old('fecha_nacimientoc')}}">
  </div>
  
</div>



 <!-- DIRECCION **************************************************************************-->
          <div class="form-group">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <label for="">Dirección *:</label>
              <input type="text" class="form-control input-sm" placeholder="dirección" id="direccionc" name="direccionc"  value="{{old('direccionc')}}">
            </div>
          </div>
          
          <div class="form-group">  
            <!-- BARRIO **************************************************************************-->
            <div class="col-md-6 col-sm-6 col-xs-12">
              <label for="">Barrio/Vereda  *: </label>
              <input type="text" class="form-control input-sm" placeholder="ingrese barrio" id="barrioc" name="barrioc" value="{{old('barrioc')}}">

            </div>

            <!-- MUNICIIPIO **************************************************************************-->
            <div class="col-md-6 col-sm-6 col-xs-12">
              <label>Municipio *:</label>
              <select class="form-control input-sm" name="municipioc_id" id="municipioc_id">
               <option value="" disabled selected hidden="">- -</option>
               @foreach($municipios as $municipio)
               <option value="{{$municipio->id}}" {{ (old("municipioc_id") == $municipio->id ? "selected":"") }}>{{$municipio->nombre.' ('.$municipio->departamento.')'}}</option>
               @endforeach
             </select>
           </div>
           </div>

             <div class="form-group">

          <!-- MOVIL **************************************************************************-->
          <div class="col-md-6 col-sm-6 col-xs-12">
            <label for="">Celular *:</label>
            <input type="tel" class="form-control input-sm" placeholder="ingrese # celular" id="movilc" name="movilc"  value="{{old('movilc')}}">
          </div>
          <!-- FIJO **************************************************************************-->
          <div class="col-md-6 col-sm-6 col-xs-12">
            <label for="">Telefono : </label>
            <input type="tel" class="form-control input-sm" placeholder="ingrese # teléfono" id="fijoc" name="fijoc" value="{{old('fijoc')}}">

          </div>    
        </div>

        <!-- OCUPACION **************************************************************************-->

<div class="form-group">           
  <div class="col-md-6 col-sm-6 col-xs-12">
    <label for="">Ocupación *:</label>
    <input type="text" class="form-control input-sm" placeholder="ocupación" id="ocupacionc" name="ocupacionc"  value="{{old('ocupacionc')}}">
  </div>

  <!-- TIPO DE ACTIVIDAD *****************************************************-->
  <div class="col-md-6 col-sm-6 col-xs-12">
    <label for="">Tipo de actividad *: </label>

    <select class="form-control input-sm" name="tipo_actividadc" id="tipo_actividadc">
      <option value="" disabled selected hidden="">- -</option>
      @foreach($tipo_actividades as $tipo_actividad)
        <option value="{{$tipo_actividad}}" {{ (old("tipo_actividadc") == $tipo_actividad ? "selected":"") }}>{{$tipo_actividad}}</option>
      @endforeach
    </select>

  </div>
</div>  

 <!-- EMPRESA **************************************************************************-->
 <div class="form-group">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <label for="">Empresa :</label>
      <input type="text" class="form-control input-sm" placeholder="ingrese empresa" id="empresac" name="empresac"  value="{{old('empresac')}}">
    </div>
  </div>  

    <!-- PLACA VEHIUCLO **************************************************************************-->
  <div class="form-group" > 
    <div class="col-md-6 col-sm-6 col-xs-12">
      <label>Placa :</label>
     <input type="text" class="form-control input-sm" placeholder="placa" id="placac" name="placac" value="{{old('placac')}}">
   </div>
    <div class="col-md-6 col-sm-6 col-xs-12">
      <label>F. vencimiento SOAT :</label>
     <input type="date" class="form-control input-sm" id="soatc" name="soatc" value="{{old('soatc')}}">
   </div>
 </div>
    <!-- PLACA VEHIUCLO **************************************************************************-->
  <div class="form-group" > 
    <div class="col-md-12 col-sm-12 col-xs-12">
      <label>Email :</label>
     <input type="email" class="form-control input-sm" placeholder="correo electrónico" id="emailc" name="emailc" value="{{old('emailc')}}">
   </div>
 </div>


