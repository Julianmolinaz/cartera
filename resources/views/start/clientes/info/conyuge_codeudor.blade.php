<div class="panel-group" id="accordion_cconyuge" role="tablist" aria-multiselectable="true" style="margin-bottom: 1px;">
  <div class="">
    <div role="tab" id="headig_cconyuge">
      <p>
        <a  role="button" data-toggle="collapse" data-parent="#accordion_cconyuge" 
            href="#collapse_cconyuge" aria-expanded="true" aria-controls="collapse_cconyuge" 
            style="font-size:12px;color:black;"
            id="btn-show-cconyuge">

        <span class="glyphicon glyphicon-menu-down" id="glyphicon" aria-hidden="true"></span>
          Información del Conyuge
        </a>
      </p>
    </div>
    <div id="collapse_cconyuge" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headig_cconyuge">
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

            <p class="text-right">
              <a href="{{route('start.conyuges.edit',[$cliente->id,'cliente'])}}" 
                class = 'btn btn-default btn-xs'><span class = "glyphicon glyphicon-pencil">
              </a>
              <a href="{{route('start.conyuges.destroy',[$cliente->id, 'cliente'])}}" 
                onclick="return confirm('¿Esta seguro de eliminar el conyuge?')" 
                class = 'btn btn-default btn-xs' 
                data-toggle="tooltip" 
                data-placement="top" 
                title="Eliminar">
                <span class = "glyphicon glyphicon-trash" >
              </a>
            </p>

      </div>
    </div>
  </div>
</div>

<script>

  const btn_show_cconyuge = document.getElementById('btn-show-cconyuge')
  const glyphicon_cconyuge = document.getElementById('glyphicon_cconyuge')
  let show_cconyuge = false

  btn_show_cconyuge.addEventListener('click', () => {
    show_cconyuge = !show_cconyuge

    glyphicon_cconyuge.classList.remove('glyphicon-menu-down')
    glyphicon_cconyuge.classList.remove('glyphicon-menu-up')

    if (show_cconyuge) {
      glyphicon_cconyuge.classList.add('glyphicon-menu-up')
    } else {
      glyphicon_cconyuge.classList.add('glyphicon-menu-down')
    }
  })

</script>

