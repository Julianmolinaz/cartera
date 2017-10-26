<div class="modal fade" tabindex="-1" role="dialog" id="myModal">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Editar Multa</h4>
            </div>
            <div class="modal-body">
              <div class="row">

              <div class="col-md-12 col-sm-12 col-xs-12">


                <form class="form-horizontal form-label-left" id="form">
                
                  <div class="form-group">
                    <div class="col-md-3 col-sm-3 col-xs-12">
                      <label for="">Credito Id :</label>
                      <input type="text" class="form-control"  id="credito_id"  readonly>
                    </div>

                  <div class="col-md-3 col-sm-3 col-xs-12">
                    <label>Fecha</label>
                    <input type="text" class="form-control" id="fecha"  >
                  </div>

                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <label>Concepto</label>
                     <input type="text" class="form-control" id="concepto" readonly>
                  </div>
                  
                </div> 

                <div class="form-group">

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <label>Estado</label>
                     <!--<input type="text" class="form-control" id="estado"  >-->
                    <select class="form-control" input-sm id="estado">


                     </select>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <label for="">Valor *:</label>
                    <input type="text" class="form-control" id="valor" readonly>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <label for="">Debe *:</label>
                    <input type="text" class="form-control" id="debe" readonly>
                  </div>

                </div>

                <div class="form-group">
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <label for="">Sumar *:</label>
                    <input type="text" class="form-control" id="sumar" >
                  </div>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <label for="">Restar *:</label>
                    <input type="text" class="form-control" id="restar" >
                  </div>
                </div> 

                <div class="form-group">
                  <div class="col-md-12 col-sm-12 col-xs-12">
                    <label>Descripción</label>
                    <textarea class="form-control" rows="3" id="descripcion" value="" ></textarea>
                  </div>
                </div> 
              <!-- *** BOTONES ***-->        
                <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}" />
                <input type="hidden" name="id" id="id" value="" />
                <input type="hidden" name="pago_id" id="pago_id" value="" />
              </form>
            </div>
          </div>

        </div>
        <div class="modal-footer">
         <center>
            <a href="#"  class = 'btn btn-primary' id="salir" OnClick='Salir();'>Salir</a>

            <a href="#"  class = 'btn btn-danger' id="editar">Guardar Cambio</a>
         </center>
      </div>
      </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div>

<script>

var Mostrar = function(id){
  route = "{{url('admin/multas')}}/"+id+"/edit";
  $.get(route, function(data){
    $('#id').val(data.multa.id);
    $('#credito_id').val(data.multa.credito_id);
    $('#fecha').val(data.multa.fecha);
    $('#concepto').val(data.multa.concepto);
    $('#debe').val(data.pago.debe);
    $('#pago_id').val(data.pago.id);

    //ESTADO
    $('#estado').empty();
    //alert(data.multa.estado);

    if(data.multa.estado == 'Debe' ){

      $('#estado').append('<option value="Debe" selected>Debe</option>');

    }
    else if(data.multa.estado == 'Ok'){
      $('#estado').append('<option value="Ok" selected>Ok</option>');
      $('#fecha').attr('readonly','true');
      $('#sumar').attr('readonly','true');
      $('#restar').attr('readonly','true');

    }
    else if(data.multa.estado =='Finalizado'){
      $('#estado').append('<option value="Finalizado" selected>Finalizado</option>');
      $('#fecha').attr('readonly','true');
      $('#sumar').attr('readonly','true');
      $('#restar').attr('readonly','true');
   }


    //END ESTADO

    $('#valor').val(data.multa.valor);
    $('#descripcion').val(data.multa.descripcion);

  });
}

var Salir = function(){ $("#myModal").modal('toggle'); }


$('#editar').click(function(){
    var id            = $('#id').val();
    var credito_id    = $('#credito_id').val();
    var fecha         = $('#fecha').val();
    var concepto      = $('#concepto').val();
    var estado        = $('#estado').val();
    var valor         = $('#valor').val();
    var descripcion   = $('#descripcion').val();
    var route         = "{{url('admin/multas')}}/"+id;
    var token         = $('#token').val();

    var sumar         = $('#sumar').val();
    var restar        = $('#restar').val();
    var pago_id       = $('#pago_id').val();


    $.ajax({
      url:route,
      headers:{'X-CSRF-TOKEN':token},
      type:'PUT',
      dataType:'json',
      data: {
            id:id,          
            credito_id:credito_id,    
            fecha:fecha,
            concepto:concepto,   
            estado:estado,
            valor:valor,
            descripcion:descripcion, 
            sumar:sumar,
            restar:restar,
            pago_id:pago_id 
            },
      success: function(data){

        //alert(data.res);
         if(data.success == 'true'){ 
           $('#myModal').modal('toggle');
           location.reload();
           //$('#message-update').fadeIn();
           }
      } 
    });

});

</script>