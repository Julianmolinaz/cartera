<script type="text/x-template" id="solicitud-template">
    
<div>
    <form @submit.prevent="">
        <div class="row">

            <!-- APROBADO  -->
            <div v-bind:class="['form-group','col-md-2',errors.first(rules.aprobado.name) ? 'has-error' :'']">
                <label for="">Aprobado @{{ rules.aprobado.required }}</label>
                <select     
                    :disabled="!show || $store.state.data.status == 'edit cred'"
                    class="form-control" 
                    v-model="solicitud.aprobado"
                    v-validate="rules.aprobado.rule"
                    :name="rules.aprobado.name"> 
                    <option selected disabled>--</option>
                    <option :disabled="$store.state.data.status == 'create'"
                        :value="estado" 
                        v-for="estado in data.estados_aprobacion">
                        @{{estado}}
                    </option>  
                </select>
                <span class="help-block">@{{ errors.first(rules.aprobado.name) }}</span>                   
            </div>   

            <!-- Consecutivo  -->

            <div v-bind:class="['form-group','col-md-2',errors.first(rules.num_fact.name) ? 'has-error' :'']">
                <label for="">Consecutivo @{{ rules.num_fact.required }}</label>    
                <input 
                    :disabled="!show"
                    style="font-size:12px;"
                    type="text" 
                    class="form-control" 
                    v-model="solicitud.num_fact"
                    v-validate="rules.num_fact.rule"
                    :name="rules.num_fact.name">  
                <span class="help-block">@{{ errors.first(rules.num_fact.name) }}</span>                   
            </div>


            <!-- FECHA SOLICITUD  -->

            <div v-bind:class="['form-group','col-md-2',errors.first(rules.fecha_solicitud.name) ? 'has-error' :'']">
                <label for="">Fecha @{{ rules.fecha_solicitud.required }}</label>    
                <input
                    :disabled="!show"
                    type="date" 
                    class="form-control my-input" 
                    v-model="solicitud.fecha"
                    v-validate="rules.fecha_solicitud.rule"
                    :name="rules.fecha_solicitud.name">  
                <span class="help-block">@{{ errors.first(rules.fecha_solicitud.name) }}</span>                   
            </div>


            <!-- Vendedor  -->

            <div v-bind:class="['form-group','col-md-3',errors.first(rules.funcionario_id.name) ? 'has-error' :'']">
                <label for="">Vendedor @{{ rules.funcionario_id.required }}</label> 
                <select
                    :disabled="!show" 
                    class="form-control my-input" 
                    v-validate="rules.funcionario_id.rule"
                    :name="rules.funcionario_id.name"
                    v-model="solicitud.funcionario_id"> 
                    <option selected disabled>--</option>
                    <option :value="vendedor.id" v-for="vendedor in data.vendedores">@{{vendedor.name}}</option>                
                </select>
                
                <span class="help-block">@{{ errors.first(rules.funcionario_id.name) }}</span>                   
            </div>

            <!-- CARTERA  -->

            <div v-bind:class="['form-group','col-md-3',errors.first(rules.cartera.name) ? 'has-error' :'']">
                <label for="">Cartera @{{ rules.cartera.required }}</label> 
                <select 
                    :disabled="!show"
                    class="form-control my-input" 
                    v-validate="rules.cartera.rule"
                    :name="rules.cartera.name"
                    v-model="solicitud.cartera_id"> 
                    <option selected disabled>--</option>
                    <option :value="cartera.id" v-for="cartera in data.carteras">@{{cartera.nombre}}</option>                
                </select>
                <span class="help-block">@{{ errors.first(rules.cartera.name) }}</span>                   
            </div>
    
        </div> <!-- row file 1  -->
        <div class="row">

            <!-- CENTRO DE COSTOS -->

            <div v-bind:class="['form-group','col-md-3',errors.first(rules.centro_costo.name) ? 'has-error' :'']">
                <label for="">Centro de Costos @{{ rules.centro_costo.required }}</label>
                <input 
                    :disabled="!show"
                    @blur="validar_negocio"
                    type="text" 
                    class="form-control"  
                    placeholder="Monto Solicitado"
                    v-model="solicitud.vlr_fin"
                    v-validate="rules.centro_costo.rule"
                    :name="rules.centro_costo.name">
                <span class="help-block" v-if="solicitud.vlr_fin > 0">$ @{{ solicitud.vlr_fin | formatPrice }}</span>                       
                <span class="help-block">@{{ errors.first(rules.centro_costo.name) }}</span>                   
            </div>

            <!-- CUOTA INICIAL -->

            <div v-bind:class="['form-group','col-md-3',errors.first(rules.cuota_inicial.name) ? 'has-error' :'']">
                <label for="">Cuota Inicial @{{ rules.cuota_inicial.required }}</label>
                <input
                    :disabled="!show"
                    type="text" 
                    class="form-control" 
                    placeholder="Monto inicial"
                    v-model="solicitud.cuota_inicial"
                    v-validate="rules.cuota_inicial.rule"
                    :name="rules.cuota_inicial.name">
                <span class="help-block" v-if="solicitud.cuota_inicial > 0">$ @{{ solicitud.cuota_inicial | formatPrice }}</span>
                <span class="help-block">@{{ errors.first(rules.cuota_inicial.name) }}</span>
            </div>

            <!-- MESES -->

            <div v-bind:class="['form-group','col-md-2',errors.first(rules.meses.name) ? 'has-error' :'']">
                <label for="">Meses @{{ rules.meses.required }}</label>
                <select 
                    :disabled="!show"
                    @change="setup"
                    class="form-control"  
                    v-model="solicitud.meses"
                    v-validate="rules.meses.rule"
                    :name="rules.meses.name">
                    <option selected disabled>--</option>
                    <option :value="meses" v-for="meses in data.rango_meses">@{{ meses }}</option>
                </select>
                <span class="help-block">@{{ errors.first(rules.periodo.name) }}</span>
            </div>

            <!-- PERIODO -->

            <div v-bind:class="['form-group','col-md-2',errors.first(rules.periodo.name) ? 'has-error' :'']">
                <label for="">Periodo @{{ rules.periodo.required }}</label>
                <select 
                    :disabled="!show"
                    @change="setup"
                    class="form-control"  
                    v-model="solicitud.periodo"
                    v-validate="rules.periodo.rule"
                    :name="rules.periodo.name">
                    <option selected disabled>--</option>
                    <option :value="periodo" v-for="periodo in data.arr_periodos">@{{ periodo }}</option>
                </select>
                <span class="help-block">@{{ errors.first(rules.periodo.name) }}</span>
            </div>

            <!-- NUMERO DE CUOTAS -->

            <div v-bind:class="['form-group','col-md-2',errors.first(rules.cuotas.name) ? 'has-error' :'']">
                <label for="">Número de Cuotas @{{ rules.cuotas.required }}</label>
                <input 
                    disabled
                    @blur="validar_negocio"
                    type="text" 
                    class="form-control" 
                    placeholder="Cantidad de Cuotas"
                    v-model="solicitud.cuotas"
                    v-validate="rules.cuotas.rule"
                    :name="rules.cuotas.name">
                <span class="help-block">@{{ errors.first(rules.cuotas.name) }}</span>
            </div>
        </div> <!-- row file 2-->
        <div class="row">

            <!-- VALOR CUOTA -->

            <div v-bind:class="['form-group','col-md-3',errors.first(rules.valor_cuotas.name) ? 'has-error' :'']">
                <label for="">Valor Cuota @{{ rules.valor_cuotas.required }}</label>
                <input 
                    :disabled="!show"
                    @blur="validar_negocio"
                    type="text" 
                    class="form-control"  
                    placeholder="valor cuotas"
                    v-model="solicitud.vlr_cuota"
                    v-validate="rules.valor_cuotas.rule"
                    :name="rules.valor_cuotas.name">

                <span class="help-block" v-if="solicitud.vlr_cuota > 0">$ @{{ solicitud.vlr_cuota | formatPrice }}</span>                    
                <span class="help-block">@{{ errors.first(rules.valor_cuotas.name) }}</span>
            </div>

            <!-- FECHA DE PAGO 1 -->

            <div v-bind:class="['form-group','col-md-3',errors.first(rules.f_pago_1.name) ? 'has-error' :'']">
                <label for="">Fecha Pago 1 @{{ rules.f_pago_1.required }}</label>
                <select 
                    :disabled="!show"
                    @change="setRango2"
                    class="form-control" 
                    v-model="solicitud.p_fecha"
                    v-validate="rules.f_pago_1.rule"
                    :name="rules.f_pago_1.name">
                    <option selected disabled></option>
                    <option :value="i" v-for="i in rango1">@{{ i }}</option>
                </select>
                <span class="help-block">@{{ errors.first(rules.f_pago_1.name) }}</span>
            </div>

            <!-- FECHA DE PAGO 2  -->

            <div v-bind:class="['form-group','col-md-3',errors.first(rules.f_pago_2.name) ? 'has-error' :'']">
                <label for="">Fecha Pago 2 @{{ rules.f_pago_2.required }}</label>
                <input
                    type="text"
                    disabled
                    class="form-control"  
                    v-model="solicitud.s_fecha"
                    v-validate="rules.f_pago_2.rule"
                    :name="rules.f_pago_2.name">
                <span class="help-block">@{{ errors.first(rules.f_pago_2.name) }}</span>
            </div>

            <!-- ESTUDIO  -->

            <div v-bind:class="['form-group','col-md-3',errors.first(rules.estudio.name) ? 'has-error' :'']">
                <label for="">Estudio @{{ rules.estudio.required }}</label>
                <select 
                    :disabled="!show"
                    class="form-control"  
                    placeholder="Tipo de Estudio"
                    v-model="solicitud.estudio"
                    v-validate="rules.estudio.rule"
                    :name="rules.estudio.name">
                    <option selected disabled>--</option>
                    <option :value="tipo" v-for="tipo in data.arr_estudios">@{{tipo}}</option>
                </select>
                <span class="help-block">@{{ errors.first(rules.estudio.name) }}</span>

            </div>
        </div><!-- row file 3-->    
        <div class="row">

            <!-- OBSERVACIONES  -->

            <div v-bind:class="['form-group','col-md-12',errors.first(rules.observaciones.name) ? 'has-error' :'']">
                <label for="">Observaciones @{{ rules.observaciones.required }}</label>
                    <textarea 
                        class="form-control" 
                        v-model="solicitud.observaciones"
                        v-validate="rules.observaciones.rule"
                        :name="rules.observaciones.name">
                    </textarea>
                <span class="help-block">@{{ errors.first(rules.observaciones.name) }}</span>
            </div>
        </div><!-- row file 4-->
        <div class="row">
            <div class="col-md-12" style="margin-top:20px;">
                <center>
                    <a class="btn btn-default" @click="volver">
                        <i class="fa fa-backward" aria-hidden="true"></i>
                        Volver</a>
                    <button class="btn btn-primary" @click="onSubmit">
                        <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                        Salvar
                    </button>
                    <a class="btn btn-default" @click="continuar" v-if="$store.state.data.status == 'edit cred'">
                        <i class="fa fa-forward" aria-hidden="true"></i>
                        Continuar</a>
                </center>
            </div>
        </div> 
    </form>
</div> <!-- div pripal -->
</script>

@include('start.precreditos.componentes.solicitudJs')