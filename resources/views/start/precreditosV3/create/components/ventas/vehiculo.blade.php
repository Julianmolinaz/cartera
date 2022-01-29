<script type="text/x-template" id="vehiculo-template">
    <form @submit.prevent="" autocomplete="off">
        
        <div class="row">
            <div class="col-md-12">

                <div class="row">  
                    <!-- DATOS DEL VEHICULO  -->                    
                    <div class="form-group col-md-12" style="margin-left:15px;">
                        <h4 style="display:inline-block; margin-right:10px;">
                            Vehículo:
                        </h4>
                    </div>
                </div>
                <!-- ELEMENTS  -->
                <div class="col-md-12">
                    <template>
                        <div class="row">
                            <!-- TIPO VEHICULO  -->
                            <div 
                                v-bind:class="[
                                    'form-group','col-md-2',
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
                            <div v-bind:class="['form-group','col-md-2',errors.first(rules.cilindraje.name + ' ' + index) ? 'has-error' :'']">
                                <label for="">Cilindraje @{{ rules.cilindraje.required }}</label>
                                <input class="form-control"
                                    v-model="vehiculo.cilindraje"
                                    v-validate="rules.cilindraje.rule"
                                    :name="rules.cilindraje.name + ' ' + index"
                                    >   
                                <span class="help-block">@{{ errors.first(rules.cilindraje.name + ' ' + index) }}</span>           
                            </div>
                            <!-- VENCIMIENTO SOAT  -->
                            <div v-bind:class="['form-group','col-md-2',errors.first(rules.vencimiento_soat.name + ' ' + index) ? 'has-error' :'']">
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
                            <div v-bind:class="['form-group','col-md-2',errors.first(rules.vencimiento_rtm.name + ' ' + index) ? 'has-error' :'']">
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
                        </div>
                        <hr>                         
                    </template>
                </div>
            </div>
        </div>
    </form>
</script>

<script src="/js/rules/solicitudV3/vehiculo.js"></script>

<script>
    Vue.component('vehiculo-component', {
        template: '#vehiculo-template',
        data() {
            return {
                name: 'vehiculo component',
                rules: rules_vehiculo
            }
        },
        props: ['vehiculo', 'index'],
        methods: {
            async validacion() {
                let validation = await this.$validator.validate();

                if (!validation) {
                    await this.$store.dispatch('noContinuarASolicitud');
                    await this.$store.dispatch('noPermitirSalvar');
                }
            },
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
            Bus.$on('validarVehiculo', () => {
                this.validacion();
            });
        }
    });
</script>
<style scoped>
    .date-vencimiento {
        font-size: 11px;
    }
</style>