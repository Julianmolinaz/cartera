<script type="text/x-template" id="credito-template">
    <div>
        <!-- <ul style="list-style-type: none;padding: 0px">
            <li style="float:left;margin-left:5px;">Solicitud: @{{ $store.state.solicitud.id }} /</li>
            <li style="float:left;margin-left:5px;">Costo del Crédito: $@{{ $store.state.solicitud.vlr_fin | formatPrice }} /</li>
            <li style="float:left;margin-left:5px;">Número de cuotas: @{{ $store.state.solicitud.cuotas }} /</li>
            <li style="float:left;margin-left:5px;">Valor cuota: $@{{ $store.state.solicitud.vlr_cuota | formatPrice }}</li>
        </ul> -->
            
        <br><hr>
        
        <form @submit.prevent="onSubmit" class="form-main" autocomplete="off">
            <div class="row">
                <!-- ESTADO  -->
                <div v-bind:class="['form-group','col-md-3',errors.first(rules.estado.name) ? 'has-error' :'']">
                    <label for="">Estado @{{ rules.estado.required }}</label>
                    <select name="" 
                        class="form-control"
                        v-validate="rules.estado.rule"
                        :name="rules.estado.name"
                        >
                        <option selected disabled>--</option>
                        <option :value="estado"  
                            v-for="estado in credito.estado">
                                @{{ estado }}
                        </option>
                    </select>
                    <span class="help-block">@{{ errors.first(rules.estado.name) }}</span>
                </div>
                <!-- VALOR CRÉDITO  -->
                <div v-bind:class="['form-group','col-md-3',errors.first(rules.valor_credito.name) ? 'has-error' :'']">
                    <label for="">Valor Crédito @{{ rules.valor_credito.required }}</label>
                    <input type="text" 
                        class="form-control" 
                        v-validate="rules.valor_credito.rule"
                        :name="rules.valor_credito.name"
                        >
                    <!-- <span class="help-block" v-if="credito.valor_credito > 0">$ @{{ credito.valor_credito | formatPrice }}</span> -->
                    <span class="help-block">@{{ errors.first(rules.valor_credito.name) }}</span>
                </div>
                <!-- SALDO  -->
                <div v-bind:class="['form-group has-success','col-md-3',errors.first(rules.saldo.name) ? 'has-error' :'']">
                    <label for="">Saldo @{{ rules.saldo.required }}</label>
                    <input type="text" 
                        class="form-control" 
                        v-validate="rules.saldo.rule"
                        :name="rules.saldo.name"
                        >
                    <!-- <span class="help-block" v-if="credito.saldo > 0">$ @{{ credito.saldo | formatPrice }}</span> -->
                    <span class="help-block">@{{ errors.first(rules.saldo.name) }}</span>
                </div>
                <!-- CUOTAS FALTANTES  -->
                <div v-bind:class="['form-group','col-md-3',errors.first(rules.cuotas_faltantes.name) ? 'has-error' :'']">
                    <label for="">Cuotas Faltantes @{{ rules.cuotas_faltantes.required }}</label>
                    <input type="text" 
                        class="form-control" 
                        v-validate="rules.cuotas_faltantes.rule"
                        :name="rules.cuotas_faltantes.name"
                        >
                    <span class="help-block">@{{ errors.first(rules.cuotas_faltantes.name) }}</span>      
                </div>
            </div>
            <div class="row">
                <!-- RENDIMIENTO  -->
                <div v-bind:class="['form-group','col-md-2',errors.first(rules.rendimiento.name) ? 'has-error' :'']">
                    <label for="">Rendimiento @{{ rules.rendimiento.required }}</label>
                    <input type="text" 
                        class="form-control" 
                        v-validate="rules.rendimiento.rule"
                        :name="rules.rendimiento.name"
                        >
                    <!-- <span class="help-block" v-if="credito.rendimiento > 0">$ @{{ credito.rendimiento | formatPrice }}</span>                         -->
                    <span class="help-block">@{{ errors.first(rules.rendimiento.name) }}</span>
                </div>
                <!-- SALDO A FAVOR -->
                <div v-bind:class="['form-group','col-md-2',errors.first(rules.saldo_favor.name) ? 'has-error' :'']">
                    <label for="">Saldo a Favor @{{ rules.saldo_favor.required }}</label>
                    <input type="text" 
                        class="form-control" 
                        v-validate="rules.saldo_favor.rule"
                        :name="rules.saldo_favor.name"
                        >
                    <!-- <span class="help-block" v-if="credito.saldo_favor > 0">$ @{{ credito.saldo_favor | formatPrice }}</span>                         -->
                    <span class="help-block">@{{ errors.first(rules.saldo_favor.name) }}</span>
                </div>
                <!-- CASTIGADA  -->
                <div v-bind:class="['form-group','col-md-2',errors.first(rules.castigada.name) ? 'has-error' :'']">
                    <label for="">Castigada @{{ rules.castigada.required }}</label>
                    <select name="" 
                        class="form-control"
                        v-validate="rules.castigada.rule"
                        :name="rules.castigada.name"
                        >
                        <option selected disabled>--</option>
                        <option value=""></option>
                    </select>
                    <span class="help-block">@{{ errors.first(rules.castigada.name) }}</span> 
                </div>
                <!-- FECHA DE PAGO -->
                <div v-bind:class="['form-group has-success','col-md-2',errors.first(rules.fecha_pago.name) ? 'has-error' :'']">
                    <label for="">Fecha de Pago @{{ rules.fecha_pago.required }}</label>
                    <input type="date" 
                        class="form-control" 
                        onkeydown="return false" 
                        v-validate="rules.fecha_pago.rule"
                        :name="rules.fecha_pago.name"
                        >
                    <span class="help-block">@{{ errors.first(rules.fecha_pago.name) }}</span> 
                </div>
                <!-- MES  -->
                <div v-bind:class="['form-group','col-md-2',errors.first(rules.mes.name) ? 'has-error' :'']">
                    <label for="">Mes de Referencia @{{ rules.mes.required }}</label>
                    <select name="" 
                        class="form-control"
                        v-validate="rules.mes.rule"
                        :name="rules.mes.name"
                        >
                        <option selected disabled>--</option>
                        <option value=""></option>
                    </select>
                    <span class="help-block">@{{ errors.first(rules.mes.name) }}</span>
                </div>
                <!-- ANIO  -->
                <div v-bind:class="['form-group','col-md-2',errors.first(rules.anio.name) ? 'has-error' :'']">
                    <label for="">Año de Referencia @{{ rules.anio.required }}</label>
                    <select name="" 
                        class="form-control"
                        v-validate="rules.anio.rule"
                        :name="rules.anio.name"
                        >
                        <option selected disabled>--</option>
                        <option value=""></option>
                    </select>
                    <span class="help-block">@{{ errors.first(rules.anio.name) }}</span>
                </div>
            </div>
            <div class="row">
                <!-- RECORDATORIO  -->
                <div v-bind:class="['form-group','col-md-12',errors.first(rules.observaciones.name) ? 'has-error' :'']">
                    <label for="">Recordatorio</label>
                    <textarea class="form-control" 
                        v-validate="rules.recordatorio.rule"
                        :name="rules.recordatorio.name"
                        >
                    </textarea>
                    <span class="help-block">@{{ errors.first(rules.recordatorio.name) }}</span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12" style="margin-top:20px;">
                    <center>
                        <a class="btn btn-default">
                            <i class="fa fa-backward" aria-hidden="true"></i>
                            Volver
                        </a>
                        <button class="btn btn-primary">
                            <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                            salvar
                        </button>
                    </center>
                </div>
            </div> 
        </form>
    </div>
</script>

<script src="/js/rules/solicitudV3/credito.js"></script>

<script>
    Vue.component('credito-component', {
        template: '#credito-template',
        data() {
            return {
                credito: this.$store.state.credito,
                rules: rules_credito
            }
        }
    });
</script>