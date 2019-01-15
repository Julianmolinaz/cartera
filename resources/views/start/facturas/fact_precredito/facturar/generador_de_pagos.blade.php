<script>
  Vue.component('generador-component',{
    template: `
        <div class="panel panel-primary" >
          <div class="panel-heading">
            <h3 class="panel-title"><i class="far fa-edit"></i> Generador de pagos</h3>
          </div>
          <div class="panel-body">

            <div class="alert alert-danger" role="alert" 
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
                  <label># Factura:</label>
                  <input class="form-control input-small" type="text" placeholder="#" 
                      v-model="factura.num_fact" :readonly="factura.auto">
                </div>

                 <!-- fecha_factura *****-->
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <label>Fecha:</label>
                    <input type="date" class="form-control input-small" 
                      v-model="factura.fecha" :readonly="factura.auto">
                </div>

                <div class="col-md-6 col-sm-6 col-xs-12">
                  <label for="">Tipo de Pago</label>
                  <select class="form-control input-small" id="tipo" v-model="factura.tipo">
                    <option value="" readonly selected hidden="">- -</option>
                    <option v-for="tipo in tipo_pago">@{{ tipo }}</option>

                  </select>
                </div>
              </div>  

              <div class="form-group">
               <!-- concepto del pago *****-->
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <label>Concepto</label>
                  <select class="form-control input-small" v-model="pago.concepto" @change="get_concepto()">
                    <option readonly selected>- -</option>
                    <option  :value="concepto" v-for="concepto in conceptos" 
                    >@{{ concepto.nombre }}</option>
                  </select>
                </div>

               <!-- monto *****-->
                <div class="col-md-6 col-sm-6 col-xs-12" id="div_monto">
                  <label for="">Monto:</label>
                  <input type="number" class="form-control input-small" placeholder="$" name="monto" :readonly="monto_readonly"
                    v-model="pago.subtotal">
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
              
                <!--Fin del formulario creador de pagos-->
              </div><!--fin del panel-body-->
        </div><!-- fin de panel panel-default-->
      `,
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
      //:::::::::::::::::::::::::::::::
      get_concepto(){ // evalua el concepto 

        console.log(this.concepto);

        if(this.pago.concepto.id == 1 ){ //si estudio típico el vlr es predeterminado
          this.pago.subtotal = this.pago.concepto.valor; //vlr predeterminado
          this.monto_readonly = true;
        } else{
          this.monto_readonly = false;
          this.pago.subtotal    = '';
        }

      },//.get_concepto
      //:::::::::::::::::::::::::::::::
      agregar_pago(){
        this.validar() //validar campos requeridos
        var pago = [JSON.parse(JSON.stringify(this.pago))]
        this.factura.pagos.push(pago)
        Bus.$emit('add_pago',this.factura) //evento envisado al list pagos generados
      },//.agregar_pago
      //:::::::::::::::::::::::::::::::
      calcular_total(){
        //calcular el total de la factura
      },//.calcular_total
      validar(){
        this.message.length = []; this.type     = "";
        if(!this.factura.auto){
          if(this.factura.num_fact === ''){
            this.message.push(["Se requiere el número de factura"]);
          } 
          if(this.factura.fecha == ''){
            this.message.push(["Se requiere la fecha de factura"]);
          }
        }
        if(this.message.length > 0){
          this.type     = "danger";
          return false;
        } else{
          this.message  = [];
          this.type     = "";
        }  
      },//.validar
      //::::::::::::::::::::::::::::::
      set_auto(){ // deshabilita las entradas de #factura y fecha
        this.factura.auto = !this.factura.auto;
        this.message.length = []; this.type = "";
      }
    } 
  });

</script>      

        