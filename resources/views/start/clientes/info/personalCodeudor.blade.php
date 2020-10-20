<div class="panel-group" id="accordion15" role="tablist" aria-multiselectable="true" style="margin-bottom: 1px;">
  <div class="">
    <div role="tab" id="headingFour">
      <p>
        <a  role="button" data-toggle="collapse" data-parent="#accordion15" 
            href="#collapseCodeudor" aria-expanded="true" aria-controls="collapseCodeudor" 
            style="font-size:12px;color:black;"
            id="btn-show_personalCodeudor">

        <span class="glyphicon glyphicon-menu-down" id="glyphicon_personal" aria-hidden="true"></span>
          Información personal
        </a>
      </p>
    </div>
    <div id="collapseCodeudor" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingCodeudor">
      <div class="panel-body" style="padding:0px;">

            <dl class="dl-horizontal">

                <dt>Ciudad exp. doc:</dt>
                <dd>{{ $cliente->codeudor->lugar_exp}}</dd>

                <dt>Fecha de exp. doc:</dt>
                <dd>{{  $cliente->codeudor->fecha_exp }}</dd>

                <dt>Estado civil:</dt>
                <dd>{{ $cliente->codeudor->estado_civil }}</dd>

                <dt>Fecha de nacimiento</dt>
                <dd>{{ $cliente->codeudor->fecha_nacimiento }}</dd>

                <dt>Lugar de nacimiento:</dt>
                <dd>{{ $cliente->codeudor->lugar_nacimiento }}</dd>

                <dt>Nivel de estudios:</dt>
                <dd>{{ $cliente->codeudor->nivel_estudios }}</dd>

            </dl>
      </div>
    </div>
  </div>
</div>

<script>

  const btn_show_personalCodeudor = document.getElementById('btn-show_personalCodeudor')
  const glyphicon_personalCodeudor = document.getElementById('glyphicon_personalCodeudor')
  let show_personalCodeudor = false

  btn_show_personalCodeudor.addEventListener('click', () => {
    show_personalCodeudor = !show_personalCodeudor

    glyphicon_personalCodeudor.classList.remove('glyphicon-menu-down')
    glyphicon_personalCodeudor.classList.remove('glyphicon-menu-up')

    if (show_personalCodeudor) {
      glyphicon_personalCodeudor.classList.add('glyphicon-menu-up')
    } else {
      glyphicon_personalCodeudor.classList.add('glyphicon-menu-down')
    }
  })

</script>

