<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true" style="margin-bottom: 1px;">
  <div class="">
    <div role="tab" id="headingThree">
      <p>
        <a  role="button" data-toggle="collapse" data-parent="#accordion" 
            href="#collapseThree" aria-expanded="true" aria-controls="collapseThree" 
            style="font-size:12px;color:black;"
            id="btn-show_empresa">

          <span class="glyphicon glyphicon-menu-down" id="glyphicon_empresa" aria-hidden="true"></span>
            Información Laboral
        </a>
      </p>
    </div>
    <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
      <div class="panel-body" style="padding:0px;" >

      <dl class="dl-horizontal">

        <dt>Ocupación:</dt>
        <dd>{{ $cliente->ocupacion }}</dd>

        <dt>Empresa:</dt>
        <dd>{{ $cliente->empresa }}</dd>

        <dt>Dirección</dt>
        <dd>{{ $cliente->dir_empresa }}</dd>

        <dt>Tipo de actividad</dt>
        <dd>{{ $cliente->tipo_actividad }}</dd>

        <dt>Teléfono empresa:</dt>
        <dd>{{ $cliente->tel_empresa }}</dd>

                <dt>Cargo:</dt>
        <dd>{{ $cliente->cargo }}</dd>

        <dt>Descripción de actividad</dt>
        <dd>{{ $cliente->descripcion_actividad }}</dd>

        <dt>Documento empresa</dt>
        <dd>{{ $cliente->doc_empresa }}</dd>

        <dt>Fecha de vinculacion</dt>
        <dd>{{ $cliente->fecha_vinculacion }}</dd>

        <dt>Oficio</dt>
        <dd>{{ $cliente->oficio }}</dd>

        <dt>Tipo de contrato</dt>
        <dd>{{ $cliente->tipo_contrato }}</dd>
      </dl>

      </div>
    </div>
  </div>
</div>

<script>

  const btn_show_empresa = document.getElementById('btn-show_empresa')
  const glyphicon_empresa = document.getElementById('glyphicon_empresa')
  let show_empresa = false

  btn_show_empresa.addEventListener('click', () => {
    show_empresa = !show_empresa

    glyphicon_empresa.classList.remove('glyphicon-menu-down')
    glyphicon_empresa.classList.remove('glyphicon-menu-up')

    if (show_empresa) {
      glyphicon_empresa.classList.add('glyphicon-menu-up')
    } else {
      glyphicon_empresa.classList.add('glyphicon-menu-down')
    }
  })

</script>

