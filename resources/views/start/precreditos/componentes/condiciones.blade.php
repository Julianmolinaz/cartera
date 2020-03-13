<div class="panel panel-default">

    <div class="panel-body">

        <div class="form-group" style="margin-bottom:10px;">
            <div class="col-md-12">
                <label>Condiciones del Negocio</label>
            </div>
        </div>

        <hr style="border:.3px solid #DCDCDC;margin-top:0px;">

        <div class="form-group">

            <div class="col-md-6">
                <label>Centro de Costos *:</label>
                <input  type="text" 
                        name="Centro de Costos"
                        v-validate="'required|numeric'"
                        id="centro_de_costos" 
                        :class="['form-control','input-sm', errors.first('Centro de Costos') ? '_has-error' : '']" 
                        v-model="solicitud.vlr_fin"
                        :disabled="user.rol != rol_permitido">
                <span class="help-block">@{{ solicitud.vlr_fin | miles }}</span>
                <h6 class="text-danger">@{{errors.first('Centro de Costos')}}</h6>
            </div>

            <div class="col-md-6">
                <label>Periodo *:</label>
                <select :class="['form-control','input-sm',errors.first('Periodo') ? '_has-error' : '']" 
                        name="Periodo"
                        v-validate="'required'"
                        v-model="solicitud.periodo" 
                        @change="changePeriodo()"
                        :disabled="user.rol != rol_permitido">
                    <option selected disabled>--</option>
                    <option :value="periodo" v-for="periodo in arr_periodos">@{{ periodo }}</option>
                </select>
                <h6 class="text-danger">@{{errors.first('Periodo')}}</h6>
            </div>

        </div>

        <div class="form-group">    

            <div class="col-md-3">
                <label>Meses *:</label>
                <input  name="Meses"
                        v-validate="'required'"
                        type="text" 
                        :class="['form-control','input-sm',errors.first('Periodo') ? '_has-error' : '']" 
                        v-model="solicitud.meses" 
                        v-on:keyup="changeMeses"
                        :disabled="user.rol != rol_permitido">
                <h6 class="text-danger">@{{errors.first('Meses')}}</h6>
            </div>

            <div class="col-md-3">
                <label>Núm. de cuotas *:</label>
                <input  type="text" 
                        class="form-control input-sm" 
                        v-model="solicitud.cuotas" 
                        :disabled="estado != 'creacion' || solicitud.periodo == 'Mensual'">
            </div>
            <div class="col-md-6">
                <label>Valor cuota *:</label>
                <input  name="Valor cuota"
                        v-validate="'required|numeric'"
                        type="text" 
                        :class="['form-control','input-sm',errors.first('Valor cuota') ? '_has-error' : '']" 
                        v-model="solicitud.vlr_cuota"
                        :disabled="user.rol != rol_permitido">
                <span class="help-block">@{{ solicitud.vlr_cuota | miles }}</span>
                <h6 class="text-danger">@{{errors.first('Valor cuota')}}</h6>
            </div>

        </div>

        <div class="form-group">

            <div class="col-md-3">
                <label>Fecha 1 *:</label>
                <select name="Fecha 1"
                        :class="['form-control','input-sm',errors.first('Fecha 1') ? '_has-error' : '']" 
                        v-model="solicitud.p_fecha" 
                        v-validate="'required'"
                        :disabled="!solicitud.periodo || user.rol != rol_permitido">
                        
                    <option selected disabled>--</option>
                    <option :value="index1" v-for="index1 in 30" 
                        v-if="index1 >= topes.p_fecha_ini && index1 <= topes.p_fecha_fin">@{{ index1 }}</option>
                </select>
                <h6 class="text-danger">@{{errors.first('Fecha 1')}}</h6>
            </div>

            <div class="col-md-3">
                <label>Fecha 2 :</label>
                <select name="Fecha 2"
                        v-validate="(solicitud.periodo == 'Quincenal') ? 'required' : ''"
                        :class="['form-control','input-sm',errors.first('Fecha 2') ? '_has-error' : '']" 
                        v-model="solicitud.s_fecha" 
                        :disabled="solicitud.periodo != 'Quincenal' || user.rol != rol_permitido">
                    <option selected disabled>--</option>
                    <option :value="index2" v-for="index2 in 30" v-if="index2 >= topes.s_fecha_ini && index2 <= topes.s_fecha_fin">@{{ index2 }}</option>
                </select>
                <h6 class="text-danger">@{{errors.first('Fecha 2')}}</h6>
            </div>

            <div class="col-md-3">
                <label>Estudio *:</label>
                <select name="Estudio"
                        v-validate="'required'"
                        :class="['form-control','input-sm',errors.first('Estudio') ? '_has-error' : '']" 
                        v-model="solicitud.estudio"
                        :disabled="user.rol != rol_permitido">
                    <option selected disabled>--</option>
                    <option :value="estudio" v-for="estudio in arr_estudios">@{{ estudio }}</option>
                </select>
                <h6 class="text-danger">@{{errors.first('Estudio')}}</h6>
            </div>

            <div class="col-md-3">
                <label>Cuota inicial :</label>
                <input  type="text"
                        class="form-control input-sm" 
                        v-model="solicitud.cuota_inicial"
                        :disabled="user.rol != rol_permitido">
                <span class="help-block">@{{ solicitud.cuota_inicial | miles }}</span>
            </div>

        </div>    

        <div class="form-group">
            <div class="col-md-12">
                <label>Observaciones:</label>
                <textarea   rows="3" 
                            class="form-control" 
                            v-model="solicitud.observaciones"
                            :disabled="user.rol != rol_permitido">>
                </textarea>
            </div>
        </div>        
            
    </div>
</div>
