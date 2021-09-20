<div class="modal fade" tabindex="-1" role="dialog" id="modal-certificados">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header my-header">
      <h4 class="modal-title" style="display:initial;"><span style="text-transform:capitalize"></span>Certificados</h4>
        <button type="button" 
            class="close" 
            data-dismiss="modal" 
            aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <li><a onclick="getPazYsalvo()" href="javascript:void(0);">Paz y Salvo</a></li>
          <li><a onclick="getPreavisoCentrales()" href="javascript:void(0);">Preaviso Centrales de Riesgo</a></li>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
    const showModalCertificados = () => {
        $("#modal-certificados").modal('show');
    }

    const cliente = {!! json_encode($precredito->cliente) !!};
    const credito = {!! json_encode($precredito->credito) !!};

    function getPreavisoCentrales() {

      alertify.confirm(
        'Confirmar',
        '¿A quien se le expide el preaviso de centrales?', 
        function () {
          window.open("/start/certificados/preaviso_centrales/"+ credito.id +"/cliente", '_blank');
        },
        function () {
          if (cliente.codeudor_id) {
            window.open("/start/certificados/preaviso_centrales/"+ credito.id +"/codeudor", '_blank');
          } else {
            alertify.alert('Error', 'No existe un codeudor.');
          }
        }
      ).set('labels', {ok:'Cliente', cancel:'Codeudor'});
    }
    
    function getPazYsalvo() {
      alertify.confirm(
        'Confirmar',
        '¿A quien se le expide el paz y salvo?', 
        function () {
          window.open(`/start/certificados/paz_y_salvo/${credito.id}/cliente`, '_blank');
        },
        function () {
          if (cliente.codeudor_id) {
            window.open(`/start/certificados/paz_y_salvo/${credito.id}/codeudor`, '_blank');
          } else {
            alertify.alert('Error', 'No existe un codeudor.');
          }
        }
      ).set('labels', {ok:'Cliente', cancel:'Codeudor'});
    }
    

</script>