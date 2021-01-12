@section('title','criterios de llamada')

@section('contenido')


<div class="row">
  <div class="col-md-3"></div>
  <div class="col-md-6 col-sm-6 col-xs-12">
    <div class="panel panel-default">
      <div class="panel-heading"><b>Criterios de llamada</b>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <button type="button" class="btn btn-default" data-toggle='modal' data-target='#myModalCrearCriterio'>Crear Criterio</button>

      </div>
      <div class="panel-body">

			  <div id="msj-success" class="alert alert-success alert-dismissible" role ="alert" style="display:none">
			    <strong id="mensaje"></strong>
			  </div>

      	<div id="list_criterios">
      	</div>	


        @include('admin.criteriocall.create_modal')
        @include('admin.criteriocall.edit_modal')


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
  	var route =  "{{url('admin/listall')}}";
  	$.get(route, function(data){
  		$('#list_criterios').empty().html(data);
  	});
  }

//trae la pagina relacionada en la pinacion

  $(document).on('click',".pagination li a", function(e){
  	e.preventDefault();
  	var route = $(this).attr("href");
  	$.get(route, function(data){
  		$('#list_criterios').empty().html(data);
  	});

  });
</script>


@endsection

@include('templates.main2')