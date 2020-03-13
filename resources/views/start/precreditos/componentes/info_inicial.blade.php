<div class="panel panel-default">
    <div class="panel-body">
        <div class="form-group" style="margin-bottom:10px;">
            <div class="col-md-12">
                <label>Información Inicial</label>
            </div>
        </div>
        <hr style="border:.3px solid #DCDCDC;margin-top:0px;">

        <div class="form-group">
            <div class="col-md-4">
                <label>Aprobado?</label>
                <select class="form-control input-sm" 
                        v-model="solicitud.aprobado" 
                        :disabled="this.estado=='creacion' || user.rol != rol_permitido">
                    <option>--</option>
                    <option :value="opcion" v-for="opcion in estados_aprobacion">@{{ opcion }}</option>
                </select>
            </div>
            <div class="col-md-4">
                <label>Número de formulario</label>
                <input type="text" name="Número de factura" 
                       v-bind:class="['form-control','input-sm',errors.first('Número de factura') ? '_has-error' :'']" 
                       v-model="solicitud.num_fact"
                       v-validate="'required|numeric'"
                       :disabled="estado != 'creacion' && user.rol != rol_permitido">
                    <h6 class="text-danger">@{{errors.first('Número de factura')}}</h6>
            </div>
            <div class="col-md-4">
                <label>Fecha de solicitud</label>
                <input type="date" 
                       v-bind:class="['form-control','input-sm',errors.first('Fecha de solicitud') ? '_has-error' : '']"
                       name="Fecha de solicitud"
                       v-validate="'required'"
                       class="form-control input-sm" 
                       v-model="solicitud.fecha"
                       :disabled="estado != 'creacion' && user.rol != rol_permitido">
                <h6 class="text-danger">@{{errors.first('Fecha de solicitud')}}</h6>
            </div>

        </div>

        <div class="form-group">

            <div class="col-md-6">
                <label>Cartera</label>
                <select name="Cartera"
                        v-model="solicitud.cartera_id"
                        v-validate="'required'"
                        v-bind:class="['form-control','input-sm', errors.first('Cartera') ? '_has-error' : '']"
                        :disabled="estado != 'creacion' && user.rol != rol_permitido">
                    <option selected disabled>--</option>
                    <option :value="cartera.id" v-for="cartera in carteras">@{{cartera.nombre}}</option>
                </select>
                <h6 class="text-danger">@{{errors.first('Cartera')}}</h6>
            </div>

            <div class="col-md-6">
                <label>Producto</label>
                <select name="Producto"
                        v-validate="(estado=='creacion') ? 'required' : ''"
                        v-bind:class="['form-control','input-sm', errors.first('Producto') ? '_has-error' : '']" 
                        @change="generarInputs()" 
                        v-model="solicitud.producto_id"
                        :disabled="estado != 'creacion' && user.rol != rol_permitido"> 
                    <option selected disabled>--</option>
                    <option v-for="producto in productos" :value="producto.id">@{{ producto.nombre }}</option>
                </select>
                <h6 class="text-danger">@{{errors.first('Producto')}}</h6>
            </div>

        </div>


        <!-- PRODUCTOS  -->


        <template v-for="elemento in solicitud.productos">
            <div class="panel panel-default">
                <div class="panel-body">

                    <div class="form-group" style="margin-bottom:10px;">
                        <div class="col-md-12">
                            <label>@{{ elemento.nombre }}</label>
                        </div>
                    </div>

                    <hr style="border:.5px solid #DCDCDC;margin-top:0px;">  

                    <div class="form-group">
                        <div class="col-md-8">
                            <label>Proveedor @{{ elemento.nombre }}</label>
                            <select v-validate="'required'"
                                    :name="'Proveedor '+elemento.nombre"
                                    v-model="elemento.proveedor_id" 
                                    v-bind:class="['form-control','input-sm', errors.first('Proveedor '+elemento.nombre) ? '_has-error' :'']">
                                <option selected disabled>--</option>
                                <option :value="proveedor.id" v-for="proveedor in proveedores">@{{ proveedor.nombre }}</option>
                            </select>
                            <h6 class="text-danger">@{{ errors.first('Proveedor '+elemento.nombre) }}</h6>
                        </div>
            
                        <div class="col-md-4">
                            <label># Factura @{{ elemento.nombre }}</label>
                            <input type="text" class="form-control" v-model="elemento.num_fact">
                        </div>
            
                    </div>
            
                    <div class="form-group">

                        <div class="col-md-4">
                            <label>Fecha Exp @{{ elemento.nombre }}</label>
                            <input type="date" class="form-control" v-model="elemento.fecha_exp">
                        </div>
            
                        <div class="col-md-4">
                            <label>Costo @{{ elemento.nombre }}</label>
                            <input  type="text" 
                                    :name="'Costo '+elemento.nombre"
                                    v-bind:class="['form-control','input-sm',errors.first('Costo '+elemento.nombre) ? '_has-error' : '']"
                                    v-model="elemento.costo"
                                    v-validate="'required|numeric'">
                            <span>@{{ elemento.costo | miles }}</span>
                            <h6 class="text-danger">@{{ errors.first('Costo '+elemento.nombre) }}</h6>
                        </div>
            
                        <div class="col-md-4">
                            <label>Iva @{{ elemento.nombre }}</label>
                            <input  :name="'Iva '+elemento.nombre"
                                    type="text" 
                                    v-bind:class="['form-control','input-sm',errors.first('Iva '+elemento.nombre) ? '_has-error' : '']" 
                                    v-model="elemento.iva"
                                    v-validate="'numeric'">
                            <span>@{{ elemento.iva | miles }}</span>
                        </div>
            
                    </div>
                </div>
            </div>
        </template>
    
    </div>
</div>