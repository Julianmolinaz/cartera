

<div class="modal fade" tabindex="-1" role="dialog" id="myModalCrearPunto">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Crear Punto</h4>
      </div>
      <div class="modal-body">
        
        <form class="form-horizontal form-label-left" action="" method="POST">

          <div class="form-group">
              <div class="col-md-12 col-sm-12 col-xs-12">
              <label for="">Nombre *:</label>
              <input type="text" class="form-control" placeholder="ingrese el nombre del punto" id="nombre" name="nombre" >
            </div>
          </div>
          <div class="form-group">
              <div class="col-md-12 col-sm-12 col-xs-12">
              <label for="">Dirección *:</label>
              <input type="text" class="form-control" placeholder="ingrese la direcciòn del punto" id="direccion" name="direccion" >
            </div>
          </div>

          <div class="form-group">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <label for="">Municipio *:</label>
              <select id="municipio_id" class="form-control">
                <option disabled selected>--</option>
              </select>
            </div>
          </div>

          <div class="form-group">
              <div class="col-md-12 col-sm-12 col-xs-12">
              <label for="">Descripción :</label>
              <textarea class="form-control" rows="3" id="descripcion" name="descripcion" placeholder='Escriba la descripción del punto' autocomplete="off"></textarea>
            </div>
          </div>          

          <input type="hidden" name="_token" id="token" value="{{{ csrf_token() }}}" />

        </form>

<!-- BOTONES **************************************************************************-->

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="btn_crear_punto">Crear</button>
      </div>

      </div>

    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->




<script>
  $('#btn_crear_punto').click(function(){ 
    
    var nombre        = $('#nombre').val();
    var direccion     = $('#direccion').val();
    var descripcion   = $('#descripcion').val();
    var municipio_id  = $('#municipio_id').val(); 
    var route         = "{{url('admin/puntos')}}";
    var token         = $("#token").val();

    $.ajax({
      url: route,
      headers: {'X-CSRF-TOKEN': token},
      type: 'POST',
      dataType: 'json',
      data: {nombre:nombre,direccion:direccion,descripcion:descripcion,municipio_id:municipio_id},
        success:function(data){
          
          if(data.res == true){
            $('#mensaje').text('El Punto '+data.nombre+' se creó con éxito!!!!');
            $('#msj-success').fadeIn();
            limpiar();
            Cargar();
            $('#myModalCrearPunto').modal('toggle');
            $('#punto').val("");
            $('#direccion').val("");
            $('#descripcion').val("");   
          } else{
            $('#mensaje').text('Ocurrió un error!!!');
            $('#msj-success').fadeIn();
          }

        }
    });

  });


  function limpiar(){
    $('#nombre').val('');
    $('#direccion').val('');
    $('#descripcion').val(''); 
  }

  function hola(){
    var route = "{{url('admin/municipios/cargar')}}";
    $.get(route, function(res){
      if(res.error){
        alert('ERROR');
      }
      else{
        $.each(res.data, function(index,municipio){
          $('#municipio_id').append(
            "<option value='"+municipio.id+"'>"+municipio.nombre+' ('+municipio.departamento+" )</option>"
            );
        });
      }
    });
  }

</script>

