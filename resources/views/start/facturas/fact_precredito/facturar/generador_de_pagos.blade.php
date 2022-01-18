<script type="text/x-template" id="generador-template">
  <div class="panel panel-primary" >
    <div class="panel-heading">
      <h3 class="panel-title"><i class="far fa-edit"></i> Generador de pagos</h3>
    </div>
    <div class="panel-body">

      <div class="alert alert-danger my-danger" role="alert" 
          v-if="(message.length > 0) && (type='danger')">
        <ul>
          <li v-for="error in message">@{{ error[0] }}</li>
        </ul>
      </div>  
      <!--formulario con los campos necesarios para crear pagos y agregarlos a una tabla-->

      <form class="form-horizontal form-label-left" @submit.prevent="agregar_pago()">

        <div class="form-group">
          <!-- num_factura *****-->
          <div class="col-md-2 col-sm-2 col-xs-12">
            <label class="label-sm"># Factura:</label>
            <input class="form-control input-small" type="text" placeholder="#" 
                v-model="factura.num_fact" :readonly="factura.auto">
          </div>

            <!-- fecha_factura *****-->
          <div class="col-md-4 col-sm-4 col-xs-12">
            <label class="label-sm">Fecha:</label>
              <input type="date" class="form-control input-small" 
                v-model="factura.fecha" :readonly="factura.auto">
          </div>

          <div class="col-md-6 col-sm-6 col-xs-12">
            <label class="label-sm">Tipo de Pago</label>
            <select class="form-control 
                  input-small" 
                  id="tipo" 
                  v-model="factura.tipo"
                  v-on:change="set_banco">
              <option value="" readonly selected hidden="">- -</option>
              <option v-for="tipo in tipo_pago">
                @{{ tipo }}
              </option>
            </select>
          </div>
        </div>  

        <div class="form-group">
          <!-- concepto del pago *****-->
          <div class="col-md-6 col-sm-6 col-xs-12">
            <label class="label-sm">Concepto</label>
            <select class="form-control input-small" v-model="concepto" @change="get_concepto()">
              <option readonly selected>- -</option>
              <option  :value="concepto" v-for="concepto in conceptos" 
              >@{{ concepto.nombre }}</option>
            </select>
          </div>

          <!-- monto *****-->
          <div class="col-md-6 col-sm-6 col-xs-12" id="div_monto">
            <label class="label-sm">Monto:</label>
            <input type="number" class="form-control input-small" placeholder="$" :readonly="monto_readonly" v-model="pago.subtotal">
          </div>

        </div>

          <div class="form-group">
            <div class="col-md-6 col-sm-6" id="btn_auto">
              <a href="#" class="btn btn-default btn-block btn-small" 
                @click="set_auto">
                Consecutivo Auto
              </a>
            </div>

            <!-- BOTON AGREGAR -->
            <div class="col-md-6 col-sm-6 col-xs-12">
              <button class="btn btn-primary btn-block btn-small">Agregar</button>
            </div>
          </div>
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
      </form>
      @include('start.facturas.fact_precredito.facturar.banco_modal')
          <!--Fin del formulario creador de pagos-->
    </div><!--fin del panel-body-->
  </div><!-- fin de panel panel-default-->
</script>


<script>
  Vue.component('generador-component',{
    template: "#generador-template",
    data(){
      return {
        tipo_pago : {!! json_encode($tipo_pago) !!},
        punto     : {!! json_encode($punto) !!}, //sucursales
        conceptos : {!! json_encode($conceptos) !!}, //conceptos de pago
        factura   : {
          auto      : false, //true para generar consecutivo y fecha automatica
          precredito: {!! json_encode($precredito) !!}, //ref de la solicitud
          num_fact  : '', //numero de factuyra
          tipo      : 'Efectivo', // por defecto es efectivo, puede ser consignacion
          banco     : '',    
          num_consignacion    : '',
          total     : 0, // total de la factura
          fecha     : '', // fecha del pago
          pagos     : [], // array de pagos
        },
        pago      : {
          subtotal : '',
          concepto : '',
        },
        message   : [], //mensage a mostrar
        type      : '', //css del mensaje: danger, info, success ...
        monto_readonly : false, // true para leer solamente el campo monto
        concepto  : '', // concepto de pago seleccionado
      }
    }, //.data
    methods:{
      set_banco(){
        if (this.factura.tipo == 'Consignación'){
          $('#banco_modal').modal('show');
        }
      },
      //:::::::::::::::::::::::::::::::
      get_concepto(){ // evalua el concepto 

        this.pago.concepto  = this.concepto;

        if(this.concepto.id == 1 || this.concepto.id == 3){ //si estudio típico el vlr es predeterminado
          this.pago.subtotal  = this.concepto.valor; //vlr predeterminado
          this.monto_readonly = true;
        } else{
          this.monto_readonly = false;
          this.pago.subtotal  = '';
        }

      },//.get_concepto
      //:::::::::::::::::::::::::::::::
      agregar_pago(){

        // validar campos requeridos

        if(! this.validar()) { 
          return false
        }

        this.reset_message()
        var pago = [JSON.parse(JSON.stringify(this.pago))]
        
        this.factura.pagos.push(pago)

        Bus.$emit('add_pago',this.factura)
      },//.agregar_pago
      //:::::::::::::::::::::::::::::::
      calcular_total(){
        //calcular el total de la factura
      },//.calcular_total
      validar(){
        this.reset_message()

        // validacion de la factura
        if(! this.factura.auto) {

          if(this.factura.num_fact.length == 0) {
            this.message.push(["Se requiere el número de factura"])
          } 
          if(this.factura.fecha.length == 0){
            this.message.push(["Se requiere la fecha de factura"])
          }
        }

        //validacion del pago **********

        if( this.pago.concepto == '' ) {
          this.message.push(['Se requiere el concepto de pago'])
        }
        if( this.pago.subtotal == '') {
          this.message.push(['Se requiere agregar el monto'])
        }

        if(this.message.length > 0){
          this.type = "danger";
          return false
        } else{
          return true
        }  
      },//.validar
      //::::::::::::::::::::::::::::::
      set_auto(){ // deshabilita las entradas de #factura y fecha
        this.factura.auto = !this.factura.auto;
        this.message.length = []; this.type = "";
      },
      reset_message(){
         this.message = []
         this.type     = ''
      }
    },
    created(){
      alertify.notify('<p class="title-punto">' + this.punto.nombre +'</p>','default',600,function(){  console.log('dismissed'); });
    }
  });

</script>      
<style>
  .my-danger{
    padding       : 5px;
    margin-bottom : 0px;
    font-size     : 10px;
  }
  .label-sm{
    font-size:10px;
  }
  .title-punto {
    background-color: #ffc32b;
    text-align: center;
    justify-content: center;
    font-weight: 900;
    font-size: 24px;
    padding: 20px 0;
  }
  .alertify-notifier.ajs-right .ajs-message.ajs-visible {
    right: 238px;
  }
</style>
        
