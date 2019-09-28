
<div class="modal fade" tabindex="-1" role="dialog" id="mes">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">

                <div class="panel panel-primary">

                    <div class="panel-heading">Mes de referencia</div>

                    <div class="panel-body" style="color:gray;">
                        <div class="form-group">
                            <label for="anio">Año</label>
                            <select class="form-control" v-model="anio">
                            <option selected disabled>--</option>
                            <option :value="anio" v-for="anio in anios">
                                @{{ anio }}
                                </option>
                            </select>
                            <p class="help-block">Digite el año al que corresponde el crédito.</p>
                        </div>

                        <div class="form-group">
                            <label for="mes">Mes</label>
                            <select class="form-control" v-model="mes">
                            <option selected disabled>--</option>
                            <option :value="mes" v-for="mes in 
                                ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre']">
                                @{{ mes }}
                                </option>
                            </select>
                            <p class="help-block">Digite el mes al que corresponde el crédito.</p>
                        </div>

                        <button type="button" class="btn btn-primary" @click="crearCredito()">Crear Crédito</button>
                    </div>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->      