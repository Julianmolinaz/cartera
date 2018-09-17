<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true" style="margin-bottom: 1px;">
  <div class="">
    <div role="tab" id="headingFour">
      <p>
        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour"
         aria-expanded="true" aria-controls="collapseFour" style="font-size:12px;color:black;"
         class="btn btn-default btn-xs">
          {{ ($cliente->codeudor) ? $cliente->codeudor->ocupacionc : ''}}
        </a>
      </p>
    </div>
    <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
      <div class="panel-body" style="padding:0px;" >

            <p>Tipo de actividad: {{ ($cliente->codeudor) ? $cliente->codeudor->tipo_actividadc : '' }}</p>
            <p>Empresa:   {{ ($cliente->codeudor) ? $cliente->codeudor->empresac : ''}}    </p>
            <p>Dirección: {{ ($cliente->codeudor) ? $cliente->codeudor->dir_empresac : ''}} </p>
            <p>Teléfonos: {{ ($cliente->codeudor) ? $cliente->codeudor->tel_empresac : ''}} </p>

      </div>
    </div>
  </div>
</div>
