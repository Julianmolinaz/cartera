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
                <select class="form-control" v-model="solicitud.aprobado" :disabled="this.estado=='creacion'">
                    <option>--</option>
                    <option :value="opcion" v-for="opcion in estados_aprobacion">@{{ opcion }}</option>
                </select>
            </div>
            <div class="col-md-4">
                <label>Número de formulario</label>
                <input type="text" class="form-control input-sm">
            </div>
            <div class="col-md-4">
                <label>Fecha de solicitud</label>
                <input type="date" class="form-control input-sm">
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-6">
                <label>Cartera</label>
                <select class="form-control">
                    <option selected disabled>--</option>
                    <option :value="cartera.id" v-for="cartera in carteras">@{{cartera.nombre}}</option>
                </select>
            </div>
            <div class="col-md-6">
                <label>Producto</label>
                <select class="form-control" @change="generarInputs()" v-model="temp">
                    <option selected disabled>--</option>
                    <option v-for="producto in productos" :value="producto">@{{ producto.nombre }}</option>
                </select>
            </div>
        </div>

        <template v-for="elemento in arr_productos">
            <div class="panel panel-default">
                <div class="panel-body">

                    <div class="form-group" style="margin-bottom:10px;">
                        <div class="col-md-12">
                            <label>@{{ elemento.nombre }}</label>
                        </div>
                    </div>

                    <hr style="border:.5px solid #DCDCDC;margin-top:0px;">  

                    <div class="form-group">
                        <div class="col-md-12">
                            <label>Proveedor @{{ elemento.nombre }}</label>
                            <select v-model="elemento.proveedor_id" class="form-control">
                                <option selected disabled>--</option>
                                <option :value="1">Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquid totam quam sint et libero nisi, aperiam inventore? Distinctio dolor accusamus quisquam neque possimus, maxime mollitia provident ea nemo, dolore perferendis.</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-3">
                            <label># Factura @{{ elemento.nombre }}</label>
                            <input type="text" class="form-control" v-model="elemento.num_factura">
                        </div>
                        <div class="col-md-3">
                            <label>Fecha Exp @{{ elemento.nombre }}</label>
                            <input type="text" class="form-control" v-model="elemento.fecha_exp">
                        </div>
                        <div class="col-md-3">
                            <label>Costo @{{ elemento.nombre }}</label>
                            <input type="text" class="form-control" v-model="elemento.costo">
                        </div>
                        <div class="col-md-3">
                            <label>Iva @{{ elemento.nombre }}</label>
                            <input type="text" class="form-control" v-model="elemento.iva">
                        </div>
                    </div>
                </div>
            </div>
        </template>
    
    </div>
</div>