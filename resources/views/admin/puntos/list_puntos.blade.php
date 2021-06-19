
@include('flash::message')

<table id="puntos" class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>    Punto Id    </th>
      <th>    Zona        </th>
      <th>    Nombre    	</th>
      <th>    Teléfono    </th>
      <th>    Dirección   </th>
      <th>    Municipio   </th>
      <th>    Estado      </th>
      <th>    Descripción </th>
      <th>    Acción    	</th>
    </tr>
  </thead>
  <tbody>
    @foreach($puntos as $punto)
      <tr>
        <td>    {{ $punto->id}}   </td>
        <td>    {{ ($punto->zona) ? $punto->zona->nombre : ''}}</td>
        <td>    {{ $punto->nombre}}      </td>
        <td>    {{ $punto->telefono }}</td>
        <td>    {{ $punto->direccion}}   </td>
        <td>    {{ $punto->municipio->nombre}}</td>
        <td>    {{ $punto->estado}}      </td>
        <td>    {{ $punto->descripcion}} </td>
        <td>

          <a href="#" class = 'btn btn-default btn-xs' data-toggle='modal' data-target='#myModalEditPunto' OnClick="Mostrar({{$punto->id}});" title="Editar">
            <span class = "glyphicon glyphicon-pencil"></span>
          </a> 
          <a href="#" OnClick="Eliminar({{$punto->id}});" class = 'btn btn-default btn-xs' title="Eliminar"><span class = "glyphicon glyphicon-trash" ></span></a>  

        </td>
      </tr>
    @endforeach
  </tbody>
</table>



<div class="text-center">
  {!! $puntos->render() !!}
</div>

<script>

  $( document ).ready(function() {

    $('#puntos').dataTable( {
      'paging':false,
      'ordering':false,
      'scrollY': 400,
      "scrollCollapse": false,
      "scrollX": false,
      "searching": true

    });

  });
//Mostrar: inserta la data en el formulario de edición del punto

 function Mostrar(punto_id){
     var route = "{{url('admin/puntos')}}/"+punto_id+"/edit";
     var route2 = "{{url('admin/municipios/cargar')}}";

     $.get(route,function(data){

       $('#id').val(data.punto.id);
       $('#_telefono').val(data.punto.telefono);
       $('#_nombre').val(data.punto.nombre);
       $('#_direccion').val(data.punto.direccion);
       $('#_descripcion').val(data.punto.descripcion);
       $('#_prefijo').val(data.punto.prefijo);
       $('#estado').empty();
       $('#_zona_id').empty();

       $('#_zona_id').append("<option selected disabled'>- -</option>");
       $.each(data.zonas, function(index, zona){
         if(data.punto.zona_id == zona.id){
           $('#_zona_id').append("<option selected value='"+zona.id+"'>"+zona.nombre+"</option>");
         } else {
           $('#_zona_id').append("<option value='"+zona.id+"'>"+zona.nombre+"</option>");
         }
       });

       if(data.punto.estado == 'Activo'){
         $('#estado').append('<option value="Activo" selected>Activo</option>');
         $('#estado').append('<option value="Inactivo" >Inactivo</option>');
       }else{
         $('#estado').append('<option value="Activo" >Activo</option>');
         $('#estado').append('<option value="Inactivo" selected>Inactivo</option>');
       }

       //llamado para traer los municipios y seleccionar el que pertenece al punto

       $.get(route2, function(res){
        if(!res.error){
          $.each(res.data.municipios, function(index,municipio){
            if(municipio.id == data.punto.municipio_id){
              $('#_municipio_id').append(
                "<option selected value='"+municipio.id+"'>"+municipio.nombre+" ("+municipio.departamento+" )</option>"
                );
            }
            else{
              $('#_municipio_id').append(
                "<option value='"+municipio.id+"'>"+municipio.nombre+" ("+municipio.departamento+" )</option>");
                }
            });
        }
        else{  alert('ERROR'); }
     });
     });
     

  }

  function Eliminar(id){
    var x = confirm('¿Esta seguro de eliminar el Punto?');
    if(!x){ return false; }
    var route= "{{url('admin/puntos')}}/"+id+"/destroy";
    $.get(route,function(res){
      Cargar();
      $('#mensaje').text(res);
      $('#msj-success').fadeIn();
    });
  }
  
</script>