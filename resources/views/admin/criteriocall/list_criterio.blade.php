
@include('flash::message')
<div class="table-responsive">
  <table class="table">
    <thead>
      <tr>
        <th>    #         	</th>
        <th>    Criterio  	</th>
        <th>    Descripción   </th>
        <th>    Acción    	</th>
      </tr>
    </thead>

    <tbody>
      @foreach($criterios as $criterio)
        <tr>
          <td>{{$criterio->id}}</td>
          <td>{{$criterio->criterio}}</td>
          <td>{{$criterio->descripcion}}</td>
          <td>

            <a href="#" class = 'btn btn-default btn-xs' data-toggle='modal' data-target='#myModalEditCriterio' OnClick="Mostrar({{$criterio->id}});" title="Editar">
              <span class = "glyphicon glyphicon-pencil"></span>
            </a> 
            <a href="#" OnClick="Eliminar({{$criterio->id}});" class = 'btn btn-default btn-xs' title="Eliminar"><span class = "glyphicon glyphicon-trash" ></span></a>  

          </td>
        </tr>
      @endforeach    
    </tbody>
  </table>
</div>


<div class="text-center">
{!! $criterios->render() !!}
</div>

<script>

 function Mostrar(criterio_id){
     var route = "{{url('admin/criteriocall')}}/"+criterio_id+"/edit";
     $.get(route,function(data){
       $('#id').val(data.id);
       $('#_criterio').val(data.criterio);
       $('#_descripcion').val(data.descripcion);
     });
  }

  function Eliminar(id){
    var x = confirm('¿Esta seguro de eliminar el criterio?');
    if(!x){ return false; }
    var route= "{{url('admin/criteriocall')}}/"+id+"/destroy";
    $.get(route,function(res){
      Cargar();
      $('#mensaje').text(res);
      $('#msj-success').fadeIn();
  });
  }
</script>