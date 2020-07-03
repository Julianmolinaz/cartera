<div class="panel panel-default">

    <div class="panel-body">

        <div class="form-group form-sm" style="margin-bottom:10px;">
            <div class="col-md-12">
                <label>Condiciones de la Solicitud</label>
            </div>
        </div>

        <hr style="border:.3px solid #DCDCDC;margin-top:0px;">

        <div class="form-group form-sm">

            <div class="col-md-6">
                <label class="text-sm">Centro de Costos *:</label>
                <input  type="text" 
                        name="Centro de Costos"
                        v-validate="'required|numeric'"
                        id="centro_de_costos" 
                        :class="['form-control','sm', errors.first('Centro de Costos') ? '_has-error' : '']" 
                        v-model="solicitud.vlr_fin"
                        :disabled="estado != 'creacion' && user.rol != rol_permitido"> 
                <span class="help-block text-sm">@{{ solicitud.vlr_fin | miles }}</span>
                <h6 class="text-danger text-sm">@{{errors.first('Centro de Costos')}}</h6>
            </div>

            <div class="col-md-6">
                <label class="text-sm">Periodo *:</label>
                <select :class="['form-control','sm',errors.first('Periodo') ? '_has-error' : '']" 
                        name="Periodo"
                        v-validate="'required'"
                        v-model="solicitud.periodo" 
                        @change="changePeriodo()"
                        :disabled="estado != 'creacion' && user.rol != rol_permitido"> 
                    <option selected disabled>--</option>
                    <option :value="periodo" v-for="periodo in arr_periodos">@{{ periodo }}</option>
                </select>
                <h6 class="text-danger text-sm">@{{errors.first('Periodo')}}</h6>
            </div>

        </div>

        <div class="form-group form-sm">    

            <div class="col-md-3">
                <label class="text-sm">Meses *:</label>
                <input  name="Meses"
                        v-validate="'required'"
                        type="text" 
                        :class="['form-control','sm',errors.first('Periodo') ? '_has-error' : '']" 
                        v-model="solicitud.meses" 
                        v-on:keyup="changeMeses"
                        :disabled="estado != 'creacion' && user.rol != rol_permitido"> 
                <h6 class="text-danger text-sm">@{{errors.first('Meses')}}</h6>
            </div>

            <div class="col-md-3">
                <label class="text-sm">Núm. de cuotas *:</label>
                <input  type="text" 
                        class="form-control sm" 
                        v-model="solicitud.cuotas" 
                        :disabled="estado == 'creacion' || user.rol != rol_permitido">
            </div>
            <div class="col-md-6">
                <label class="text-sm">Valor cuota *:</label>
                <input  name="Valor cuota"
                        v-validate="'required|numeric'"
                        type="text" 
                        :class="['form-control','sm',errors.first('Valor cuota') ? '_has-error' : '']" 
                        v-model="solicitud.vlr_cuota"
                        :disabled="estado != 'creacion' && user.rol != rol_permitido"> 
                <span class="help-block text-sm">@{{ solicitud.vlr_cuota | miles }}</span>
                <h6 class="text-danger text-sm">@{{errors.first('Valor cuota')}}</h6>
            </div>

        </div>

        <div class="form-group form-sm">

            <div class="col-md-3">
                <label class="text-sm">Fecha 1 *:</label>
                <select name="Fecha 1"
                        :class="['form-control','sm',errors.first('Fecha 1') ? '_has-error' : '']" 
                        v-model="solicitud.p_fecha" 
                        v-validate="'required'"
                        :disabled="estado != 'creacion' && (!solicitud.periodo || user.rol != rol_permitido)">
                        
                    <option selected disabled>--</option>
                    <option :value="index1" v-for="index1 in 30" 
                        v-if="index1 >= topes.p_fecha_ini && index1 <= topes.p_fecha_fin">@{{ index1 }}</option>
                </select>
                <h6 class="text-danger text-sm">@{{errors.first('Fecha 1')}}</h6>
            </div>

            <div class="col-md-3">
                <label class="text-sm">Fecha 2 :</label>
                <select name="Fecha 2"
                        v-validate="(solicitud.periodo == 'Quincenal') ? 'required' : ''"
                        :class="['form-control','sm',errors.first('Fecha 2') ? '_has-error' : '']" 
                        v-model="solicitud.s_fecha" 
                        :disabled="solicitud.periodo == 'Mensual' && (estado != 'creacion' || user.rol != rol_permitido)">
                    <option selected disabled>--</option>
                    <option :value="index2" v-for="index2 in 30" v-if="index2 >= topes.s_fecha_ini && index2 <= topes.s_fecha_fin">@{{ index2 }}</option>
                </select>
                <h6 class="text-danger text-sm">@{{errors.first('Fecha 2')}}</h6>
            </div>

            <div class="col-md-3">
                <label class="text-sm">Estudio *:</label>   
                <select name="Estudio"
                        v-validate="'required'"
                        :class="['form-control','sm',errors.first('Estudio') ? '_has-error' : '']" 
                        v-model="solicitud.estudio"
                        :disabled="estado != 'creacion' && user.rol != rol_permitido"> 
                    <option selected disabled>--</option>
                    <option :value="estudio" v-for="estudio in arr_estudios">@{{ estudio }}</option>
                </select>
                <h6 class="text-danger text-sm">@{{errors.first('Estudio')}}</h6>
            </div>

            <div class="col-md-3">
                <label class="text-sm">Cuota inicial :</label>
                <input  type="text"
                        class="form-control sm" 
                        v-model="solicitud.cuota_inicial"
                        :disabled="estado != 'creacion' && user.rol != rol_permitido"> 
                <span class="help-block text-sm">@{{ solicitud.cuota_inicial | miles }}</span>
            </div>

        </div>    

        <div class="form-group form-sm">
            <div class="col-md-12">
                <label class="text-sm">Observaciones:</label>
                <textarea   rows="3" 
                            class="form-control form-sm" 
                            v-model="solicitud.observaciones"
                            :disabled="estado != 'creacion' && user.rol != rol_permitido"> 
                </textarea>
            </div>
        </div>        
            
    </div>
</div>
