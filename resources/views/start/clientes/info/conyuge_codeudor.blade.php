
<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true" style="margin-bottom: 1px;">
  <div class="">
    <div role="tab" id="headingTwo">
      <p>
        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo" style="font-size:12px;color:black;">
          {{$cliente->codeudor->conyuge->nombrey}}
        </a>
      </p>
    </div>
    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
      <div class="panel-body" style="padding:0px;">

            <p>Documento: {{$cliente->codeudor->conyuge->tipo_docy.' '.$cliente->codeudor->conyuge->num_docy}}</p>
            <p>Dirección: {{$cliente->codeudor->conyuge->diry}}</p>
            <p>Teléfonos: {{($cliente->codeudor->conyuge->fijoy) ? $cliente->codeudor->conyuge->fijoy : ' '}}
                           {{($cliente->codeudor->conyuge->movily) ? $cliente->codeudor->conyuge->movily : ''}} 
            </p>

      </div>
    </div>
  </div>
</div>
