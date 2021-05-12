<script type="text/x-template" id="producto-template">

    <form @submit.prevent="">
    
        <div class="row">
            <div class="col-md-12">
                
                <!-- PRODUCTO  -->

                <div v-bind:class="['form-group','col-md-4',errors.first(rules.producto_id.name) ? 'has-error' :'']">
                    <label for="">Nombre del Producto @{{ rules.producto_id.required }} <span></span></label>  
                    <select 
                        :disabled="$store.state.data.status == 'edit cred'"
                        @change="cargarProducto()"
                        type="text" 
                        class="form-control" 
                        v-model="producto_id"
                        v-validate="rules.producto_id.rule"
                        :name="rules.producto_id.name">                           
                        <option selected disabled>--</option>
                        <option :value="producto.id" v-for="producto in productos">
                            @{{producto.nombre}}
                        </option>
                    </select>
                    <span class="help-block">@{{ errors.first(rules.producto_id.name) }}</span>
                </div> 

                <!-- ELEMENTS  -->

                <div class="col-md-12">
                    <template v-for="(element, index) in ref_productos">

                        <div class="row">
                        
                            <!-- FACTURACION DEL PRODUCTO  -->
                            
                            <div class="form-group col-md-12">
                                <h4 style="display:inline-block; margin-right:10px;">@{{ index + 1 +'-'+element.nombre }}
                                    <span style="margin-left:10px;color:#3c763d"> Total: $@{{ 
                                        parseInt(element.costo)+ 
                                        parseInt(element.iva)  + 
                                        parseInt(element.otros)
                                        | formatPrice}}</span>
                                </h4>
                                <div class="checkbox" style="display:inline-block" v-if="index > 0">
                                    <label>
                                        <input type="checkbox" @change="check(index)" :id="'check'+index" value="false"> Clonar vehiculo
                                    </label>
                                </div>
                                <hr>
                            </div>

                        </div>
                        <!-- Expedido a -->
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label class="input-solicitud">Expedido a: </label>
                                <select v-model="element.expedido_a" class="form-control">
                                    <option selected disabled>--</option>
                                    <option
					 :value="cliente" 
					 v-for="cliente in $store.state.data.clientes"
					>@{{ cliente }}</option>
                                </select>
                            </div>
                        

                            <!-- PROVEEDOR  -->
                        
                            <div class="form-group col-md-4" :id="'div-proveedor'+index">
                                <label class="input-solicitud">Proveedor @{{element.nombre }} *</label>  
                                <select
                                    :disabled="element.estado != 'En proceso'"
                                    class="form-control input-solicitud" 
                                    v-model="element.proveedor_id"
                                    :id="'proveedor'+index"
                                    @change="validateProveedor(index)">  
                                    <option selected disabled>--</option>
                                    <option 
					:value="proveedor.id" 
					v-for="proveedor in $store.state.data.proveedores">
					@{{ (proveedor.municipio) ? proveedor.municipio + '-' : ''}} @{{proveedor.nombre_comercial}}
				    </option>
                                </select>
                                <span class="help-block" :id="'span-proveedor'+index"></span>
                            </div>

                            <!-- COSTO  -->

                            <div v-bind:class="['form-group','has-success','col-md-4',errors.first(rules.costo.name+index) ? 'has-error' :'']">
                                <label class="input-solicitud">Costo @{{element.nombre }} @{{ rules.costo.required }}</label> 
                                <input type="text" 
                                    :disabled="element.estado != 'En proceso'"
                                    class="form-control input-solicitud" 
                                    v-model="element.costo"
                                    v-validate="rules.costo.rule"
                                    :name="rules.costo.name+index">  
                                <span class="help-block" v-if="element.costo >= 0">$ @{{ element.costo | formatPrice }}</span>
                                <span class="help-block">@{{ errors.first(rules.costo.name+index) }}</span>  

                            </div>
                        </div>

                        <div class="row">    

                            <!-- NUMERO DE FACTURA  -->

                            <div v-bind:class="['form-group','col-md-2',errors.first(rules.num_fact.name) ? 'has-error' :'']">
                                <label class="input-solicitud">Número Factura @{{element.nombre }} @{{ rules.num_fact.required }}</label>  
                                <input 
                                    :disabled="element.estado != 'En proceso'"
                                    class="form-control input-solicitud"
                                    v-model="element.num_fact" 
                                    v-validate="rules.num_fact.rule"
                                    :name="rules.num_fact.name">  
                                <span class="help-block" v-if="errors.first(rules.num_fact.name)">@{{ errors.first(rules.num_fact.name) }}</span> 
                                <span class="help-block" v-else><small>Ver factura ...</small></span> 

                            </div> 

                            <!-- FECHA DE EXPEDICION  -->

                            <div v-bind:class="['form-group','col-md-3',errors.first(rules.fecha_exp.name) ? 'has-error' :'']">
                                <label class="input-solicitud">Fecha de Expedicion @{{ rules.fecha_exp.required }}</label> 
                                <input 
			                        onkeydown="return false"
                                    :disabled="element.estado != 'En proceso'"
                                    type="date" 
                                    class="form-control input-solicitud"
                                    v-model="element.fecha_exp"
                                    v-validate="rules.fecha_exp.rule"
                                    @blur="vencimiento(index)"
                                    :name="rules.fecha_exp.name">  
                                <span class="help-block" v-if="errors.first(rules.fecha_exp.name)">@{{ errors.first(rules.fecha_exp.name) }}</span>      
                                <span class="help-block"><small>Ver factura ...</small></span>                           
                            </div>


                            <!-- IVA  -->

                            <div v-bind:class="['form-group','has-success','col-md-2',errors.first(rules.iva.name) ? 'has-error' :'']">
                                <label class="input-solicitud">IVA @{{element.nombre }} @{{ rules.iva.required }}</label>   
                                <input type="text" 
                                    :disabled="element.estado != 'En proceso'"
                                    class="form-control input-solicitud" 
                                    v-model="element.iva"
                                    v-validate="rules.iva.rule"
                                    :name="rules.iva.name"> 
                                <span class="help-block" v-if="element.iva > 0">$ @{{ element.iva | formatPrice }}</span> 
                                <span class="help-block" v-if="element.iva <= 0"><small>Ver factura ...</small></span> 
                                <span class="help-block">@{{ errors.first(rules.iva.name) }}</span>                          
                            </div>


                            <!-- COSTO  -->

                            <div v-bind:class="['form-group','has-success','col-md-3',errors.first(rules.otros.name+index) ? 'has-error' :'']">
                                <label class="input-solicitud">Otros @{{element.nombre }} @{{ rules.otros.required }}</label> 
                                <input type="text" 
                                    class="form-control input-solicitud" 
                                    v-model="element.otros"
                                    v-validate="rules.otros.rule"
                                    :name="rules.otros.name+index">  
                                <span class="help-block" v-if="element.otros > 0">$ @{{ element.otros | formatPrice }}</span>
                                <span class="help-block">@{{ errors.first(rules.otros.name+index) }}</span>  

                            </div>

                            <!-- ESTADO -->
                            <div v-bind:class="['form-group','col-md-2',errors.first(rules.estado.name) ? 'has-error' :'']">
                                <label for="">Estado @{{element.nombre }} @{{ rules.estado.required }}</label> 
                                <select 
                                    disabled
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

                            <div class="form-group col-md-3" :id="'div-tipo_vehiculo_id'+index">
                                <label for="">Tipo Vehiculo *</label>
                                <select type="text" 
                                    :disabled="element.estado != 'En proceso'"
                                    class="form-control"
                                    placeholder="escoja tipo vehiculo"
                                    :id="'tipo_vehiculo_id'+index"
                                    @change="validateTipoVehiculo(index)"
                                    v-model="element._tipo_vehiculo_id"
                                    name="tipo_vehiculo_id">   
                                    <option selected disabled>--</option>    
                                    <option :value="tipo.id" v-for="tipo in $store.state.data.tipo_vehiculos">@{{ tipo.nombre }}</option>                   
                                </select>
                                <span class="help-block" :id="'span-tipo_vehiculo_id'+index"></span>
                            </div> 

                            <!-- PLACA  -->

                            <div v-bind:class="['form-group','col-md-3',errors.first('placa'+index) ? 'has-error' :'']">
                                <label for="">Placa *</label>  
                                <input class="form-control"  
                                    :disabled="element.estado != 'En proceso'"
                                    placeholder="escriba placa"
                                    v-model="element._placa"
                                    v-validate="'required'"
                                    :name="'placa'+index">
                                <span class="help-block">@{{ errors.first('placa'+index) }}</span>
                            </div> 

                            <!-- VENCIMIENTO SOAT  -->

                            <div v-bind:class="['form-group','col-md-3',errors.first('vencimiento_soat'+index) ? 'has-error' :'']">
                                <label for="">Vencimiento SOAT *</label>
                                <input type="date" 
				    onkeydown="return false"
                                    :disabled="element.estado != 'En proceso'"
                                    class="form-control"
                                    v-model="element._vencimiento_soat"
                                    v-validate="'required'"
                                    :name="'vencimiento_soat'+index">              
                                <span class="help-block">@{{ errors.first('vencimiento_soat'+index) }}</span>            
                            </div>

                            <!-- VENCIMIENTO RTM  -->

                            <div v-bind:class="['form-group','col-md-3',errors.first('vencimiento_rtm'+index) ? 'has-error' :'']">
                                <label for="">Vencimiento RTM *</label>
                                <input type="date"
				    onkeydown="return false"
                                    :disabled="element.estado != 'En proceso'" 
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
                                <a class="btn btn-default" href="{{ route('start.clientes.show',$data['cliente']['id']) }}">
                                    <i class="fa fa-paper-plane" aria-hidden="true"></i>
                                    Salir</a>
                                <button class="btn btn-primary" @click="update()" v-if="$store.state.data.status=='edit' || $store.state.data.status=='edit cred'" >
                                    <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                                    Salvar</button>
                                <button type="submit" class="btn btn-default" @click="continuar">
                                    <i class="fa fa-forward" aria-hidden="true"></i>
                                    Continuar</button>
                            </center>
                        </div>  
                    </div>
                </div>
                
            </div>
        </div>

    </form>


</script>

@include('start.precreditos.componentes.productoJs');



















