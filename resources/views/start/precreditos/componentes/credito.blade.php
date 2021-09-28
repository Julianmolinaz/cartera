<script type="text/x-template" id="credito-template">
    
    <div>
        
        <ul style="list-style-type: none;padding: 0px">
            <li style="float:left;margin-left:5px;">Solicitud: @{{ $store.state.solicitud.id }} /</li>
            <li style="float:left;margin-left:5px;">Costo del Crédito: $@{{ $store.state.solicitud.vlr_fin | formatPrice }} /</li>
            <li style="float:left;margin-left:5px;">Número de cuotas: @{{ $store.state.solicitud.cuotas }} /</li>
            <li style="float:left;margin-left:5px;">Valor cuota: $@{{ $store.state.solicitud.vlr_cuota | formatPrice }}</li>
        </ul>
            
        <br><hr>

        <form @submit.prevent="onSubmit" class="form-main">
            <div class="row">

                <!-- Estado  -->

                <div v-bind:class="['form-group','col-md-3',errors.first(rules.estado.name) ? 'has-error' :'']">
                    <label for="">Estado @{{ rules.estado.required }}</label>
                    <select 
                        type="text" 
                        class="form-control"  
                        v-model="credito.estado"
                        v-validate="rules.estado.rule"
                        :name="rules.estado.name"
                        @change="changeEstado()">                              
                        <option selected disabled>--</option>
                        <option :value="estado" 
                            v-for="(estado,index) in $store.state.data_credito.estados"
                            v-if="estado != 'Cancelado por refinanciacion'">@{{estado}}</option>
                    </select>
                    <span class="help-block">@{{ errors.first(rules.estado.name) }}</span>
                </div> 

                <!-- Valor credito  -->

                <div v-bind:class="['form-group','col-md-3',errors.first(rules.valor_credito.name) ? 'has-error' :'']">
                    <label for="">Valor Credito @{{ rules.valor_credito.required }}</label>
                    <input 
                        type="text" 
                        class="form-control"  
                        v-model="credito.valor_credito"
                        v-validate="rules.valor_credito.rule"
                        :name="rules.valor_credito.name"> 
                    <span class="help-block" v-if="credito.valor_credito > 0">$ @{{ credito.valor_credito | formatPrice }}</span>
                    <span class="help-block">@{{ errors.first(rules.valor_credito.name) }}</span>
                </div>      

                <!-- Saldo -->

                <div v-bind:class="['form-group has-success','col-md-3',errors.first(rules.saldo.name) ? 'has-error' :'']">
                    <label class="control-label">Saldo deuda @{{ rules.saldo.required }}</label>
                    <input 
                        type="text" 
                        class="form-control" 
                        v-model="credito.saldo"
                        v-validate="rules.saldo.rule"
                        :name="rules.saldo.name"> 
                    <span class="help-block" v-if="credito.saldo > 0">$ @{{ credito.saldo | formatPrice }}</span>
                    <span class="help-block">@{{ errors.first(rules.saldo.name) }}</span>
                </div> 

                <!-- Cuotas faltantes  -->

                <div v-bind:class="['form-group','col-md-3',errors.first(rules.cuotas_faltantes.name) ? 'has-error' :'']">
                    <label for="">Cuotas Faltantes @{{ rules.cuotas_faltantes.required }}</label>    
                    <input 
                        type="text" 
                        class="form-control" 
                        v-model="credito.cuotas_faltantes"
                        v-validate="rules.cuotas_faltantes.rule"
                        :name="rules.cuotas_faltantes.name"> 
                    <span class="help-block">@{{ errors.first(rules.cuotas_faltantes.name) }}</span>      
                </div>
            </div> <!-- row file 1 -->


            <div class="row">

                <!-- Rendimiento  -->

                <div v-bind:class="['form-group','col-md-2',errors.first(rules.rendimiento.name) ? 'has-error' :'']">
                    <label for="">Rendimiento @{{ rules.rendimiento.required }}</label>       
                    <input 
                        type="text" 
                        class="form-control" 
                        v-model="credito.rendimiento"
                        v-validate="rules.rendimiento.rule"
                        :name="rules.rendimiento.name"> 
                    <span class="help-block" v-if="credito.rendimiento > 0">$ @{{ credito.rendimiento | formatPrice }}</span>                        
                    <span class="help-block">@{{ errors.first(rules.rendimiento.name) }}</span>         
                </div>

                <!-- Saldo a Favor  -->

                <div v-bind:class="['form-group','col-md-2',errors.first(rules.saldo_favor.name) ? 'has-error' :'']">
                    <label for="">Saldo a Favor @{{ rules.saldo_favor.required }}</label>     
                    <input 
                        type="text" 
                        class="form-control" 
                        v-model="credito.saldo_favor"
                        v-validate="rules.saldo_favor.rule"
                        :name="rules.saldo_favor.name"> 
                    <span class="help-block" v-if="credito.saldo_favor > 0">$ @{{ credito.saldo_favor | formatPrice }}</span>                        
                    <span class="help-block">@{{ errors.first(rules.saldo_favor.name) }}</span>         
                </div>

                <!-- Castigada  -->

                <div v-bind:class="['form-group','col-md-2',errors.first(rules.castigada.name) ? 'has-error' :'']">
                    <label for="">Castigada @{{ rules.castigada.required }}</label>    
                    <select 
                        type="text" 
                        class="form-control" 
                        v-model="credito.castigada"
                        v-validate="rules.castigada.rule"
                        :name="rules.castigada.name">
                        <option selected disabled>--</option>
                        <option :value="estado" v-for="estado in $store.state.data_credito.estados_castigada">@{{ estado }}</option>
                    </select>  
                    <span class="help-block">@{{ errors.first(rules.castigada.name) }}</span>   
                </div>

                <!-- FECHA DE PAGO  -->

                <div v-bind:class="['form-group has-success','col-md-2',errors.first(rules.fecha_pago.name) ? 'has-error' :'']">
                    <label class="control-label">Fecha de pago @{{ rules.fecha_pago.required }}</label>    
                    <input
		        onkeydown="return false" 
                        type="date" 
                        class="form-control form-main__input--small" 
                        v-model="fecha_pago"
                        @change="setFechaPago()"
                        v-validate="rules.fecha_pago.rule"
                        :name="rules.fecha_pago.name">
                    <span class="help-block">@{{ errors.first(rules.fecha_pago.name) }}</span>   
                </div>                

                <!-- MES  -->

                <div v-bind:class="['form-group','col-md-2',errors.first(rules.mes.name) ? 'has-error' :'']">
                    <label class="form-main__label--small">Mes de referencia@{{ rules.mes.required }}</label>    
                    <select 
                        type="text" 
                        class="form-control"  
                        v-model="credito.mes"
                        v-validate="rules.mes.rule"
                        :name="rules.mes.name">
                        <option selected disabled>--</option>
                        <option :value="mes" v-for="mes in $store.state.data_credito.meses">@{{ mes }}</option>
                    </select>
                    <span class="help-block">@{{ errors.first(rules.mes.name) }}</span>
                </div>  

                <!-- AÑO  -->

                <div v-bind:class="['form-group','col-md-2',errors.first(rules.anio.name) ? 'has-error' :'']">
                    <label class="form-main__label--small">Año de referencia@{{ rules.anio.required }}</label> 
                    <select 
                        type="text" 
                        class="form-control" 
                        v-model="credito.anio"
                        v-validate="rules.anio.rule"
                        :name="rules.anio.name">
                        <option selected disabled>--</option>
                        <option :value="anio" v-for="anio in $store.state.data_credito.anios">@{{ anio }}</option>
                    </select>  
                    <span class="help-block">@{{ errors.first(rules.anio.name) }}</span>     
                </div> 
            </div> <!-- row file 2 -->
            <div class="row">

                <!-- OBSERVACIONES  -->

                <!-- <div v-bind:class="['form-group','col-md-6',errors.first(rules.observaciones.name) ? 'has-error' :'']">
                        <label for="">Observaciones @{{ rules.observaciones.required }}</label>
                        <textarea 
                            class="form-control" 
                            v-model="credito.observaciones"
                            v-validate="rules.observaciones.rule"
                            :name="rules.observaciones.name">
                        </textarea>
                    <span class="help-block">@{{ errors.first(rules.observaciones.name) }}</span>
                </div> -->

                <!-- RECORDATORIO  -->

                <div v-bind:class="['form-group','col-md-12',errors.first(rules.observaciones.name) ? 'has-error' :'']">
                        <label for="">Recordatorio @{{ rules.recordatorio.required }}</label>
                        <textarea 
                            class="form-control" 
                            v-model="credito.recordatorio"
                            v-validate="rules.recordatorio.rule"
                            :name="rules.recordatorio.name">
                        </textarea>
                    <span class="help-block">@{{ errors.first(rules.recordatorio.name) }}</span>
                </div>
            </div><!-- row file 3-->
            <div class="row">
                <div class="col-md-12" style="margin-top:20px;">
                    <center>
                        <a class="btn btn-default" @click="volver">
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

        @include('start.precreditos.componentes.calificar_cliente_modal')

    </div> <!-- div fin -->
</script>
    
<script src="/js/interfaces/credito.js"></script>
<script src="/js/rules/credito.js"></script>

@include('filters')

<script>

    const credito = Vue.component('credito-component',{
        template: '#credito-template',
        data() {
            return {
                credito: this.$store.state.credito,
                rules: rules_credito,
                fecha_pago: this.$store.state.fecha_pago
            }
        },
        methods: {
            async onSubmit() {
                if (! await this.validation()) return false; 

                await this.assignData();

                await this.$store.dispatch('updateCredito');
          
            },
            setFechaPago() {
                this.$store.commit('setFechaPago',this.fecha_pago);
            },
            async assignData() {
                await this.$store.commit('setCredito', this.credito);
                // await this.$store.commit('setFechaPago', this.fecha_pago);
            },
            async volver() {

                if (! await this.validation()) return false; 
                await this.assignData();

                $('.nav-tabs a[href="#solicitud"]').tab('show');
            },
            async validation() {
                let valid = await this.$validator.validate();

                if (!valid) {
                    alertify.set('notifier','position', 'top-right');
                    alertify.notify('Por favor complete los campos en rojo', 'error', 5, function(){ });

                    return false
                }
                else return true
            },
            changeEstado() {
                if (this.credito.estado == 'Cancelado') {
                    $('#calificar').modal('show')
                }
            }
        },
        created() {
            Bus.$on('assign_credito', () => {
                console.log('view credito');
                this.assignData();
            });
        }
    });

</script>

<style scoped>

    @media only screen and (min-width : 990px) and (max-width : 1220px) {
        .form-main__label--small {
            font-size:.8em;
        }
    }
    .form-main__input--small {
        font-size:.8em;
    }
</style>




