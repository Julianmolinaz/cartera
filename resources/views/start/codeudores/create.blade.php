@section('title','crear cliente')
@section('contenido')


  <div class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-12">


      <div class="row">

        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="panel panel-primary">
            <div class="panel-heading">Crear Codeudor</div>
              <div class="panel-body">
              @include('templates.error')
              @include('flash::message')
                


      <form class="form-horizontal form-label-left" 
            action="{{route('start.codeudores.store')}}" 
            method="POST">

    <input type="hidden" name="cliente_id" value="{{ $cliente_id }}">

      <div class="form-group">

        <div class="col-md-12 col-sm-12 col-xs-12 ">  
          <label class="title-section">Datos personales del codeudor</label>
          <hr class="linea">
        </div>

        <div class="col-md-3 col-sm-3 col-xs-12 ">


          <label class="txt-small">Primer nombre *:</label>
          <input type="text" 
                class="form-control" 
                placeholder="primer nombre" 
                id="primer_nombrec" 
                name="primer_nombrec"  
                value="{{old('primer_nombrec')}}">

        </div>


        <div class="col-md-3 col-sm-3 col-xs-12">
          <label class="txt-small">Segundo nombre :</label>
          <input type="text" 
                class="form-control" 
                placeholder="segundo nombre" 
                id="segundo_nombrec" 
                name="segundo_nombrec"  
                value="{{old('segundo_nombrec')}}">
        </div>
 
        <div class="col-md-3 col-sm-3 col-xs-12">
          <label class="txt-small">Primer Apellido *:</label>
          <input type="text" 
                class="form-control" 
                placeholder="primer apellido" 
                id="primer_apellidoc" 
                name="primer_apellidoc"  
                value="{{old('primer_apellidoc')}}">
        </div>


        <div class="col-md-3 col-sm-3 col-xs-12">
          <label class="txt-small">Segundo Apellido :</label>
          <input type="text" 
                class="form-control" 
                placeholder="segundo apellido" 
                id="segundo_apellidoc" 
                name="segundo_apellidoc"  
                value="{{old('segundo_apellidoc')}}">
        </div>
      </div>                   

        <!-- NUM DOC **************************************************************************-->
      <div class="form-group">  

        <div class="col-md-3 col-sm-3 col-xs-12">
          <label class="txt-small">Tipo de documento *:</label>
          <select class="form-control" 
                  id="tipo_docc" 
                  name="tipo_docc">

            <option value="" disabled selected hidden=""></option>
            @foreach($tipos_documento as $tipo_docc)
              <option value="{{$tipo_docc}}" {{ (old("tipo_docc") == $tipo_docc ? "selected":"") }}>{{$tipo_docc}}</option>
            @endforeach
          </select>

        </div>

        <div class="col-md-3 col-sm-3 col-xs-12">
          <label class="txt-small">Documento *: </label>
          <input type="number" 
                class="form-control" 
                placeholder="#" 
                id="num_docc" 
                name="num_docc" 
                value="{{old('num_docc')}}">
        </div>

        <div class="col-md-6 col-sm-6 col-xs-12">
          <label class="txt-small">F. nacimiento *:</label>
            <input type="date" 
                  class="form-control" 
                  id="fecha_nacimientoc" 
                  name="fecha_nacimientoc" 
                  value="{{old('fecha_nacimientoc')}}">
        </div>

      </div>
        <br>   
        <label class="title-section">Datos de ubicación</label>
        <hr class="linea">



      <!-- DIRECCION **************************************************************************-->
      <div class="form-group">
        <div class="col-md-4 col-sm-4 col-xs-12">
          <label class="txt-small">Dirección *:</label>
          <input type="text" 
                class="form-control" 
                placeholder="dirección" 
                id="direccionc" 
                name="direccionc"  
                value="{{old('direccionc')}}">
        </div>

        <!-- BARRIO **************************************************************************-->
        <div class="col-md-4 col-sm-4 col-xs-12">
          <label class="txt-small">Barrio/Vereda  *: </label>
          <input type="text" 
                class="form-control" 
                placeholder="ingrese barrio" 
                id="barrioc" 
                name="barrioc" 
                value="{{old('barrioc')}}">

        </div>

        <!-- MUNICIIPIO **************************************************************************-->
        <div class="col-md-4 col-sm-4 col-xs-12">
          <label class="txt-small">Municipio *:</label>
          <select class="form-control" name="municipioc_id" id="municipioc_id">
            <option value="" disabled selected hidden="">- -</option>
            @foreach($municipios as $municipioc)
            <option value="{{$municipioc->id}}" {{ (old("municipioc_id") == $municipioc->id ? "selected":"") }}>{{$municipioc->nombre.' ('.$municipioc->departamento.')'}}</option>
            @endforeach
        </select>
      </div>
      </div>

      <div class="form-group">
      <!-- MOVIL **************************************************************************-->
        <div class="col-md-4 col-sm-4 col-xs-12">
          <label class="txt-small">Celular *:</label>
          <input type="tel" class="form-control" placeholder="ingrese # celular" 
                 id="movilc" name="movilc"  value="{{old('movilc')}}">
        </div>
        <!-- FIJO **************************************************************************-->
        <div class="col-md-4 col-sm-4 col-xs-12">
          <label class="txt-small">Telefono : </label>
          <input type="tel" 
                class="form-control" 
                placeholder="ingrese # teléfono" 
                id="fijoc" 
                name="fijoc" 
                value="{{old('fijoc')}}">

        </div>

          <div class="col-md-4 col-sm-4 col-xs-12">
            <label class="txt-small">Email :</label>
            <input type="email" 
                  class="form-control" 
                  placeholder="correo electrónico" 
                  id="emailc" 
                  name="emailc" 
                  value="{{old('emailc')}}"  
                  size="60">
        </div>
      </div>
        
        <br>

        <label class="title-section">Datos laborales</label>
        <hr class="linea">

                          
      <!-- OCUPACION **************************************************************************-->

      <div class="form-group">           
        <div class="col-md-4 col-sm-4 col-xs-12">
          <label class="txt-small">Ocupación *:</label>
          <input type="text-small" 
                class="form-control" 
                placeholder="ocupación" 
                id="ocupacionc" 
                name="ocupacionc"  
                value="{{old('ocupacionc')}}">
        </div>

                    <!-- TIPO DE ACTIVIDAD *****************************************************-->
        <div class="col-md-4 col-sm-4 col-xs-12">
          <label class="txt-small">Tipo de actividad *: </label>
          <select class="form-control" 
                  name="tipo_actividadc" 
                  id="tipo_actividadc">
          <option value="" disabled selected hidden="">- -</option>
              @foreach($tipo_actividades as $tipo_actividad)
                  <option value="{{$tipo_actividad}}" {{ (old("tipo_actividadc") == $tipo_actividad ? "selected":"") }}>{{$tipo_actividad}}</option>
          @endforeach
        </select>
        </div>

          <div class="col-md-4 col-sm-4 col-xs-12">
            <label class="txt-small ">Nombre empresa :</label>
            <input type="text" 
                    class="form-control" 
                    placeholder="ingrese empresa" 
                    id="empresac" 
                    name="empresac"  
                    value="{{old('empresac')}}">
          </div>

        </div>
        <div class="form-group">  
          <div class="col-md-4 col-sm-4 col-xs-12">
            <label class="txt-small">Teléfono empresa :</label>
            <input type="text" 
                  class="form-control" 
                  placeholder="ingrese teléfono empresa" 
                  id="tel_empresac" 
                  name="tel_empresac"  
                  value="{{old('tel_empresac')}}">
          </div>

          <div class="col-md-8 col-sm-8 col-xs-12">
            <label class="txt-small">Dirección empresa :</label>
            <input type="text" 
                  class="form-control" 
                  placeholder="ingrese dirección empresa" 
                  id="dir_empresac" 
                  name="dir_empresac"  
                  value="{{old('dir_empresac')}}">
          </div>
        </div>
        
        <br>

        <label class="title-section">Otros</label>
        <hr class="linea">

          <!-- PLACA VEHIUCLO **************************************************************************-->
        <div class="form-group" > 

          <div class="col-md-6 col-sm-6 col-xs-12">
            <label class="txt-small">Placa :</label>
          <input type="text" 
                  class="form-control" 
                  placeholder="placa" 
                  id="placac" 
                  name="placac" 
                  value="{{old('placac')}}">
        </div>

          <div class="col-md-6 col-sm-6 col-xs-12">
            <label class="txt-small">F. vencimiento SOAT :</label>
          <input type="date" 
                  class="form-control" 
                  id="soatc" 
                  name="soatc" 
                  value="{{old('soatc')}}">
        </div>
      </div>
   <input type="hidden" name="_token" value="{{ csrf_token() }}" />
      <br>

        <center>
          <a href="javascript:window.history.back();"><button type="button" class="btn btn-primary">Volver</button></a>
          <button type="submit" class="btn btn-danger">&nbsp;&nbsp;Crear&nbsp;&nbsp;</button>
        </center>  

              </div>
            </div>                  
        </div>  

      
    </form>

  </div>

@endsection
@include('templates.main2')