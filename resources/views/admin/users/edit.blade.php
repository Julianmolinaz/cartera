@section('title','editar usuario')

@section('contenido')


<div class="row">

  <div class="col-md-4 col-sm-4 "></div>

  <div class="col-md-4 col-sm-4 col-xs-12">

    <div class="panel panel-primary">
      <div class="panel-heading">Editar Usuario</div>
      <div class="panel-body">
        @include('templates.error')
        <br />


        <form class="form-horizontal form-label-left" action="{{route('admin.users.update',$user)}}" method="POST" autocomplete="off">        
          <input type="hidden" name="_method" value="PUT">
          <!-- NOMBRE**************************************************************************-->

          <div class="form-group">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <label for="">Nombre *:</label>
              <input type="text" class="form-control" placeholder="ingrese nombre" id="name" name="name"  value="{{$user->name}}" required>
            </div>
          </div>  
          <!-- ESTADO *****************************************************-->            
          
          <div class="form-group">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <label>Estado *:</label>
            <select class="form-control" placeholder="rol de usuario" name="estado" id="estado" required>
              <option value="" disabled selected hidden="estado">- -</option>
              @foreach(['Activo','Inactivo'] as $key => $tipo)
              <option id="estado" name="estado" value="{{ $tipo }}" {{ $user->estado == $tipo ? "selected":"" }}>{{  $tipo }}</option>
              @endforeach
            </select>
            </div>
          </div>


            <!-- ROL DE USUARIO *****************************************************--> 
          <div class="form-group">             
          <div class="col-md-12 col-sm-12 col-xs-12">
            <label>Rol *:</label>
            <select class="form-control" placeholder="rol de usuario" name="rol" id="rol" required>
              <option value="" disabled selected hidden="rol">- -</option>
              @foreach($roles as $rol)
              <option id="rol" name="rol" value="{{ $rol }}" {{ $user->rol == $rol ? "selected":"" }}>{{  $rol }}</option>
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
              <option value="{{ $punto->id }}" {{ $user->punto_id == $punto->id ? "selected":"" }}>{{  $punto->nombre }}</option>
              @endforeach
            </select>
            </div>
          </div>  


          <div class="form-group">
            <!-- EMAIL**************************************************************************-->
            <div class="col-md-12 col-sm-12 col-xs-12">
              <label for="">Email *: </label>
              <input type="email" class="form-control" placeholder="ingrese email" id="email" name="email" 
                    value="{{$user->email}}" autocomplete="off" required>

            </div>
          </div>
          
          <div class="form-group">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <label for="">Contraseña *: </label>
              <input type="password" class="form-control" placeholder="ingrese contraseña" id="password" name="password" value="{{$user->password}}" required>
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
                      {{ ($banco->id == $user->banco_id) ? "selected":"" }}>{{  $banco->nombre }}</option>
                  @endforeach
            </select>
            </div>
          </div> 

            <!-- NUMERO DE CUENTA **************************************************************************-->
          <div class="form-group">            
            <div class="col-md-12 col-sm-12 col-xs-12">
              <label for="">Número de cuenta: </label>
              <input type="text" class="form-control" placeholder="número de cuenta nómina" 
                id="num_cuenta" name="num_cuenta" value="{{$user->num_cuenta}}">

            </div>
          </div>  


         <!-- BOTONES **************************************************************************-->

          <center>
            <a href="{{route('admin.users.index')}}">
              <button type="button" class="btn btn-primary">Cancelar</button>
            </a>
            <button type="submit" class="btn btn-danger">&nbsp;&nbsp;Guardar Cambios&nbsp;&nbsp;</button>
          </center>  


        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
      </form>

    </div>
    </div>
  </div>      
  <div class="col-md-4 col-sm-4 "></div>
</div>



@endsection
@include('templates.main2')