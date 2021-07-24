
<div class="modal fade" tabindex="-1" role="dialog" id="myModalEditCriterio">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Editar Criterio de llamada</h4>
      </div>
      <div class="modal-body">


        <form class="form-horizontal form-label-left" action="" method="POST">

          <div class="form-group">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <label for="">Criterio *:</label>
              <input type="text" class="form-control" id="_criterio" name="_criterio">
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
        <button type="button" class="btn btn-primary" id="actualizar">Guardar Cambios</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>

   $('#actualizar').click(function(){

 
      var id          = $('#id').val();
      var criterio    = $('#_criterio').val();
      var descripcion = $('#_descripcion').val();
      var route       = "{{url('admin/criteriocall')}}/"+id;
      var token       = $('#token_').val();

      $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': token},
        type: 'PUT',
        dataType: 'json',
        data: {id:id,criterio:criterio,descripcion:descripcion},
        success:function(res){

            console.log({res});

            if (res.success) {
                $('#mensaje').text('El criterio "'+res.dat+'" se editó con éxito!!!!');
                $('#msj-success').fadeIn();
                $('#myModalEditCriterio').modal('toggle');
                Cargar();
            } else {
                alertify.alert('Error', res.message);
            }
        }
      });


   });
</script>
