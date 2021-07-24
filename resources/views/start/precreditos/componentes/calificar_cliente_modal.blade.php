<div class="modal fade" id="calificar" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header my-header">
                <h4 class="modal-title">Calificar Cliente</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="">Calificación</label>
                    <select class="form-control" v-model="credito.calificacion">
                        <option selected disabled>--</option>
                        <option :value="calificacion" v-for="calificacion in $store.state.data_credito.calificaciones">@{{ calificacion }}</option>
                    </select>
                </div>

                <div class="form-group">
                    <button class="btn btn-primary btn-block" data-dismiss="modal">Aceptar</button>
                </div>
            </div>
        </div>
    </div>
</div>