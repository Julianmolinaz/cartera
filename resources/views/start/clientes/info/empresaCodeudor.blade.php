<div class="panel-group" id="accordion3" role="tablist" aria-multiselectable="true" style="margin-bottom: 1px;">
  <div class="">
    <div role="tab" id="headingEmpresaCodeudor">
      <p>
        <a  role="button" data-toggle="collapse" 
            data-parent="#accordion3" 
            href="#collapseEmpresaCodeudor" 
            aria-expanded="true" 
            aria-controls="collapseThree" 
            style="font-size:12px;color:black;"
            id="btn-show_empresaCodeudor">

          <span class="glyphicon glyphicon-menu-down" id="glyphicon_empresaCodeudor" aria-hidden="true"></span>
            Información Laboral
        </a>
      </p>
    </div>
    <div id="collapseEmpresaCodeudor" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingEmpresaCodeudor">
      <div class="panel-body" style="padding:0px;" >

      <dl class="dl-horizontal">

        <dt>Ocupación:</dt>
        <dd>{{ $cliente->codeudor->ocupacion }}</dd>

        <dt>Empresa:</dt>
        <dd>{{ $cliente->codeudor->empresa }}</dd>

        <dt>Dirección</dt>
        <dd>{{ $cliente->codeudor->dir_empresa }}</dd>

        <dt>Tipo de actividad</dt>
        <dd>{{ $cliente->codeudor->tipo_actividad }}</dd>

        <dt>Teléfono empresa:</dt>
        <dd>{{ $cliente->codeudor->tel_empresa }}</dd>

        <dt>Cargo:</dt>
        <dd>{{ $cliente->codeudor->cargo }}</dd>

        <dt>Descripción de actividad</dt>
        <dd>{{ $cliente->codeudor->descripcion_actividad }}</dd>

        <dt>Documento empresa</dt>
        <dd>{{ $cliente->codeudor->doc_empresa }}</dd>

        <dt>Fecha de vinculacion</dt>
        <dd>{{ $cliente->codeudor->fecha_vinculacion }}</dd>

        <dt>Oficio</dt>
        <dd>{{ $cliente->codeudor->oficio }}</dd>

        <dt>Tipo de contrato</dt>
        <dd>{{ $cliente->codeudor->tipo_contrato }}</dd>

      </dl>

      </div>
    </div>
  </div>
</div>

<script>

  const btn_show_empresaCodeudor = document.getElementById('btn-show_empresaCodeudor')
  const glyphicon_empresaCodeudor = document.getElementById('glyphicon_empresaCodeudor')
  let show_empresaCodeudor = false

  btn_show_empresaCodeudor.addEventListener('click', () => {
    show_empresaCodeudor = !show_empresaCodeudor

    glyphicon_empresaCodeudor.classList.remove('glyphicon-menu-down')
    glyphicon_empresaCodeudor.classList.remove('glyphicon-menu-up')

    if (show_empresaCodeudor) {
      glyphicon_empresaCodeudor.classList.add('glyphicon-menu-up')
    } else {
      glyphicon_empresaCodeudor.classList.add('glyphicon-menu-down')
    }
  })

</script>

