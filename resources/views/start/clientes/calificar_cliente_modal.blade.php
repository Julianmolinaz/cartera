

<div class="modal fade" id="calificar_cliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <p>
          BB : Mejor calificación pagó cumplido.
        </p>
        <p>
          B : Se le hicierón llamados pero pago.
        </p>
        <p>
          M : Se insistió mucho, muy dificil el cliente pero pagó.
        </p>
        <p>
          MM : Pagó con demanda.
        </p>
        <p>
          CASTIGADA : no pagó.  
        </p>
        <hr>

          <div class="form-group">
            <label for="recipient-name" class="form-control-label">Calificación:</label>
            <select class="form-control form-control-lg" id="select_calificacion">
                <option disabled selected>- -</option>
              @foreach($calificaciones as $calificacion)
                <option>{{$calificacion}}</option>
              @endforeach
            </select>
          </div>
          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onClick="Calificar();">Aceptar</button>
      </div>
    </div>
  </div>
</div>


<script>
  function Calificar(){
    $('#calificacion').val($('#select_calificacion').val());
    $('#calificar_cliente').modal('toggle');

  }
</script>