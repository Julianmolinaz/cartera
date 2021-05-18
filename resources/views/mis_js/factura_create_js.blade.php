<script>

var main = new Vue({
    el: '#main',
    data: {
        user            : {!! json_encode($user) !!},
        punto           : {!! json_encode($punto) !!},
        punto_auto      : false,        //permite ver el boton generador del autoincremento
        general : {                     //objeto que se envia al servidor para crear la factura
            num_fact    : '',           // numero de factura
            fecha       : '',           // fecha de la factura
            monto       : '',           // valor a pagar
            tipo_pago   : 'Efectivo',   // puede ser efectivo o consignacion
            auto        : false,        // activa o desactiva el btn Consecutivo Auto 
            pagos       : [],           //listado de pagos
            banco       : '',           //banco por donde se hace la consignacion
            credito_id  : {!! json_encode($credito->id) !!},
            num_consignacion: ''
        },
        bandera                 : 0,    // se pone en uno cuando se hace el pago
        credito                 : {!! json_encode($credito) !!}, //objeto crédito
        mover_fecha             : [],   //contenedor de la cuota parcial sin mover fecha
        status_mover_fecha      : false, //se mueve la fecha si es true
        cta_parcial_ini_origin  :'',    //contenedor de la fecha inicial original cta parcial
        cta_parcial_fin_origin  :'',    //contenedor de la fecha final original cta parcial
        message                 : '',   //alerta con mesajes o notificaciones en generador de pagos
        message2                : '',   //alerta con mesajes o notificaciones en listado de pagos generados
    },
    methods: {
        set_auto: function(){           // activa o desactiva el consecutivo automatico
            this.general.auto       = !this.general.auto;
            if (this.general.auto) {    // si el consecutivo es auto resetea num_fact y fecha
                this.general.num_fact = '';
                this.general.fecha    = '';
            }
        },
        //distribuye el monto en el listado de pagos
        async agregar () {
		
	    console.log('agregar')

            if (this.general.monto === '') { 
                alertify.alert('Atención', 'Se requiere el monto');  
                return false; 
            } 

            await this.validarPagosRecientes();

            const res = await axios.post("{{url('start/facturas/abonos')}}", this.general);

            if (!res.data.error) { 
                this.general.pagos = res.data.dat; 
                self.mover_fecha   = res.data.cta_parcial_sin_movimiento_de_fecha;
            }     
        },
        async validarPagosRecientes() {
            var data = {
                monto: this.general.monto, 
                credito_id: this.general.credito_id
            };

            const res = await axios.post('/api/recibos/recibos-recientes', data);
	    console.log({res})

            if (res.data.dat == true) {
                alertify.alert('Atención', 'Existe un pago reciente para este cliente');
            }

        },
        borrar () { 
            this.bandera        = 0;
            this.general.pagos  = [];
            this.message        = '';
            this.message2       = '';
        },
        async aceptar () {        //facturar
            var validacion = await this.validar_fact();
       
            if (validacion.error) {
                alertify.alert('Alerta', validacion.message);
                return false;
            } 

            if (this.general.auto) {
                await this.send(this.general);
            } else {
                await this.validar_num_fact();
            }
        },
        // valida que si el numero de factura existe (true)
        async validar_num_fact () { 

            const res = axios.get( "{{url('start/facturas')}}/" + this.general.num_fact + "/consultar_factura" )

            if(!res.data){
                this.send( this.general );
            } else {
                alertify.alert('Atención', 'Ya existe otra recibo con el mismo número');
            }
     
            return status;
        },
        //envia la data de la factura al servidor
        async send (general) {    

            if (confirm('Desea continuar con la transacción')) {
                const res = await axios.post("{{url('start/facturas')}}", general);

                if (res.data.error) {
                    alertify.alert('Error =(',res.data.mensaje);
                } else {
                    await alertify.success(res.data.mensaje, 2 , function() {
                        document.location.href = "{{route('start.facturas.create',$credito->id)}}";
                    });
                }

            } else {
                alertify.error('Operación cancelada');
            }
        },
        validar_fact: function(){
            var str = ''; // contenedor del mensaje de error

            if (this.general.num_fact === '' && this.general.auto === false) { //validar num_fact si auto === false
                str += 'Se requiere el número de factura \n'; 
            }
            
            if (this.general.fecha === '' && this.general.auto === false) {//validar fecha si auto === false
                str += 'Se requiere la fecha de la factura\n'; 
            }
            
            if (this.general.pagos.length < 2) {//validar pagos
                str += 'Se requiere agregar pagos a la factura'; 
            }

            if (str != '') { //valor de retorno
                return {
                    error:true, message: str
                };
            } else {
                return {
                    error:false
                };
            }
        },
        //permite modificar la fecha para cuota parcial
        mover_fecha_parcial (index) {
            var status = this.status_mover_fecha = !this.status_mover_fecha;

            if (status) {
                this.cta_parcial_ini_origin = this.general.pagos[index]['ini'].slice();
                this.cta_parcial_fin_origin = this.general.pagos[index]['fin'].slice();
                this.general.pagos[index]['ini'] = this.mover_fecha.ini;
                this.general.pagos[index]['fin'] = this.mover_fecha.fin;
            } else {
                this.general.pagos[index]['ini'] = this.cta_parcial_ini_origin;
                this.general.pagos[index]['fin'] = this.cta_parcial_fin_origin;
            }

            this.revisar_pagos(index);
        },
        set_banco() {
            if (this.general.tipo_pago == 'Consignacion') {
          
                $('#banco_modal').modal('show');
            }
        }
    },
    created: function(){
        this.punto_auto = true;
    },
    mounted: function(){
        if(this.credito.castigada == 'Si'){
            $message = 'Atención!, esta es una cartera castigada';
	        alertify.notify($message, 'error', 5);
        }
    }
  })
</script>
