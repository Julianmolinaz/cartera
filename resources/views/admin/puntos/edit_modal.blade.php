
<div class="modal fade" tabindex="-1" role="dialog" id="myModalEditPunto">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Editar Punto</h4>
      </div>
      <div class="modal-body">
        

        <form class="form-horizontal form-label-left" action="" method="POST">

          <div class="form-group">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <label for="">Nombre *:</label>
              <input type="text" class="form-control" id="_nombre" name="_nombre">
            </div>
          </div>

          <div class="form-group">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <label for="">Dirección *:</label>
              <input type="text" class="form-control" id="_direccion" name="_direccion">
            </div>
          </div>

          <div class="form-group">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <label for="">Municipio</label>
              <select id="_municipio_id" class="form-control">
              </select>
            </div>
          </div> 

          <div class="form-group">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <label>Estado</label>
                <select class="form-control" input-sm id="estado">

                </select>
            </div>  
          </div>         

          <div class="form-group">
              <div class="col-md-12 col-sm-12 col-xs-12">
              <label for="">Descripción :</label>
              <textarea class="form-control" rows="3" id="_descripcion" name="_descripcion"></textarea>
            </div>
          </div>  


          <input type="hidden" name="id" id="id"/>
          <input type="hidden" name="_token" id="token_" value="{{{ csrf_token() }}}" />

        </form>  


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="actualizar">Guardar Cambio</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>

   $('#actualizar').click(function(){ 


      var id          = $('#id').val();
      var nombre      = $('#_nombre').val();
      var direccion   = $('#_direccion').val();
      var municipio_id= $('#_municipio_id').val();
      var estado      = $('#estado').val();
      var descripcion = $('#_descripcion').val();
      var route       = "{{url('admin/puntos')}}/"+id;
      var token       = $('#token_').val();

          
      $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': token},
        type: 'PUT',
        dataType: 'json',
        data: { id          :id,
                nombre      :nombre,
                direccion   :direccion,
                municipio_id:municipio_id,
                estado      :estado,
                descripcion :descripcion},
          success:function(res){
            Cargar();
            $('#mensaje').text(res.mensaje);
            $('#msj-success').fadeIn();
            $('#myModalEditPunto').modal('toggle');
           }
      });
   });


</script>

