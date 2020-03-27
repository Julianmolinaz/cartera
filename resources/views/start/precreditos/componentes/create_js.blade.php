<script src="/js/interfaces/filters.js"></script>
<script src="/js/interfaces/solicitud.js"></script>
<script src="/js/interfaces/producto.js"></script>
<script src="/js/vue/vee_es.js"></script>

<script>

  Vue.config.devtools = true
  Vue.use(VeeValidate);
  VeeValidate.Validator.localize("es");

  const obligacion = new Vue({
    el: "#obligacion",
    data: {
      user              : {!! json_encode($user) !!},
      cliente           : {!! json_encode($cliente) !!},
      carteras          : {!! json_encode($carteras) !!},
      productos         : {!! json_encode($productos) !!},
      proveedores       : {!! json_encode($proveedores) !!},
      estado            : {!! json_encode($estado) !!},
      estados_aprobacion: {!! json_encode($estados_aprobacion) !!},
      solicitud         : new Solicitud(),
      temp              : '', // producto temporal
      arr_estudios      : {!! json_encode($arr_estudios) !!},  
      arr_periodos      : {!! json_encode($arr_periodos) !!},
      rol_permitido     : 'Administrador',
      credito           : {!! json_encode($credito) !!},
      estados_credito   : {!! json_encode($estados_credito) !!},
      fecha_pago        : {!! json_encode($fecha_pago) !!},
      topes: {
        p_fecha_ini: '',
        s_fecha_ini: '',
        p_fecha_fin: '',
        s_fecha_fin: ''
      }

    },
    methods: {
      generarInputs(){

        this.temp = this.productos.find( element => element.id == this.solicitud.producto_id );

        this.solicitud.productos = [];

        switch (this.temp.id) {
          case 1:
            this.solicitud.productos.push(new Producto(this.temp.id,this.temp.nombre));
            break;
          case 2:
            this.solicitud.productos.push(new Producto(this.temp.id,this.temp.nombre));
            break;
          case 3:
            this.solicitud.productos.push(new Producto(this.temp.id,'SOAT'));
            this.solicitud.productos.push(new Producto(this.temp.id,'RTM'));
            break;
          default:
            break;
        }
      },
      changePeriodo(){
        if (this.solicitud.meses){
          var factor_periodo = (this.solicitud.periodo == 'Quincenal') ? 2 : 1;
          this.solicitud.cuotas = this.solicitud.meses * factor_periodo;
        }
        
        this.topes.p_fecha_ini = 1;

        if (this.solicitud.periodo == 'Quincenal'){
          this.topes.p_fecha_fin = 15;
          this.topes.s_fecha_ini = 16;
          this.topes.s_fecha_fin = 30;
        } else {
          this.solicitud.s_fecha = '';
          this.topes.p_fecha_fin = 30;
        }
      },
      changeMeses(){
        if (this.solicitud.periodo){
          var factor_periodo = (this.solicitud.periodo == 'Quincenal') ? 2 : 1;
          this.solicitud.cuotas = this.solicitud.meses * factor_periodo;
        } else {
          alert('Se requiere el periodo');
        }
      },
      onSubmit(){
        var self = this;
        
        this.$validator.validate()
          .then( validate => {
            if(validate){
              self.send();
            } else {
              alert('Por favor complete correctamente todos los campos requeridos.');
            }
          })
      },
      send(){

        if(this.estado == 'creacion') {
          this.sendPorCreacionDeSolicitud();
        } else if ( this.estado == 'edicion_solicitud') {
          this.sendPorEdicionDeSolicitud();
        } else if (this.estado == 'edicion_credito') {
          this.sendPorEdicionDeCredito();
        }
      },
      sendPorCreacionDeSolicitud() {
        this.solicitud.cliente_id = this.cliente.id;

        axios.post('/start/precreditos',this.solicitud)
          .then( res => {
            alert(res.data.message);
            if (res.data.error) {
              console.log(res.data.dat);
            }

            window.open("{{url('/start/precreditos')}}/"+ res.data.dat.id +"/ver");
          })
          .catch( error => {
            if (error.response.headers.connection == 'close') {
                // window.location.href = "{{url('/log')}}";
            }
          });
      },
      sendPorEdicionDeSolicitud() {

        axios.put('/start/precreditos/'+this.solicitud.id,this.solicitud)
          .then( res => {
            if (res.data.error) {
              alert(res.data.message);
              console.log(res.data.dat);
            } else {
              alert(res.data.message);
              window.open("{{url('/start/precreditos')}}/"+ res.data.dat.id +"/ver");
            }
          })
          .catch( error => {
            if (error.response.headers.connection == 'close') {
                // window.location.href = "{{url('/log')}}";
            }
          });
      },
      sendPorEdicionDeCredito() {
        
        var data = {
          'solicitud' : this.solicitud,
          'credito'   : this.credito,
          'fecha_pago': this.fecha_pago
        };
        
        axios.put('/start/creditos/'+this.credito.id,data)
          .then( res => {

            if (res.data.error) {
              alert(res.data.message);
              console.log(res.data.dat);
            } else {
              alert(res.data.message);
              window.open("{{url('/start/precreditos')}}/"+ res.data.dat +"/ver");
            }
          })
          .catch( error => {
            if (error.response.headers.connection == 'close') {
                //window.location.href = "{{url('/log')}}";
                console.log(error)
            }
          });
      },
      refresh(){
        if (this.estado == 'creacion') {
          window.location.href = "{{url('/start/precreditos')}}/"+this.cliente.id;
        } else if( this.estado == 'edicion_solicitud') {
          window.location.href = "{{url('/start/precreditos')}}/"+this.solicitud.id+"/edit";
        } else {
          window.location.href = "{{url('/start/creditos')}}/"+this.credito.id+"/edit";
        }
      }
    },
    filters: {
      miles(value) {
        if(value)
          return '$ '+formatVue(value);
        else 
          return '';
      }
    },
    created(){

      if (this.estado == 'creacion') {
        this.solicitud.aprobado = 'En estudio';
      }
      else if (this.estado == 'edicion_solicitud' || this.estado == 'edicion_credito') {
        let precredito = {!! json_encode($precredito) !!};
        this.solicitud =  precredito;
        this.solicitud.productos = {!! json_encode($arr_productos) !!}
        this.changePeriodo();
        console.log(this.credito);
      }

    }
  });

</script>

<style scoped>
  ._has-error {
    border-color: red;
  }
  .sm {
    height: 25px;
    font-size: .8em;
  }

  .form-sm {
    margin-bottom: 0px;
    padding: 0px 7px;
  }
  
  .text-sm {
    font-size: .8em;
  }

  spam {
    margin-top: 2px;
  }
</style>
