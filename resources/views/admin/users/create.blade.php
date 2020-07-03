@section('title','crear usuario')

@section('contenido')


<div class="row">

  <div class="col-md-4 col-sm-4 "></div>

  <div class="col-md-4 col-sm-4 col-xs-12">

    <div class="panel panel-primary">
      <div class="panel-heading">Crear Usuarios</div>
      <div class="panel-body">


        <form class="form-horizontal form-label-left" action="{{route('admin.users.store')}}" method="POST" autocomplete="off">        

          <!-- NOMBRE **************************************************************************-->
          <div class="form-group">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <label for="">Nombre *:</label>
              <input type="text" class="form-control" placeholder="ingrese nombre" id="name" name="name"  value="{{old('name')}}" required>
            </div>
           </div> 

          <div class="form-group">
            <!-- ROL DE USUARIO *****************************************************-->            
          <div class="col-md-12 col-sm-12 col-xs-12">
            <label>Rol *:</label>
            <select class="form-control" placeholder="rol de usuario" name="rol_id" id="rol_id" required>
              <option value="" disabled selected hidden="rol">- -</option>
              @foreach($roles as $rol)
              <option value="{{ $rol->id }}" {{ (old("rol_id") == $rol->id ? "selected":"") }}>
                {{  $rol->display_name }}</option>
              @endforeach
            </select>
            </div>
          </div>           

          <div class="form-group">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <label>Punto *:</label>
            <select class="form-control" placeholder="punto" name="punto_id" id="punto_id" required>
              <option value="" disabled selected hidden="punto">- -</option>
              @foreach($puntos as $punto)
              <option value="{{ $punto->id }}" {{ (old("punto") == $punto->id ? "selected":"") }}>{{  $punto->nombre }}</option>
              @endforeach
            </select>
            </div>
          </div>  

            <!-- EMAIL **************************************************************************-->
          <div class="form-group">            
            <div class="col-md-12 col-sm-12 col-xs-12">
              <label for="">Email *: </label>
              <input type="email" class="form-control" placeholder="ingrese email" id="email" name="email" value="{{old('email')}}" 
                  autocomplete="off" required>

            </div>
          </div>  

          <div class="form-group">            
            <div class="col-md-12 col-sm-12 col-xs-12">
              <label for="">Contraseña *: </label>
              <input type="password" class="form-control" placeholder="ingrese contraseña" id="password" 
                    name="password" value="{{old('password')}}" autocomplete="off" required>

            </div>
          </div>  

          <div class="form-group">
            <!-- BANCO *****************************************************-->            
          <div class="col-md-12 col-sm-12 col-xs-12">
            <label>Banco :</label>
            <select class="form-control" placeholder="banco cuenta de nómina" name="banco_id" id="banco_id">
              <option value="" disabled selected hidden="rol">- -</option>
                  @foreach($bancos as $banco)
                    <option id="banco_id" name="banco_id" value="{{ $banco->id }}" 
                      {{ (old("banco_id") == $banco->id ? "selected":"") }}>{{  $banco->nombre }}</option>
                  @endforeach
            </select>
            </div>
          </div> 

            <!-- NUMERO DE CUENTA **************************************************************************-->
          <div class="form-group">            
            <div class="col-md-12 col-sm-12 col-xs-12">
              <label for="">Número de cuenta: </label>
              <input type="text" class="form-control" placeholder="número de cuenta nómina" 
                id="num_cuenta" name="num_cuenta" value="{{old('num_cuenta')}}">

            </div>
          </div>  

         <!-- BOTONES **************************************************************************-->

         <center>
            <a href="{{route('admin.users.index')}}"><button type="button" class="btn btn-primary">Cancelar</button></a>
            <button type="submit" class="btn btn-danger">&nbsp;&nbsp;Crear&nbsp;&nbsp;</button>
          </center>

        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
      </form>



    </div>
    </div>
  </div>      
  <div class="col-md-4 col-sm-4 "></div>
<div>

@endsection
@include('templates.main2')