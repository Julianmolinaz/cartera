<script type="text/x-template" id="invoice-template">
    <form @submit.prevent="">
        
        <div class="row">
            <div class="col-md-12">

                <!-- ELEMENTS  -->

                <div class="col-md-12">
                    <template >

                        <div class="row">
                        
                            <!-- FACTURACION DEL PRODUCTO  -->
                            
                            <div class="form-group col-md-12">
                                <h4 style="display:inline-block; margin-right:10px;">Facturación:
                                <!-- @{{ index + 1 +'-'+element.nombre }} -->
                                    <span style="margin-left:10px;color:#3c763d"> Total: $000.000 
                                        <!-- $@{{parseInt(element.costo)+ 
                                        parseInt(element.iva)  + 
                                        parseInt(element.otros)
                                        | formatPrice}} -->
                                    </span>
                                </h4>
                            </div>

                        </div>
                        <div class="row">
                            <!-- Expedido a -->
                            <div v-bind:class="['form-group','col-md-4',errors.first(rules.expedido_a.name) ? 'has-error' :'']">
                                <label class="input-solicitud">Expedido a @{{ rules.expedido_a.required }}</label>
                                <select  class="form-control" 
                                    v-model="invoice.expedido_a"
                                    v-validate="rules.expedido_a.rule"
                                    :name="rules.expedido_a.name"
                                    >
                                    <option selected disabled>--</option>
                                    <option :value="expedido"  
                                        v-for="expedido in insumos.list_expedido_a">
                                            @{{ expedido }}
                                    </option>
                                </select>
                                <span class="help-block">@{{ errors.first(rules.expedido_a.name) }}</span>
                            </div>
                            <!-- PROVEEDOR  -->
                            <div v-bind:class="['form-group','col-md-4',errors.first(rules.proveedor_id.name) ? 'has-error' :'']">
                                <label class="input-solicitud">Proveedor @{{ rules.proveedor_id.required }}</label>  
                                <select class="form-control" 
                                    v-model="invoice.proveedor_id"
                                    v-validate="rules.proveedor_id.rule"
                                    :name="rules.proveedor_id.name"
                                    >  
                                    <option selected disabled>--</option>
                                    <option :value="proveedor.id"  
                                        v-for="proveedor in insumos.proveedores">
                                            @{{ (proveedor.municipio) ? proveedor.municipio + '-' : ''}} @{{proveedor.nombre}}
                                    </option>
                                </select>
                                <span class="help-block">@{{ errors.first(rules.proveedor_id.name) }}</span>
                            </div>
                            <!-- COSTO  -->
                            <div v-bind:class="['form-group','col-md-4',errors.first(rules.costo.name) ? 'has-error' :'']">
                                <label class="input-solicitud">Costo @{{ rules.costo.required }}</label> 
                                <input type="text"
                                    class="form-control" 
                                    autocomplete="off"        
                                    v-model="invoice.costo"
                                    placeholder="Ingrese el costo del producto"
                                    v-validate="rules.costo.rule"
                                    :name="rules.costo.name"
                                    >  
                                <span class="help-block">@{{ errors.first(rules.costo.name) }}</span>
                            </div>
                        </div>

                        <div class="row">    
                            <!-- NUMERO DE FACTURA  -->
                            <div v-bind:class="['form-group','col-md-3',errors.first(rules.num_fact.name) ? 'has-error' :'']">
                                <label class="input-solicitud">Número Factura @{{ rules.num_fact.required }}</label>  
                                <input class="form-control" 
                                    v-model="invoice.num_fact"
                                    v-validate="rules.num_fact.rule"
                                    :name="rules.num_fact.name"
                                    >  
                                <span class="help-block" v-if="errors.first(rules.num_fact.name)">@{{ errors.first(rules.num_fact.name) }}</span> 
                                <span class="help-block" v-else><small>Ver factura ...</small></span> 
                            </div> 
                            <!-- FECHA DE EXPEDICION  -->
                            <div v-bind:class="['form-group','col-md-3',errors.first(rules.fecha_exp.name) ? 'has-error' :'']">
                                <label class="input-solicitud">Fecha de Expedicion @{{ rules.fecha_exp.required }}</label> 
                                <input type="date" 
                                    class="form-control" 
                                    v-model="invoice.fecha_exp"
                                    onkeydown="return false"
                                    v-validate="rules.fecha_exp.rule"
                                    :name="rules.fecha_exp.name"
                                >
                                <span class="help-block" v-if="errors.first(rules.fecha_exp.name)">@{{ errors.first(rules.fecha_exp.name) }}</span> 
                                <span class="help-block" v-else><small>Ver factura ...</small></span> 
                            </div>
                            <!-- IVA  -->
                            <div v-bind:class="['form-group','col-md-2',errors.first(rules.iva.name) ? 'has-error' :'']">
                                <label class="input-solicitud">IVA @{{ rules.iva.required }}</label> 
                                <input type="text"
                                    class="form-control" 
                                    v-model="invoice.iva"
                                    v-validate="rules.iva.rule"
                                    :name="rules.iva.name"
                                    >
                                <span class="help-block" v-if="errors.first(rules.iva.name)">@{{ errors.first(rules.iva.name) }}</span> 
                                <span class="help-block" v-else><small>Ver factura ...</small></span>                          
                            </div>
                            <!-- OTROS  -->
                            <div v-bind:class="['form-group','col-md-2',errors.first(rules.otros.name) ? 'has-error' :'']">
                                <label class="input-solicitud">Otros</label> 
                                <input type="text"
                                    class="form-control" 
                                    v-model="invoice.otros"
                                    v-validate="rules.otros.rule"
                                    :name="rules.otros.name"
                                    >
                                <span class="help-block">@{{ errors.first(rules.otros.name) }}</span>                                             
                            </div>

                            <!-- ESTADO -->
                            <div v-bind:class="['form-group','col-md-2',errors.first(rules.estado.name) ? 'has-error' :'']">
                                <label for="">Estado @{{ rules.estado.required }}</label> 
                                <select class="form-control" 
                                    v-model="invoice.estado"
                                    v-validate="rules.estado.rule"
                                    :name="rules.estado.name"
                                    >                          
                                    <option selected disabled>--</option>
                                    <option :value="estado"  
                                        v-for="estado in insumos.list_estados_ref_productos">
                                            @{{ estado }}
                                    </option>
                                </select>
                                <span class="help-block">@{{ errors.first(rules.estado.name) }}</span>
                            </div> 
                        </div>
                        
                        <div class="row">
                            <div class="form-group col-md-12" >
                                <label for="">Observaciones </label>
                                    <textarea class="form-control" v-model="invoice.observaciones">
                                    </textarea>
                                
                            </div>
                        </div>
                        
                        <hr>
    
                    </template>
                </div>
                
            </div>
        </div>
        
    </form>
</script>

<script src="/js/rules/solicitudV3/invoice.js"></script>

<script>

    Vue.component('invoice-component', {
        template: '#invoice-template',
        data() {
            return {
                name: 'invoice component',
                rules: rules_invoice
            }
        },
        props: ['invoice'],
        methods: {
            async validacion() {
                let validation = await this.$validator.validate();

                if (!validation) {
                    await this.$store.dispatch('noContinuarASolicitud');
                }
            }
        },
        computed: {  
            insumos() {
              return this.$store.state.insumos
            },
        },
        created() {
            Bus.$on('validarComponents', () => {
                this.validacion();
            });
        }
    });
</script>