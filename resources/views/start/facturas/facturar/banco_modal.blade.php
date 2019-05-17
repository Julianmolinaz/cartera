<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" 
    aria-labelledby="mySmallModalLabel" id="banco_modal">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">

        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Banco de consignación</h4>
        </div>

        <div class="modal-body">
        
            <select class="form-control" v-model="general.banco">
                @foreach($bancos as $banco)
                    <option value="{{$banco}}">{{ $banco }}</option>
                @endforeach
            </select>
        </div>

        <div class="modal-footer">

            <button type="button" class="btn btn-primary" data-dismiss="modal">Aceptar</button>
        </div>
    </div>
  </div>
</div>