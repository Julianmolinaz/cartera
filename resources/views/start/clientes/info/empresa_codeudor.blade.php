<div class="panel-group" 
     id="accordion4" 
     role="tablist" 
     aria-multiselectable="true" 
     style="margin-bottom: 1px;">
  <div class="">
    <div role="tab" id="headingEmpresa_codeudor">
      <p>
        <a role="button" 
            data-toggle="collapse" 
            data-parent="#accordionEmpresa_codeudor" 
            href="#collapseEmpresa_codeudor"
            aria-expanded="true" 
            aria-controls="collapseEmpresa_codeudor" 
            style="font-size:12px;color:black;"
            class="btn btn-default btn-xs"
            id="btn-show_empresa_codeudor">
          <span class="glyphicon glyphicon-menu-down" 
            id="glyphicon_empresa_codeudor" 
            aria-hidden="true"></span>
            Información Laboral
        </a>
      </p>
    </div>
    <div id="collapseEmpresa_codeudor" 
        class="panel-collapse collapse" 
        role="tabpanel" 
        aria-labelledby="headingEmpresa_codeudor">
      <div class="panel-body" style="padding:0px;" >

            <p>Tipo de actividad: {{ ($cliente->codeudor) ? $cliente->codeudor->tipo_actividadc : '' }}</p>
            <p>Empresa:   {{ ($cliente->codeudor) ? $cliente->codeudor->empresac : ''}}    </p>
            <p>Dirección: {{ ($cliente->codeudor) ? $cliente->codeudor->dir_empresac : ''}} </p>
            <p>Teléfonos: {{ ($cliente->codeudor) ? $cliente->codeudor->tel_empresac : ''}} </p>

      </div>
    </div>
  </div>
</div>


<script>

  const btn_show_empresa_codeudor = document.getElementById('btn-show_empresa_codeudor')
  const glyphicon_empresa_codeudor = document.getElementById('glyphicon_empresa_codeudor')
  let show_empresa_codeudor = false

  btn_show_empresa_codeudor.addEventListener('click', () => {
    show_empresa_codeudor = !show_empresa_codeudor

    glyphicon_empresa_codeudor.classList.remove('glyphicon-menu-down')
    glyphicon_empresa_codeudor.classList.remove('glyphicon-menu-up')

    if (show_empresa_codeudor) {
      glyphicon_empresa_codeudor.classList.add('glyphicon-menu-up')
    } else {
      glyphicon_empresa_codeudor.classList.add('glyphicon-menu-down')
    }
  })

</script>
