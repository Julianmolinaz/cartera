<script type="text/x-template" id="producto-template">
    <!-- PRODUCTO -->
    <div>
        <form @submit.prevent="onSubmit">
             <!-- NOMBRE PRODUCTO -->
            <div class="row">       
                <div v-bind:class="['form-group','col-md-12',errors.first(rules.producto_id.name) ? 'has-error' :'']">
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
            </div> 
            <!-- END NOMBRE PRODUCTO -->
            <!-- PROVEEDOR -->   
            <div v-for="(element, i) in elements">
                <h1>@{{ element.nombre }}</h1>
                <hr>
                <div class="row">                    
                    <div v-bind:class="['form-group','col-md-4',errors.first(rules.proveedor_id.name) ? 'has-error' :'']">
                        <label for="">Proveedor @{{element.nombre }} @{{ rules.proveedor_id.required }}</label>  
                        <select 
                            v-model="element.proveedor_id"
                            class="form-control" 
                            v-validate="rules.proveedor_id.rule"
                            :name="rules.proveedor_id.name">                 
                            <option selected disabled>--</option>
                            <option :value="i" v-for="i in [1,2,3]">@{{i}}</option>
                        </select>
                        <span class="help-block">@{{ errors.first(rules.proveedor_id.name) }}</span>
                    </div>
                    <!-- END PROVEEDOR -->
                    <!-- NUM FACTURA -->
                    <div v-bind:class="['form-group','col-md-4',errors.first(rules.num_fac.name) ? 'has-error' :'']">
                        <label for="">Num Factura @{{element.nombre }} @{{ rules.num_fac.required }}</label>  
                        <input 
                            class="form-control"  
                            v-model="element.num_fac" 
                            v-validate="rules.num_fac.rule"
                            :name="rules.num_fac.name">  
                        <span class="help-block">@{{ errors.first(rules.num_fac.name) }}</span>                        
                    </div> 
                    <!-- END NUM FACTURA -->
                    <!-- F. EXPEDICION -->
                    <div v-bind:class="['form-group','col-md-4',errors.first(rules.fecha_exp.name) ? 'has-error' :'']">
                        <label for="">Fecha de Expedicion @{{element.nombre }} @{{ rules.fecha_exp.required }}</label> 
                        <input 
                            type="date" 
                            class="form-control" 
                            v-model="element.fecha_exp"
                            v-validate="rules.fecha_exp.rule"
                            :name="rules.fecha_exp.name">  
                        <span class="help-block">@{{ errors.first(rules.fecha_exp.name) }}</span>                           
                    </div>
                    <!-- END F DE EXPEDICION -->
                </div> 
                <div class="row">
                    <!-- COSTO -->
                    <div v-bind:class="['form-group','col-md-4',errors.first(rules.costo.name) ? 'has-error' :'']">
                        <label for="">Costo @{{element.nombre }} @{{ rules.costo.required }}</label> 
                        <input 
                            type="text" 
                            class="form-control" 
                            v-model="element.costo"
                            v-validate="rules.costo.rule"
                            :name="rules.costo.name">  
                        <span class="help-block">@{{ errors.first(rules.costo.name) }}</span>                            
                    </div>
                    <!-- END COSTO -->
                    <!-- IVA -->
                    <div v-bind:class="['form-group','col-md-4',errors.first(rules.iva.name) ? 'has-error' :'']">
                        <label for="">IVA @{{element.nombre }} @{{ rules.iva.required }}</label>   
                        <input 
                            type="text" 
                            class="form-control" 
                            v-model="element.iva"
                            v-validate="rules.iva.rule"
                            :name="rules.iva.name">  
                        <span class="help-block">@{{ errors.first(rules.iva.name) }}</span>                          
                    </div>
                    <!-- END IVA -->
                    <!-- ESTADO -->
                    <div v-bind:class="['form-group','col-md-4',errors.first(rules.estado.name) ? 'has-error' :'']">
                        <label for="">Estado @{{element.nombre }} @{{ rules.estado.required }}</label> 
                        <select 
                            type="text" 
                            class="form-control" 
                            v-model="element.estado"
                            v-validate="rules.estado.rule"
                            :name="rules.estado.name">                          
                            <option selected disabled>--</option>
                            <option :value="i" v-for="i in [1,2,3]">@{{i}}</option>
                        </select>
                        <span class="help-block">@{{ errors.first(rules.estado.name) }}</span>                          
                    </div> 
                    <!-- END ESTADO -->
                </div> 

                <!-- TIPO VEHICULO -->
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="">Tipo Vehiculo</label>
                        <select 
                            type="text" 
                            class="form-control"
                            placeholder="escoja tipo vehiculo"
                            v-model="element.tipo_vehiculo"
                            name="tipo_vehiculo">                          
                        </select>
                    </div>    
                
                    <div class="form-group col-md-6">
                        <label for="">Placa</label>  
                            <input  
                                class="form-control"  
                                placeholder="escriba placa"
                                v-model="element.placa"
                                name="placa">
                    </div> 
                </div>
                <div class="row">                  
                    <div class="form-grup, col-md-6">
                        <label for="">Vencimiento SOAT</label>
                        <select 
                            type="date" 
                            class="form-control"
                            v-model="element.vencimiento_soat"
                            name="vencimiento_soat">                          
                        </select>
                    </div>
                    <div class="form-grup, col-md-6">
                        <label for="">Vencimiento SOAT</label>  
                            <input  
                            type="date" 
                            class="form-control"
                            v-model="element.vencimiento_rtm"
                            name="vencimiento_rtm">  
                    </div>
                </div>
                <!-- END TIPO VEHICULO -->
                <!-- DESCRIPCIO PRODUCTO -->
                <br>
                <div class="row">
                    <div v-bind:class="['form-group','col-md-12',errors.first(rules.observaciones.name) ? 'has-error' :'']">
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
                <!-- END DESCRIPCION PRODUCTO -->
            </div>
            <div class="row">
                <div class="col-md-12" style="margin-top:20px;">
                    <center>
                        <button class="btn btn-primary">Continuar</button>
                    </center>
                </div>
            </div> 
        </form>
    </div>
    <!-- END PRODUCTO -->
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
                let valid = await this.$validator.validate()

                // imprimir por consola
                console.log(valid)
            },
            cargarProducto() {
                // let product = this.productos.filter( item => item.id == this.producto.id)
                this.elements = getProductos(this.producto)
                
                this.$store.commit('setProducto',this.producto)
                let min_vehiculos = this.producto.min_vehiculos
                let vehiculos = []
                
                for (var i = 0; i < min_vehiculos; i++) {
                    let vehiculo = new Vehiculo();

                }

                console.log(min_vehiculos)

            }
        }
    });

</script>




















