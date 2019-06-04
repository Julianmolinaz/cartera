<script>
    var Bus = new Vue()
    var create_egreso = new Vue({
        el:"#create_egreso",
        data:{
            egreso:{
                user         : '',
                user_nomina_id: '', //usuario referenciado por nómina
                concepto     : '',
                banco_id     : '',
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
            users          : '',
            show_providers : false, //true muestra el listado de proveedores
            show_bancos    : false,
            show_users     : false
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

                this.egreso.user         = '';
                this.egreso.banco_id     = '';
                this.egreso.proveedor_id = null; 
                this.egreso.tipo         = '';
                this.egreso.valor        = ''; 
                this.egreso.fecha        = '';
                this.egreso.num_consignacion= ''; 
                this.egreso.observaciones = '';

                this.validate_type();
            
                if(this.egreso.concepto == "Pago a proveedores") {
                    this.show_providers = true
                    this.show_users = false
                } 
                else if(this.egreso.concepto == "Nómina") {
                    this.getUsers();
                    this.show_providers = false
                    this.show_users = true
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
                this.egreso.user         = '';
                this.egreso.concepto     = ''; 
                this.egreso.banco_id     = '';
                this.egreso.proveedor_id = null; 
                this.egreso.tipo         = '';
                this.egreso.valor        = ''; 
                this.egreso.fecha        = '';
                this.egreso.num_consignacion= ''; 
                this.egreso.observaciones = '';
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
            getUsers(){
                var self = this
                axios.get('/admin/users/get_users')
                    .then(function(res){
                        if(res.data.error){
                            alert(res.data.message)
                        }
                        else {
                            self.users = res.data.dat
                        }
                    })
            },
            asignar_cuenta(){
                this.egreso.banco_id = this.egreso.user.banco_id
                this.egreso.user_nomina_id = this.egreso.user.id
            }           
        },
        created(){
            this.get_data()
        }
    })
</script>