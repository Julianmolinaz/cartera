<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true" style="margin-bottom: 1px;">
  <div class="">
    <div role="tab" id="headingOne">
      <p>
        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne" style="font-size:12px;color:black;">
          {{$cliente->conyuge->nombrey}}
        </a>
      </p>
    </div>
    <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
      <div class="panel-body" style="padding:0px;">

            <p>Documento: {{$cliente->conyuge->tipo_docy.' '.$cliente->conyuge->num_docy}}</p>
            <p>Dirección: {{$cliente->conyuge->diry}}</p>
            <p>Teléfonos: {{($cliente->conyuge->fijoy) ? $cliente->conyuge->fijoy : ' '}}
                           {{($cliente->conyuge->movily) ? $cliente->conyuge->movily : ''}} 
            </p>

      </div>
    </div>
  </div>
</div>

