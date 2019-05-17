<div id="create_egreso">
<h3  style="margin:4px 4px;display:inline-block">
    <span class="glyphicon glyphicon-king"></span>
    Crear egreso 
</h3>
<div style="display:inline-block;float:right;margin-top:12px;">
    <a  href="{{ route('admin.proveedores.create') }}" class="btn btn-default btn-xs"
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
    <div class="row" style="margin: 10px 4px;" v-if="show_bancos">
        <div class="col-md-6 col-sm-6 col-xs-12 min">
            <label>Banco *:</label> 
            <select id="tipo" class="form-control input-small" v-model="egreso.banco">
                <option value="" readonly="readonly" selected="selected" hidden="hidden">- -</option> 
                <option :value="banco" v-for="banco in dat.bancos">@{{ banco }}</option> 
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

<script>
    var Bus = new Vue()
    var create_egreso = new Vue({
        el:"#create_egreso",
        data:{
            egreso:{
                concepto     : '',
                banco        : '',
                proveedor_id : null,
                tipo         : '',
                valor        : '',
                fecha        : '',
                num_consignacion: '',
                punto_id     : '',
                cartera_id   : 6
            },
            dat:{
                providers : '',
                bancos    : '',
                conceptos : '',
                puntos    : '',
                auth      : ''
            },
            show_providers : false, //true muestra el listado de proveedores
            show_bancos    : false
        },
        methods:{
            get_data(){
                var self = this
                axios.get('/start/egresos/get_data')
                    .then(function(res){
                        console.log('get data: ',res.data)
                        if(res.data.error){
                            alert(res.data.message)
                        } else {
                            self.dat = res.data.dat
                            self.egreso.punto_id = res.data.dat.auth.punto_id
                            self.egreso.fecha = res.data.dat.now
                        }
                    })
            },//.get_data()
            validate_concept(){
                if(this.egreso.concepto == "Pago a proveedores") {
                    this.show_providers = true
                }
                else {
                    this.show_providers = false
                }
            },//.validate_concept()
            validate_type(){
                if(this.egreso.tipo == 'Consignacion'){
                    this.show_bancos = true
                }
                else {
                    this.show_bancos = false
                }
            },//.validate_type()
            create(){
                var self = this

                if(!this.validate_egreso()){return false;}

                axios.post('egresos',{ egreso: self.egreso })
                    .then(function(res){
                        console.log('respuesta store ', res.data)
                        if(res.data.error){
                            alert(res.data.message)
                        }
                        else {
                            self.reset_egreso()
                            Bus.$emit('get_egresos')
                        }
                    })
            },//.create()
            reset_egreso(){
                this.egreso.concepto     = ''; this.egreso.banco        = '';
                this.egreso.proveedor_id=null; this.egreso.tipo         = '';
                this.egreso.valor        = ''; this.egreso.fecha        = '';
                this.egreso.num_consignacion= ''; this.egreso.observaciones = '';
            },
            validate_egreso() {
                var error = ''
                if(this.egreso.fecha == ''){ error += 'La fecha es requerida \n'; }

                if(this.egreso.concepto == ''){ 
                    error += 'El concepto es requerido \n'; 
                }
                else if(this.egreso.concepto == 'Pago a proveedores') {
                 
                    if(this.egreso.proveedor_id == ''){
                        error += 'El proveedor es requerido \n'
                    }
                }

                if(this.egreso.valor == ''){ error += 'El valor es requerido \n'; }

                if(this.egreso.tipo == ''){ 
                    error += 'El tipo de pago es requerido \n'; 
                }
                else if(this.egreso.tipo == 'Consignacion'){
                    if(this.egreso.banco == ''){
                        error += 'El banco es requerido \n'
                    }
                    if(this.egreso.num_consignacion == ''){
                        error += 'El número de consignación es requerido \n'
                    }
                }

                if(error != ''){
                    alert('CORRIJA LOS SIGUIENTES ERRORES \n\n' + error)
                    return false
                } else {
                    return true
                }

            },//.validate_egreso
            add_solicitudes(){
                
                $('#solicitudes_modal').modal('show')
            },//.add_solicitudes

            
        },
        created(){
            this.get_data()
        }
    })
</script>