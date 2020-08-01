<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true" style="margin-bottom: 1px;">
  <div class="">
    <div role="tab" id="headingFour">
      <p>
        <a  role="button" data-toggle="collapse" data-parent="#accordion" 
            href="#collapseFour" aria-expanded="true" aria-controls="collapseFour" 
            style="font-size:12px;color:black;"
            id="btn-show_personalCliente">

        <span class="glyphicon glyphicon-menu-down" id="glyphicon_personalCliente" aria-hidden="true"></span>
          Información personal
        </a>
      </p>
    </div>
    <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
      <div class="panel-body" style="padding:0px;">

            <dl class="dl-horizontal">

              <dt>Ciudad exp. doc:</dt>
              <dd>{{ $cliente->lugar_exp}}</dd>

              <dt>Fecha de exp. doc:</dt>
              <dd>{{  \Carbon\Carbon::parse($cliente->fecha_exp)->format('d-m-Y') }}</dd>

              <dt>Estado civil:</dt>
              <dd>{{ $cliente->estado_civil }}</dd>

              <dt>Fecha de nacimiento</dt>
              <dd>{{ \Carbon\Carbon::parse($cliente->fecha_nacimiento)->format('d-m-Y') }}</dd>

              <dt>Lugar de nacimiento:</dt>
              <dd>{{ $cliente->lugar_nacimiento }}</dd>

              <dt>Nivel de estudios:</dt>
              <dd>{{ $cliente->nivel_estudios }}</dd>

            </dl>
      </div>
    </div>
  </div>
</div>

<script>

  const btn_show_personalCliente = document.getElementById('btn-show_personalCliente')
  const glyphicon_personalCliente = document.getElementById('glyphicon_personalCliente')
  let show_personalCliente = false

  btn_show_personalCliente.addEventListener('click', () => {
    show_personalCliente = !show_personalCliente

    glyphicon_personalCliente.classList.remove('glyphicon-menu-down')
    glyphicon_personalCliente.classList.remove('glyphicon-menu-up')

    if (show_personalCliente) {
      glyphicon_personalCliente.classList.add('glyphicon-menu-up')
    } else {
      glyphicon_personalCliente.classList.add('glyphicon-menu-down')
    }
  })

</script>

