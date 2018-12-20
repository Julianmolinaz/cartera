<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.min.js"></script>

<script>

  var main = new Vue({
    el:'#main',
    /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::*/
    data:{
      punto   : {!! json_encode($punto) !!},
      general : {
        num_fact    : '', // numero de factura
        fecha       : '', // fecha de la factura
        monto       : '', // valor a pagar
        tipo_pago   : 'Efectivo', // puede ser efectivo o consignacion
        credito_id  : {!! json_encode($credito->id) !!},
        auto        : false, // activa o desactiva el btn Consecutivo Auto 
        pagos       : [],  //listado de pagos
      },
      bandera : 0,  // se pone enuna cuando se hace el pago
      credito : {!! json_encode($credito) !!},
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
      agregar: function(){

        if(this.general.monto === ''){ alert('Se requiere el monto');  return false; } // valida si se ingresó el monto
        if(this.bandera > 0){ alert('Se esta procesando la petición'); return false; } // si la bandera esta > 1, sale, evita duplicar fact
        if(this.general.pagos.length > 1){ 
          alert('Si dese agregar nuevamente el monto borre el listado de pagos');
          return false;
        }
        var self  = this;
        
        axios.post("{{url('start/facturas/abonos')}}",this.general).then(function(res){ //el servidor distribuye el pago
          if (!res.data.error){ self.general.pagos = res.data.data; }
          self.bandera = 0;
        })

        self.bandera = 1; // se incrementa la bandera
      },//.agregar
      /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::*/
      borrar: function(){ // reset de datos
        this.bandera        = 0;
        this.general.pagos  = [];
      },
      /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::*/
      aceptar: function(){

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
      validar_num_fact: function(){
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
      send: function(general){
        let confirmar = confirm('Desea continuar con la transacción');
 
        if(confirmar){
          axios.post("{{url('start/facturas')}}",general).then(function(res){
            console.log(res);
            if(res.data.error){
              alert(res.data.mensaje);
            } else {
              alert(res.data.mensaje);
              //recargar info 
              //recargar listado de pagos
            }
          })
        } else {
          return false;
        }
      },//.send
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
      }
    },
    /*:::::::::::::::::::::::::::::::::::::::::::::::::::::::*/
    created: function(){
        if(this.punto.id === 1){
          this.auto = true;
        }
    }
  })

</script>