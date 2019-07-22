@section('title','puntos')

@section('contenido')


<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="panel panel-default">
      <div class="panel-heading"><b>Puntos de pago</b>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        
        <button type="button" class="btn btn-default" data-toggle='modal' data-target='#myModalCrearPunto' onClick="hola();">
          Crear Punto
        </button>

      </div>
      <div class="panel-body">

			  <div id="msj-success" class="alert alert-success alert-dismissible" role ="alert" style="display:none">
			    <strong id="mensaje"></strong>
			  </div>

      	<div id="list_puntos">
      	</div>	

      	@include('admin.puntos.create_modal')
        @include('admin.puntos.edit_modal')


      </div>   
    </div>  
  </div>
  <div class="col-md-3"></div>
</div>



<script>
  $(document).ready(function(){
    Cargar();
  });

// carga el listado de los criterios
  function Cargar(){
  	var route =  "{{url('admin/puntos_listall')}}";
  	$.get(route, function(data){
  		$('#list_puntos').empty().html(data);
  	});
  }

//trae la pagina relacionada en la paginacion

  $(document).on('click',".pagination li a", function(e){
  	e.preventDefault();
  	var route = $(this).attr("href");
  	$.get(route, function(data){
  		$('#list_puntos').empty().html(data);
  	});

  });
</script>


@endsection

@include('templates.main2')