<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true" style="margin-bottom: 1px;">
  <div class="">
    <div role="tab" id="headingOne">
      <p>
        <a  role="button" data-toggle="collapse" data-parent="#accordion" 
            href="#collapseOne" aria-expanded="true" aria-controls="collapseOne" 
            style="font-size:12px;color:black;"
            id="btn-show-conyuge">

        <span class="glyphicon glyphicon-menu-down" id="glyphicon" aria-hidden="true"></span>
          Información del Conyuge
        </a>
      </p>
    </div>
    <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
      <div class="panel-body" style="padding:0px;">

            <dl class="dl-horizontal">

              <!-- Nombre  -->

              <dt>Nombre:</dt>
              <dd>{{ $cliente->conyuge->nombrey }}</dd>

              <dt>Documento:</dt>
              <dd>{{ $cliente->conyuge->identificacion }}</dd>

              <dt>Teléfono celular</dt>
              <dd>{{ $cliente->conyuge->movily }}</dd>

              <dt>Teléfono fijo:</dt>
              <dd>{{ $cliente->conyuge->fijoy }}</dd>

              <dt>Dirección:</dt>
              <dd>{{ $cliente->conyuge->diry }}</dd>

            </dl>
      </div>
    </div>
  </div>
</div>

<script>

  const btn_show_conyuge = document.getElementById('btn-show-conyuge')
  const glyphicon = document.getElementById('glyphicon')
  let show = false

  btn_show_conyuge.addEventListener('click', () => {
    show = !show

    glyphicon.classList.remove('glyphicon-menu-down')
    glyphicon.classList.remove('glyphicon-menu-up')

    if (show) {
      glyphicon.classList.add('glyphicon-menu-up')
    } else {
      glyphicon.classList.add('glyphicon-menu-down')
    }
  })

</script>

