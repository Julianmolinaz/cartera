<div class="modal fade" tabindex="-1" role="dialog" id="modal-activar-credito">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button 
            type="button" 
            class="close" 
            data-dismiss="modal" 
            aria-label="Close"
        >
            <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title">Activar Crédito</h4>
      </div>
        <form action="{{ route('start.v3.creditos.store') }}" method="POST">
            <div class="modal-body">

                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group">
                    <label for="mes de comision">Mes</label>
                    <select name="mes" value="mes['nombre']" class="form-control">
                        @foreach($data['meses'] as $mes)
                            <option 
                                value="{{ $mes['nombre']}}"
                                {{ $mes['checked'] ? 'selected' : '' }}
                            >
                                {{ $mes['nombre'] }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="año de comisión">Año</label>
                    <select name="anio" class="form-control">
                        @foreach($data['anos'] as $ano)
                            <option
                                value="{{ $ano['nombre'] }}"
                                {{ $ano['checked'] ? 'selected' : '' }}
                            >
                                {{ $ano['nombre'] }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn pg-btn-dark">Activar Crédito</button>
            </div>
        </form>
    </div>
  </div>
</div>

<script>
    const btn = document.querySelector("#btn-activar-credito");

    btn.addEventListener("click", () => {
        $('#modal-activar-credito').modal('show');
    });
</script>