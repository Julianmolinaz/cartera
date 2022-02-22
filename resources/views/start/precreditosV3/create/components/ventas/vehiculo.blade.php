<script type="text/x-template" id="vehiculo-template">
    
        <div class="row">
            <div class="col-md-12">
                <div class="row">  
                    <!-- DATOS DEL VEHICULO  -->                    
                    <div class="form-group col-md-12" style="margin-left:15px;">
                        <h4 class="vehiculo-title">
                            Vehículo:
                        </h4>
                    </div>
                </div>
                <!-- ELEMENTS  -->
                <div class="col-md-12">
                    <template>
                        <div class="row">
                            <form @submit.prevent="" autocomplete="off">
                                <!-- TIPO VEHICULO  -->
                                <div v-bind:class="[
                                    'form-group', 'col-md-2',
                                    errors.first(rules.tipo_vehiculo.name + ' ' + index) ? 'has-error' :'']"
                                >
                                    <label for="">Tipo Vehiculo @{{ rules.tipo_vehiculo.required }}</label>
                                    <select class="form-control" 
                                        v-model="vehiculo.tipo_vehiculo_id"
                                        v-validate="rules.tipo_vehiculo.rule"
                                        :name="rules.tipo_vehiculo.name + ' ' + index"
                                        >   
                                        <option selected disabled>--</option>    
                                        <option :value="tipo_vehiculo.id"  
                                            v-for="tipo_vehiculo in insumos.list_tipo_vehiculo">
                                                @{{ tipo_vehiculo.nombre }}
                                        </option>
                                    </select>
                                    <span class="help-block">@{{ errors.first(rules.tipo_vehiculo.name + ' ' + index) }}</span>
                                </div> 
                                <!-- PLACA  -->
                                <div 
                                    v-bind:class="['form-group','col-md-2',errors.first(rules.placa.name + ' ' + index) ? 'has-error' :'']"
                                >
                                    <label for="">Placa @{{ rules.placa.required }}</label>  
                                    <input 
                                        class="form-control" 
                                        v-model="vehiculo.placa"
                                        v-validate="rules.placa.rule"
                                        :name="rules.placa.name + ' ' + index"
                                        @keyup="placaToUpperCasse"
                                    >
                                    <span class="help-block">@{{ errors.first(rules.placa.name + ' ' + index) }}</span>
                                </div> 
                                <!-- MODELO  -->
                                <div v-bind:class="['form-group','col-md-2',errors.first(rules.modelo.name + ' ' + index) ? 'has-error' :'']">
                                    <label for="">Modelo @{{ rules.modelo.required }}</label>
                                    <input class="form-control"
                                        v-model="vehiculo.modelo"
                                        v-validate="rules.modelo.rule"
                                        :name="rules.modelo.name + ' ' + index"
                                        >   
                                    <span class="help-block">@{{ errors.first(rules.modelo.name + ' ' + index) }}</span>           
                                </div>
                                <!-- CILINDRAJE  -->
                                <div v-bind:class="['form-group', 'col-md-2',errors.first(rules.cilindraje.name + ' ' + index) ? 'has-error' :'']">
                                    <label for="">Cilindraje @{{ rules.cilindraje.required }}</label>
                                    <input class="form-control"
                                        v-model="vehiculo.cilindraje"
                                        v-validate="rules.cilindraje.rule"
                                        :name="rules.cilindraje.name + ' ' + index"
                                        >   
                                    <span class="help-block">@{{ errors.first(rules.cilindraje.name + ' ' + index) }}</span>           
                                </div>
                                <!-- VENCIMIENTO SOAT  -->
                                <div v-bind:class="['form-group', 'vehiculo-fecha','col-md-2',errors.first(rules.vencimiento_soat.name + ' ' + index) ? 'has-error' :'']">
                                    <label for="">Vence SOAT @{{ rules.vencimiento_soat.required }}</label>
                                    <input 
                                        type="date" 
                                        onkeydown="return false" 
                                        class="form-control date-vencimiento" 
                                        v-model="vehiculo.vencimiento_soat"
                                        v-validate="rules.vencimiento_soat.rule"
                                        :name="rules.vencimiento_soat.name + ' ' + index"
                                        >  
                                    <span class="help-block">@{{ errors.first(rules.vencimiento_soat.name + ' ' + index) }}</span>            
                                </div>
                                <!-- VENCIMIENTO RTM  -->
                                <div v-bind:class="['form-group', 'vehiculo-fecha', 'col-md-2',errors.first(rules.vencimiento_rtm.name + ' ' + index) ? 'has-error' :'']">
                                    <label for="">Vence RTM @{{ rules.vencimiento_rtm.required }}</label>
                                    <input 
                                        type="date" 
                                        onkeydown="return false" 
                                        class="form-control date-vencimiento" 
                                        v-model="vehiculo.vencimiento_rtm"
                                        v-validate="rules.vencimiento_rtm.rule"
                                        :name="rules.vencimiento_rtm.name + ' ' + index"
                                        >  
                                    <span class="help-block">
                                        @{{ errors.first(rules.vencimiento_rtm.name + ' ' + index) }}
                                    </span>
                                </div> 
                            </form>
                        </div>                      
                    </template>
                </div>
            </div>
        </div>
    
</script>

<script src="/js/rules/solicitudV3/vehiculo.js"></script>

<script>
    Vue.component('vehiculo-component', {
        template: '#vehiculo-template',
        data() {
            return {
                name: 'vehiculo component',
                rules: rules_vehiculo,
            }
        },
        props: ['vehiculo', 'index'],
        methods: {
            async validar() {
                if (!await this.$validator.validate()) {
                    let error = `Por favor complete los campos del vehiculo para el producto ${this.index}`;
                    this.$store.state.errores += error + "<br>";
                }
            },
            // async onSubmit() {
            //     if (!await this.$validator.validate()) {
            //         let error = `Por favor complete los campos del vehiculo para el producto ${this.index}`;
            //         this.$store.state.errores += error + "<br>";
            //     }
            // },
            placaToUpperCasse() {
                this.vehiculo.placa = capitalize(this.vehiculo.placa);
            }
        },
        computed: {  
            insumos() {
              return this.$store.state.insumos
            }
        },
        created() {

            Bus.$on('VALIDAR_VEHICULO', () => {
                this.validar();
            });
            // Bus.$on('VEHICULO_ON_SUBMIT', () => {
            //     this.onSubmit();
            // });
            Bus.$on('consultarVehiculo', () => {
                this.$store.commit("setToListaVehiculos", this.vehiculo);
            });
        }
    });
</script>
<style scoped>
    .date-vencimiento {
        font-size: 11px;
    }
    .vehiculo-title {
        display:inline-block; 
        margin-right:10px;
        margin-bottom: .1rem;
    }
    
    @media (min-width: 970px) {
        .vehiculo-fecha {
            padding-left: 0;
        }
    }
</style>