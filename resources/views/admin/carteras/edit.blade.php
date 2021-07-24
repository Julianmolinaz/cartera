@section('title','editar cartera')

@section('contenido')


<div class="row">

  <div class="col-md-4 col-sm-4 "></div>

  <div class="col-md-4 col-sm-4 col-xs-12">

    <div class="panel panel-primary">
      <div class="panel-heading">Crear Cartera</div>
      <div class="panel-body">

        @include('templates.error')
        @include('flash::message')

        <form class="form-horizontal form-label-left" action="{{route('admin.carteras.update',$cartera)}}" method="POST">     
          <input type="hidden" name="_method" value="PUT">   

          <!-- NOMBRE**************************************************************************-->
          <div class="form-group">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <label for="">Nombre *:</label>
              <input type="text" class="form-control" placeholder="ingrese nombre" id="nombre" name="nombre"  value="{{$cartera->nombre}}" >
            </div>

          </div>

          <!-- ESTADO**************************************************************************-->
          <div class="form-group">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <label for="">Estado *:</label>

              <select class="form-control input-sm" id="estado" name="estado">
                <option disabled selected >- -</option>
                @foreach($estados as $estado)
                <option value="{{$estado}}" {{ $estado == $cartera->estado ? "selected":"" }}>{{$estado}}</option>
                @endforeach  

              </select> 

            </div>

          </div>         
          <!-- BOTONES **************************************************************************-->

          <div class="form-group">

            <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-3"><br>
              <a href="{{route('admin.carteras.index')}}"><button type="button" class="btn btn-primary">Cancelar</button></a>
              <button type="submit" class="btn btn-danger">&nbsp;&nbsp;Guardar Cambios&nbsp;&nbsp;</button>
            </div>
          </div>


          <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        </form>

      </div>
    </div>
  </div>      

  <div class="col-md-4 col-sm-4 "></div>
</div>  


@endsection
@include('templates.main2')