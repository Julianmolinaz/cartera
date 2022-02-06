<div class="modal fade" tabindex="-1" role="dialog" id="modal-aprobacion">
    <div class="modal-dialog" role="document">
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
                <h4 class="modal-title">Aprobar</h4>
            </div>
            <form method="POST" action="{{ route('start.precreditosV3.aprobar') }}">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="aprobado">Aprobado?</label>
                                <select name="aprobado" class="form-control">
                                    @foreach($opcionesAprobacion as $opcion)
                                    <option 
                                        value="{{ $opcion }}"
                                        {{ $solicitud->aprobado === $opcion ? 'selected' : '' }}
                                    >{{ $opcion }}</option>
                                    @endforeach
                                </select>

                                <input type="hidden" name="solicitudId" value="{{ $data['solicitud']->id }}">

                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Salvar Cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    const aprobar = () => {
        $('#modal-aprobacion').modal('show');
    }
</script>