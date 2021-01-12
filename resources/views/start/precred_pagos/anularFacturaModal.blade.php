<div class="modal fade" tabindex="-1" role="dialog" id="modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="titulo"></h4>
      </div>
      <div class="modal-body">

        <form class="form-horizontal form-label-left" action="{{route('start.precred_pagos.anular')}}" method="POST">
          
        <div class="form-group">
          <textarea class="form-control" rows="3" id="motivo_anulacion" 
            name="motivo_anulacion" placeholder=''>
          </textarea>
        </div>
        <div class="form-group">
        <center>  
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary">Enviar</button>          
        </center>  
        </div>
          <input type="hidden" name="factura_id" id="factura_id" />
          <input type="hidden" name="num_factura" id="num_fact"/>
          <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        
        </form>

      </div>
        
      
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
