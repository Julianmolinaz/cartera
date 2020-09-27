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
            <dd>{{ $cliente->codeudor->conyuge->nombrey }}</dd>

            <dt>Documento:</dt>
            <dd>{{ $cliente->codeudor->conyuge->identificacion }}</dd>

            <dt>Teléfono celular</dt>
            <dd>{{ $cliente->codeudor->conyuge->movily }}</dd>

            <dt>Teléfono fijo:</dt>
            <dd>{{ $cliente->codeudor->conyuge->fijoy }}</dd>

            <dt>Dirección:</dt>
            <dd>{{ $cliente->codeudor->conyuge->diry }}</dd>

        </dl>
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

