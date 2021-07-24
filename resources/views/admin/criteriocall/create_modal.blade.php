

<div class="modal fade" tabindex="-1" role="dialog" id="myModalCrearCriterio">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Crear criterio llamada</h4>
      </div>
      <div class="modal-body">
        
        <form class="form-horizontal form-label-left" action="" method="POST">

          <div class="form-group">
              <div class="col-md-12 col-sm-12 col-xs-12">
              <label for="">Criterio *:</label>
              <input type="text" class="form-control" placeholder="ingrese el criterio de llamada" id="criterio" name="criterio" >
            </div>
          </div>

          <div class="form-group">
              <div class="col-md-12 col-sm-12 col-xs-12">
              <label for="">Descripción :</label>
              <textarea class="form-control" rows="3" id="descripcion" name="descripcion" placeholder='Escriba la descripción del criterio' autocomplete="off"></textarea>
            </div>
          </div>          

          <input type="hidden" name="_token" id="token" value="{{{ csrf_token() }}}" />

        </form>

<!-- BOTONES **************************************************************************-->

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="btn_crear_criterio">Crear</button>
      </div>

      </div>

    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->




<script>
  $('#btn_crear_criterio').click(function(){
    
    var criterio      = $('#criterio').val();
    var descripcion   = $('#descripcion').val();   
    var route         = "{{url('admin/criteriocall')}}";
    var token         = $("#token").val();

    $.ajax({
      url: route,
      headers: {'X-CSRF-TOKEN': token},
      type: 'POST',
      dataType: 'json',
      data: {criterio:criterio,descripcion:descripcion},
        success:function(data){
          
          if(data.res == true){
            $('#mensaje').text('El tipo criterio '+data.criterio+' se creó con éxito!!!!');
            $('#msj-success').fadeIn();
            Cargar();
            $('#myModalCrearCriterio').modal('toggle');
            $('#criterio').val("");
            $('#descripcion').val("");   
          } else{
            $('#mensaje').text('Ocurrió un error!!!');
            $('#msj-success').fadeIn();
          }

        }
    });

  });
</script>

