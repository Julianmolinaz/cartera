<div id="create_egreso">
<h3  style="margin:4px 4px;display:inline-block">
    <span class="glyphicon glyphicon-king"></span>
    Crear egreso 
</h3>
<div style="display:inline-block;float:right;margin-top:12px;">
    <a  href="{{ route('admin.proveedores.index') }}" class="btn btn-default btn-xs"
        target="_blanck">
        <span class="glyphicon glyphicon-new-window"></span>
        Crear proveedores
    </a>
</div>

<div class="panel panel-default" style="margin-top:14px;">
  <div class="panel-body">

    <div class="row" style="margin: 10px 4px;">
        <div class="col-md-3 col-sm-3 col-xs-12 min">
            <label>Punto</label>
            <select class="form-control input-small" v-model="egreso.punto_id" 
                   :disabled="dat.auth.rol != 'Administrador'" style="font-size:9px;">
                <option :value="punto.id" v-for="punto in dat.puntos">
                    @{{ punto.nombre }}
                </option>
            </select>
        </div>
        <div class="col-md-3 col-sm-3 col-xs-12 min">
            <label>Cartera</label>
            <select class="form-control input-small" v-model="egreso.cartera_id" 
                   :disabled="dat.auth.rol != 'Administrador'" style="font-size:9px;">
                <option :value="cartera.id" v-for="cartera in dat.carteras">
                    @{{ cartera.nombre }}
                </option>
            </select>
        </div>
        <div class="col-md-3 col-sm-3 col-xs-12 min">
            <label>Fecha *:</label> 
            <input type="date" class="form-control input-small" v-model="egreso.fecha">
        </div> 
        <div class="col-md-3 col-sm-3 col-xs-12 min">
            <label for="">Concepto *:</label> 
            <select class="form-control input-small" v-model="egreso.concepto"
                    v-on:change="validate_concept()" style="font-size:9px;">
                <option value="" readonly="readonly" selected="selected" hidden="hidden">- -</option> 
                <option :value="concepto" v-for="concepto in dat.conceptos">@{{ concepto }}</option>
            </select>
        </div>
    </div>

    <div class="row" style="margin: 10px 4px;" v-if="show_providers">
        <div id="div_monto" class="col-md-12 col-sm-12 col-xs-12 min">
            <div>
                <label for="">Proveedor *:</label> 
                <select class="form-control input-small" v-model="egreso.proveedor_id">
                    <option selected disabled>- -</option>
                    <option :value="proveedor.id" v-for="proveedor in dat.proveedores">@{{ proveedor.nombre }}</option>
                </select>
            </div>
        </div> 
        <!-- <div id="div_monto" class="col-md-6 col-sm-6 col-xs-12 min">
            <div>
                <label for="">Agregar solicitudes</label> <br>
                <button class="btn btn-success btn-xs btn-block" @click="add_solicitudes">
                    click
                </button>
          
            </div>
        </div>  -->
    </div>

    <!-- FUNCIONARIO NOMINA -->

    <div class="row" style="margin: 10px 4px;" v-if="show_users">
        <div class="col-md-12 col-sm-12 col-xs-12 min">
            <label for="">Funcionarios</label> 
            <select class="form-control input-small" v-model="egreso.user" v-on:change="asignar_cuenta()">
                <option readonly="readonly" selected="selected">- -</option> 
                <option :value="user" v-for="user in users">@{{ user.name }}</option> 
            </select>
            <span class="help-block" v-if="egreso.user.banco"
                style="font-size:11px;">Cuenta #: @{{ egreso.user.num_cuenta }}, Ent. Financiera: @{{ egreso.user.banco.nombre }}</span>
            <span class="help-block" v-else
                style="font-size:11px;">Sin cuenta de nómina</span>
        </div>
    </div>

    <!-- VALOR DEL EGRESO -->
    <div class="row" style="margin: 10px 4px;">
        <div id="div_monto" class="col-md-6 col-sm-6 col-xs-12 min">
            <label for="">Valor *:</label> 
            <input type="number" placeholder="$" v-model="egreso.valor" class="form-control input-small">
        </div> 
        <div class="col-md-6 col-sm-6 col-xs-12 min">
            <label for="">Tipo de Pago</label> 
            <select class="form-control input-small" v-on:change="validate_type()" v-model="egreso.tipo">
                <option readonly="readonly" selected="selected">- -</option> 
                <option value="Efectivo">Efectivo</option> 
                <option value="Consignacion">Consignacion</option>
            </select>
        </div>
    </div>

    <div class="row" style="margin: 10px 4px;" v-show="show_bancos">
        <div class="col-md-6 col-sm-6 col-xs-12 min">
            <label>Banco *:</label> 
            <select id="banco_id" class="form-control input-small" v-model="egreso.banco_id">
                <option selected>- -</option> 
                <option :value="banco.id" v-for="banco in dat.bancos">@{{ banco.nombre }}</option> 
            </select>
        </div> 
        <div class="col-md-6 col-sm-6 col-xs-12 min">
            <label>Número de consignación *:</label>
            <input type="text" class="form-control input-small" v-model="egreso.num_consignacion">
        </div>
    </div>
    <div class="row" style="margin: 10px 4px;">
        <div class="col-md-12 col-sm-12 col-xs-12 min">
            <label>Observaciones: </label> 
            <textarea cols="30" rows="2" class="form-control" v-model="egreso.observaciones"></textarea>
        </div> 
    </div>
    <div class="row" style="margin: 10px 4px;">
        <center>
            <a href="#" class="btn btn-danger btn-xs" @click="reset_egreso()">Borrar</a>
            <a href="#" class="btn btn-primary btn-xs" @click="create()">Crear</a>            
        </center>
    </div>

  </div>
</div>

</div>

@include('start.egresos.create_js')