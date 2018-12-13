@section('title','crear cliente')
@section('contenido')


  <div class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-12">
      <div class="row">

      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="panel panel-primary">
          <div class="panel-heading">Editar Cliente</div>
            <div class="panel-body">
              @include('templates.error')
              @include('flash::message')

      <form class="form-horizontal form-label-left" 
            action="{{route('start.clientes.update',$cliente)}}" 
            method="POST">

        <input type="hidden" name="_method" value="PUT">
        
        
        <div class="form-group">

        <div class="col-md-12 col-sm-12 col-xs-12 ">  
          <label class="title-section">Datos personales del solicitante</label>
          <hr class="linea">
        </div>

        <div class="col-md-3 col-sm-3 col-xs-12 ">


          <label class="txt-small">Primer nombre *:</label>
          <input type="text" 
                class="form-control" 
                placeholder="primer nombre" 
                id="primer_nombre" 
                name="primer_nombre"  
                value="{{ $cliente->primer_nombre }}">

        </div>


        <div class="col-md-3 col-sm-3 col-xs-12">
          <label class="txt-small">Segundo nombre :</label>
          <input type="text" 
                class="form-control" 
                placeholder="segundo nombre" 
                id="segundo_nombre" 
                name="segundo_nombre"  
                value="{{ $cliente->segundo_nombre}}">
        </div>
 
        <div class="col-md-3 col-sm-3 col-xs-12">
          <label class="txt-small">Primer Apellido *:</label>
          <input type="text" 
                class="form-control" 
                placeholder="primer apellido" 
                id="primer_apellido" 
                name="primer_apellido"  
                value="{{$cliente->primer_apellido}}">
        </div>


        <div class="col-md-3 col-sm-3 col-xs-12">
          <label class="txt-small">Segundo Apellido :</label>
          <input type="text" 
                class="form-control" 
                placeholder="segundo apellido" 
                id="segundo_apellido" 
                name="segundo_apellido"  
                value="{{$cliente->segundo_apellido}}">
        </div>
      </div>                   

        <!-- NUM DOC **************************************************************************-->
      <div class="form-group">  

        <div class="col-md-3 col-sm-3 col-xs-12">
          <label class="txt-small">Tipo de documento *:</label>
          <select class="form-control" 
                  id="tipo_doc" 
                  name="tipo_doc">

            <option value="" disabled selected hidden=""></option>
            @foreach($tipos_documento as $tipo_doc)
              <option value="{{$tipo_doc}}" {{ ($cliente->tipo_doc == $tipo_doc) ? "selected" : "" }}>
                {{$tipo_doc}}</option>
            @endforeach
          </select>

        </div>

        <div class="col-md-3 col-sm-3 col-xs-12">
          <label class="txt-small">Documento *: </label>
          <input type="number" 
                class="form-control" 
                placeholder="#" 
                id="num_doc" 
                name="num_doc" 
                value="{{ $cliente->num_doc}}">
        </div>

        <div class="col-md-6 col-sm-6 col-xs-12">
          <label class="txt-small">F. nacimiento *:</label>
            <input type="date" 
                  class="form-control" 
                  id="fecha_nacimiento" 
                  name="fecha_nacimiento" 
                  value="{{ $cliente->fecha_nacimiento}}">
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
                id="direccion" 
                name="direccion"  
                value="{{ $cliente->direccion }}">
        </div>

        <!-- BARRIO **************************************************************************-->
        <div class="col-md-4 col-sm-4 col-xs-12">
          <label class="txt-small">Barrio/Vereda  *: </label>
          <input type="text" 
                class="form-control" 
                placeholder="ingrese barrio" 
                id="barrio" 
                name="barrio" 
                value="{{$cliente->barrio}}">

        </div>

        <!-- MUNICIIPIO **************************************************************************-->
        <div class="col-md-4 col-sm-4 col-xs-12">
          <label class="txt-small">Municipio *:</label>
          <select class="form-control" name="municipio_id" id="municipio_id">
            <option value="" disabled selected hidden="">- -</option>
            @foreach($municipios as $municipio)
            <option value="{{$municipio->id}}" {{ $cliente->municipio_id == $municipio->id ? "selected":"" }}>
              {{$municipio->nombre.' ('.$municipio->departamento.')'}}</option>
            @endforeach
        </select>
      </div>
      </div>

      <div class="form-group">
      <!-- MOVIL **************************************************************************-->
        <div class="col-md-4 col-sm-4 col-xs-12">
          <label class="txt-small">Celular *:</label>
          <input type="tel" class="form-control" 
                 placeholder="ingrese # celular" 
                 id="movil" name="movil"  value="{{ $cliente->movil }}">
        </div>
        <!-- FIJO **************************************************************************-->
        <div class="col-md-4 col-sm-4 col-xs-12">
          <label class="txt-small">Telefono : </label>
          <input type="tel" 
                class="form-control" 
                placeholder="ingrese # teléfono" 
                id="fijo" 
                name="fijo" 
                value="{{ $cliente->fijo}}">

        </div>

          <div class="col-md-4 col-sm-4 col-xs-12">
            <label class="txt-small">Email :</label>
            <input type="email" 
                  class="form-control" 
                  placeholder="correo electrónico" 
                  id="email" 
                  name="email" 
                  value="{{ $cliente->email }}"  
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
                id="ocupacion" 
                name="ocupacion"  
                value="{{$cliente->ocupacion}}">
        </div>

                    <!-- TIPO DE ACTIVIDAD *****************************************************-->
        <div class="col-md-4 col-sm-4 col-xs-12">
          <label class="txt-small">Tipo de actividad *: </label>
          <select class="form-control" 
                  name="tipo_actividad" 
                  id="tipo_actividad">
          <option value="" disabled selected hidden="">- -</option>
              @foreach($tipo_actividades as $tipo_actividad)
                  <option value="{{$tipo_actividad}}" {{ $cliente->tipo_actividad == $tipo_actividad ? "selected":"" }}>
                   {{$tipo_actividad}}</option>
          @endforeach
        </select>
        </div>

          <div class="col-md-4 col-sm-4 col-xs-12">
            <label class="txt-small ">Nombre empresa :</label>
            <input type="text" 
                    class="form-control" 
                    placeholder="ingrese empresa" 
                    id="empresa" 
                    name="empresa"  
                    value="{{ $cliente->empresa }}">
          </div>

        </div>
        <div class="form-group">  
          <div class="col-md-4 col-sm-4 col-xs-12">
            <label class="txt-small">Teléfono empresa :</label>
            <input type="text" 
                  class="form-control" 
                  placeholder="ingrese teléfono empresa" 
                  id="tel_empresa" 
                  name="tel_empresa"  
                  value="{{ $cliente->tel_empresa }}">
          </div>

          <div class="col-md-8 col-sm-8 col-xs-12">
            <label class="txt-small">Dirección empresa :</label>
            <input type="text" 
                  class="form-control" 
                  placeholder="ingrese dirección empresa" 
                  id="dir_empresa" 
                  name="dir_empresa"  
                  value="{{ $cliente->dir_empresa }}">
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
                  id="placa" 
                  name="placa" 
                  value="{{ $cliente->placa }}">
        </div>

          <div class="col-md-6 col-sm-6 col-xs-12">
            <label class="txt-small">F. vencimiento SOAT :</label>
          <input type="date" 
                  class="form-control" 
                  id="soat" 
                  name="soat" 
                  value="{{ ($cliente->soat) ? $cliente->soat->vencimiento :'' }}">
        </div>
      </div>
   <input type="hidden" name="_token" value="{{ csrf_token() }}" />
      <br>

        <center>
          <a href="javascript:window.history.back();"><button type="button" class="btn btn-primary">Volver</button></a>
          <button type="submit" class="btn btn-danger">&nbsp;&nbsp;Guaradar Cambios&nbsp;&nbsp;</button>
        </center>  

              </div>
            </div>                  
        </div>  

      
    </form>

  </div>

@endsection
@include('templates.main2')