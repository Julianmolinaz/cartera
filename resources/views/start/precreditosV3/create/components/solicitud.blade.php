<script type="text/x-template" id="solicitud-template">
    <div>
        <form @submit.prevent="" autocomplete="off">
            <div class="row">
                <!-- APROBADO  -->
                <div v-bind:class="['form-group','col-md-2',errors.first(rules.aprobado.name) ? 'has-error' :'']">
                    <label for="">Aprobado @{{ rules.aprobado.required }}</label>
                    <select :name="rules.aprobado.name" 
                        class="form-control" 
                        v-model="solicitud.aprobado"
                        v-validate="rules.aprobado.rule">
                        <option selected disabled>--</option>  
                        <option v-for="estado in data.estados_aprobacion">
                            @{{estado}}
                        </option>  
                    </select>
                    <span class="help-block">@{{ errors.first(rules.aprobado.name) }}</span>
                </div>
                <!-- CONSECUTIVO  -->
                <div v-bind:class="['form-group','col-md-2',errors.first(rules.num_fact.name) ? 'has-error' :'']">
                    <label for="">Consecutivo @{{ rules.num_fact.required }}</label>
                    <input type="text" 
                        style="font-size:12px;"
                        class="form-control my-input" 
                        v-model="solicitud.num_fact"
                        v-validate="rules.num_fact.rule"
                        :name="rules.num_fact.name">
                    <span class="help-block" v-if="errors.first(rules.num_fact.name) ">@{{ errors.first(rules.num_fact.name) }}</span>   
                    <span class="help-block" v-else>Número del formulario</span>
                </div>
                <!-- FECHA SOLICITUD  -->
                <div v-bind:class="['form-group','col-md-2',errors.first(rules.fecha_solicitud.name) ? 'has-error' :'']">
                    <label for="">Fecha Solicitud  @{{ rules.fecha_solicitud.required }}</label>
                    <input type="date" 
                        class="form-control my-input" 
                        v-model="solicitud.fecha"
                        onkeydown="return false"
                        v-validate="rules.fecha_solicitud.rule"
                        :name="rules.fecha_solicitud.name">
                    <span class="help-block">@{{ errors.first(rules.fecha_solicitud.name) }}</span>
                </div>
                <!-- CARTERA  -->
                <div v-bind:class="['form-group','col-md-3',errors.first(rules.cartera.name) ? 'has-error' :'']">
                    <label for="">Cartera @{{ rules.cartera.required }}</label>
                    <select class="form-control my-input" 
                        v-model="solicitud.cartera_id"
                        v-validate="rules.cartera.rule"
                        :name="rules.cartera.name">
                        <option selected disabled>--</option>
                        <option :value="cartera.id" 
                            v-for="cartera in data.carteras">
                            @{{cartera.nombre}}
                        </option>                
                    </select>
                    <span class="help-block">@{{ errors.first(rules.cartera.name) }}</span>
                </div>
                <!-- VENDEDOR  -->
                <div v-bind:class="['form-group','col-md-3',errors.first(rules.funcionario_id.name) ? 'has-error' :'']">
                    <label for="">Vendedor @{{ rules.funcionario_id.required }}</label>
                    <select class="form-control" 
                        v-model="solicitud.funcionario_id"
                        v-validate="rules.funcionario_id.rule"
                        :name="rules.funcionario_id.name">
                        <option selected disabled>--</option>
                        <option :value="vendedor.id" v-for="vendedor in data.vendedores">
                            @{{vendedor.name}}
                        </option>
                    </select>
                    <span class="help-block">@{{ errors.first(rules.funcionario_id.name) }}</span>   
                </div>
            </div>
            <div class="row">
                
            </div>
            <div class="row">
                <!-- COSTO DEL CREDITO  -->
                <div v-bind:class="['form-group','col-md-2',errors.first(rules.centro_costo.name) ? 'has-error' :'']">
                    <label for="">Costo del Crédito @{{ rules.centro_costo.required }}</label>
                    <input type="tex" 
                        class="form-control" 
                        placeholder="Monto Solicitado"
                        v-model="solicitud.vlr_fin"
                        @blur="validar_negocio"
                        v-validate="rules.centro_costo.rule"
                        :name="rules.centro_costo.name">
                    <span class="help-block" v-if="solicitud.vlr_fin > 0">$ @{{ solicitud.vlr_fin | formatPrice }}</span>                       
                    <span class="help-block">@{{ errors.first(rules.centro_costo.name) }}</span>
                </div>
                <!-- CUAOTA INICIAL  -->
                <div v-bind:class="['form-group','col-md-2',errors.first(rules.cuota_inicial.name) ? 'has-error' :'']">
                    <label for="">Cuota Inicial @{{ rules.cuota_inicial.required }}</label>
                    <input type="text" 
                        class="form-control" 
                        placeholder="Monto inicial"
                        v-model="solicitud.cuota_inicial"
                        v-validate="rules.cuota_inicial.rule"
                        :name="rules.cuota_inicial.name">
                    <span class="help-block" v-if="solicitud.cuota_inicial > 0">$ @{{ solicitud.cuota_inicial | formatPrice }}</span>
                    <span class="help-block">@{{ errors.first(rules.cuota_inicial.name) }}</span>
                </div>
                <!-- VALOR ASISTENCIA  -->
                <div v-bind:class="['form-group','col-md-2',errors.first(rules.vlr_asistencia.name) ? 'has-error' :'']">
                    <label for="">Asistencia @{{ rules.cuota_inicial.required }}</label>
                    <input type="text" 
                        class="form-control" 
                        placeholder="Monto inicial"
                        v-model="solicitud.vlr_asistencia"
                        v-validate="rules.cuota_inicial.rule"
                        :name="rules.cuota_inicial.name">
                    <span class="help-block" v-if="solicitud.cuota_inicial > 0">$ @{{ solicitud.vlr_asistencia | formatPrice }}</span>
                    <span class="help-block">@{{ errors.first(rules.vlr_asistencia.name) }}</span>
                </div>
                <!-- MESES  -->
                <div v-bind:class="['form-group','col-md-2',errors.first(rules.meses.name) ? 'has-error' :'']">
                    <label for="">Meses @{{ rules.meses.required }}</label>
                    <select name="" class="form-control" 
                        v-model="solicitud.meses"
                        @change="setup"
                        v-validate="rules.meses.rule"
                        :name="rules.meses.name">
                        <option selected disabled>--</option>
                        <option :value="meses" v-for="meses in data.rango_meses" >
                            @{{ meses }}
                        </option>
                    </select>
                    <span class="help-block">@{{ errors.first(rules.meses.name) }}</span>
                </div>
                <!-- PERIODO  -->
                <div v-bind:class="['form-group','col-md-2',errors.first(rules.periodo.name) ? 'has-error' :'']">
                    <label for="">Periodo @{{ rules.periodo.required }}</label>
                    <select class="form-control" 
                        v-model="solicitud.periodo"
                        @change="setup"
                        v-validate="rules.periodo.rule"
                        :name="rules.periodo.name">
                        <option selected disabled>--</option>
                        <option :value="periodo" v-for="periodo in data.arr_periodos" >
                            @{{ periodo }}
                        </option>
                    </select>
                    <span class="help-block">@{{ errors.first(rules.periodo.name) }}</span>
                </div>
                <!-- NUMERO DE CUOTAS  -->
                <div v-bind:class="['form-group','col-md-2',errors.first(rules.cuotas.name) ? 'has-error' :'']">
                    <label for="">Núm Cuotas @{{ rules.cuotas.required }}</label>
                    <input type="test" disabled
                        class="form-control" 
                        placeholder="Cantidad de Cuotas"
                        v-model="solicitud.cuotas"
                        @blur="validar_negocio"
                        v-validate="rules.cuotas.rule"
                        :name="rules.cuotas.name">
                    <span class="help-block">@{{ errors.first(rules.cuotas.name) }}</span>
                </div>
            </div>
            <div class="row">
                <!-- VALOR CUOTA  -->
                <div v-bind:class="['form-group','col-md-3',errors.first(rules.valor_cuotas.name) ? 'has-error' :'']">
                    <label for="">Valor Cuota @{{ rules.valor_cuotas.required }}</label>
                    <input type="text" 
                        class="form-control" 
                        placeholder="valor cuotas"
                        v-model="solicitud.vlr_cuota"
                        @blur="validar_negocio"
                        v-validate="rules.valor_cuotas.rule"
                        :name="rules.valor_cuotas.name">
                    <span class="help-block" v-if="solicitud.vlr_cuota > 0">$ @{{ solicitud.vlr_cuota | formatPrice }}</span>                    
                <span class="help-block">@{{ errors.first(rules.valor_cuotas.name) }}</span>
                </div>
                <!-- FECHA DE PAGO 1 -->
                <div v-bind:class="['form-group','col-md-3',errors.first(rules.f_pago_1.name) ? 'has-error' :'']">
                    <label for="">Fecha pago 1 @{{ rules.f_pago_1.required }}</label>
                    <select name="" 
                        class="form-control" 
                        v-model="solicitud.p_fecha"
                        @change="setRango2" 
                        v-validate="rules.f_pago_1.rule"
                        :name="rules.f_pago_1.name"
                    >
                        <option selected disabled>--</option>
                        <option :value="i" v-for="i in rango1">
                            @{{ i }}
                        </option>
                    </select>
                    <span class="help-block">@{{ errors.first(rules.f_pago_1.name) }}</span>
                </div>
                <!-- FECHA DE PAGO 2 -->
                <div v-bind:class="['form-group','col-md-3',errors.first(rules.f_pago_2.name) ? 'has-error' :'']">
                    <label for="">Fecha pago 2 @{{ rules.f_pago_2.required }}</label>
                    <input type="text"
                        disabled
                        class="form-control"
                        v-model="solicitud.s_fecha"
                        v-validate="rules.f_pago_2.rule"
                        :name="rules.f_pago_2.name">
                    <span class="help-block">@{{ errors.first(rules.f_pago_2.name) }}</span>
                </div>
                <!-- ESTUDIO -->
                <div v-bind:class="['form-group','col-md-3',errors.first(rules.estudio.name) ? 'has-error' :'']">
                    <label for="">Estudio @{{ rules.estudio.required }}</label>
                    <select class="form-control" 
                        v-model="solicitud.estudio"
                        v-validate="rules.estudio.rule"
                        :name="rules.estudio.name">
                        <option selected disabled>--</option>
                        <option :value="tipo" v-for="tipo in data.arr_estudios">
                            @{{tipo}}
                        </option>
                    </select>
                    <span class="help-block">@{{ errors.first(rules.estudio.name) }}</span>
                </div>
            </div>
            <div class="row">
                <div v-bind:class="['form-group','col-md-12',errors.first(rules.observaciones.name) ? 'has-error' :'']">
                    <label for="">Observaciones</label> 
                    <textarea class="form-control"
                        v-model="solicitud.observaciones"
                        v-validate="rules.observaciones.rule"
                        :name="rules.observaciones.name">
                    </textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12" style="margin-top:20px;">
                    <center>
                        <a class="btn btn-default" @click="volver">
                            <i class="fa fa-backward" aria-hidden="true"></i>
                            Volver
                        </a>
                        <button class="btn btn-primary" @click="onSubmit">
                            <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                            Salvar
                        </button>
                        <a class="btn btn-default" @click="continuar">
                            <i class="fa fa-forward" aria-hidden="true"></i>
                            Continuar
                        </a>
                    </center>
                </div>
            </div> 

        </form>

    </div>
</script>


<script src="/js/rules/solicitudV3/solicitud.js"></script>

<script>
    const solicitud = Vue.component('solicitud-component', {
        template: '#solicitud-template',
        data() {
            return{
                rango1: [],
                rango2: [],
                solicitud: null,
                rules: rules_solicitud
            }
        },
        methods: {
            validar_negocio() {
                if (this.solicitud.vlr_fin && this.solicitud.cuotas && this.solicitud.vlr_cuota ) {

                    const sumatoria = this.solicitud.cuotas *  this.solicitud.vlr_cuota;

                    if ( sumatoria < (this.solicitud.vlr_fin * 1)) {
                        alertify.alert('Error de validación =(','La sumatoria de cuotas no coincide con el valor del Costo del crédito', 'error')
                    } else {
                        alertify.notify('Los valores son correctos', 'success', 5, function(){  });
                    }
                }
            },
            async onSubmit() {
                console.log('onSubmit solicitud');
                return this.$store.dispatch('onSubmit');
            }, 
            async assignData() {
                await this.$store.commit('setSolicitud', this.solicitud);
            }, 
            async continuar () {
                if (! await this.validation()) return false;
                await this.assignData();
                $('.nav-tabs a[href="#credito"]').tab('show') 
            },
            async volver() {
                if (! await this.validation()) return false; 
                await this.assignData();
                $('.nav-tabs a[href="#producto"]').tab('show');
            },                
            async validation() {
                if ( ! await this.$validator.validate() ) {
                    alertify.set('notifier','position', 'top-right');
                    alertify.notify('Por favor complete los campos', 'error', 5, function(){  });
                    return false;
                }
                return true;
            },
            async setup(){

                if (this.solicitud.meses && this.solicitud.periodo) {
                    rock = (this.solicitud.periodo == 'Quincenal') ? 2 : 1;  
                    this.solicitud.cuotas = parseInt(this.solicitud.meses) * parseInt(rock);
                }

                if ( this.solicitud.periodo == 'Quincenal' ) {
                    this.rango1 = [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15];
                } else {
                    this.rango1 = [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30];
                }

                if (this.solicitud.p_fecha) await this.setRango2()

                await this.validar_negocio();
            },
            setRango2(){

                this.solicitud.s_fecha = '';
            
                if (this.solicitud.periodo === 'Quincenal') {

                    var n = parseInt(this.solicitud.p_fecha);
                    this.solicitud.s_fecha = n + 15;
                    
                } else {
                    this.rango2 = []
                }
            }
        },
        filters: {
            formatPrice(value) {
                let val = (value/1).toFixed(0).replace('.', ',')
                return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
            }
        },
        computed: {
            data() {
                return this.$store.state.data;
            }
        },
        created() {
            this.solicitud = this.$store.state.solicitud;

            if (this.$store.state.modo === 'Editar Solicitud') {
                this.setup();
                this.setRango2();
            }
        }
    });
</script>