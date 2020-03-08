<div class="panel panel-default">
    <div class="panel-body">
        <div class="form-group" style="margin-bottom:10px;">
            <div class="col-md-12">
                <label>Condiciones del Negocio</label>
            </div>
        </div>
        <hr style="border:.3px solid #DCDCDC;margin-top:0px;">
        <div class="form-group">
            <template v-if="estado == 'actualizacion'">
                <div class="col-md-3">
                    <label>Ref. Mes</label>            
                    <select name="" id="" class="form-control input-sm">
                        <option>--</option>
                    </select>
                </div>
                <div class="col-md-3" v-if="estado == 'actualizacion'">
                    <label>Ref. Año</label>            
                    <select name="" id="" class="form-control input-sm">
                        <option>--</option>
                    </select>
                </div>
            </template>
            <div class="col-md-6">
                <label>Centro de Costos *:</label>
                <input type="text" name="" id="" class="form-control input-sm">
                <span></span>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-3">
                <label>Periodo *:</label>
                <select name="" id="" class="form-control input-sm" v-model="solicitud.periodo" @change="changePeriodo()">
                    <option selected disabled>--</option>
                    <option :value="periodo" v-for="periodo in arr_periodos">@{{ periodo }}</option>
                </select>
            </div>
            <div class="col-md-3">
                <label>Meses *:</label>
                <input type="text" name="" id="" class="form-control input-sm" v-model="solicitud.meses" v-on:keyup="changeMeses">
            </div>
            <div class="col-md-3">
                <label>Núm. de cuotas *:</label>
                <input type="text" class="form-control input-sm" v-model="solicitud.cuotas" :disabled="this.estado=='creacion'">
            </div>
            <div class="col-md-3">
                <label>Valor cuota *:</label>
                <input type="text" class="form-control input-sm">
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-3">
                <label>Fecha 1 *:</label>
                <input type="text" class="form-control input-sm">
            </div>
            <div class="col-md-3">
                <label>Fecha 2 :</label>
                <input type="text" class="form-control input-sm">
            </div>
            <div class="col-md-3">
                <label>Estudio *:</label>
                <select name="" id="" class="form-control input-sm">
                    <option selected disabled>--</option>
                    <option :value="estudio" v-for="estudio in arr_estudios">@{{ estudio }}</option>
                </select>
            </div>
            <div class="col-md-3">
                <label>Cuota inicial :</label>
                <input type="text" class="form-control input-sm">
            </div>
        </div>    

        <div class="form-group">
            <div class="col-md-12">
                <label>Observaciones:</label>
                <textarea rows="3" class="form-control"></textarea>
            </div>
        </div>        
            
    </div>
</div>
    

</div>