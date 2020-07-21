<script type="text/x-template" id="producto-template">

    <form @submit.prevent="onSubmit">
    
        <div class="row">
            <div class="col-md-12">
                
                <!-- PRODUCTO  -->

                <div v-bind:class="['form-group','col-md-4',errors.first(rules.producto_id.name) ? 'has-error' :'']">
                    <label for="">Nombre del Producto @{{ rules.producto_id.required }}</label>  
                    <select 
                        @change="cargarProducto()"
                        type="text" 
                        class="form-control" 
                        v-model="producto"
                        v-validate="rules.producto_id.rule"
                        :name="rules.producto_id.name">                           
                        <option selected disabled>--</option>
                        <option :value="item_producto" v-for="item_producto in productos">
                            @{{item_producto.nombre}}
                        </option>
                    </select>
                    <span class="help-block">@{{ errors.first(rules.producto_id.name) }}</span>
                </div> 

                <!-- ELEMENTS  -->

                <div class="col-md-12">
                    <template v-for="(element, index) in elements">

                            <div class="row">
                            
                                <!-- FACTURACION DEL PRODUCTO  -->
                                
                                <div class="form-group col-md-12">
                                    <h4 style="display:inline-block; margin-right:10px;">@{{ element.nombre }}</h4>
                                    <div class="checkbox" style="display:inline-block" v-if="index > 0">
                                        <label>
                                            <input type="checkbox" @change="check(index)" :id="'check'+index" value="false"> Clonar vehiculo
                                        </label>
                                    </div>
                                    <hr>
                                </div>


                                <!-- PROVEEDOR  -->
                            
                                <div class="form-group col-md-2" :id="'div-proveedor'+index">
                                    <label class="input-solicitud">Proveedor @{{element.nombre }} *</label>  
                                    <select
                                        class="form-control" 
                                        v-model="element.proveedor_id"
                                        :id="'proveedor'+index"
                                        @change="validateProveedor(index)">  
                                        <option selected disabled>--</option>
                                        <option :value="proveedor.id" v-for="proveedor in $store.state.data.proveedores">@{{ proveedor.razon_social }}</option>
                                    </select>
                                    <span class="help-block" :id="'span-proveedor'+index"></span>
                                </div>

                                <!-- NUMERO DE FACTURA  -->

                                <div v-bind:class="['form-group','col-md-2',errors.first(rules.num_fac.name) ? 'has-error' :'']">
                                    <label class="input-solicitud">Num Factura @{{element.nombre }} @{{ rules.num_fac.required }}</label>  
                                    <input class="form-control input-solicitud"
                                        v-model="element.num_fac" 
                                        v-validate="rules.num_fac.rule"
                                        :name="rules.num_fac.name">  
                                    <span class="help-block">@{{ errors.first(rules.num_fac.name) }}</span>                        
                                </div> 

                                <!-- FECHA DE EXPEDICION  -->

                                <div v-bind:class="['form-group','col-md-2',errors.first(rules.fecha_exp.name) ? 'has-error' :'']">
                                    <label class="input-solicitud">Fecha de Expedicion @{{ rules.fecha_exp.required }}</label> 
                                    <input type="date" 
                                        class="form-control input-solicitud"
                                        v-model="element.fecha_exp"
                                        v-validate="rules.fecha_exp.rule"
                                        :name="rules.fecha_exp.name">  
                                    <span class="help-block">@{{ errors.first(rules.fecha_exp.name) }}</span>                           
                                </div>


                                <!-- COSTO  -->

                                <div v-bind:class="['form-group','col-md-2',errors.first(rules.costo.name+index) ? 'has-error' :'']">
                                    <label class="input-solicitud">Costo @{{element.nombre }} @{{ rules.costo.required }}</label> 
                                    <input type="text" 
                                        class="form-control input-solicitud" 
                                        v-model="element.costo"
                                        v-validate="rules.costo.rule"
                                        :name="rules.costo.name+index">  
                                    <span class="help-block">@{{ errors.first(rules.costo.name+index) }}</span>                            
                                </div>

                                <!-- IVA  -->

                                <div v-bind:class="['form-group','col-md-2',errors.first(rules.iva.name) ? 'has-error' :'']">
                                    <label class="input-solicitud">IVA @{{element.nombre }} @{{ rules.iva.required }}</label>   
                                    <input type="text" 
                                        class="form-control input-solicitud" 
                                        v-model="element.iva"
                                        v-validate="rules.iva.rule"
                                        :name="rules.iva.name">  
                                    <span class="help-block">@{{ errors.first(rules.iva.name) }}</span>                          
                                </div>


                                <!-- ESTADO -->
                                <div v-bind:class="['form-group','col-md-2',errors.first(rules.estado.name) ? 'has-error' :'']">
                                    <label for="">Estado @{{element.nombre }} @{{ rules.estado.required }}</label> 
                                    <select 
                                        class="form-control" 
                                        v-model="element.estado">                          
                                        <option selected disabled>--</option>
                                        <option :value="estado" v-for="estado in $store.state.data.estados_ref_producto">@{{ estado }}</option>
                                    </select>
                                    <span class="help-block">@{{ errors.first(rules.estado.name) }}</span>                          
                                </div> 
                            </div>
                            

                            <div class="row">

                                <!-- TIPO VEHICULO  -->

                                <div class="form-group col-md-3" :id="'div-tipo_vehiculo'+index">
                                    <label for="">Tipo Vehiculo *</label>
                                    <select type="text" 
                                        class="form-control"
                                        placeholder="escoja tipo vehiculo"
                                        :id="'tipo_vehiculo'+index"
                                        @change="validateTipoVehiculo(index)"
                                        v-model="element._tipo_vehiculo"
                                        name="tipo_vehiculo">   
                                        <option selected disabled>--</option>    
                                        <option :value="tipo" v-for="tipo in $store.state.data.tipo_vehiculos">@{{ tipo }}</option>                   
                                    </select>
                                    <span class="help-block" :id="'span-tipo_vehiculo'+index"></span>
                                </div> 



                                <!-- PLACA  -->

                                <div v-bind:class="['form-group','col-md-3',errors.first('placa'+index) ? 'has-error' :'']">
                                    <label for="">Placa</label>  
                                    <input class="form-control"  
                                        placeholder="escriba placa"
                                        v-model="element._placa"
                                        v-validate="'required'"
                                        :name="'placa'+index">
                                    <span class="help-block">@{{ errors.first('placa'+index) }}</span>
                                </div> 

                                <!-- VENCIMIENTO SOAT  -->

                                <div v-bind:class="['form-group','col-md-3',errors.first('vencimiento_soat'+index) ? 'has-error' :'']">
                                    <label for="">Vencimiento SOAT</label>
                                    <input type="date" 
                                        class="form-control"
                                        v-model="element._vencimiento_soat"
                                        v-validate="'required'"
                                        :name="'vencimiento_soat'+index">              
                                    <span class="help-block">@{{ errors.first('vencimiento_soat'+index) }}</span>            
                                </div>

                                <!-- VENCIMIENTO RTM  -->

                                <div v-bind:class="['form-group','col-md-3',errors.first('vencimiento_rtm'+index) ? 'has-error' :'']">
                                    <label for="">Vencimiento RTM</label>
                                    <input type="date" 
                                        class="form-control"
                                        v-model="element._vencimiento_rtm"
                                        v-validate="'required'"
                                        :name="'vencimiento_rtm'+index">              
                                    <span class="help-block">@{{ errors.first('vencimiento_rtm'+index) }}</span>            
                                </div>
                            </div>
                            
                            <div class="row">
                                <div v-bind:class="['form-group','col-md-6',errors.first(rules.observaciones.name) ? 'has-error' :'']">
                                    <label for="">Observaciones @{{element.nombre }} @{{ rules.observaciones.required }}</label>
                                        <textarea 
                                            class="form-control" 
                                            v-model="element.observaciones"
                                            v-validate="rules.observaciones.rule"
                                            :name="rules.observaciones.name">
                                        </textarea>
                                    <span class="help-block">@{{ errors.first(rules.observaciones.name) }}</span>
                                </div>
                            </div>
                            <br>
        
                    </template>

                    <div class="row">
                        <div class="col-md-12" style="margin-top:20px;">
                            <center>
                                <button type="submit" class="btn btn-primary">Continuar</button>
                            </center>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>

    </form>


</script>

<script src="/js/interfaces/producto.js"></script>
<script src="/js/rules/producto.js"></script>
<script src="/js/productos/logica.js"></script>

<script>

    const producto = Vue.component('producto-component',{
        template: '#producto-template',
        data() {
            return {
                producto    : '',
                rules       : rules_producto,
                productos   : this.$store.state.productos,
                elements    : []
            }
        },
        methods: {
            async onSubmit() {

                if (!this.validate()) return false;
                await this.$store.commit('setElements',this.elements);
                this.continuar()

            },
            cargarProducto() {
                // let product = this.productos.filter( item => item.id == this.producto.id)
                this.elements = getProductos(this.producto)
                
                this.$store.commit('setProducto',this.producto)
                let min_vehiculos = this.producto.min_vehiculos
                let vehiculos = []
                
                for (var i = 0; i < min_vehiculos; i++) {
                    let vehiculo = new Vehiculo()
                }
            },
            check(index) {
                let check = document.getElementById('check'+index).value

                this.resetVehiculo(index)

                if (!check || check == 'false') {
                    document.getElementById('check'+index).value = true
                    this.asignarVehiculo(index)
                } else {
                    document.getElementById('check'+index).value = false
                }
                console.log(check)
            },
            asignarVehiculo(index) {
                this.elements[index]._placa = this.elements[index - 1 ]._placa
                this.elements[index]._tipo_vehiculo = this.elements[index - 1 ]._tipo_vehiculo
                this.elements[index]._vencimiento_soat = this.elements[index - 1 ]._vencimiento_soat
                this.elements[index]._vencimiento_rtm  = this.elements[index - 1 ]._vencimiento_rtm
            },
            resetVehiculo(index) {
                this.elements[index]._placa             = ''
                this.elements[index]._tipo_vehiculo     = ''
                this.elements[index]._vencimiento_soat  = ''
                this.elements[index]._vencimiento_rtm   = ''
            },
            continuar() {
                
                $('.nav-tabs a[href="#solicitud"]').tab('show');
            },
            async validate() {

                var count = 0;

                for (var i=0; i < this.elements.length; i++) {
                    if (!this.validateProveedor(i) ) count ++
                    if (!this.validateTipoVehiculo(i) ) count ++
                }

                let valid = await this.$validator.validate()

                if (!valid || count > 0) {
                    alert('Por favor complete los campos');
                    return false
                }
                else return true
            },
            validateProveedor(index) {

                if (!this.elements[index].proveedor_id) {
                    document.getElementById('div-proveedor'+index).classList.add('has-error')
                    document.getElementById('span-proveedor'+index).textContent = 'El proveedor es requerido'
                    return false;
                } else {
                    document.getElementById('div-proveedor'+index).classList.remove('has-error')
                    document.getElementById('span-proveedor'+index).textContent = ''
                    return true;
                }
            },
            validateTipoVehiculo(index) {

                if (!this.elements[index]._tipo_vehiculo) {
                    document.getElementById('div-tipo_vehiculo'+index).classList.add('has-error')
                    document.getElementById('span-tipo_vehiculo'+index).textContent = 'El tipo de vehículo es requerido'
                    return false;
                } else {
                    document.getElementById('div-tipo_vehiculo'+index).classList.remove('has-error')
                    document.getElementById('span-tipo_vehiculo'+index).textContent = ''
                    return true;
                }
            }
        }
    });

</script>




















