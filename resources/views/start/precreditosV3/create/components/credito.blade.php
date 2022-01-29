<script type="text/x-template" id="credito-template">
    <div>
        <ul class="info-solicitud-content">
            <li class="info-solicitud-item">Solicitud: @{{ $store.state.solicitud.id }} |</li>
            <li class="info-solicitud-item">Costo del Crédito: $@{{ $store.state.solicitud.vlr_fin | formatPrice }} |</li>
            <li class="info-solicitud-item">Número de cuotas: @{{ $store.state.solicitud.cuotas }} |</li>
            <li class="info-solicitud-item">Valor cuota: $@{{ $store.state.solicitud.vlr_cuota | formatPrice }}</li>
        </ul>
            
        <br><hr>
        
        <form @submit.prevent="" class="form-main" autocomplete="off">
            <div class="row">
                <!-- ESTADO  -->
                <div v-bind:class="['form-group','col-md-3',errors.first(rules.estado.name) ? 'has-error' :'']">
                    <label for="">Estado @{{ rules.estado.required }}</label>
                    <select 
                        class="form-control"
                        v-model="credito.estado"
                        v-validate="rules.estado.rule"
                        :name="rules.estado.name"
                    >
                        <option selected disabled>--</option>
                        <option :value="estado" v-for="estado in insumos.estado">
                            @{{ estado }}
                        </option>
                    </select>
                    <span class="help-block">@{{ errors.first(rules.estado.name) }}</span>
                </div>
                <!-- VALOR CRÉDITO  -->
                <div v-bind:class="['form-group','col-md-3',errors.first(rules.valor_credito.name) ? 'has-error' :'']">
                    <label for="valor credito">Valor Crédito @{{ rules.valor_credito.required }}</label>
                    <input 
                        type="text" 
                        class="form-control" 
                        v-model="credito.valor_credito"
                        v-validate="rules.valor_credito.rule"
                        :name="rules.valor_credito.name"
                    >
                    <span class="help-block">@{{ errors.first(rules.valor_credito.name) }}</span>
                </div>
                <!-- SALDO  -->
                <div v-bind:class="['form-group has-success','col-md-3',errors.first(rules.saldo.name) ? 'has-error' :'']">
                    <label for="">Saldo @{{ rules.saldo.required }}</label>
                    <input 
                        type="text" 
                        class="form-control" 
                        v-model="credito.saldo"
                        v-validate="rules.saldo.rule"
                        :name="rules.saldo.name"
                    >
                    <span class="help-block">@{{ errors.first(rules.saldo.name) }}</span>
                </div>
                <!-- CUOTAS FALTANTES  -->
                <div v-bind:class="['form-group','col-md-3',errors.first(rules.cuotas_faltantes.name) ? 'has-error' :'']">
                    <label for="cuotas faltantes">Cuotas Faltantes @{{ rules.cuotas_faltantes.required }}</label>
                    <input 
                        type="text" 
                        class="form-control" 
                        v-model="credito.cuotas_faltantes"
                        v-validate="rules.cuotas_faltantes.rule"
                        :name="rules.cuotas_faltantes.name"
                    >
                    <span class="help-block">@{{ errors.first(rules.cuotas_faltantes.name) }}</span>      
                </div>
            </div>
            <div class="row">
                <!-- RENDIMIENTO  -->
                <div v-bind:class="['form-group','col-md-2',errors.first(rules.rendimiento.name) ? 'has-error' :'']">
                    <label for="rendimiento">Rendimiento @{{ rules.rendimiento.required }}</label>
                    <input 
                        type="text" 
                        class="form-control" 
                        v-model="credito.rendimiento"
                        v-validate="rules.rendimiento.rule"
                        :name="rules.rendimiento.name"
                    >
                    <span class="help-block">@{{ errors.first(rules.rendimiento.name) }}</span>
                </div>
                <!-- SALDO A FAVOR -->
                <div v-bind:class="['form-group','col-md-2',errors.first(rules.saldo_favor.name) ? 'has-error' :'']">
                    <label for="saldo a favor">Saldo a Favor @{{ rules.saldo_favor.required }}</label>
                    <input 
                        type="text" 
                        class="form-control" 
                        v-model="credito.saldo_favor"
                        v-validate="rules.saldo_favor.rule"
                        :name="rules.saldo_favor.name"
                    >
                    <span class="help-block">@{{ errors.first(rules.saldo_favor.name) }}</span>
                </div>
                <!-- CASTIGADA  -->
                <div v-bind:class="['form-group','col-md-2',errors.first(rules.castigada.name) ? 'has-error' :'']">
                    <label for="cartera castigada">Castigada @{{ rules.castigada.required }}</label>
                    <select 
                        name="" 
                        class="form-control"
                        v-model="credito.castigada"
                        v-validate="rules.castigada.rule"
                        :name="rules.castigada.name"
                    >
                        <option selected disabled>--</option>
                        <option :value="castigada" v-for="castigada in insumos.castigada">
                            @{{ castigada }}
                        </option>
                    </select>
                    <span class="help-block">@{{ errors.first(rules.castigada.name) }}</span> 
                </div>
                <!-- FECHA DE PAGO -->
                <div v-bind:class="['form-group has-success','col-md-2',errors.first(rules.fecha_pago.name) ? 'has-error' :'']">
                    <label for="fecha de pago" class="my-label-min">
                        Fecha de Pago @{{ rules.fecha_pago.required }}
                    </label>
                    <input 
                        type="date" 
                        class="form-control my-input-min" 
                        onkeydown="return false" 
                        v-model="credito.fecha_pago"
                        v-validate="rules.fecha_pago.rule"
                        :name="rules.fecha_pago.name"
                    >
                    <span class="help-block">@{{ errors.first(rules.fecha_pago.name) }}</span> 
                </div>
                <!-- MES  -->
                <div v-bind:class="['form-group','col-md-2',errors.first(rules.mes.name) ? 'has-error' :'']">
                    <label for="mes comision" class="my-label-min">
                        Mes de Referencia @{{ rules.mes.required }}
                    </label>
                    <select 
                        class="form-control"
                        v-model="credito.mes"
                        v-validate="rules.mes.rule"
                        :name="rules.mes.name"
                    >
                        <option selected disabled>--</option>
                        <option :value="mes" v-for="mes in insumos.mes">
                            @{{ mes }}
                        </option>
                    </select>
                    <span class="help-block">@{{ errors.first(rules.mes.name) }}</span>
                </div>
                <!-- ANIO  -->
                <div v-bind:class="['form-group','col-md-2',errors.first(rules.anio.name) ? 'has-error' :'']">
                    <label for="año de referencia" class="my-label-min">
                        Año de Referencia @{{ rules.anio.required }}
                    </label>
                    <select 
                        class="form-control"
                        v-model="credito.anio"
                        v-validate="rules.anio.rule"
                        :name="rules.anio.name"
                    >
                        <option selected disabled>--</option>
                        <option :value="anio" v-for="anio in insumos.anio">
                            @{{ anio }}
                        </option>
                    </select>
                    <span class="help-block">@{{ errors.first(rules.anio.name) }}</span>
                </div>
            </div>
            <div class="row">
                <!-- RECORDATORIO  -->
                <div v-bind:class="['form-group','col-md-12',errors.first(rules.observaciones.name) ? 'has-error' :'']">
                    <label for="">Recordatorio</label>
                    <textarea 
                        class="form-control" 
                        v-model="credito.recordatorio"
                        v-validate="rules.recordatorio.rule"
                        :name="rules.recordatorio.name"
                    ></textarea>
                    <span class="help-block">
                        @{{ errors.first(rules.recordatorio.name) }}
                    </span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12" style="margin-top:20px;">
                    <center>
                        <a class="btn btn-default" @click="volver">
                            <i class="fa fa-backward" aria-hidden="true"></i>
                            Volver
                        </a>
                        <a href="javascript:void(0);" class="btn btn-primary" @click="onSubmit">
                            <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                            Salvar
                        </a>
                    </center>
                </div>
            </div> 
        </form>
    </div>
</script>

<script src="/js/rules/solicitudV3/credito.js"></script>

@include('filters')

<script>
    const credito = Vue.component('credito-component', {
        template: '#credito-template',
        data() {
            return {
                credito: null,
                rules: rules_credito
            }
        },
        computed: {
            insumos() {
                return this.$store.state.insumosCredito;
            },
            rutaSalida() {
                return this.$store.getters.getRutaSalida;
            }
        },
        methods: {     
            async volver() {
                if (! await this.validation()) return false; 
                $('.nav-tabs a[href="#solicitud"]').tab('show');
            },                
            async validation() {
                if ( ! await this.$validator.validate() ) {
                    alertify.set('notifier','position', 'top-right');
                    alertify.notify('Por favor complete los campos', 'error', 5, function(){  });
                    return false;
                }
                return true;
            },
            async onSubmit() {
                this.$store.dispatch('onSubmit');
            }, 
        },
        created() {
            this.credito = this.$store.state.credito;
        }
    });
</script>

<style scoped>
    .info-solicitud-content {
        list-style-type: none;
        padding: 0px;
    }
    .info-solicitud-item  {
        float:left;
        margin-left:5px;
    }
    .my-label-min {
        font-size: 12px;
    }
    .my-input-min {
        font-size: 1rem;
    }

    @media (max-width: 800px) {
        .my-label-min {
            font-size: 16px;
        }
    }
</style>