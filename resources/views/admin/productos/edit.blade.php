@section('title','editar producto')

@section('contenido')


<div class="row">

  <div class="col-md-4 col-sm-4 "></div>

  <div class="col-md-4 col-sm-4 col-xs-12">

    <div class="panel panel-primary">
    <div class="panel-heading">Editar Poducto</div>
      <div class="panel-body">

        @include('templates.error')
        @include('flash::message')




        <form class="form-horizontal form-label-left" action="{{route('admin.productos.update',$producto)}}" method="POST">   
          <input type="hidden" name="_method" value="PUT">     

          <!-- NOMBRE *******-->
          
          <div class="form-group">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <label for="">Nombre *:</label>
              <input type="text" class="form-control" placeholder="ingrese nombre del producto" id="nombre" name="nombre"  value="{{$producto->nombre}}" >
            </div>  
          </div>
          
          <div class="form-group">  

            <!-- DESCRIPCION *******-->    
            <div class="col-md-12 col-sm-12 col-xs-12">
              <label>Descripción :</label>
              <textarea class="form-control" rows="3" id="descripcion" name="descripcion" placeholder='Escriba la descripción del producto' autocomplete="off"  value="{{$producto->descripcion}}">{{$producto->descripcion}}</textarea>
            </div>
          </div>

          <!-- BOTONES **************-->

          <center>
            <a href="{{route('admin.productos.index')}}"><button type="button" class="btn btn-primary">Cancelar</button></a>
            <button type="submit" class="btn btn-danger">&nbsp;&nbsp;Guardar Cambio&nbsp;&nbsp;</button>
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