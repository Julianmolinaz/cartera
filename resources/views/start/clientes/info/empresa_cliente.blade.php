<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true" style="margin-bottom: 1px;">
  <div class="">
    <div role="tab" id="headingThree">
      <p>
        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="true" aria-controls="collapseThree" style="font-size:12px;color:black;">
          {{$cliente->ocupacion}}
        </a>
      </p>
    </div>
    <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
      <div class="panel-body" style="padding:0px;" >

            <p>Tipo de actividad: {{ $cliente->tipo_actividad  }}</p>
            <p>Empresa:   {{ $cliente->empresa }}    </p>
            <p>Dirección: {{ $cliente->dir_empresa}} </p>
            <p>Teléfonos: {{ $cliente->tel_empresa}} </p>

      </div>
    </div>
  </div>
</div>

