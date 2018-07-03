 

<div class="form-group">
  <div class="col-md-6 col-sm-6 col-xs-12 ">

    <label for="">Primer nombre *:</label>
    <input type="text" class="form-control input-sm" placeholder="primer nombre" id="primer_nombre" name="primer_nombre"  value="{{old('primer_nombre')}}">

  </div>


  <div class="col-md-6 col-sm-6 col-xs-12">
    <label for="">Segundo nombre :</label>
    <input type="text" class="form-control input-sm" placeholder="segundo nombre" id="segundo_nombre" name="segundo_nombre"  value="{{old('segundo_nombre')}}">
  </div>
</div>  

<div class="form-group">  
  <div class="col-md-6 col-sm-6 col-xs-12">
    <label for="">Primer Apellido *:</label>
    <input type="text" class="form-control input-sm" placeholder="primer apellido" id="primer_apellido" name="primer_apellido"  value="{{old('primer_apellido')}}">
  </div>


  <div class="col-md-6 col-sm-6 col-xs-12">
    <label for="">Segundo Apellido :</label>
    <input type="text" class="form-control input-sm" placeholder="segundo apellido" id="segundo_apellido" name="segundo_apellido"  value="{{old('segundo_apellido')}}">
  </div>
</div>                   

  <!-- NUM DOC **************************************************************************-->
<div class="form-group">  

  <div class="col-md-6 col-sm-6 col-xs-12">
    <label>Tipo de documento *:</label>
    <select class="form-control input-sm" id="tipo_doc" name="tipo_doc">
      <option value="" disabled selected hidden=""></option>
      @foreach($tipos_documento as $tipo_doc)
        <option value="{{$tipo_doc}}" {{ (old("tipo_doc") == $tipo_doc ? "selected":"") }}>{{$tipo_doc}}</option>
      @endforeach
    </select>

  </div>

  <div class="col-md-3 col-sm-3 col-xs-12">
    <label for="">Documento *: </label>
    <input type="number" class="form-control input-sm" placeholder="#" id="num_doc" name="num_doc" value="{{old('num_doc')}}">

  </div>
  <!-- FECHA NACIMIENTO***************************************************************-->

  <div class="col-md-3 col-sm-3 col-xs-12">
    <label for=""><small>F. nacimiento *:</small></label>
      <input type="text" class="form-control input-sm" data-inputmask="'mask': '99-99-9999'" placeholder="dd-mm-aaaa" id="fecha_nacimiento" name="fecha_nacimiento" value="{{old('fecha_nacimiento')}}">
  </div>

 </div>



<!-- DIRECCION **************************************************************************-->
<div class="form-group">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <label for="">Dirección *:</label>
    <input type="text" class="form-control input-sm" placeholder="dirección" id="direccion" name="direccion"  value="{{old('direccion')}}">
  </div>
</div>
          
<div class="form-group">  
  <!-- BARRIO **************************************************************************-->
  <div class="col-md-6 col-sm-6 col-xs-12">
    <label for="">Barrio/Vereda  *: </label>
    <input type="text" class="form-control input-sm" placeholder="ingrese barrio" id="barrio" name="barrio" value="{{old('barrio')}}">

  </div>

  <!-- MUNICIIPIO **************************************************************************-->
  <div class="col-md-6 col-sm-6 col-xs-12">
    <label>Municipio *:</label>
    <select class="form-control input-sm" name="municipio_id" id="municipio_id">
     <option value="" disabled selected hidden="">- -</option>
     @foreach($municipios as $municipio)
     <option value="{{$municipio->id}}" {{ (old("municipio_id") == $municipio->id ? "selected":"") }}>{{$municipio->nombre.' ('.$municipio->departamento.')'}}</option>
     @endforeach
   </select>
 </div>
 </div>

 <div class="form-group">
 <!-- MOVIL **************************************************************************-->
  <div class="col-md-6 col-sm-6 col-xs-12">
    <label for="">Celular *:</label>
    <input type="tel" class="form-control input-sm" placeholder="ingrese # celular" id="movil" name="movil"  value="{{old('movil')}}">
  </div>
  <!-- FIJO **************************************************************************-->
  <div class="col-md-6 col-sm-6 col-xs-12">
    <label for="">Telefono : </label>
    <input type="tel" class="form-control input-sm" placeholder="ingrese # teléfono" id="fijo" name="fijo" value="{{old('fijo')}}">

  </div>
</div>  
                     
<!-- OCUPACION **************************************************************************-->

<div class="form-group">           
  <div class="col-md-6 col-sm-6 col-xs-12">
    <label for="">Ocupación *:</label>
    <input type="text" class="form-control input-sm" placeholder="ocupación" id="ocupacion" name="ocupacion"  value="{{old('ocupacion')}}">
  </div>

              <!-- TIPO DE ACTIVIDAD *****************************************************-->
  <div class="col-md-6 col-sm-6 col-xs-12">
    <label for="">Tipo de actividad *: </label>
   <select class="form-control input-sm" name="tipo_actividad" id="tipo_actividad">
     <option value="" disabled selected hidden="">- -</option>
     @foreach($tipo_actividades as $tipo_actividad)
     <option value="{{$tipo_actividad}}" {{ (old("tipo_actividad") == $tipo_actividad ? "selected":"") }}>{{$tipo_actividad}}</option>
     @endforeach
   </select>
  </div>
</div>  

 <!-- EMPRESA **************************************************************************-->
 <div class="form-group">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <label for="">Empresa :</label>
      <input type="text" class="form-control input-sm" placeholder="ingrese empresa" id="empresa" name="empresa"  value="{{old('empresa')}}">
    </div>
  </div>  

    <!-- PLACA VEHIUCLO **************************************************************************-->
  <div class="form-group" > 
    <div class="col-md-6 col-sm-6 col-xs-12">
      <label>Placa :</label>
     <input type="text" class="form-control input-sm" placeholder="placa" id="placa" name="placa" value="{{old('placa')}}">
   </div>
    <div class="col-md-6 col-sm-6 col-xs-12">
      <label>F. vencimiento SOAT :</label>
     <input type="date" class="form-control input-sm" id="soat" name="soat" value="{{old('soat')}}">
   </div>
 </div>
    <!-- Email VEHIUCLO **************************************************************************-->
  <div class="form-group" > 
    <div class="col-md-12 col-sm-12 col-xs-12">
      <label>Email :</label>
     <input type="email" class="form-control input-sm" placeholder="correo electrónico" id="email" name="email" value="{{old('email')}}"  size="60">
   </div>
 </div>
<br>
