<div class="panel panel-default">
    <div class="panel-body">

        <div class="form-group form-sm" style="margin-bottom:10px;">
            <div class="col-md-12">
                <label>Información del crédito</label>
            </div>
        </div>

        <hr style="border:.3px solid #DCDCDC;margin-top:0px;">
            
        <div class="form-group form-sm">

            <!-- estado credito  -->
            <div class="col-md-3">
                <label class="text-sm">Estado *</label>
                <select class="form-control sm" 
                        v-model="credito.estado"
                        :disabled="user.rol != rol_permitido">
                    <option :value="estado" v-for="estado in estados_credito" v-text="estado"></option>
                </select>
            </div>
            
            <!-- cuotas faltantes  -->
            <div class="col-md-3">
                <label class="text-sm">Cts faltantes *</label>
                <input  type="text" 
                        v-validate="'required|numeric'"
                        name="Cuotas faltantes"
                        v-bind:class="['form-control','sm', errors.first('Cuotas faltantes') ? '_has-error' :'']"
                        v-model="credito.cuotas_faltantes"
                        :disabled="user.rol != rol_permitido">
                <h6 class="text-danger">@{{ errors.first('Cuotas faltantes') }}</h6>
            </div>
        
            <!-- saldo  -->
            <div class="col-md-3">
                <label class="text-sm">Saldo deuda *</label>
                <input  type="text" 
                        name="Saldo deuda"
                        v-validate="'required|numeric'"
                        v-bind:class="['form-control','sm', errors.first('Saldo deuda') ? '_has-error' :'']"
                        v-model="credito.saldo"
                        :disabled="user.rol != rol_permitido">
                <span class="text-sm">@{{ credito.saldo | miles }}</span>
                <h6 class="text-danger text-sm">@{{ errors.first('Saldo deuda') }}</h6>
            </div>

            <!-- saldo a favor  -->
            <div class="col-md-3">
                <label class="text-sm">Saldo a favor</label>
                <input  type="text" 
                        class="form-control sm" 
                        v-model="credito.saldo_favor"
                        :disabled="user.rol != rol_permitido">
                <span class="text-sm">@{{ credito.saldo_favor | miles }}</span>
            </div>

        </div>

        <div class="form-group form-sm">
        
            <!-- rendimiento  -->
            <div class="col-md-3">
                <label class="text-sm">Rendimiento *</label>
                <input  type="text" 
                        name="Rendimiento"
                        v-validate="'required|numeric'"
                        v-bind:class="['form-control','sm', errors.first('Rendimiento') ? '_has-error' :'']"
                        v-model="credito.rendimiento"
                        :disabled="user.rol != rol_permitido">
                <span class="text-sm">@{{ credito.rendimiento | miles }}</span>
                <h6 class="text-danger text-sm">@{{ errors.first('Rendimiento') }}</h6>
            </div>

            <!-- valor total de credito  -->   
            <div class="col-md-3">
                <label class="text-sm">Vlr total crédito *</label>
                <input  type="text" 
                        name="Valor total credito"
                        v-validate="'required|numeric'"
                        v-bind:class="['form-control','sm', errors.first('Valor total credito') ? '_has-error' :'']"
                        v-model="credito.valor_credito"
                        :disabled="user.rol != rol_permitido">
                <span class="text-sm">@{{ credito.valor_credito | miles }}</span>
                <h6 class="text-danger text-sm">@{{ errors.first('Valor total credito') }}</h6>
            </div>

            <!-- castigada -->
            <div class="col-md-2">
                <label class="text-sm">Castigada</label>
                <select class="form-control sm" v-model="credito.castigada" :disabled="user.rol != rol_permitido">
                    <option :value="'Si'">Si</option>
                    <option :value="'No'">No</option>
                </select>
            </div>

            <!-- fecha de pago  -->
            <div class="col-md-4">
                <label class="text-sm" style="color:#c03a31;font-weight:bold;">FECHA DE PAGO *</label>
                <input  type="date" 
                  
                        name="Fecha de pago"
                        v-validate="'required'"
                        v-bind:class="['form-control','sm', errors.first('Fecha de pago') ? '_has-error' :'']"
                        v-model="fecha_pago"
                        :disabled="user.rol != rol_permitido">
                <h6 class="text-danger text-sm">@{{ errors.first('Fecha de pago') }}</h6>
            </div>
            
        </div>

        <div class="form-group form-sm">

            <!-- recordatorios de pago  -->
            <div class="col-md-12">
                <label class="text-sm">Recordatorio de pago</label>
                <textarea   class="form-control sm" 
                            v-model="credito.recordatorio"
                            :disabled="user.rol != rol_permitido">
                </textarea>
            </div>

        </div>

    </div>
</div>