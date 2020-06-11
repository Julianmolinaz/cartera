<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true" style="margin-bottom: 1px;">
  <div class="">
    <div role="tab" id="headingOne">
      <p>
        <a  role="button" data-toggle="collapse" data-parent="#accordion" 
            href="#collapseOne" aria-expanded="true" aria-controls="collapseOne" 
            style="font-size:12px;color:black;"
            id="btn-show">

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

  const btn_show = document.getElementById('btn-show')
  const glyphicon = document.getElementById('glyphicon')
  let show = false

  btn_show.addEventListener('click', () => {
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

