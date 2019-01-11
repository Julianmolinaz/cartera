<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.min.js"></script>

<script>

  var main = new Vue({
    el:'#main',
    /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::*/
    data:{
      punto   : {!! json_encode($punto) !!},
      punto_auto    : false,//permite ver el boton generador del autoincremento
      general : {//objeto que se envia al servidor para crear la factura
        num_fact    : '', // numero de factura
        fecha       : '', // fecha de la factura
        monto       : '', // valor a pagar
        tipo_pago   : 'Efectivo', // puede ser efectivo o consignacion
        credito_id  : {!! json_encode($credito->id) !!},
        auto        : false, // activa o desactiva el btn Consecutivo Auto 
        pagos       : [],  //listado de pagos
      },
      bandera     : 0,  // se pone enuna cuando se hace el pago
      credito     : {!! json_encode($credito) !!}, //objeto crédito
      mover_fecha : [], //contenedor de la cuota parcial sin mover fecha
      status_mover_fecha      : false, //se mueve la fecha si es true
      cta_parcial_ini_origin  :'', //contenedor de la fecha inicial original cta parcial
      cta_parcial_fin_origin  :'',  //contenedor de la fecha final original cta parcial
      message     : '', //alerta con mesajes o notificaciones en generador de pagos
      message2    : '', //alerta con mesajes o notificaciones en listado de pagos generados
    },
    
    methods:{
      /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::*/
      set_auto: function(){ // activa o desactiva el consecutivo automatico
        this.general.auto = !this.general.auto;
        if(this.general.auto){ // si el consecutivo es auto resetea num_fact y fecha
          this.general.num_fact = '';
          this.general.fecha    = '';
        }
      },//.set_auto
      /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::*/
      agregar: function(){//distribuye el mnonto en el listado de pagos

        if(this.general.monto === ''){ alert('Se requiere el monto');  return false; } // valida si se ingresó el monto
        if(this.bandera > 0){ alert('Se esta procesando la petición'); return false; } // si la bandera esta > 1, sale, evita duplicar fact
        if(this.general.pagos.length > 1){ 
          alert('Si dese agregar nuevamente el monto borre el listado de pagos');
          return false;
        }
        var self  = this;
        
        axios.post("{{url('start/facturas/abonos')}}",this.general).then(function(res){ //el servidor distribuye el pago
          console.log(res);
          if (!res.data.error){ 
            self.general.pagos = res.data.data; 
            self.mover_fecha   = res.data.cta_parcial_sin_movimiento_de_fecha;
          }
          self.revisar_pagos();
          self.bandera = 0;
        })

        self.bandera = 1; // se incrementa la bandera
      },//.agregar
      /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::*/
      revisar_pagos: function(){//valida que la 1ra cuota parcial de un pago no este por debajo de un tope establecido
        var self = this;
        this.general.pagos.filter(function(pago){
          if(pago.marcado){
            if(pago.subtotal < ( self.credito.precredito.vlr_cuota * 0.6) ){
              self.message2 = 'Recuerde que la cuota parcial resaltada esta por debajo del valor normal permitido, seleccione el recuadro a la izquierda para no mover la fecha';
            }
          }
        })
      },//.revisar_pagos
      /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::*/
      borrar: function(){ // reset de datos
        this.bandera        = 0;
        this.general.pagos  = [];
        this.message        = '';
        this.message2       = '';
      },
      /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::*/
      aceptar: function(){//facturar
        var validacion = this.validar_fact();
        
        if(validacion.error){
          alert(validacion.message);
          return false;
        } 

        if(this.credito.castigada === 'Si'){ // se muestra alerta si esta castigado
          if ( !confirm("Le recordamos que el credito esta reportado como cartera castigada, desea continuar?") ) {
            return false; } 
        }
        if(this.general.auto){
          this.send(this.general);
        } else {
          this.validar_num_fact();
        }
      },//.aceptar
      /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::*/
      validar_num_fact: function(){ // valida que si el numero de factura existe (true)
        var self    = this;
        axios.get( "{{url('start/facturas')}}/"+this.general.num_fact+"/consultar_factura" )
          .then(function(res){
            if(!res.data){
              self.send( self.general );
            } else {
              alert('Ya existe otra factura con el mismo número');
            }
        })
        return status;
      },//.vaidar_num_fact
      /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::*/
      send: function(general){//envia la data de la factura al servidor
        let confirmar = confirm('Desea continuar con la transacción');
 
        if(confirmar){
          axios.post("{{url('start/facturas')}}",general).then(function(res){
            console.log(res);
            if(res.data.error){
              alert(res.data.mensaje);
            } else {
              alert(res.data.mensaje);
              document.location.href="{{route('start.facturas.create',$credito->id)}}";
            }
          })
        } else {
          return false;
        }
      },//.send
      /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::*/
      validar_fact: function(){
        var str = ''; // contenedor del mensaje de error

        if(this.general.num_fact === '' && this.general.auto === false){ //validar num_fact si auto === false
          str += 'Se requiere el número de factura \n'; }
        
        if(this.general.fecha === '' && this.general.auto === false){//validar fecha si auto === false
          str += 'Se requiere la fecha de la factura\n'; }
        
        if(this.general.pagos.length < 2){//validar pagos
          str += 'Se requiere agregar pagos a la factura'; }

        if(str != ''){ //valor de retorno
          return {error:true, message: str};
        } else {
          return {error:false};
        }
      },//.validar_fact
      mover_fecha_parcial: function(index){//permite modificar la fecha para cuota parcial
        var status = this.status_mover_fecha = !this.status_mover_fecha;
        if(status){
          this.cta_parcial_ini_origin = this.general.pagos[index]['ini'].slice();
          this.cta_parcial_fin_origin = this.general.pagos[index]['fin'].slice();
          this.general.pagos[index]['ini'] = this.mover_fecha.ini;
          this.general.pagos[index]['fin'] = this.mover_fecha.fin;
          console.log(this.mover_fecha.fin);
        } else{
          this.general.pagos[index]['ini'] = this.cta_parcial_ini_origin;
          this.general.pagos[index]['fin'] = this.cta_parcial_fin_origin;
        }

        this.revisar_pagos(index);
      }
    },
    /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::*/
    created: function(){
        if(this.punto.id === 1 || this.punto.id === 8 || this.punto.id === 23 || this.punto.id === 5
           || this.punto.id === 10 || this.punto.id === 30 || this.punto.id === 9 
           || this.punto.id === 29 || this.punto.id === 11 ){
          this.punto_auto = true;
        }
    },//.created
    /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::*/
    mounted: function(){
      if(this.credito.castigada == 'Si'){
        this.message = 'Le recordamos que este crédito esta en cartera castigada';
      }
    }
  })
</script>
